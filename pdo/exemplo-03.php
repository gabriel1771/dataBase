<?php

$conn = new PDO("mysql:dbname=dbphp7;host=localhost", "root", "");

$stmt = $conn->prepare("INSERT INTO tb_usuarios(deslogin, dessenha) VALUES( :LOGIN, :PASSWORD) ");

$login = "José";
$password = "1234";

$stmt->bindParam(":LOGIN", $login);
$stmt->bindParam(":PASSWORD", $password);

$stmt->execute();

echo "Inserido ok !"; 

?>