<?php
    session_start();
    include("../PHP/conexao.php");

    $erro = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = trim($_POST["nome"]);
        $cpf = preg_replace('/\D/', '', $_POST["cpf"] ?? '');
        $email = trim($_POST["email"]);
        $senha = $_POST["senha"];
        

    if ($nome == "" || $cpf == "" ||$email == "" || $senha == "") {
        $erro = "Preencha todos os campos.";
    } elseif (strlen($cpf) != 11) {
            $erro = "CPF inválido.<br>";
        } else {
            // Pra verificar se o email já existe
            $cad = mysqli_prepare($connect, "SELECT id FROM clientes WHERE email = ? or cpf = ?"); 
            mysqli_stmt_bind_param($cad, "ss", $email, $cpf);
            mysqli_stmt_execute($cad);
            mysqli_stmt_store_result($cad);

        if (mysqli_stmt_num_rows($cad) > 0) {
            $erro = "Email ou CPF já cadastrado.<br>";
        } else {
            // Aqui insere o novo cliente
           $cad2 = mysqli_prepare($connect, "INSERT INTO clientes (nome, cpf, email, senha) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($cad2, "ssss", $nome, $cpf, $email, $senha);
            mysqli_stmt_execute($cad2);      

        // Manda essa bomba pra pagina de login 
        header("location: login.php?cadastro=ok");
        exit;
        }
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lu Modas | Cadastro</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Lu Moda para Toda Família - loja de roupas femininas.">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <link rel="stylesheet" href="../CSS/login.css">
        <link rel="stylesheet" href="../CSS/navbar.css">
        <link rel="stylesheet" href="../CSS/configuracoes_globais.css">
        <link rel="stylesheet" href="../CSS/contatos.css">
        <link rel="stylesheet" href="../CSS/introducao.css">
        <link rel="stylesheet" href="../CSS/footer.css">

        <link rel="icon" type="../imagens/png" href="../imagens/logo.png">
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
                        <li class="nav-item pad" style="padding-left: 60px;">
                            <a class="nav-link" href="login.php"style="color: #FFFFFF; text-decoration: none;">👤   Entre ou Cadastre-se</a>
                        </li>

                    </ul>
                </div>

            </div>
        </nav>
    </header>
       
    <!-- A página vai ficar toda feia, apenas estou implantando o CRUD, boa sorte Front-end -->
        
    <!-- Cadastro  -->
    <section id="inicio" class="hero-section min-vh-100 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="caixa-login p-4 rounded-3 shadow">
                    
                    <h3 class="mb-4 text-center">Cadastre-se</h3>

                    <?php if ($erro != "") { ?>
                        <div> <?php echo $erro; ?> </div>
                    <?php } ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="nomeInput" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control"  name="nome" placeholder="Nome">
                        </div>                         
                        
                        <div class="mb-3">
                            <label for="cpfInput" class="form-label">CPF</label>
                            <input type="text" class="form-control" name="cpf" placeholder="CPF" maxlength="11">
                        </div>

                        <div class="mb-3">
                            <label for="emailInput" class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>

                        <div class="mb-3">
                            <label for="senhaInput" class="form-label">Senha</label>
                            <input type="password" class="form-control" name="senha" placeholder="Senha">
                        </div>
                <button type="submit" class="btnEnviar btn btn-light w-100 mt-3 fw-bold btnEnviar">Cadastrar</button>
                
            </form>

            <p><a href="login.php" style="color: #000000;">Já tenho conta</a></p>
        </div>
    </body>
</html>