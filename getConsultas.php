<?php
if(isset($_POST['tipo'])){
    $tipo = $_POST['tipo'];
}else{
    $tipo = "";
}
$id_usuario = $_POST['id_usuario'] / 4801000;
require_once "init.php";
require_once DIR."/classes/DB.php";
$db = new DB();
$query_consultas = "SELECT `a`.`id` AS `id`, `a`.`data_inicio` AS `data_inicio`,`a`.`data_fim` AS `data_fim`,`b`.`descricao` AS `descricao` FROM `consulta` AS `a` INNER JOIN `tipoconsulta` AS `b` ON `a`.`idTipoConsulta` = `b`.`id` WHERE `a`.`idUsuario` = '$id_usuario' AND `b`.`descricao` = '$tipo'";
echo $query_consultas;
$result = $db->consultar($query_consultas,$db);
while($ln = $result->fetch_assoc()){
    $response[] = array("title"=>$ln['descricao'],"start"=>$ln['data_inicio'],"end"=>$ln['data_fim'],"id"=>$ln['id']);
}    
$json = json_encode($response);
echo $json;
?>