<?php

require_once("config.php");

$sql = new Sql();

$resultados = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($resultados);

?>