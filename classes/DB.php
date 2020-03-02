<?php
class DB{
    private $db;
    private $usuario;
    private $senha;
    private $host;
    private $sql;

    function __construct(){
        $this->db = "clinicatcc";
        $this->usuario = "root";
        $this->senha = "";
        $this->host = "localhost";
        $this->sql = mysqli_connect($this->host, $this->usuario, $this->senha, $this->db);
    }
    
    public function getSql(){
        return $this->sql;
    }

    public function inserir($query, $sql){
        $sql->sql->query($query);
    }
    public function consultar($query, $sql){
        $result = $sql->sql->query($query);
        return $result; 
    }
}