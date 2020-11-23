<?php
$id_usuario = $_POST['id_usuario'];
$nota_utilidade = $_POST['nota_nps'];
$comentarios = $_POST['comentario'];
$data = date("Y-m-d H:i:s");
require_once "init.php";
require_once DIR."/classes/DB.php";
require_once DIR."/classes/nps.php";
$db = new DB();
$nps = new NPS("",$id_usuario,$nota_utilidade,$comentarios,$data);
$nps->cadastrarNPS($db);
?>


