<?php
class NPS{
    private $id;
    private $idUsuario;
    private $notaUtilidade;
    private $comentarios;
    private $data;

    function __construct($id,$idUsuario,$notaUtilidade,$comentarios,$data){
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->notaUtilidade = $notaUtilidade;
        $this->comentarios = $comentarios;
        $this->data = $data;        
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
    public function getNotaUtilidade(){
        return $this->notaUtilidade;
    }
    public function setNotaUtilidade($notaUtilidade){
        $this->notaUtilidade = $notaUtilidade;
    }
    public function getComentarios(){
        return $this->comentarios;
    }
    public function setComentarios($comentarios){
        $this->comentarios = $comentarios;
    }
    public function getData(){
        return $this->data;
    }
    public function setData($data){
        $this->data = $data;
    }
    public function cadastrarNPS($db){
        $query = "INSERT INTO `nps` (`id`,`idUsuario`,`nota_utilidade`,`comentarios`,`data`) VALUES ('{$this->getId()}','{$this->getIdUsuario()}','{$this->getNotaUtilidade()}','{$this->getComentarios()}','{$this->getData()}')";
        echo $query;
        $db->inserir($query,$db);
    }
}

