<?php

$conn = new mysqli("localhost", "root", "", "dbphp7");

if($conn->connect_error){
    echo "Error: " .$conn->connect_error;
}

$stmt = $conn->prepare("INSERT INTO tb_usuarios(deslogin, dessenha) VALUES(?, ?)");

$stmt->bind_param("ss", $deslogin, $pass);

$deslogin = "devGabriel";
$pass = "246klfjgldsk";

$stmt->execute();

$deslogin = "Engenheiro Computacional - Gabriel Reinhardt Dos Reis";
$pass = "foco men";

$stmt->execute();

?>