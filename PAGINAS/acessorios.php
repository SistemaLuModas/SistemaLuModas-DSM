<?php session_start(); ?>
<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Lu Moda para Toda Família - loja de roupas femininas.">
        <title>Lu Moda </title>

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
        <link rel="icon" type="../imagens/png" href="../imagens/logo.png">
    </head>
    <body>
    <!-- ESSA É A NAVBAR, FIQUE ATENTO COM AS PASTAS PARA NÃO CAGAR TUDO -->
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
                            <?php if (isset($_SESSION["usuario_logado"])) { ?>
                                <i class="bi bi-person-circle" style="color: #FFFFFF;"></i>
                                <!-- Aqui é só pra mostrar o primeiro nome -->
                                Olá, <strong style="color: #FFFFFF";><?php echo explode(" ", $_SESSION["nome_usuario"])[0]; ?></strong>
                                | <a href="logout.php" style="color: #aeaeae;" >Sair</a>
                            <?php } else { ?>
                                <a href="login.php" style="color: #FFFFFF; text-decoration: none;">👤   Entre ou cadastre-se</a>
                            <?php } ?>
                        </li>

                    </ul>
                </div>

            </div>
        </nav>
    </header>

    <main class="container my-5 pt-5">
        <h2 class="text-center mb-4">Destaques da Semana</h2>
        
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            
            <!-- Card 1 -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="../imagens/azul.jpeg" class="card-img-top" alt="Vestido Azul" style="object-fit: cover; height: 280px;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate">Vestido Azul Elegante</h5>
                        <p class="card-text text-muted small">Perfeito para ocasiões especiais.</p>
                        <h6 class="mt-auto text-success fw-bold">R$ 129,90</h6>
                        <a href="#" class="btn btn-dark w-100 mt-2"><i class="bi bi-cart-plus me-2"></i>Comprar</a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="../imagens/cinza.jpeg" class="card-img-top" alt="Casaco Cinza" style="object-fit: cover; height: 280px;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate">Blusa de Frio Cinza</h5>
                        <p class="card-text text-muted small">Conforto e estilo para o dia a dia.</p>
                        <h6 class="mt-auto text-success fw-bold">R$ 89,90</h6>
                        <a href="#" class="btn btn-dark w-100 mt-2"><i class="bi bi-cart-plus me-2"></i>Comprar</a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="../imagens/rosa.jpeg" class="card-img-top" alt="Produto 3" style="object-fit: cover; height: 280px;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate">Produto Exemplo 3</h5>
                        <p class="card-text text-muted small">Breve descrição do produto da loja.</p>
                        <h6 class="mt-auto text-success fw-bold">R$ 59,90</h6>
                        <a href="#" class="btn btn-dark w-100 mt-2"><i class="bi bi-cart-plus me-2"></i>Comprar</a>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="../imagens/verde.jpeg" class="card-img-top" alt="Produto 4" style="object-fit: cover; height: 280px;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate">Produto Exemplo 4</h5>
                        <p class="card-text text-muted small">Breve descrição do produto da loja.</p>
                        <h6 class="mt-auto text-success fw-bold">R$ 79,90</h6>
                        <a href="#" class="btn btn-dark w-100 mt-2"><i class="bi bi-cart-plus me-2"></i>Comprar</a>
                    </div>
                </div>
            </div>

        </div>
    </main>

    
    <script src="https://jsdelivr.net"></script>
</body>
</html>
