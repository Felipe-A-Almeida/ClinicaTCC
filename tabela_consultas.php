<?php
require_once "init.php";
require_once DIR."/classes/DB.php";
require_once DIR."/classes/usuarios.php";
$db = new DB();
$usuario = new Usuario("","","","","","","","","","","","","","","","","","","","","","","","");
$usuario->validaSessao($db);
$id_usuario=$_SESSION['id'];
$opcoes = json_encode($_POST['opcoes']);
$usuario->setUsuario($id_usuario,$db);
$data = $_POST['data'];
$clinica = str_replace("(","",$_POST['clinica']);
$clinica = str_replace(")","",$clinica);
if($clinica == "Fisioterapia"){
    $banco_consulta = "anamnesefisio";
}else{
    $banco_consulta = "anamneseenfermagem";
}
$query_consultas = "SELECT `a`.`id` AS `id`, `a`.`data_inicio` AS `data_inicio`,`a`.`data_fim` AS `data_fim`,`b`.`descricao` AS `descricao` FROM `consulta` AS `a` INNER JOIN `tipoconsulta` AS `b` ON `a`.`idTipoConsulta` = `b`.`id` WHERE `a`.`idUsuario` = '$id_usuario' AND `tipo` = '$clinica' AND `data_inicio` LIKE '%$data%'";
$result = $db->consultar($query_consultas,$db);
$query_tipo = "SELECT * FROM `tipoconsulta` WHERE `tipo` = '$clinica'";
$result_tipo = $db->consultar($query_tipo,$db);
?>
<table id="tabela-consultas">
    <thead>
        <td>
            Horário
        </td>
        <td>
            Tipo consulta
        </td>        
        <td>
            Ações
        </td>
    </thead>
    <tbody>
        <?php
        while($ln = $result->fetch_assoc()){ ?>
        <tr>
            <td>
                <?= date("d/m/Y",strtotime($ln['data_inicio'])) . "<br>" . date("H:i",strtotime($ln['data_inicio'])) . " - " .  date("H:i",strtotime($ln['data_fim'])) ?>
            </td>
            <td>
                <?= $ln['descricao'] ?>
            </td>            
            <td>
                <button type="button" id="editar_<?= $ln['id'] ?>" class="btn btn-primary botao-editar-consulta"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</button>
            </td>
        </tr>

        <?php
        }
        ?>
    </tbody>
