<?php
class Admin{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $telefone;

    function __construct($id,$nome,$email,$senha,$telefone)
    {
        if($id != "") { $this->id = $id; };
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->telefone = $telefone;
    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function getSenha(){
        return $this->senha;
    }
    public function setSenha($senha){
        $this->senha = $senha;
    }
    public function getTelefone(){
        return $this->telefone;
    }
    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function cadastrarAdmin($db){
        $query = "INSERT INTO `adm` (`nome`,`email`,`senha`,`telefone`) VALUES ('{$this->getNome()}','{$this->getEmail()}','{$this->getSenha()}','{$this->getTelefone()}')";
        echo $query;
        $db->inserir($query,$db);
    }
    public function sessao(){        
        session_start();
        $_SESSION['id_admin'] = $this->getId();
        $_SESSION['nome_admin'] = $this->getNome();  
        $_SESSION['LAST_ACTIVITY'] = time();
    }
    public function validaSessao($db){        
        session_start();
        $tempo_maximo = 1800;
        if((isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $tempo_maximo)) || !(isset($_SESSION['id_admin']))){
            session_unset(); 
            session_destroy();
            header("LOCATION: ".URL_BASE . "/admin");
        }else{    
            $this->setId($_SESSION['id_admin']);
            $this->setNome($_SESSION['nome_admin']);
            $_SESSION['LAST_ACTIVITY'] = time();
        }
    }

}


?>