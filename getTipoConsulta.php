<?php
$clinica = str_replace("(","",$_POST['clinica']);
$clinica = str_replace(")","",$clinica);
if(isset($_POST['tipo'])){
    $tipo = $_POST['tipo'];
}else{
    $tipo = "";
}
require_once "init.php";
require_once DIR."/classes/DB.php";
$db = new DB();
$query_tipo = "SELECT * FROM `tipoconsulta` WHERE `tipo` = '$clinica'";
$result_tipo = $db->consultar($query_tipo,$db);
echo '<select name="tipo-consulta" class="form-control">';
echo '<option value="">Selecione um serviço</option>';
while($ln_tipo = $result_tipo->fetch_assoc()){
    if($ln_tipo['id'] == $tipo) $selected = "selected";
    else $selected = "";
    echo '<option value="'.$ln_tipo['id'] .'" '.$selected.'>'.$ln_tipo['descricao']. '</option>';
}
echo "</select>";
?>