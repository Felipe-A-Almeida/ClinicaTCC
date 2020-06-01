<?php
class AnamneseFisioterapia{
    private $id;
    private $idUsuario;
    private $queixaPrincipal;
    private $inicio;
    private $exercicios;
    private $freqExercicios;
    private $recreacao;
    private $descRecreacao;    
    private $doencaFamilia;
    private $tratamentoFamilia;

    function __construct($id, $idUsuario,$queixaPrincipal,$inicio,$exercicios,$freqExercicios,$recreacao,$descRecreacao,$doencaFamilia,$tratamentoFamilia){
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->queixaPrincipal = $queixaPrincipal;
        $this->inicio = $inicio;        
        $this->exercicios = $exercicios;
        $this->freqExercicios = $freqExercicios;
        $this->recreacao = $recreacao;
        $this->descRecreacao = $descRecreacao;          
        $this->doencaFamilia = $doencaFamilia;       
        $this->tratamentoFamilia = $tratamentoFamilia;       
    }       

    public function inserir($query, $sql){
        $sql->sql->query($query);
    }
    public function consultar($query, $sql){
        $result = $sql->sql->query($query);
        return $result; 
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of idUsuario
     */ 
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set the value of idUsuario
     *
     * @return  self
     */ 
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get the value of queixaPrincipal
     */ 
    public function getQueixaPrincipal()
    {
        return $this->queixaPrincipal;
    }

    /**
     * Set the value of queixaPrincipal
     *
     * @return  self
     */ 
    public function setQueixaPrincipal($queixaPrincipal)
    {
        $this->queixaPrincipal = $queixaPrincipal;

        return $this;
    }

    /**
     * Get the value of inicio
     */ 
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Set the value of inicio
     *
     * @return  self
     */ 
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;

        return $this;
    }

    /**
     * Get the value of exercicios
     */ 
    public function getExercicios()
    {
        return $this->exercicios;
    }

    /**
     * Set the value of exercicios
     *
     * @return  self
     */ 
    public function setExercicios($exercicios)
    {
        $this->exercicios = $exercicios;

        return $this;
    }

    /**
     * Get the value of recreacao
     */ 
    public function getRecreacao()
    {
        return $this->recreacao;
    }

    /**
     * Set the value of recreacao
     *
     * @return  self
     */ 
    public function setRecreacao($recreacao)
    {
        $this->recreacao = $recreacao;

        return $this;
    }

    /**
     * Get the value of freqExercicios
     */ 
    public function getFreqExercicios()
    {
        return $this->freqExercicios;
    }

    /**
     * Set the value of freqExercicios
     *
     * @return  self
     */ 
    public function setFreqExercicios($freqExercicios)
    {
        $this->freqExercicios = $freqExercicios;

        return $this;
    }

    /**
     * Get the value of descRecreacao
     */ 
    public function getDescRecreacao()
    {
        return $this->descRecreacao;
    }

    /**
     * Set the value of descRecreacao
     *
     * @return  self
     */ 
    public function setDescRecreacao($descRecreacao)
    {
        $this->descRecreacao = $descRecreacao;

        return $this;
    }

    
    /**
     * Get the value of doencaFamilia
     */ 
    public function getDoencaFamilia()
    {
        return $this->doencaFamilia;
    }

    /**
     * Set the value of doencaFamilia
     *
     * @return  self
     */ 
    public function setDoencaFamilia($doencaFamilia)
    {
        $this->doencaFamilia = $doencaFamilia;

        return $this;
    }

    /**
     * Get the value of tratamentoFamilia
     */ 
    public function getTratamentoFamilia()
    {
        return $this->tratamentoFamilia;
    }

    /**
     * Set the value of tratamentoFamilia
     *
     * @return  self
     */ 
    public function setTratamentoFamilia($tratamentoFamilia)
    {
        $this->tratamentoFamilia = $tratamentoFamilia;

        return $this;
    }

    public function inserirFisioterapia($db){
        $query = "INSERT INTO `anamnesefisio` (`id`,`idUsuario`,`queixaPrincipal`,`inicio`,`exercicios`,`descExercicios`,`recreacao`,`descRecreacao`,`doencasFamilia`,`tratamentoFamilia`) VALUES ('{$this->getId()}','{$this->getIdUsuario()}','{$this->getQueixaPrincipal()}','{$this->getInicio()}','{$this->getExercicios()}','{$this->getFreqExercicios()}','{$this->getRecreacao()}','{$this->getDescRecreacao()}','{$this->getDoencaFamilia()}','{$this->getTratamentoFamilia()}')";
        $db->inserir($query,$db);
    }
    public function setAnamnese($id,$db){
        $query = "SELECT * FROM `anamnesefisio` WHERE `idUsuario` = $id";
        $result = $db->consultar($query,$db);
        if($ln = $result->fetch_assoc()){
            $this->setId($ln['id']);
            $this->setIdUsuario($ln['idUsuario']);
            $this->setQueixaPrincipal($ln['queixaPrincipal']);
            $this->setInicio($ln['inicio']);
            $this->setExercicios($ln['exercicios']);
            $this->setFreqExercicios($ln['descExercicios']);
            $this->setRecreacao($ln['recreacao']);
            $this->setDescRecreacao($ln['descRecreacao']);
            $this->setDoencaFamilia($ln['doencasFamilia']);
            $this->setTratamentoFamilia($ln['tratamentoFamilia']);
        }
    }
    public function editarAnamnese($db){
        $query = "UPDATE `anamnesefisio` SET `queixaPrincipal` = '{$this->getQueixaPrincipal()}',`inicio` = '{$this->getInicio()}',`exercicios` = '{$this->getExercicios()}',`descExercicios` = '{$this->getFreqExercicios()}',`recreacao` = '{$this->getRecreacao()}',`descRecreacao` = '{$this->getDescRecreacao()}',`doencasFamilia` = '{$this->getDoencaFamilia()}',`tratamentoFamilia` = '{$this->getTratamentoFamilia()}' WHERE `idUsuario` = {$this->getIdUsuario()}";
        echo $query;
        $db->editar($query,$db);
    }
}