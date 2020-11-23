<?php
class Usuario{
    private $id;
    private $nome;
    private $rg;
    private $cpf;
    private $data_nascimento;
    private $naturalidade;
    private $telefone;
    private $nomeMae;
    private $nomePai;
    private $cartaoSUS;
    private $profissao;
    private $tempoServico;
    private $cep;
    private $logradouro;
    private $bairro;
    private $cidade;
    private $estado;
    private $email;
    private $senha;
    private $numero;
    private $sexo;
    private $estadoCivil;
    private $token;

    function __construct($id,$nome,$rg,$cpf,$data_nascimento,$naturalidade,$telefone,$nomePai,$nomeMae,$cartaoSUS,$profissao,$tempoServico,$email,$senha,$numero,$complemento,$cep,$logradouro,$bairro,$cidade,$estado,$estadoCivil,$sexo,$token){
        if($id != "") { $this->id = $id; };
        $this->nome = $nome;
        $this->rg = $this->limpaString($rg);
        $this->cpf = $this->limpaString($cpf);
        $this->data_nascimento = $data_nascimento;
        $this->naturalidade = $naturalidade;
        $this->telefone = $this->limpaString($telefone);
        $this->nomePai = $nomePai;
        $this->nomeMae = $nomeMae;
        $this->cartaoSUS = $this->limpaString($cartaoSUS) ;
        $this->profissao = $profissao;
        $this->tempoServico = $tempoServico;
        $this->estadoCivil = $estadoCivil;
        $this->email = $email;
        $this->senha = $senha;
        $this->cep = $this->limpaString($cep);
        $this->logradouro = $logradouro;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->numero = $numero;
        $this->sexo = $sexo;
        $this->complemento = $complemento;
        $this->token = $token;
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
    public function getRg(){
        return $this->rg;
    }
    public function setRg($rg){
        $this->rg = $rg;
    }
    public function getCpf(){
        return $this->cpf;
    }
    public function setCpf($cpf){
        $this->cpf = $cpf;
    }
    public function getDataNascimento(){
        return $this->data_nascimento;
    }
    public function setDataNascimento($data_nascimento){
        $this->data_nascimento = $data_nascimento;
    }
    public function getNaturalidade(){
        return $this->naturalidade;
    }
    public function setNaturalidade($naturalidade){
        $this->naturalidade = $naturalidade;
    }
    public function getTelefone(){
        return $this->telefone;
    }
    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }  
    public function getCartaoSUS(){
        return $this->cartaoSUS;
    }
    public function setCartaoSUS($cartaoSUS){
        $this->cartaoSUS = $cartaoSUS;
    }
    public function getProfissao(){
        return $this->profissao;
    }
    public function setProfissao($profissao){
        $this->profissao = $profissao;
    }
    public function getTempoServico(){
        return $this->tempoServico;
    }
    public function setTempoServico($tempoServico){
        $this->tempoServico = $tempoServico;
    }
    public function getEstadoCivil(){
        return $this->estadoCivil;
    }
    public function setEstadoCivil($estadoCivil){
        $this->estadoCivil = $estadoCivil;
    }
    public function getCEP(){
        return $this->cep;
    }
    public function setCEP($cep){
        $this->cep = $cep;
    }
    public function getLogradouro(){
        return $this->logradouro;
    }
    public function setLogradouro($logradouro){
        $this->logradouro = $logradouro;
    }
    public function getBairro(){
        return $this->bairro;
    }
    public function setBairro($bairro){
        $this->bairro = $bairro;
    }
    public function getCidade(){
        return $this->cidade;
    }
    public function setCidade($cidade){
        $this->cidade = $cidade;
    }
    public function getEstado(){
        return $this->estado;
    }
    public function setEstado($estado){
        $this->estado = $estado;
    }
    public function getNomeMae(){
        return $this->nomeMae;
    }
    public function setNomeMae($nomeMae){
        $this->nomeMae = $nomeMae;
    }
    public function getNomePai(){
        return $this->nomePai;
    }
    public function setNomePai($nomePai){
        $this->nomePai = $nomePai;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function getSenha(){
        return md5($this->senha);
    }
    public function setSenha($senha){
        $this->senha = $senha;
    }
    public function getNumero(){
        return $this->numero;
    }
    public function setNumero($numero){
        $this->numero = $numero;
    }
    public function getComplemento(){
        return $this->complemento;
    }
    public function setComplemento($complemento){
        $this->complemento = $complemento;
    }
    public function getSexo(){
        return $this->sexo;
    }
    public function setSexo($sexo){
        $this->sexo = $sexo;
    }
    public function getToken(){
        return $this->token;
    }
    public function setToken($token){
        $this->token = $token;
    }
    public function gera_token($tamanho){   
        $regex = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
        return substr(str_shuffle($regex),0, $tamanho); 
    } 
    public function cadastrar($db){
        $this->token = $this->gera_token(35);
        $query = "INSERT INTO `usuario` (`nome`,`rg`,`cpf`,`cep`,`logradouro`,`bairro`,`cidade`,`estado`,`complemento`,`naturalidade`,`telefone`,`nomeMae`,`nomePai`,`dataNascimento`,`cartaoSUS`,`profissao`,`tempoServico`,`senha`,`email`,`numero`,`sexo`,`estadoCivil`,`token`) VALUES ('{$this->getNome()}','{$this->getRG()}','{$this->getCPF()}','{$this->getCEP()}','{$this->getLogradouro()}','{$this->getBairro()}','{$this->getCidade()}','{$this->getEstado()}','{$this->getComplemento()}','{$this->getNaturalidade()}','{$this->getTelefone()}','{$this->getNomeMae()}','{$this->getNomePai()}','{$this->getDataNascimento()}','{$this->getCartaoSUS()}','{$this->getProfissao()}','{$this->getTempoServico()}','{$this->getSenha()}','{$this->getEmail()}','{$this->getNumero()}','{$this->getSexo()}','{$this->getEstadoCivil()}','{$this->getToken()}')";
        echo $query;
        $db->inserir($query,$db);        
    }
    public function editar($db){
        $query = "UPDATE `usuario` SET `nome` = '{$this->getNome()}',`rg` = '{$this->getRG()}',`cpf` = '{$this->getCPF()}',`cep` = '{$this->getCEP()}',`logradouro` = '{$this->getLogradouro()}',`bairro` = '{$this->getBairro()}',`cidade` = '{$this->getCidade()}',`estado` = '{$this->getEstado()}',`numero` = '{$this->getNumero()}',`complemento` = '{$this->getComplemento()}',`naturalidade` = '{$this->getNaturalidade()}',`telefone` = '{$this->getTelefone()}',`nomeMae` = '{$this->getNomeMae()}',`nomePai` = '{$this->getNomePai()}',`dataNascimento` = '{$this->getDataNascimento()}',`cartaoSUS` = '{$this->getCartaoSUS()}',`profissao` = '{$this->getProfissao()}',`tempoServico` = '{$this->getTempoServico()}',`email` = '{$this->getEmail()}',`numero` = '{$this->getNumero()}',`sexo` = '{$this->getSexo()}',`estadoCivil` = '{$this->getEstadoCivil()}' WHERE `id` = {$this->getId()}";
        echo $query;
        $db->editar($query,$db);
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
    public function sessao(){        
        session_start();
        $_SESSION['id'] = $this->getId();
        $_SESSION['nome'] = $this->getNome();          
        $_SESSION['LAST_ACTIVITY'] = time();
    }
    public function validaSessao($db){        
        session_start();
        $tempo_maximo = 1800;
        if((isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $tempo_maximo)) || !(isset($_SESSION['id']))){
            session_unset(); 
            session_destroy();            
            print_r($_SESSION);
            header("LOCATION: ".URL_BASE);
        }else{    
            $this->setId($_SESSION['id']);
            $this->setNome($_SESSION['nome']);
            $_SESSION['LAST_ACTIVITY'] = time();
        }
    }
    public function setUsuario($id,$db){
        $query = "SELECT * FROM `usuario` WHERE `id` = $id";
        $result = $db->consultar($query,$db);
        if($ln = $result->fetch_assoc()){
            $this->setId($ln['id']);
            $this->setNome($ln['nome']);
            $this->setRg($ln['rg']);
            $this->setCpf($ln['cpf']);
            $this->setCEP($ln['cep']);
            $this->setLogradouro($ln['logradouro']);
            $this->setBairro($ln['bairro']);
            $this->setCidade($ln['cidade']);
            $this->setEstado($ln['estado']);
            $this->setNumero($ln['numero']);
            $this->setComplemento($ln['complemento']);
            $this->setNaturalidade($ln['naturalidade']);
            $this->setTelefone($ln['telefone']);
            $this->setNomeMae($ln['nomeMae']);
            $this->setNomePai($ln['nomePai']);
            $this->setDataNascimento($ln['dataNascimento']);
            $this->setCartaoSus($ln['cartaoSUS']);
            $this->setProfissao($ln['profissao']);
            $this->setTempoServico($ln['tempoServico']);
            $this->setEmail($ln['email']);
            $this->setSexo($ln['sexo']);
            $this->setEstadoCivil($ln['estadoCivil']);
            $this->setToken($ln['TOKEN']);
        }
    }
    public function alteraSenha($senha,$db){
        $senha_encrypt = md5($senha);
        $query = "UPDATE `usuario` SET `senha` = '{$senha_encrypt}' WHERE `id` = {$this->getId()}";
        $db->editar($query,$db);
    }
}
?>