</table>
<link href='includes/dataTable/datatables.min.css' rel='stylesheet' />
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src='includes/dataTable/datatables.min.js'></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<script>    
    $("#tabela-consultas").dataTable({
        "language": {
            "lengthMenu": "Exibindo _MENU_ consultas por página",
            "zeroRecords": "Não há consultas marcadas",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Sem consultas agendadas",
            "infoFiltered": "(Total: _MAX_)",
            "search":"Pesquisar",
            "oPaginate": {
                "sFirst":    "Primeiro",
                "sPrevious": "Anterior",
                "sNext":     "Próximo",
                "sLast":     "Último"
            },
        }
    });
    
    function editarConsulta(id){
        $.ajax({
            url: 'getConsulta.php',
            type: 'POST',
            data: {id:id},
            dataType: 'JSON',
            success: function(data){
                console.log(data);
                $("#editar-data").val(data[0].data_inicio) ;  
                $("#editar-periodo").val(data[0].periodo) ;
                getEditHorario(data[0].periodo,data[0].clinica,data[0].horario);
                $("#editar-tipo-consulta").val(data[0].idTipo);
                $("#editar-label-tipo-consulta").val(data[0].descricao);
                $("#idConsulta").val(data[0].id);
                $("#modal-body-consultas-usuario").hide(200);
                setTimeout(function(){
                    $(".editar-consulta").show(300);     
                },50);
            }                               
        });
        var opcoes_editar = [
            <?php
            while($ln_tipo = $result_tipo->fetch_assoc()){
                echo '{ label: "'.$ln_tipo['descricao'].'", value: "'.$ln_tipo['id'].'"},';
            }            
            ?>      
        ];
        $("#editar-label-tipo-consulta").autocomplete({
            source: opcoes_editar,
            minLength: 0,
            select: function(event, ui) {
                $( "#editar-label-tipo-consulta" ).val(ui.item.label);
                $( "#editar-tipo-consulta" ).val(ui.item.value);           
                return false;
            },        
        }).on('focus', function(event) {
            var self = this;
            $("#label-tipo-consulta").autocomplete( "search", this.value);
        });
    }
    function getEditHorario(periodo,clinica,horario){        
        $.post("getPeriodo.php",{periodo:periodo,clinica:clinica,horario:horario},function(data){
            $("#editar-horario").html(data);            
        });
    }
    $(".botao-editar-consulta").click(function(){
        editarConsulta(($(this).attr('id').split("_"))[1]);
    });        
    $(".voltar-tabela-consultas").on("click",function(){
        $(".editar-consulta").hide(200);
        setTimeout(function(){
            $("#modal-body-consultas-usuario").show(300);     
        },50);
    });
    $(".voltar-tabela-anamnese").click(function(){
        $("#anamnese-fisio-body").hide(200);
        $("#anamnese-enfermagem-body").hide(200);
        setTimeout(function(){
            $("#modal-body-consultas-usuario").show(300);     
        },50);
    });    
    $(".botao-editar-anamnese").click(function(){
        var id_consulta = ($(this).attr("id").split("_"))[1];
        <?php
        if($clinica == "Fisioterapia"){
        ?>
        $.post('getAnamnese.php', {id_consulta:id_consulta, bancoConsulta: "<?= $banco_consulta; ?>"}, function(data){            
            $("#queixa-principal").val(data[0].queixa_principal);
            $("#inicio").val(data[0].inicio); 
            if(~(data[0].doenca).indexOf("cardiopatia")){
                $("input[value='cardiopatia']").attr("checked",true);
            }
            if(~(data[0].doenca).indexOf("hipertensao")){
                $("input[value='hipertensao']").attr("checked",true);
            }
            if(~(data[0].doenca).indexOf("diabetes")){
                $("input[value='diabetes']").attr("checked",true);
            }
            if(~(data[0].doenca).indexOf("cancer")){
                $("input[value='cancer']").attr("checked",true);
            }
            if(~(data[0].doenca).indexOf("outros")){
                $("input[value='outros']").attr("checked",true);                
            }
            $("#desc-doencas-fisio").val(data[0].descDoenca);
            var $radios = $('input:radio[name=alergia]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].alergia+']').prop('checked', true);
            }
            $("#desc-alergia-fisio").val(data[0].descAlergia);
            var $radios = $('input:radio[name=medicamento]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].medicamento+']').prop('checked', true);
            }
            $("#desc-medicamento-fisio").val(data[0].descMedicamento);
            var $radios = $('input:radio[name=fumo]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].fumo+']').prop('checked', true);
            }
            $("#freq-fumo-fisio").val(data[0].freqFumo); 
            var $radios = $('input:radio[name=drogas]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].drogas+']').prop('checked', true);
            }
            $("#freq-drogas-fisio").val(data[0].freqDrogas);            
            var $radios = $('input:radio[name=alcool]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].bebidas+']').prop('checked', true);
            }
            $("#freq-alcool-fisio").val(data[0].freqBebidas); 
            var $radios = $('input:radio[name=exercicios]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].exercicios+']').prop('checked', true);
            }
            $("#freq-exercicios-fisio").val(data[0].freqExercicios);
            var $radios = $('input:radio[name=recreacao]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].recreacao+']').prop('checked', true);
            }
            $("#freq-recreacao-fisio").val(data[0].freqRecreacao);  
            var $radios = $('input:radio[name=animais]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].animais+']').prop('checked', true);
            }
            $("#freq-animais-fisio").val(data[0].descAnimais);   
            var $radios = $('input:radio[name=recreacao]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].recreacao+']').prop('checked', true);
            }
            var $radios = $('input:radio[name=posto]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].postos+']').prop('checked', true);
            }
            $("#doencas-familia").val(data[0].doencaFamilia);
            $("#tratamento-familia").val(data[0].tratamentoFamilia);
            $("#idUsuario").val(data[0].id_usuario);
            $("#idConsultaFisio").val(id_consulta);
        },"json");
        $("#modal-body-consultas-usuario").hide(200);
        setTimeout(function(){
            $("#anamnese-fisio-body").show(300);     
        },50);
        <?php
        }else{
        ?>
        $.post('getAnamnese.php', {id_consulta:id_consulta, bancoConsulta: "<?= $banco_consulta; ?>"}, function(data){
            $("#queixa-principal-enfermagem").val(data[0].queixa_principal);
            $("#inicio-enfermagem").val(data[0].inicio); 
            if(~(data[0].doenca).indexOf("cardiopatia")){
                $("input[value='cardiopatia']").attr("checked",true);
            }
            if(~(data[0].doenca).indexOf("hipertensao")){
                $("input[value='hipertensao']").attr("checked",true);
            }
            if(~(data[0].doenca).indexOf("diabetes")){
                $("input[value='diabetes']").attr("checked",true);
            }
            if(~(data[0].doenca).indexOf("cancer")){
                $("input[value='cancer']").attr("checked",true);
            }
            if(~(data[0].doenca).indexOf("outros")){
                $("input[value='outros']").attr("checked",true);
            }
            $("#desc-doencas").val(data[0].descDoenca);
            var $radios = $('input:radio[name=alergia]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].alergia+']').prop('checked', true);
            }
            $("#desc-alergia").val(data[0].descAlergia);
            var $radios = $('input:radio[name=medicamento]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].medicamento+']').prop('checked', true);
            }
            $("#desc-medicamento").val(data[0].descMedicamento);
            var $radios = $('input:radio[name=fumo]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].fumo+']').prop('checked', true);
            }
            $("#freq-fumo").val(data[0].freqFumo); 
            var $radios = $('input:radio[name=drogas]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].drogas+']').prop('checked', true);
            }
            $("#freq-drogas").val(data[0].freqDrogas);            
            var $radios = $('input:radio[name=alcool]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].bebidas+']').prop('checked', true);
            }
            $("#freq-alcool").val(data[0].freqBebidas); 
            var $radios = $('input:radio[name=exercicios]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].exercicios+']').prop('checked', true);
            }
            $("#freq-exercicios").val(data[0].freqExercicios);
            var $radios = $('input:radio[name=recreacao]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].recreacao+']').prop('checked', true);
            }
            $("#freq-recreacao-enfermagem").val(data[0].freqRecreacao);  
            var $radios = $('input:radio[name=animais]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].animais+']').prop('checked', true);
            }
            $("#freq-animais").val(data[0].descAnimais);   
            var $radios = $('input:radio[name=recreacao]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].recreacao+']').prop('checked', true);
            }
            var $radios = $('input:radio[name=posto]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].postos+']').prop('checked', true);
            }
            $("#doencas-familia-enfermagem").val(data[0].doencaFamilia);
            $("#tratamento-familia-enfermagem").val(data[0].tratamentoFamilia);
            $("#idUsuario-enfermagem").val(data[0].id_usuario);
            $("#idConsulta-enfermagem").val(data[0].id_consulta);
        },"json");
        $("#modal-body-consultas-usuario").hide(200);
        setTimeout(function(){
            $("#anamnese-enfermagem-body").show(300);     
        },50);
        <?php
        }
        ?>   
    });
    $(".botao-excluir-consulta").click(function(){
        if(confirm("Tem certeza que deseja cancelar a consulta?")){
            id = ($(this).attr("id").split("_"))[1];
            $.post("controler/controler.php",{idConsulta:id,acao:"excluir-consulta"},function(){
                $(".fecha-modal-consultas-usuario").click();
                setTimeout(function(){
                    excluirEventoCalendario(id);                 
                },100);
                return 1;                
            });
        }else{
            return 0;
        }
    });
</script>