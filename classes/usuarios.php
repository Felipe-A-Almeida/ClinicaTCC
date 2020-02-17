<?php
class Usuario{
    private $id;
    private $nome;
    private $rg;
    private $cpf;
    private $data_nascimento;
    private $naturalidade;
    private $telefone;
    private $filiacao;
    private $cartaoSUS;
    private $cep;
    private $logradouro;
    private $bairro;
    private $cidade;
    private $estado;

    function __construct($id,$nome,$rg,$cpf,$data_nascimento,$naturalidade,$telefone,$filiacao,$cartaoSUS,$cep,$logradouro,$bairro,$cidade,$estado){
        $this->id = $id;
        $this->nome = $nome;
        $this->rg = $rg;
        $this->cpf = $cpf;
        $this->data_nascimento = $data_nascimento;
        $this->naturalidade = $naturalidade;
        $this->telefone = $telefone;
        $this->filiacao = $filiacao;
        $this->$cartaoSUS = $cartaoSUS ;
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
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
    public function getFiliacao(){
        return $this->filiacao;
    }
    public function setFiliacao($filiacao){
        $this->filiacao = $filiacao;
    }
    public function getCartaoSUS(){
        return $this->cartaoSUS;
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
}
?>