<?php
class DB{
    private $db;
    private $usuario;
    private $senha;
    private $host;

    function __construct(){
        $this->db = "clinicatcc";
        $this->usuario = "root";
        $this->senha = "";
        $this->host = "localhost";
    }

    public function conectar(){
        return mysqli_connect($this->host, $this->usuario, $this->senha, $this->db);
    }
    public function inserir($query, $sql){
        $sql->query($query);
    }
}