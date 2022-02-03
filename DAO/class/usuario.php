<?php

//todos os métodos giram em torno da tabela definida e suas ligações

//select e gerais

// essa classe ao dar um echo no objeto ela retorna os valores dos atributos que são os valores das colunas da tabela tb_usuario, ==== essa classe também tem um método 
// chamado loadbyid que ao passar o id de um usuario ele carrega já a class(os atributos) com todos os valores do usuario identificado ==== método getList() que retorna todos os 
// dados dos usuarios em ordem de nome ==== método que trás todos os dados dos usuarios cujo tenha tal caractéres no nome deles e esses caractéres é passado como parâmetro para 
// poder ser feito a pesquisa e ser retornado os dados ==== método login() que ao passar login and password se estiverem corretos ele retorna os dados do usuario e se não existir 
// ele estoura uma excessão e futuramente tratar o memo. ==== método setData() ele recebe um array e preenche os atributos com o mesmo


//insert 

//método insert() ele pega dois valores dos atributos e manda para o banco, onde vai ter uma procedure(função no mysql) que vai inserir os valores na tabela criando um novo 
// usuario e vai retornar todos os valores do mesmo, então o método vai reeprencher os atributos com os valores retornados usando  o métod serData().


//update

//método update() recebe os dadaos que precisam mudar, no seu processo ele usa o id já carregado nos atributos pra identificar a linha que vai ser alterada usando o método queyP();


//delete

//



class Usuario {

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro; 

    public function getIdusuario(){
        return $this->idusuario;
    }

    public function setIdusuario($value){
        $this->idusuario = $value;
    }

    public function getDeslogin(){
        return $this->deslogin;
    }

    public function setDeslogin($value){
        $this->deslogin = $value;
    }

    public function getDessenha(){
        return $this->dessenha;
    }

    public function setDessenha($value){
        $this->dessenha = $value;
    }

    public function getDtcadastro(){
        return $this->dtcadastro;
    }

    public function setDtcadastro($value){
        $this->dtcadastro = $value;
    }


    public function __construct($login = "", $password = ""){
        $this->setDeslogin = $login;
        $this->setDessenha = $password;
    }

    public function __toString(){

        return json_encode(array(
            "idusuario" => $this->getIdusuario(),
            "deslogin" => $this->getDeslogin(),
            "dessenha" => $this->getDessenha(),
            "dtcadastro" => $this->getDtcadastro()->format("d/m/Y H:i:s")
        ));

    }



    public function loadById($id){

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID" => $id
        ));

        if(count($results) > 0){
            $this->setData($results);

        }


    }


    public static function getList(){
       $sql = new Sql();
       return $sql->select("SELECT * FROM tb_usuarios ORDER BY  deslogin;");
    }

    public static function search($login){
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin;", array(
            ":SEARCH" => "%" .$login ."%"
        ));
    }

    public function login($login, $password){
        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
            ":LOGIN" => $login,
            ":PASSWORD" => $password
        ));

        if(count($results) > 0){

            $this->setData($results);            

        } else{
            throw new Exception("login e/ou senha, invalidos");
            
        }
    }

    public function setData($data){
        $row = $data[0];
        $this->setIdusuario($row['idusuario']);
        $this->setDeslogin($row['deslogin']);
        $this->setDessenha($row['dessenha']);
        $this->setDtcadastro(new DateTime($row['dtcadastro']));

    }

    public function insert(){
        $sql = new Sql();
        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            ":LOGIN"=>$this->getDeslogin(),
            ":PASSWORD"=>$this->getDessenha()
        ) );

        if (count($results) > 0) {
            $this->setData($results);
            
        }

    }

    public function update($login, $password){

        $this->setDeslogin($login) ;
        $this->setDessenha($password);

        $sql = new Sql();
        $sql->queryP("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
            ':LOGIN' => $this->getDeslogin(),
            ':PASSWORD' => $this->getDessenha(),
            ':ID' => $this->getIdusuario()
        ));  
    }

    public function delete(){
        $sql = new Sql();

        $sql->queryP("DELETE  FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID" => $this->getIdusuario()
        ));
    
        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro( new DateTime());

    }


}

?>