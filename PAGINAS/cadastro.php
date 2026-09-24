<?php
    session_start();
    include("../PHP/conexao.php");

    $erro = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = trim($_POST["nome"]);
        $email = trim($_POST["email"]);
        $senha = $_POST["senha"];
        

    if ($nome == "" || $email == "" || $senha == "") {
        $erro = "Preencha todos os campos.";
    } else {
        // Pra verificar se o email já existe
        $cad = mysqli_prepare($connect, "SELECT id FROM clientes WHERE email = ?"); 
        mysqli_stmt_bind_param($cad, "s", $email);
        mysqli_stmt_execute($cad);
        mysqli_stmt_store_result($cad);

        if (mysqli_stmt_num_rows($cad) > 0) {
            $erro = "Esse email já está cadastrado.";
        } else {
            // Aqui insere o novo cliente
           $cad2 = mysqli_prepare($connect, "INSERT INTO clientes (nome, email, senha) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($cad2, "sss", $nome, $email, $senha);
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
    </head>
     <!-- A página vai ficar toda feia, apenas estou implantando o CRUD, boa sorte Front-end -->
    <div>
        <h2>Criar conta</h2>

        <?php if ($erro != "") { ?>
            <div> <?php echo $erro; ?> </div>
        <?php } ?>

        <form method="POST">
            <input type="text" name="nome" placeholder="Nome">
            <input type="text" name="email" placeholder="Email">
            <input type="password" name="senha" placeholder="Senha">
            <button type="submit">Cadastrar</button>
            
        </form>

        <p><a href="login.php" style="color: #FFFFFF; text-decoration: none;">Já tenho conta</a></p>
    </div>
</html>