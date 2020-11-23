<?php
$id = $_POST['idAvaliacao'];
require_once "init.php";
require_once DIR."/classes/DB.php";
$db = new DB();
$idAvaliacao = $_POST['idAvaliacao'];
$query = "SELECT `a`.`id`,`a`.`id_consulta`,`a`.`cod_diagnostico`,`a`.`texto_diagnostico`,`a`.`nota_avaliacao`,`a`.`texto_avaliacao`,`a`.`id_avaliador`,`b`.`nome` AS `nome_avaliador` FROM `prontuario` AS `a` LEFT JOIN `adm` AS `b` ON `a`.`id_avaliador` = `b`.`id` WHERE `a`.`id` = $idAvaliacao";
$result = $db->consultar($query,$db);
if($ln = $result->fetch_assoc()){
    $id = $ln['id'];    
    $id_consulta = $ln['id_consulta'];
    $cod_diagnostico = $ln['cod_diagnostico'];
    $texto_diagnostico = $ln['texto_diagnostico'];
    if($ln['nota_avaliacao'] == -1){
        $nota_avaliacao = "";
    }else{
        $nota_avaliacao = $ln['nota_avaliacao'];
    }
    $texto_avaliacao = $ln['texto_avaliacao'];
    $id_avaliador = $ln['id_avaliador'];
    $nome_avaliador = $ln['nome_avaliador'];
    if($nota_avaliacao == ""){
        $flag_avaliacao = 1;
    }else{
        $flag_avaliacao = 0;
    }
    $return_arr[] = array(
        'id'=>$id,
        "id_consulta"=>$id_consulta,
        "cod_diagnostico"=>$cod_diagnostico,
        "texto_diagnostico"=>$texto_diagnostico,
        "nota_avaliacao"=>$nota_avaliacao,
        "texto_avaliacao"=>$texto_avaliacao,
        "id_avaliador"=>$id_avaliador,
        "nome_avaliador"=>$nome_avaliador,
        "flag_avaliacao"=>$flag_avaliacao
    );
    echo json_encode($return_arr);
}
