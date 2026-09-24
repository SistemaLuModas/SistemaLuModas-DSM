<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Lu Moda para Toda Família - loja de roupas femininas.">
        <title>Lu Moda </title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- NÃO MEXA NISSO, FOI O QUE QUEBROU O CÓDIGO DA ULTIMA VEZ-->
        <link rel="stylesheet" href="../CSS/styles.css">
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
                        <li class="nav-item pad" style="padding-left: 60px;">
                            <a class="nav-link" href="login.php">👤   Entre ou Cadastre-se</a>
                        </li>

                    </ul>
                </div>

            </div>
        </nav>
    </header>


    <main>

        <!-- Banner da empresa -->
        <section id="inicio" class="hero-section">
            <div class="container">

                <div class="row align-items-center min-vh-100">
                    <div class="text-center">
                        <h1> Blusas </h1> 
                    </div>
                    </div>

                    <div class="col-lg-6 text-center mt-5 mt-lg-0">

                    </div>

                </div>

            </div>
        </section>




        <!-- Contato da moça -->
        <section id="contato" class="contact-section py-5">

            <div class="container">

                <div class="contact-box text-center">

                    <span>FALE COM A LU MODA</span>

                    <h2>
                        Gostou de algum look?
                    </h2>

                    <p>
                        Entre em contato e descubra nossas peças disponíveis.
                    </p>


                    <div class="d-flex justify-content-center gap-3 flex-wrap mb-5">

                        <a href="https://chat.whatsapp.com/G7AgsUbjkBy5aiS4tPpKp6" target="_blank" rel="noopener" class="btn btn-light btn-lg">
                            <i class="bi bi-whatsapp"></i>
                            WhatsApp
                        </a>

                        <a href="https://www.instagram.com/lumodas2.0?stkn=ZDNlZDc0MzIxNw%3D%3D" target="_blank" rel="noopener" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-instagram"></i>
                            Instagram
                        </a>

                    </div>

                    <form class="contact-form mx-auto needs-validation" id="formContato" novalidate>

                        <div class="row g-3 text-start">

                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome" required>
                                <div class="invalid-feedback">Digite seu nome.</div>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="voce@email.com" required>
                                <div class="invalid-feedback">Digite um e-mail válido.</div>
                            </div>

                            <div class="col-12">
                                <label for="mensagem" class="form-label">Mensagem</label>
                                <textarea class="form-control" id="mensagem" name="mensagem" rows="4" placeholder="Conte pra gente o que você procura" required></textarea>
                                <div class="invalid-feedback">Escreva uma mensagem.</div>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-light btn-lg px-5">Enviar mensagem</button>
                            </div>

                        </div>

                    </form>


                </div>

            </div>

        </section>

    </main>


    <!-- Fim da PG -->
    <footer class="footer py-4">

        <div class="container">

            <div class="row align-items-center g-3">

                <div class="col-md-6 text-center text-md-start">

                    <address class="m-0">
                        Lu Moda &middot; Moda para toda família
                    </address>

                </div>

                <div class="col-md-6 text-center text-md-end">

                    <p class="m-0">
                        &copy; <span id="anoAtual">2026</span> Lu Moda. Todos os direitos reservados.
                    </p>

                </div>

            </div>

        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    </body>
</html>