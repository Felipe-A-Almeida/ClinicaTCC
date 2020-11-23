<?php
$id = $_POST['id'];
require_once "init.php";
require_once DIR."/classes/DB.php";
$db = new DB();
$query = "SELECT `a`.`id`,`a`.`ra`,`a`.`nome`,`b`.`descricao` AS `curso`,`b`.`id` AS `id_curso`, `a`.`telefone`,`a`.`email`,`c`.`descricao` AS `tipo_acesso`, `periodo` FROM `aluno` AS `a` INNER JOIN `curso` AS `b` ON `a`.`idCurso` = `b`.`id` INNER JOIN `tipoacessoaluno` AS `c` ON `a`.`tipo_acesso` = `c`.`id` WHERE `a`.`id` = $id";
$result = $db->consultar($query,$db);
if($ln = $result->fetch_assoc()){        
    $ra = $ln['ra'];
    $nome = $ln['nome'];
    $curso_nome = $ln['curso'];
    $curso_id = $ln['id_curso'];
    $telefone = $ln['telefone'];
    $email = $ln['email'];
    $tipo_acesso = $ln['tipo_acesso'];
    $periodo = $ln['periodo'];

    $return_arr[] = array(
                    "id" => $id,
                    "ra" => $ra,
                    "nome" => $nome,
                    "curso" => $curso_nome,
                    "curso_id" => $curso_id,
                    "telefone" => $telefone,
                    "email" => $email,
                    "tipo_acesso" => $tipo_acesso,
                    "periodo" => $periodo
                );
    
}

// Encoding array in JSON format
echo json_encode($return_arr);
?>