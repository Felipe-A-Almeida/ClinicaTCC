<?php
    define("URL_BASE","http://localhost/tcc/");
    define("DIR","C:/xampp/htdocs/tcc/");
    require_once DIR."/classes/DB.php";
    $db = new DB();
    $paciente = $_POST['nome'];
    $query = "SELECT `id`, `nome` FROM `usuario` WHERE `nome` LIKE '%$paciente%'";
    $result = $db->consultar($query,$db);
    while($ln = $result->fetch_assoc()){
        $response[] = array("nome"=>$ln['nome']);
    }    
    $json = json_encode($response);
    echo $json;
?>