<?php session_start(); ?>
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

            </div>
        </nav>
    </header>

    <?php
    // Cada linha é um card 
    // Para add as imagem precisam estar na pasta imagens/vestidos/
    $produtos = [
        ["nome" => "Vestido Azul Elegante", "descricao" => "Perfeito para ocasiões especiais.",   "preco" => "129,90", "imagem" => "azul.jpeg"],
        ["nome" => "Blusa de Frio Cinza",   "descricao" => "Conforto e estilo para o dia a dia.", "preco" => "89,90",  "imagem" => "cinza.jpeg"],
        ["nome" => "Vestido Rosa",          "descricao" => "Breve descrição do produto da loja.", "preco" => "59,90",  "imagem" => "rosa.jpeg"],
        ["nome" => "Vestido Verde",         "descricao" => "Breve descrição do produto da loja.", "preco" => "79,90",  "imagem" => "verde.jpeg"],
        ["nome" => "Tomara que Caia",       "descricao" => "Otimo para festas.", "preco" => "67,90",  "imagem" => "vermelho_pequeno.jpeg"],
        ["nome" => "Vestido Xadrez Marrom", "descricao" => "Breve descrição do produto da loja.", "preco" => "86,90",  "imagem" => "vestido_midi_xadrez_marrom.jpg"],
        ["nome" => "Tomara que Caia Branco","descricao" => "Breve descrição do produto da loja.", "preco" => "42,90",  "imagem" => "tomara_que_caia_branco_coquette.jpg"],
        ["nome" => "Vestido Vermelho",      "descricao" => "Breve descrição do produto da loja.", "preco" => "88,90",  "imagem" => "vermelho.jpeg"],
        ["nome" => "Tomara que Caia Preto", "descricao" => "Breve descrição do produto da loja.", "preco" => "60,90",  "imagem" => "tomara_que_caia_preto.jpg"],
        ["nome" => "vestido azul",         "descricao" => "Breve descrição do produto da loja.", "preco" => "99,90",  "imagem" => "vestido_long_azul_rosa.jpg"],
        ["nome" => "Vestido Marrom",        "descricao" => "Breve descrição do produto da loja.", "preco" => "134,90",  "imagem" => "vestido_long_marrom.jpg"],
        ["nome" => "Vestido Preto",         "descricao" => "Breve descrição do produto da loja.", "preco" => "96,90",  "imagem" => "vestido_long_preto.jpg"],
        ["nome" => "Vestido Azul Bebe",     "descricao" => "Breve descrição do produto da loja.", "preco" => "34,90",  "imagem" => "vestido_midi_azul_bebe.jpg"],
        ["nome" => "Vestido Bege Coquette", "descricao" => "Breve descrição do produto da loja.", "preco" => "80,90",  "imagem" => "vestido_midi_bege_coquette.jpg"],
        ["nome" => "Vestido Branco Coquette","descricao" => "Breve descrição do produto da loja.", "preco" => "79,90",  "imagem" => "vestido_midi_branco_coquette.jpg"],
        ["nome" => "Vestido Branco",         "descricao" => "Breve descrição do produto da loja.", "preco" => "89,90",  "imagem" => "vestido_midi_preto_coquette.jpg"],
    ];
    ?>

    <main class="container my-5 pt-5">
        <h2 class="text-center mb-4">Destaques da Semana</h2>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php foreach ($produtos as $p) { ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="../imagens/vestidos/<?php echo htmlspecialchars($p['imagem']); ?>"
                             class="card-img-top"
                             alt="<?php echo htmlspecialchars($p['nome']); ?>"
                             style="object-fit: cover; height: 280px;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate"><?php echo htmlspecialchars($p['nome']); ?></h5>
                            <p class="card-text text-muted small"><?php echo htmlspecialchars($p['descricao']); ?></p>
                            <h6 class="mt-auto text-success fw-bold">R$ <?php echo htmlspecialchars($p['preco']); ?></h6>
                            <a href="#" class="btn btn-dark w-100 mt-2"><i class="bi bi-cart-plus me-2"></i>Comprar</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>