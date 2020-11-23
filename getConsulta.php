<?php
$id = $_POST['id'];
require_once "init.php";
require_once DIR."/classes/DB.php";
$db = new DB();
$query_consulta = "SELECT `a`.`id` AS `id`, `a`.`data_inicio` AS `data_inicio`,`a`.`data_fim` AS `data_fim`,`b`.`descricao` AS `descricao`,`b`.`tipo` AS `clinica`,`b`.`id` AS `idTipo`,`c`.`nome` AS `nome`,`c`.`id` AS `idPaciente`,`a`.`idAluno` AS `idAluno` FROM `consulta` AS `a` INNER JOIN `tipoconsulta` AS `b` ON `a`.`idTipoConsulta` = `b`.`id` INNER JOIN `usuario` AS `c` ON `a`.`idUsuario` = `c`.`id` WHERE `a`.`id` = '$id'";
$result_consulta = $db->consultar($query_consulta,$db);
if($ln = $result_consulta->fetch_assoc()){    
    
    $data_hora_inicio = (explode(" ",$ln['data_inicio']));
    $data_inicio = $data_hora_inicio[0];
    $hora_inicio=$data_hora_inicio[1];
    $data_hora_fim = (explode(" ",$ln['data_fim']));
    $data_fim = $data_hora_fim[0];
    $hora_fim=$data_hora_fim[1];
    $horario = date("H:i",strtotime($hora_inicio)) . " - " . date("H:i",strtotime($hora_fim));
    $query_periodo = "SELECT `periodo` FROM `horarios` WHERE `horario` = '$horario'";
    $result_periodo = $db->consultar($query_periodo,$db);
    if($ln_periodo = $result_periodo->fetch_assoc()){
        $periodo = $ln_periodo['periodo'];
    }
    $descricao = $ln['descricao'];
    $clinica = $ln['clinica'];
    $idTipo = $ln['idTipo'];
    $nome = $ln['nome'];
    if($ln['idAluno'] == 0){
        $id_aluno = 0;
        $nome_aluno = "";
    }else{
        $id_aluno = $ln['idAluno'];
        $query_aluno = "SELECT * FROM `aluno` WHERE `id` = $id_aluno";
        $result_aluno = $db->consultar($query_aluno,$db);
        $ln_aluno = $result_aluno->fetch_assoc();
        $nome_aluno = $ln_aluno['nome'];
    }    
    $idPaciente = $ln['idPaciente'];
    $return_arr[] = array(
                    "id" => $id,
                    "data_inicio" => $data_inicio,     
                    "periodo" => $periodo,             
                    "horario" => $horario,
                    "descricao" => $descricao,
                    "clinica" => $clinica,
                    "idTipo" => $idTipo,
                    "nome" => $nome,
                    "idPaciente" => $idPaciente,
                    "idAluno" => $id_aluno,
                    "nomeAluno" => $nome_aluno
                );
}
// Encoding array in JSON format
echo json_encode($return_arr);
?>