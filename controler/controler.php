<?php
    define("URL_BASE","http://localhost/tcc/");
    define("DIR","C:/xampp/htdocs/tcc/");
    require_once DIR."/classes/DB.php";
    $db = new DB();    
    if(isset($_POST['nome'])){
        require_once DIR."/classes/usuarios.php";        
        
        $usuario = new Usuario("",$_POST['nome'], $_POST['RG'],$_POST['CPF'],$_POST['data-nascimento'],$_POST['naturalidade'],$_POST['telefone'],$_POST['nomePai'],$_POST['nomeMae'],$_POST['cartao-sus'],$_POST['email'],$_POST['senha'],$_POST['cep'],$_POST['logradouro'],$_POST['bairro'],$_POST['cidade'],$_POST['estado'],$_POST['complemento']);
        print_r($db->getSql());
        $usuario->cadastrar($db);

    }
    if(isset($_POST['cpf-login'])){
        require_once DIR."/classes/usuarios.php"; 
        $senha = md5($_POST['senha']);
        $cpf = limpaString($_POST['cpf-login']);
        $query = "SELECT `senha`,`cpf` FROM `usuario` WHERE `cpf` = '$cpf' AND `senha` = '$senha'";
        $result = $db->consultar($query,$db);
        $ln = $result->fetch_assoc();
        echo $query;
        print_r($ln);
        
        
    }
    function limpaString($valor){
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
?>