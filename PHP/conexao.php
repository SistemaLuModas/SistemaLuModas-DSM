<?php
    // Conecta ao xamp
    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "BD_Lumodas";

    $connect = mysqli_connect("$host", "$usuario", "$senha", "$banco");

    if (!$connect)
        {
            die("Erro! Erro!, não conseguimos nos conectar: " . mysqli_connect_error());
        }
    if (!defined("CATEGORIAS")) {
    define("CATEGORIAS", [
        "blusas"     => "Blusas",
        "conjuntos"  => "Conjuntos",
        "acessorios" => "Acessórios",
        "vestidos"   => "Vestidos",
    ]);
}
?>