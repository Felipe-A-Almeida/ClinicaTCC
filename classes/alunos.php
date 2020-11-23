<?php
class Aluno{
    private $id;
    private $ra;
    private $email;
    private $senha;
    private $nome;
    private $idCurso;
    private $ano;
    private $telefone;    
    private $tipo_acesso;
    private $TOKEN;

    function __construct($id,$ra,$email,$senha,$nome,$idCurso,$ano,$telefone,$tipo_acesso,$TOKEN){
        if($id != ""){ $this->id = $id; };        
        $this->nome = $nome;
        $this->ra = $ra;
        $this->email = $email;
        $this->senha = $senha;
        $this->idCurso = $idCurso;
        $this->ano = $ano;
        $this->telefone = $this->limpaString($telefone);
        $this->tipo_acesso = $tipo_acesso;
        $this->tipo_acesso ;
        $this->TOKEN = $TOKEN;
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
    public function getRa(){
        return $this->ra;
    }
    public function setRa($ra){
        $this->ra = $ra;
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
    public function getIdCurso(){
        return $this->idCurso;
    }
    public function setIdCurso($idCurso){
        $this->idCurso = $idCurso;
    }
    public function getAno(){
        return $this->ano;
    }
    public function setAno($ano){
        $this->ano = $ano;
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

    public function cadastrarAluno($db){
        $this->setSenha(md5($this->getSenha()));
        $this->setToken($this->gera_token(35));
        $query = "INSERT INTO `aluno` (`ra`,`email`,`senha`,`nome`,`idCurso`,`periodo`,`telefone`,`tipo_acesso`,`TOKEN`) VALUES ('{$this->getRa()}','{$this->getEmail()}','{$this->getSenha()}','{$this->getNome()}','{$this->getIdCurso()}','{$this->getAno()}','{$this->getTelefone()}','{$this->getTipoAcesso()}','{$this->getToken()}')";
        echo $query;
        $db->inserir($query,$db);
    }
    public function setAluno($id,$db){
        $query = "SELECT * FROM `usuario` WHERE `id` = $id";
        $result = $db->consultar($query,$db);
        if($ln = $result->fetch_assoc()){
            $this->setId($ln['id']);
            
        }
    }
    public function excluirAluno($db){
        $query = "DELETE FROM `aluno` WHERE `id` = '{$this->getId()}'";
        $db->inserir($query,$db);
    }
    public function atualizarAluno($db){
        $query = "UPDATE `aluno` SET `ra`='{$this->getRa()}',`nome` = '{$this->getNome()}',`idCurso` ='{$this->getIdCurso()}',`periodo` = '{$this->getAno()}',`telefone` = '{$this->getTelefone()}',`email` = '{$this->getEmail()}',`tipo_acesso` = '{$this->getTipoAcesso()}' WHERE `id` = '{$this->getId()}'";
        echo "<br>$query<br>";
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