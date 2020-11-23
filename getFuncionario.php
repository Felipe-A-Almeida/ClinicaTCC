<?php
$id = $_POST['id'];
require_once "init.php";
require_once DIR."/classes/DB.php";
$db = new DB();
$query = "SELECT `a`.`id`,`a`.`email`,`a`.`nome`,`a`.`cod_adm`,`b`.`descricao` AS `clinica`, `a`.`telefone`,`c`.`id` AS `id_acesso`,`c`.`descricao` AS `tipo_acesso` FROM `adm` AS `a` INNER JOIN `curso` AS `b` ON `a`.`clinica` = `b`.`id` INNER JOIN `tipoacessoaluno` AS `c` ON `a`.`tipo_acesso` = `c`.`id` WHERE `a`.`id` = {$id}";
$result = $db->consultar($query,$db);
if($ln = $result->fetch_assoc()){ 
    $id = $ln['id'];
    $nome = $ln['nome'];
    $cod_adm = $ln['cod_adm'];
    $curso_nome = $ln['clinica'];
    $telefone = $ln['telefone'];
    $email = $ln['email'];
    $id_acesso = $ln['id_acesso'];
    $tipo_acesso = $ln['tipo_acesso'];

    $return_arr[] = array(
                    "id" => $id,
                    "nome" => $nome,
                    "cod_adm" => $cod_adm,
                    "clinica" => $curso_nome,
                    "telefone" => $telefone,
                    "email" => $email,
                    "id_acesso" => $id_acesso,
                    "tipo_acesso" => $tipo_acesso,
                );
    
}

// Encoding array in JSON format
echo json_encode($return_arr);
?>