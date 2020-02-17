<?php
    if(isset($_POST['acao']) && $_POST['acao'] == 'cadastrar-usuario-fisioterapia'){
        include_once "classes/DB.php";
        $sql = new DB();
        $sql = $sql->conectar();  
        $nome = $_POST['nome'];
        $rg = $_POST['rg'];
        $cpf = $_POST['cpf'];
        $data_resposta = $_POST['data_nascimento'];
        $naturalidade = $_POST['naturalidade'];
        $telefone = $_POST['telefone'];
        $filiacao = $_POST['filiacao'];
        $cartaoSUS = $_POST['cartaoSUS'];
        $cep = $_POST['cep'];
        $logradouro = $_POST['logradouro'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];

        
        $query="INSERT INTO `usuario` (`nome`,`rg`,`cpf`,`logradouro`,`bairro`,`cidade`,`estado`,`naturalidade`,`telefone`,`telefone`,`filiacao`,`dataNascimento`,`cartaoSUS`,`cep`,`senha`,`e-mail`)";
        //$sql->inserir($query,$sql);
    }
?>