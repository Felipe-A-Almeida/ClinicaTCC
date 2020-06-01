<?php
$periodo = $_POST['periodo'];
if(isset($_POST['horario'])){
    $horario = $_POST['horario'];
}else{
    $horario = "";
}
$clinica = str_replace("(","",$_POST['clinica']);
$clinica = str_replace(")","",$clinica);

require_once "init.php";
require_once DIR."/classes/DB.php";
$db = new DB();
$query_horarios = "SELECT * FROM `horarios` WHERE `clinica` = '$clinica' AND `periodo` = '$periodo'";
$result_horarios = $db->consultar($query_horarios,$db);
echo '<select name="horario" id="horario" class="form-control campo-texto">';
while($ln_horarios = $result_horarios->fetch_assoc()){
    if($ln_horarios['horario'] == $horario) $selected = "selected";
    else $selected = "";
    echo '<option value="'.$ln_horarios['horario'].'" '.$selected.'>'.$ln_horarios['horario'].'</option>';
}
echo "</select>";
?>