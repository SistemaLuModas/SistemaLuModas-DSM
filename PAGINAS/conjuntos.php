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
    // Para add as imagem precisam estar na pasta imagens/conjuntos/
    $produtos = [
        ["nome" => "Conjunto Casual",            "descricao" => "Perfeito para ocasiões especiais.",   "preco" => "129,90", "imagem" => "conjunto_casual.jpg"],
        ["nome" => "Conjunto Fofo",              "descricao" => "Conforto e estilo para o dia a dia.", "preco" => "89,90",  "imagem" => "conjunto_fofo.jpg"],
        ["nome" => "Conjunto Marrom",            "descricao" => "Breve descrição do produto da loja.", "preco" => "59,90",  "imagem" => "conjunto_marrom.jpg"],
        ["nome" => "Conjunto Preto",             "descricao" => "Breve descrição do produto da loja.", "preco" => "79,90",  "imagem" => "conjunto_preto.jpg"],
        ["nome" => "Conjunto Social",            "descricao" => "Otimo para festas.", "preco" => "67,90",  "imagem" => "conjunto_social.jpg"],
        ["nome" => "Conjunto Social Azul",       "descricao" => "Breve descrição do produto da loja.", "preco" => "86,90",  "imagem" => "conjunto_social2.jpg"],
        ["nome" => "Conjunto Verde",             "descricao" => "Breve descrição do produto da loja.", "preco" => "42,90",  "imagem" => "conjunto_verde.jpg"],
        ["nome" => "Conjunto Vermelho",          "descricao" => "Breve descrição do produto da loja.", "preco" => "88,90",  "imagem" => "conjunto_vermelho.jpg"],
        ["nome" => "Conjunto Vermelho Feminino", "descricao" => "Breve descrição do produto da loja.", "preco" => "60,90",  "imagem" => "conjunto_vermelho2.jpg"],
        ["nome" => "Conjunto Vermelho Casual",   "descricao" => "Breve descrição do produto da loja.", "preco" => "99,90",  "imagem" => "conjunto_vermelho3.jpg"],
        ["nome" => "Conjuntos Azul",             "descricao" => "Breve descrição do produto da loja.", "preco" => "134,90",  "imagem" => "conjuntos_azul.jpg"],
        ["nome" => "Conjuntos Bage",             "descricao" => "Breve descrição do produto da loja.", "preco" => "96,90",  "imagem" => "conjuntos_bage.jpg"],
        ["nome" => "Conjuntos Elegante",         "descricao" => "Breve descrição do produto da loja.", "preco" => "34,90",  "imagem" => "conjuntos_elegante.jpg"],
        ["nome" => "Conjuntos Jeans",            "descricao" => "Breve descrição do produto da loja.", "preco" => "80,90",  "imagem" => "conjuntos_jens.jpg"],
        ["nome" => "Conjuntos Marrom",           "descricao" => "Breve descrição do produto da loja.", "preco" => "79,90",  "imagem" => "conjuntos_marrom.jpg"],
        ["nome" => "Conjuntos Rosa",              "descricao" => "Breve descrição do produto da loja.", "preco" => "89,90",  "imagem" => "conjuntos_rosa.jpg"],
    ];
    ?>

    <main class="container my-5 pt-5">
        <h2 class="text-center mb-4">Destaques da Semana</h2>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php foreach ($produtos as $p) { ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="../imagens/conjuntos/<?php echo htmlspecialchars($p['imagem']); ?>"
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