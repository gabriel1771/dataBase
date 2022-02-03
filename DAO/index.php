<?php

require_once("config.php");

/* // carrega um usuario
$root = new Usuario();
$root->loadById(1);
echo $root; */

/* // carrega uma lista de usuarios
$lista = Usuario::getList();
echo json_encode($lista);  */

/* //carrega uma lista de usuarios buscando pelo login
$search = Usuario::search("m");
echo json_encode($search); */

//verifica se o login e a senha estão correto e se estiver, retorna os dados do usuario
/* $sql = new Usuario();
$sql->login("joao", "12345");
$usuario = $sql;

echo $usuario; */

//insere 1 usuario ao banco de dados e retorna todos os campos do mesmo. 
$aluno = new Usuario();
$aluno->setDeslogin("Gabriel Reinhardt Dos Reis");
$aluno->setDessenha("!@#####@!!@#K###");

$aluno->insert();

echo $aluno;




?>