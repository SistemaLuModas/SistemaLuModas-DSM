<?php
    session_start();
    include("../PHP/conexao.php");

    if (!isset($_SESSION["adm_logado"])) {
        header("location: login.php");
        exit;
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    mysqli_set_charset($connect, "utf8mb4");

    if (isset($_GET["sair"])) {
        session_unset();
        session_destroy();
        header("location: login.php");
        exit;
    }
    const PASTA_IMAGENS_FS  = __DIR__ . "/../imagens/produtos/"; // caminho no disco
    const PASTA_IMAGENS_URL = "imagens/produtos/";               // caminho salvo no BD
    const TAMANHO_MAX_IMG   = 2 * 1024 * 1024;                   // 2 MB
    const TIPOS_IMG = [
        "image/jpeg" => "jpg",
        "image/png"  => "png",
        "image/webp" => "webp",
        ];

    function  e($valor): string
    {
        return htmlspecialchars((string) $valor, ENT_QUOTES, "UTF-8");
    }

    function csrf_token(): string
    {
        if (empty($_SESSION["csrf"])) {
        $_SESSION["csrf"] = bin2hex(random_bytes(32));
    }
    return $_SESSION["csrf"];
    }
    
    function csrf_valido(): bool
    {
        return isset($_POST["csrf"], $_SESSION["csrf"])
            && hash_equals($_SESSION["csrf"], (string) $_POST["csrf"]);
    }
    
    function voltar(string $tipo, string $texto): void
    {
        $_SESSION["flash"] = ["tipo" => $tipo, "texto" => $texto];
        header("location: admin.php");
        exit;
    }
    
    $flash = $_SESSION["flash"] ?? null;
    unset($_SESSION["flash"]);
    
    $erros = [];
    $form  = ["nome" => "", "preco" => "", "quantidade" => "0", "descricao" => ""];
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
 
    if (!csrf_valido()) {
        http_response_code(403);
        exit("Requisição inválida (token expirado ou arquivo grande demais). Volte e tente novamente.");
    }
 
    $acao = $_POST["acao"] ?? "";

    // ===== ADICIONAR PRODUTO =====
    if ($acao === "adicionar") {
        $form["nome"]       = trim($_POST["nome"] ?? "");
        $form["preco"]      = trim($_POST["preco"] ?? "");
        $form["quantidade"] = trim($_POST["quantidade"] ?? "0");
        $form["descricao"]  = trim($_POST["descricao"] ?? "");

    if ($form["nome"] === "" || mb_strlen($form["nome"]) > 100) {
        $erros[] = "Informe um nome de até 100 caracteres.";
        }

    // Preço (aceita 49,90 ou 49.90)
        $preco = filter_var(str_replace(",", ".", $form["preco"]), FILTER_VALIDATE_FLOAT);
        if ($preco === false || $preco < 0 || $preco > 99999999.99) {
            $erros[] = "Informe um preço válido (ex.: 49,90).";
        }

    // Estoque
        $quantidade = filter_var($form["quantidade"], FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]]);
        if ($quantidade === false) {
            $erros[] = "A quantidade em estoque deve ser um número inteiro maior ou igual a 0.";
        }

    // Imagem (deixei opcional)
        $imagem_url  = null;
        $nome_final  = null;
        $arquivo_tmp = null;

    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] !== UPLOAD_ERR_NO_FILE) {
            $img = $_FILES["imagem"];
 
            if ($img["error"] !== UPLOAD_ERR_OK) {
                $erros[] = "Não foi possível enviar a imagem (código " . (int) $img["error"] . ").";
            } elseif ($img["size"] > TAMANHO_MAX_IMG) {
                $erros[] = "A imagem deve ter no máximo 2 MB.";
            } else {
                // Confere o tipo real do arquivo (não confia na extensão)
                $mime = (new finfo(FILEINFO_MIME_TYPE))->file($img["tmp_name"]);
                if (!isset(TIPOS_IMG[$mime])) {
                    $erros[] = "Formato de imagem não permitido. Use JPG, PNG ou WEBP.";
                } else {
                    $nome_final  = bin2hex(random_bytes(8)) . "." . TIPOS_IMG[$mime];
                    $arquivo_tmp = $img["tmp_name"];
                    $imagem_url  = PASTA_IMAGENS_URL . $nome_final;
                }
            }
        }


        if (!$erros) {
            // Move a imagem para a pasta definitiva
            if ($arquivo_tmp !== null) {
                if (!is_dir(PASTA_IMAGENS_FS)) {
                    mkdir(PASTA_IMAGENS_FS, 0755, true);
                }
                if (!move_uploaded_file($arquivo_tmp, PASTA_IMAGENS_FS . $nome_final)) {
                    $erros[]    = "Falha ao salvar a imagem no servidor (verifique as permissões da pasta).";
                    $imagem_url = null;
                }
            }
        }
 
        if (!$erros) {
            try {
                $sql  = "INSERT INTO produtos (nome, preco, quantidade_estoque, descricao, imagem_url)
                         VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($connect, $sql);
                $preco_txt = number_format($preco, 2, ".", "");
                mysqli_stmt_bind_param($stmt, "ssiss", $form["nome"], $preco_txt, $quantidade, $form["descricao"], $imagem_url);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
 
                voltar("success", "Produto \"" . $form["nome"] . "\" adicionado ao catálogo.");
            } catch (mysqli_sql_exception $ex) {
                // Se o INSERT falhou, apaga a imagem que acabou de ser enviada
                if ($nome_final !== null && is_file(PASTA_IMAGENS_FS . $nome_final)) {
                    unlink(PASTA_IMAGENS_FS . $nome_final);
                }
                $erros[] = "Erro ao salvar no banco de dados.";
            }
        }
    }

    // ===== REMOVER PRODUTO =====
    if ($acao === "remover") {
        $id = filter_var($_POST["id"] ?? "", FILTER_VALIDATE_INT);
 
        if ($id === false || $id < 1) {
            voltar("danger", "Produto inválido.");
        }
 
        try {
            $stmt = mysqli_prepare($connect, "SELECT nome, imagem_url FROM produtos WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $produto = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
            mysqli_stmt_close($stmt);
 
            if (!$produto) {
                voltar("warning", "Esse produto não existe mais.");
            }
 
            $stmt = mysqli_prepare($connect, "DELETE FROM produtos WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
 
            if (!empty($produto["imagem_url"])) {
                $arquivo = PASTA_IMAGENS_FS . basename($produto["imagem_url"]);
                if (is_file($arquivo)) {
                    unlink($arquivo);
                }
            }
 
            voltar("success", "Produto \"" . $produto["nome"] . "\" removido do catálogo.");
        } catch (mysqli_sql_exception $ex) {
            // 1451 = existe venda ligada a esse produto (chave estrangeira em itens_venda)
            if ((int) $ex->getCode() === 1451) {
                voltar(
                    "warning",
                    "Esse produto já foi vendido e não pode ser excluído (isso apagaria o histórico de vendas). " .
                    "Para tirá-lo da loja, zere o estoque dele."
                );
            }
            voltar("danger", "Erro ao remover o produto.");
        }
    }
    }
    
    // ---------- Dados para a tela ----------
    $resultado = mysqli_query($connect, "SELECT * FROM produtos ORDER BY id DESC");
    $produtos  = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    $total     = count($produtos);
    $sem_estoque = 0;
    foreach ($produtos as $p) {
        if ((int) $p["quantidade_estoque"] === 0) {
            $sem_estoque++;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="../imagens/logo.png">
    
    <link rel="stylesheet" href="../CSS/configuracoes_globais.css">
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/introducao.css">
    <link rel="stylesheet" href="../CSS/highlights.css">
    <link rel="stylesheet" href="../CSS/categorias.css">
    <link rel="stylesheet" href="../CSS/contatos.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/about.css">
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="../CSS/media_queries.css">

    <title>Admin | Lu Moda</title>
</head>
<body>
    
    <style>
        .thumb { width: 56px; height: 56px; object-fit: cover; border-radius: 8px; background: #e9ecef; }
        .thumb-vazio { width: 56px; height: 56px; border-radius: 8px; background: #e9ecef;
                       display: flex; align-items: center; justify-content: center; color: #adb5bd; }
        .descricao { max-width: 280px; }
    </style>
</head>
<body>
 
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container">

                <a class="navbar-brand d-flex align-items-center" href="../index.php"
                    aria-label="Lu Moda - início">
                    <img src="../imagens/logo.png" alt="Logo Lu Moda" class="logo">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#menuPrincipal" aria-controls="menuPrincipal"
                    aria-expanded="false" aria-label="Abrir menu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="menuPrincipal">
                    <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                        <li class="nav-item pad" style="padding-left: 60px; color: #FFFFFF;">

                            <!-- Verifica se o usuario tá logado e troca o header da página -->
                            <?php if (isset($_SESSION["usuario_logado"]) || isset($_SESSION["adm_logado"])) {
                                $nome_exibido = isset($_SESSION["nome_usuario"])
                                    ? explode(" ", $_SESSION["nome_usuario"])[0]
                                    : "Admin";
                                $link_sair = isset($_SESSION["adm_logado"]) ? "admin.php?sair=1" : "logout.php";
                            ?>
                                <i class="bi bi-person-circle" style="color: #FFFFFF;"></i>
                                Olá, <strong style="color: #FFFFFF;"><?= e($nome_exibido) ?></strong>
                                | <a href="<?= $link_sair ?>" style="color: #aeaeae;">Sair</a>
                            <?php } else { ?>
                                <a href="login.php" style="color: #FFFFFF; text-decoration: none;">👤 Entre ou cadastre-se</a>
                            <?php } ?>
                        </li>

                    </ul>
                </div>

            </div>
        </nav>
    </header>
 
<main class="container pb-4" style="padding-top: 100px;">
 
    <?php if ($flash): ?>
        <div class="alert alert-<?= e($flash["tipo"]) ?> alert-dismissible fade show" role="alert">
            <?= e($flash["texto"]) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    <?php endif; ?>
 
    <?php if ($erros): ?>
        <div class="alert alert-danger">
            <strong>Não foi possível salvar:</strong>
            <ul class="mb-0">
                <?php foreach ($erros as $erro): ?>
                    <li><?= e($erro) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
 
    <!-- Resumo -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card shadow-sm"><div class="card-body">
                <div class="text-muted small">Produtos no catálogo</div>
                <div class="fs-3 fw-bold"><?= $total ?></div>
            </div></div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card shadow-sm"><div class="card-body">
                <div class="text-muted small">Sem estoque</div>
                <div class="fs-3 fw-bold <?= $sem_estoque ? "text-danger" : "" ?>"><?= $sem_estoque ?></div>
            </div></div>
        </div>
    </div>
 
    <!-- Formulário: novo produto -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white fw-bold">
            <i class="bi bi-plus-circle"></i> Adicionar produto
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" class="row g-3">
                <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
                <input type="hidden" name="acao" value="adicionar">
 
                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" maxlength="100"
                           value="<?= e($form["nome"]) ?>" required>
                </div>
 
                <div class="col-6 col-md-3">
                    <label for="preco" class="form-label">Preço (R$)</label>
                    <input type="text" class="form-control" id="preco" name="preco" inputmode="decimal"
                           placeholder="49,90" value="<?= e($form["preco"]) ?>" required>
                </div>
 
                <div class="col-6 col-md-3">
                    <label for="quantidade" class="form-label">Estoque</label>
                    <input type="number" class="form-control" id="quantidade" name="quantidade" min="0"
                           value="<?= e($form["quantidade"]) ?>" required>
                </div>
 
                <div class="col-12">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="3"><?= e($form["descricao"]) ?></textarea>
                </div>
 
                <div class="col-12">
                    <label for="imagem" class="form-label">Imagem (JPG, PNG ou WEBP, até 2 MB)</label>
                    <input type="file" class="form-control" id="imagem" name="imagem"
                           accept="image/jpeg,image/png,image/webp">
                </div>
 
                <div class="col-12">
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-check-lg"></i> Salvar produto
                    </button>
                </div>
            </form>
        </div>
    </div>
 
    <!-- Lista de produtos -->
    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold">
            <i class="bi bi-box-seam"></i> Catálogo
        </div>
 
        <?php if (!$produtos): ?>
            <div class="card-body text-muted">Nenhum produto cadastrado ainda.</div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Foto</th>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th>Descrição</th>
                            <th class="text-end">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($produtos as $p): ?>
                        <tr>
                            <td>
                                <?php if (!empty($p["imagem_url"])): ?>
                                    <img class="thumb" src="../<?= e($p["imagem_url"]) ?>" alt="<?= e($p["nome"]) ?>">
                                <?php else: ?>
                                    <div class="thumb-vazio"><i class="bi bi-image"></i></div>
                                <?php endif; ?>
                            </td>
                            <td><?= (int) $p["id"] ?></td>
                            <td class="fw-semibold"><?= e($p["nome"]) ?></td>
                            <td>R$ <?= number_format((float) $p["preco"], 2, ",", ".") ?></td>
                            <td>
                                <?php if ((int) $p["quantidade_estoque"] === 0): ?>
                                    <span class="badge text-bg-danger">Esgotado</span>
                                <?php else: ?>
                                    <?= (int) $p["quantidade_estoque"] ?>
                                <?php endif; ?>
                            </td>
                            <td class="descricao text-muted small text-truncate"><?= e($p["descricao"]) ?></td>
                            <td class="text-end">
                                <form method="post" class="d-inline"
                                      onsubmit="return confirm('Remover «<?= e(addslashes($p["nome"])) ?>» do catálogo?');">
                                    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
                                    <input type="hidden" name="acao" value="remover">
                                    <input type="hidden" name="id" value="<?= (int) $p["id"] ?>">
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i> Remover
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
 
</main>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</body>
</html>