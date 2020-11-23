<?php
class Consulta{
    private $id;
    private $idUsuario;
    private $idAluno;
    private $idAdm;
    private $data_inicio;
    private $data_fim;
    private $idTipoConsulta;

    function __construct($id,$idUsuario,$idAluno,$idAdm,$data_inicio,$data_fim,$idTipoConsulta){
        if($id != ""){ $this->id = $id; };
        if($idUsuario != ""){ $this->idUsuario = $idUsuario; };
        if($idAluno != ""){ $this->idAluno = $idAluno; };
        if($idAdm != ""){ $this->idAdm = $idAdm; };
        $this->data_inicio = $data_inicio;
        $this->data_fim = $data_fim;
        $this->idTipoConsulta = $idTipoConsulta;
    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getIdUsuario(){
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }
    public function getIdAluno(){
        return $this->idAluno;
    }
    public function setIdAluno($idAluno){
        $this->idAluno = $idAluno;
    }
    public function getIdAdm(){
        return $this->idAdm;
    }
    public function setIdAdm($idAdm){
        $this->idAdm = $idAdm;
    }
    public function getDataInicio(){
        return $this->data_inicio;
    }
    public function setDataInicio($data_inicio){
        $this->data_inicio = $data_inicio;
    }
    public function getDataFim(){
        return $this->data_fim;
    }
    public function setDataFim($data_fim){
        $this->data_fim = $data_fim;
    }
    public function getIdTipoConsulta(){
        return $this->idTipoConsulta;
    }
    public function setIdTipoConsulta($idTipoConsulta){
        $this->idTipoConsulta = $idTipoConsulta;
    }

    public function cadastrarConsulta($db){
        $query = "INSERT INTO `consulta` (`idUsuario`,`idAluno`,`idAdm`,`data_inicio`,`data_fim`,`idTipoConsulta`) VALUES ('{$this->getIdUsuario()}','{$this->getIdAluno()}','{$this->getIdAdm()}','{$this->getDataInicio()}','{$this->getDataFim()}','{$this->getIdTipoConsulta()}')";
        echo $query;
        $db->inserir($query,$db);
    }
    public function editarConsulta($db){
        $query = "UPDATE `consulta` SET `idUsuario`='{$this->getIdUsuario()}',`idAluno` = '{$this->getIdAluno()}',`idAdm` ='{$this->getIdAdm()}',`data_inicio` = '{$this->getDataInicio()}',`data_fim` = '{$this->getDataFim()}',`idTipoConsulta` = '{$this->getIdTipoConsulta()}' WHERE `id` = '{$this->getId()}'";
        $db->inserir($query,$db);
    }
    public function excluirConsulta($db){
        $query = "DELETE FROM `consulta` WHERE `id` = '{$this->getId()}'";
        $db->inserir($query,$db);
    }
    public function buscaId($db){
        $query = "SELECT `id` FROM `consulta` WHERE `idUsuario` = {$this->getIdUsuario()} ORDER BY `id` DESC LIMIT 1";
        $result = $db->consultar($query,$db);
        $ln = $result->fetch_assoc();
        $this->setId($ln['id']);
    }
    public function buscaAnamnese($clinica,$db){
        if($clinica == "fisioterapia") $tabela = "anamnesefisio"; else $tabela = "anamneseenfermagem";
        $query = "SELECT `id` FROM `$tabela` WHERE `idUsuario` = {$this->getIdUsuario()}";
        if($result = $db->consultar($query,$db)){
            if($result->num_rows > 0){
                return true;
            }else{
                return false;
            }
        }
    }

    
}

?>