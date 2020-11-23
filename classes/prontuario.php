<?php
class Prontuario{
    private $id;
    private $id_consulta;
    private $cod_diagnostico;
    private $texto_diagnostico;
    private $nota_avaliacao;
    private $texto_avaliacao;
    private $id_avaliador;    

    function __construct($id,$id_consulta,$cod_diagnostico,$texto_diagnostico,$nota_avaliacao,$texto_avaliacao,$id_avaliador){
        $this->id = $id;
        $this->id_consulta = $id_consulta;
        $this->cod_diagnostico = $cod_diagnostico;
        $this->texto_diagnostico = $texto_diagnostico;
        $this->nota_avaliacao = $nota_avaliacao;
        $this->texto_avaliacao = $texto_avaliacao;
        $this->id_avaliador = $id_avaliador;
    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getIdConsulta(){
        return $this->idConsulta;
    }
    public function setIdConsulta($id_consulta){
        $this->id_consulta = $id_consulta;
    }
    public function getCodDiagnostico(){
        return $this->cod_diagnostico;
    }
    public function setCodDiagnostico($cod_diagnostico){
        $this->cod_diagnostico = $cod_diagnostico;
    }
    public function getTextoDiagnostico(){
        return $this->texto_diagnostico;
    }
    public function setTextoDiagnostico($texto_diagnostico){
        $this->texto_diagnostico = $texto_diagnostico;
    }
    public function getNotaAvaliacao(){
        return $this->nota_avaliacao;
    }
    public function setNotaAvaliacao($nota_avaliacao){
        $this->nota_avaliacao = $nota_avaliacao;
    }
    public function getTextoAvaliacao(){
        return $this->texto_avaliacao;
    }
    public function setTextoAvaliacao($texto_avaliacao){
        $this->texto_avaliacao = $texto_avaliacao;
    }
    public function getIdAvaliador(){
        return $this->id_avaliador;
    }
    public function setIdAvalidor($id_avaliador){
        $this->id_avaliador = $id_avaliador;
    }
    public function editarProntuario($db){
        $query = "UPDATE `prontuario` SET `nota_avaliacao` = '{$this->getNotaAvaliacao()}' , `texto_avaliacao` = '{$this->getTextoAvaliacao()}', `id_avaliador` = '{$this->getIdAvaliador()}' WHERE `id` = {$this->getId()}";
        echo $query;
        $db->inserir($query,$db);
    }
}

