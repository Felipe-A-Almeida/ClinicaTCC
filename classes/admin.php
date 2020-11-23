<?php
class Admin{
    private $id;
    private $codigo;
    private $nome;
    private $email;
    private $senha;
    private $telefone;
    private $tipo_acesso;
    private $clinica;
    private $TOKEN;

    function __construct($id,$codigo,$nome,$email,$senha,$telefone,$tipo_acesso,$clinica,$TOKEN)
    {
        if($id != "") { $this->id = $id; };
        $this->nome = $nome;
        $this->codigo = $codigo;
        $this->email = $email;
        $this->senha = $senha;
        $this->telefone = $this->limpaString($telefone);
        $this->tipo_acesso = $tipo_acesso;
        $this->clinica = $clinica;
        $this->TOKEN = $TOKEN;
    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getCodigo(){
        return $this->codigo;
    }
    public function setCodigo($codigo){
        $this->codigo = $codigo;
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
    public function getTipoAcesso(){
        return $this->tipo_acesso;
    }
    public function setTipoAcesso($tipo_acesso){
        $this->tipo_acesso = $tipo_acesso;
    }
    public function getClinica(){
        return $this->clinica;
    }
    public function setClinica($clinica){
        $this->clinica = $clinica;
    }
    public function getToken(){
        return $this->TOKEN;
    }
    public function setToken($TOKEN){
        $this->TOKEN = $TOKEN;
    }

    public function gera_token($tamanho){   
        $regex = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
        return substr(str_shuffle($regex),0, $tamanho); 
    } 

    public function cadastrarAdmin($db){
        $this->setToken($this->gera_token(35));
        $query = "INSERT INTO `adm` (`nome`,`cod_adm`,`email`,`senha`,`telefone`,`tipo_acesso`,`clinica`,`TOKEN`) VALUES ('{$this->getNome()}','{$this->getCodigo()}','{$this->getEmail()}','{$this->getSenha()}','{$this->getTelefone()}','{$this->getTipoAcesso()}','{$this->getClinica()}','{$this->getToken()}')";
        echo $query;
        $db->inserir($query,$db);
    }
    public function atualizarAdmin($db){
        $query = "UPDATE `adm` SET `nome`='{$this->getNome()}',`cod_adm` = {$this->getCodigo()},`email` = '{$this->getEmail()}',`telefone` = '{$this->getTelefone()}',`tipo_acesso` = {$this->getTipoAcesso()} WHERE `id` = '{$this->getId()}'";
        echo "<br>$query<br>";
        $db->inserir($query,$db);
    }
    public function sessao(){        
        session_start();
        $_SESSION['id_admin'] = $this->getId();
        $_SESSION['nome_admin'] = $this->getNome();  
        $_SESSION['tipo_acesso'] = $this->getTipoAcesso();
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
    public function setUsuario($id,$db){
        $query = "SELECT * FROM `adm` WHERE `id` = $id";
        $result = $db->consultar($query,$db);
        if($ln = $result->fetch_assoc()){
            $this->setId($ln['id']);    
            $this->setCodigo($ln['cod_adm']);
            $this->setNome($ln['nome']);
            $this->setEmail($ln['email']);
            $this->setSenha($ln['senha']);
            $this->setTelefone($ln['telefone']);
            $this->setTipoAcesso($ln['tipo_acesso']);
            $this->setClinica($ln['clinica']);
            $this->setToken($ln['TOKEN']);            
        }
    }
    public function excluirAdmin($db){
        $query = "DELETE FROM `adm` WHERE `id` = '{$this->getId()}'";
        $db->inserir($query,$db);
    }
    public function limpaString($valor){
        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        $valor = str_replace("(", "", $valor);
        $valor = str_replace(")", "", $valor);
        $valor = str_replace(" ", "", $valor);
        return $valor;
    }
}


?>