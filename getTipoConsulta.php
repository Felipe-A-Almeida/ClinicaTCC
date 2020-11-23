
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
echo '<input name="tipo-consulta" id="tipo-consulta" class="form-control">';
?>
<script>
  $( function() {
    var opcoes = [
        <?php
        while($ln_tipo = $result_tipo->fetch_assoc()){
            if($ln_tipo['id'] == $tipo) $selected = "selected";
            else $selected = "";
            echo '"'.$ln_tipo['descricao'].'",';
        }            
        ?>      
    ];
    $( "#tipo-consulta" ).autocomplete({
      source: opcoes
    });
  } );
  </script>