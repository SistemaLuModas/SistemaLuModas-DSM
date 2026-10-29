<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Saindo...</title>
</head>
<body>
    <script>
        try { localStorage.removeItem('carrinho'); } catch (e) {}
        window.location.replace('../index.php');
    </script>
    <noscript><a href="../index.php">Continuar</a></noscript>
</body>
</html>