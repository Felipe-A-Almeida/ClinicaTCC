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
    private $cep;
    private $logradouro;
    private $bairro;
    private $cidade;
    private $estado;
    private $email;
    private $senha;

    function __construct($id,$nome,$rg,$cpf,$data_nascimento,$naturalidade,$telefone,$nomePai,$nomeMae,$cartaoSUS,$email,$senha,$cep,$logradouro,$bairro,$cidade,$estado){
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
        $this->email = $email;
        $this->senha = $senha;
        $this->cep = $this->limpaString($cep);
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

    public function cadastrar($db){
        $query = "INSERT INTO `usuario` (`nome`,`rg`,`cpf`,`cep`,`logradouro`,`bairro`,`cidade`,`estado`,`naturalidade`,`telefone`,`nomeMae`,`nomePai`,`dataNascimento`,`cartaoSUS`,`senha`,`email`) VALUES ('{$this->getNome()}','{$this->getRG()}','{$this->getCPF()}','{$this->getCEP()}','{$this->getLogradouro()}','{$this->getBairro()}','{$this->getCidade()}','{$this->getEstado()}','{$this->getNaturalidade()}','{$this->getTelefone()}','{$this->getNomeMae()}','{$this->getNomePai()}','{$this->getDataNascimento()}','{$this->getCartaoSUS()}','{$this->getSenha()}','{$this->getEmail()}')";
        echo $query;
        $db->inserir($query,$db);
        
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
}
?>