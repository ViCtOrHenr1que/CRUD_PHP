<?php
if ( isset($_GET["id"])){
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $passoword = "";
    $database = "crudphp";

    //conectando o banco de dados
    $connection = new mysqli($servername, $username, $passoword, $database);

    $sql = "DELETE FROM clientes WHERE id=$id";
    $connection->query($sql);

    header("location: /crudphp/index.php");
    exit;
}
?>