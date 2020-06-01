<?php
class AnamneseEnfermagem{
    private $id;
    private $idUsuario;
    private $queixaPrincipal;
    private $inicio;
    private $doenca;
    private $descDoenca;
    private $alergia;
    private $descAlergia;
    private $medicamento;
    private $descMedicamento;
    private $fumo;
    private $freqFumo;
    private $drogas;
    private $freqDrogas;
    private $bebidas;
    private $freqBebidas;
    private $exercicios;
    private $freqExercicios;
    private $recreacao;
    private $descRecreacao;
    private $animais;
    private $descAnimais;
    private $postos;
    private $doencaFamilia;
    private $tratamentoFamilia;

    function __construct($id, $idUsuario,$queixaPrincipal,$inicio,$doenca,$descDoenca,$alergia,$descAlergia,$medicamento,$descMedicamento,$fumo,$freqFumo,$drogas,$freqDrogas,$bebidas,$freqBebidas,$exercicios,$freqExercicios,$recreacao,$descRecreacao,$animais,$descAnimais,$postos,$doencaFamilia,$tratamentoFamilia){
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->queixaPrincipal = $queixaPrincipal;
        $this->inicio = $inicio;
        $this->doenca = $doenca;
        $this->descDoenca = $descDoenca;
        $this->alergia = $alergia;
        $this->descAlergia = $descAlergia;
        $this->medicamento = $medicamento;
        $this->descMedicamento = $descMedicamento;
        $this->fumo = $fumo;
        $this->freqFumo = $freqFumo;
        $this->drogas = $drogas;
        $this->freqDrogas = $freqDrogas;
        $this->bebidas = $bebidas;
        $this->freqBebidas = $freqBebidas;
        $this->exercicios = $exercicios;
        $this->freqExercicios = $freqExercicios;
        $this->recreacao = $recreacao;
        $this->descRecreacao = $descRecreacao;
        $this->animais = $animais;
        $this->descAnimais = $descAnimais;
        $this->postos = $postos;  
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
     * Get the value of doenca
     */ 
    public function getDoenca()
    {
        return $this->doenca;
    }

    /**
     * Set the value of doenca
     *
     * @return  self
     */ 
    public function setDoenca($doenca)
    {
        $this->doenca = $doenca;

        return $this;
    }

    /**
     * Get the value of alergia
     */ 
    public function getAlergia()
    {
        return $this->alergia;
    }

    /**
     * Set the value of alergia
     *
     * @return  self
     */ 
    public function setAlergia($alergia)
    {
        $this->alergia = $alergia;

        return $this;
    }

    /**
     * Get the value of descAlergia
     */ 
    public function getDescAlergia()
    {
        return $this->descAlergia;
    }

    /**
     * Set the value of descAlergia
     *
     * @return  self
     */ 
    public function setDescAlergia($descAlergia)
    {
        $this->descAlergia = $descAlergia;

        return $this;
    }

    /**
     * Get the value of medicamento
     */ 
    public function getMedicamento()
    {
        return $this->medicamento;
    }

    /**
     * Set the value of medicamento
     *
     * @return  self
     */ 
    public function setMedicamento($medicamento)
    {
        $this->medicamento = $medicamento;

        return $this;
    }

    /**
     * Get the value of descMedicamento
     */ 
    public function getDescMedicamento()
    {
        return $this->descMedicamento;
    }

    /**
     * Set the value of descMedicamento
     *
     * @return  self
     */ 
    public function setDescMedicamento($descMedicamento)
    {
        $this->descMedicamento = $descMedicamento;

        return $this;
    }

    /**
     * Get the value of fumo
     */ 
    public function getFumo()
    {
        return $this->fumo;
    }

    /**
     * Set the value of fumo
     *
     * @return  self
     */ 
    public function setFumo($fumo)
    {
        $this->fumo = $fumo;

        return $this;
    }

    /**
     * Get the value of freqFumo
     */ 
    public function getFreqFumo()
    {
        return $this->freqFumo;
    }

    /**
     * Set the value of freqFumo
     *
     * @return  self
     */ 
    public function setFreqFumo($freqFumo)
    {
        $this->freqFumo = $freqFumo;

        return $this;
    }

    /**
     * Get the value of drogas
     */ 
    public function getDrogas()
    {
        return $this->drogas;
    }

    /**
     * Set the value of drogas
     *
     * @return  self
     */ 
    public function setDrogas($drogas)
    {
        $this->drogas = $drogas;

        return $this;
    }

    /**
     * Get the value of freqDrogas
     */ 
    public function getFreqDrogas()
    {
        return $this->freqDrogas;
    }

    /**
     * Set the value of freqDrogas
     *
     * @return  self
     */ 
    public function setFreqDrogas($freqDrogas)
    {
        $this->freqDrogas = $freqDrogas;

        return $this;
    }

    /**
     * Get the value of bebidas
     */ 
    public function getBebidas()
    {
        return $this->bebidas;
    }

    /**
     * Set the value of bebidas
     *
     * @return  self
     */ 
    public function setBebidas($bebidas)
    {
        $this->bebidas = $bebidas;

        return $this;
    }

    /**
     * Get the value of freqBebidas
     */ 
    public function getFreqBebidas()
    {
        return $this->freqBebidas;
    }

    /**
     * Set the value of freqBebidas
     *
     * @return  self
     */ 
    public function setFreqBebidas($freqBebidas)
    {
        $this->freqBebidas = $freqBebidas;

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
     * Get the value of animais
     */ 
    public function getAnimais()
    {
        return $this->animais;
    }

    /**
     * Set the value of animais
     *
     * @return  self
     */ 
    public function setAnimais($animais)
    {
        $this->animais = $animais;

        return $this;
    }

    /**
     * Get the value of descAnimais
     */ 
    public function getDescAnimais()
    {
        return $this->descAnimais;
    }

    /**
     * Set the value of descAnimais
     *
     * @return  self
     */ 
    public function setDescAnimais($descAnimais)
    {
        $this->descAnimais = $descAnimais;

        return $this;
    }

    /**
     * Get the value of postos
     */ 
    public function getPostos()
    {
        return $this->postos;
    }

    /**
     * Set the value of postos
     *
     * @return  self
     */ 
    public function setPostos($postos)
    {
        $this->postos = $postos;

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
    /**
     * Get the value of descDoenca
     */ 
    public function getDescDoenca()
    {
        return $this->descDoenca;
    }

    /**
     * Set the value of descDoenca
     *
     * @return  self
     */ 
    public function setDescDoenca($descDoenca)
    {
        $this->descDoenca = $descDoenca;

        return $this;
    }

    public function inserirEnfermagem($db){
        $query = "INSERT INTO `anamneseenfermagem` (`id`,`idUsuario`,`queixaPrincipal`,`inicio`,`doenca`,`descDoenca`,`alergia`,`descAlergia`,`medicamento`,`descMedicamento`,`fumo`,`freqFumo`,`drogas`,`freqDrogas`,`bebidas`,`freqBebidas`,`exercicios`,`freqExercicios`,`recreacao`,`descRecreacao`,`animais`,`descAnimais`,`postos`,`doencaFamilia`,`tratamentoFamilia`) VALUES ('{$this->getId()}','{$this->getIdUsuario()}','{$this->getQueixaPrincipal()}','{$this->getInicio()}','{$this->getDoenca()}','{$this->getDescDoenca()}','{$this->getAlergia()}','{$this->getDescAlergia()}','{$this->getMedicamento()}','{$this->getDescMedicamento()}','{$this->getFumo()}','{$this->getFreqFumo()}','{$this->getDrogas()}','{$this->getFreqDrogas()}','{$this->getBebidas()}','{$this->getFreqBebidas()}','{$this->getExercicios()}','{$this->getFreqExercicios()}','{$this->getRecreacao()}','{$this->getDescRecreacao()}','{$this->getAnimais()}','{$this->getdescAnimais()}','{$this->getPostos()}','{$this->getDoencaFamilia()}','{$this->getTratamentoFamilia()}')";
        echo $query;
        $db->inserir($query,$db);
    }
    public function editarAnamnese($db){
    $query = "UPDATE `anamneseenfermagem` SET `queixaPrincipal` = '{$this->getQueixaPrincipal()}',`inicio` = '{$this->getInicio()}',`doenca` = '{$this->getDoenca()}',`descDoenca` = '{$this->getDescDoenca()}',`alergia` = '{$this->getAlergia()}',`descAlergia` = '{$this->getDescAlergia()}',`medicamento` = '{$this->getMedicamento()}',`descMedicamento` = '{$this->getDescMedicamento()}',`fumo` = '{$this->getFumo()}',`freqFumo` = '{$this->getFreqFumo()}',`drogas` = '{$this->getDrogas()}',`freqDrogas` = '{$this->getFreqDrogas()}',`bebidas` = '{$this->getBebidas()}',`freqBebidas` = '{$this->getFreqBebidas()}',`exercicios` = '{$this->getExercicios()}',`freqExercicios` = '{$this->getFreqExercicios()}',`recreacao` = '{$this->getRecreacao()}',`descRecreacao` = '{$this->getDescRecreacao()}',`animais` = '{$this->getAnimais()}',`descAnimais` = '{$this->getdescAnimais()}',`postos` = '{$this->getPostos()}',`doencaFamilia` = '{$this->getDoencaFamilia()}',`tratamentoFamilia` = '{$this->getTratamentoFamilia()}' WHERE `idUsuario` = {$this->getIdUsuario()}";
        echo $query;
        $db->editar($query,$db);
    }
    public function setAnamnese($id,$db){
        $query = "SELECT * FROM `anamneseenfermagem` WHERE `idUsuario` = $id";
        $result = $db->consultar($query,$db);
        if($ln = $result->fetch_assoc()){
            $this->setId($ln['id']);
            $this->setIdUsuario($ln['idUsuario']);
            $this->setQueixaPrincipal($ln['queixaPrincipal']);
            $this->setInicio($ln['inicio']);
            $this->setDoenca($ln['doenca']);
            $this->setDescDoenca($ln['descDoenca']);
            $this->setAlergia($ln['alergia']);
            $this->setDescAlergia($ln['descAlergia']);
            $this->setMedicamento($ln['medicamento']);
            $this->setDescMedicamento($ln['descMedicamento']);
            $this->setFumo($ln['fumo']);
            $this->setFreqFumo($ln['freqFumo']);
            $this->setDrogas($ln['drogas']);
            $this->setFreqDrogas($ln['freqDrogas']);
            $this->setBebidas($ln['bebidas']);
            $this->setFreqBebidas($ln['freqBebidas']);
            $this->setExercicios($ln['exercicios']);
            $this->setFreqExercicios($ln['freqExercicios']);
            $this->setRecreacao($ln['recreacao']);
            $this->setDescRecreacao($ln['descRecreacao']);
            $this->setAnimais($ln['animais']);
            $this->setDescAnimais($ln['descAnimais']);
            $this->setPostos($ln['postos']);
            $this->setDoencaFamilia($ln['doencaFamilia']);
            $this->setTratamentoFamilia($ln['tratamentoFamilia']);
        }
    }
    
}