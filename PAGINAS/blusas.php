<?php 
session_start();
include("../PHP/conexao.php");
include('./estruturaCarrinho.php');
$categoria = "blusas";

$stmt = mysqli_prepare($connect, "SELECT * FROM produtos WHERE categoria = ? ORDER BY id DESC");
mysqli_stmt_bind_param($stmt, "s", $categoria);
mysqli_stmt_execute($stmt);
$produtos = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);  



?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Lu Moda para Toda Família - loja de roupas femininas.">
        <title>Lu Moda</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- NÃO MEXA NISSO, FOI O QUE QUEBROU O CÓDIGO DA ULTIMA VEZ-->
        <link rel="stylesheet" href="../CSS/configuracoes_globais.css">
        <link rel="stylesheet" href="../CSS/tema_escuro.css?v=20261027-2">
        <link rel="stylesheet" href="../CSS/navbar.css">
        <link rel="stylesheet" href="../CSS/introducao.css">
        <link rel="stylesheet" href="../CSS/highlights.css">
        <link rel="stylesheet" href="../CSS/categorias.css">
        <link rel="stylesheet" href="../CSS/contatos.css">
        <link rel="stylesheet" href="../CSS/footer.css">
        <link rel="stylesheet" href="../CSS/about.css">
        <link rel="stylesheet" href="../CSS/login.css">
        <link rel="stylesheet" href="../CSS/media_queries.css">
        <link rel="icon" type="image/png" href="../imagens/logo.png">
        <link rel="stylesheet" href="../CSS/carrinho.css">
        <script src="../javascript/tema.js?v=20261027-2"></script>
    </head>
    <body>

    <!-- ESSA É A NAVBAR, FIQUE ATENTO COM AS PASTAS PARA NÃO CAGAR TUDO -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container">

                <a class="navbar-brand d-flex align-items-center" href="../index.php" aria-label="Lu Moda - início">
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
                            <?php if (isset($_SESSION["usuario_logado"])) { ?>
                                <i class="bi bi-person-circle" style="color: #FFFFFF;"></i>
                                Olá, <strong style="color: #FFFFFF;"><?php echo htmlspecialchars(explode(" ", $_SESSION["nome_usuario"])[0]); ?></strong>
                                | <a href="logout.php" style="color: #aeaeae;">Sair</a>
                            <?php } else { ?>
                                <a href="login.php" style="color: #FFFFFF; text-decoration: none;">👤 Entre ou cadastre-se</a>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
                <button class = "btnCarrinho" id = "btnCarrinho" ><i class="bi bi-handbag-fill"></i></button>
            </div>
        </nav>
    </header>

    <main class="container my-5 pt-5">
        <h2 class="text-center mb-4"><?= htmlspecialchars(CATEGORIAS[$categoria]) ?></h2>

        <?php if (!$produtos) { ?>
            <p class="text-center text-muted">Nenhum produto cadastrado nesta categoria ainda.</p>
        <?php } ?>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <!-- produtos é o dicioanrio total, posicao e o indice dele na volta e o item atual é o item da vez -->
             <!-- coloquei cada informacao pelo item atual do foreach -->
                <!-- no final e colocado o indice do botao, para no js ele puxar qual indice ouve o clicque e pegar todos os elementos dele -->
            <?php foreach ($produtos as $posicao => $itemAtual) {
                $esgotado = (int) $itemAtual['quantidade_estoque'] === 0;
            ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <?php if (!empty($itemAtual['imagem_url'])) { ?>
                            <img src="../<?= htmlspecialchars($itemAtual['imagem_url']) ?>"
                                 class="card-img-top <?= $esgotado ? 'opacity-50' : '' ?>"
                                 alt="<?= htmlspecialchars($itemAtual['nome']) ?>"
                                 style="object-fit: cover; height: 280px;">
                        <?php } else { ?>
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center text-secondary"
                                 style="height: 280px;">
                                <i class="bi bi-image fs-1"></i>
                            </div>
                        <?php } ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate"><?= htmlspecialchars($itemAtual['nome']) ?></h5>
                            <p class="card-text text-muted small"><?= htmlspecialchars($itemAtual['descricao'] ?? '') ?></p>
                            <h6 class="mt-auto text-success fw-bold">R$ <?= number_format((float) $itemAtual['preco'], 2, ',', '.') ?></h6>
                            <?php if ($esgotado) { ?>
                                <button class="btn btn-secondary w-100 mt-2" disabled>Esgotado</button>
                            <?php } else { ?>
                                <a href="#" class="btn btn-dark w-100 mt-2 btn btnComprar" data-id = "<?php echo $posicao ?>"><i class="bi bi-cart-plus me-2"></i>Comprar</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>

    <script>

        // verfica se o usuário está logado para add um item ao carrinho
        const usuarioLogado = <?= isset($_SESSION['usuario_logado']) ? 'true' : 'false' ?>;

        // essa parte cria uma variavel no php e atribui ela ao nome e email do usuario cadastrado
        <?php 
            $nomeUsuario = '';
            if (isset($_SESSION['nome_usuario'])){
                $nomeUsuario = $_SESSION['nome_usuario'];
            }
        
            $emailUsuario = '';
            if (isset($_SESSION['email_usuario'])){
                $emailUsuario = $_SESSION['email_usuario'];
            }
        ?>
        // coloca dentro de um objeto para puxar na mensagem do zapzap
        const dadosCliente = {
            nome: "<?php echo $nomeUsuario; ?>",
            email : "<?php echo $emailUsuario; ?>"
        }   
        // converte o antigo dicionario (ou onde estao as infos) em  js
        const produtosJS = <?php echo json_encode($produtos); ?>;
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../javascript/carrinho.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../javascript/whatsap.js"></script>
</body>
</html>