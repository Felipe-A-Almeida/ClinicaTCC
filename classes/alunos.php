<?php
class Aluno{
    private $id;
    private $ra;
    private $nome;
    private $idCurso;
    private $ano;
    private $telefone;    

    function __construct($id,$ra,$nome,$idCurso,$ano,$telefone){
        if($id != ""){ $this->id = $id; };        
        $this->nome = $nome;
        $this->ra = $ra;
        $this->idCurso = $idCurso;
        $this->ano = $ano;
        $this->telefone = $telefone;
    }

    
    

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of idCurso
     */ 
    public function getIdCurso()
    {
        return $this->idCurso;
    }

    /**
     * Set the value of idCurso
     *
     * @return  self
     */ 
    public function setIdCurso($idCurso)
    {
        $this->idCurso = $idCurso;

        return $this;
    }

    /**
     * Get the value of ano
     */ 
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * Set the value of ano
     *
     * @return  self
     */ 
    public function setAno($ano)
    {
        $this->ano = $ano;

        return $this;
    }

    /**
     * Get the value of telefone
     */ 
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set the value of telefone
     *
     * @return  self
     */ 
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }
     /**
     * Get the value of ra
     */ 
    public function getRa()
    {
        return $this->ra;
    }

    /**
     * Set the value of ra
     *
     * @return  self
     */ 
    public function setRa($ra)
    {
        $this->ra = $ra;

        return $this;
    }
    public function cadastrarAluno($db){
        $query = "INSERT INTO `aluno` (`ra`,`nome`,`idCurso`,`anoInicio`,`telefone`) VALUES ('{$this->getRa()}','{$this->getNome()}','{$this->getIdCurso()}','{$this->getAno()}','{$this->getTelefone()}')";
        echo $query;
        $db->inserir($query,$db);
    }

   
}

?>