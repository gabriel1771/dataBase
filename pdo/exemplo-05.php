<?php

$conn = new PDO("mysql:dbname=dbphp7;host=localhost", "root", "");

$stmt = $conn->prepare("DELETE FROM tb_usuarios  WHERE idusuario = :ID");

$id = 10;


$stmt->bindParam(":ID", $id);

$stmt->execute();

$id = 11;
$stmt->bindParam(":ID", $id);
$stmt->execute();

$id = 12;
$stmt->bindParam(":ID", $id);
$stmt->execute();

echo "Dados Deletados  ok !"; 



?>