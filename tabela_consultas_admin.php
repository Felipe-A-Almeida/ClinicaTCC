<?php
require_once "init.php";
require_once DIR."/classes/DB.php";
require_once DIR."/classes/admin.php";
$db = new DB();
$admin = new Admin("","","","","","","","","");
$admin->validaSessao($db);
$opcoes = json_encode($_POST['opcoes']);
$data = $_POST['data'];
$clinica = str_replace("(","",$_POST['clinica']);
$clinica = str_replace(")","",$clinica);
if($clinica == "fisioterapia"){
    $banco_consulta = "anamnesefisio";
}else{
    $banco_consulta = "anamneseenfermagem";
}
$query_consultas = "SELECT `a`.`id` AS `id`, `a`.`data_inicio` AS `data_inicio`,`a`.`data_fim` AS `data_fim`,`b`.`descricao` AS `descricao`,`idUsuario`, `c`.`cod_diagnostico` AS `diagnostico`, `c`.`id` AS `id_diagnostico` FROM `consulta` AS `a` INNER JOIN `tipoconsulta` AS `b` ON `a`.`idTipoConsulta` = `b`.`id` LEFT JOIN `prontuario` AS `c` ON `a`.`id` = `c`.`id_consulta` WHERE `tipo` = '$clinica' AND `data_inicio` LIKE '%$data%'";
$result = $db->consultar($query_consultas,$db);
$query_tipo = "SELECT * FROM `tipoconsulta` WHERE `tipo` = '$clinica'";
$result_tipo = $db->consultar($query_tipo,$db);
$query_alunos = "SELECT `a`.`id`,`a`.`nome` FROM `aluno` AS `a` INNER JOIN `curso` AS `b` ON `a`.`idCurso` = `b`.`id` WHERE `b`.`descricao` = '$clinica'";
$result_alunos = $db->consultar($query_alunos,$db);       
$query_pacientes = "SELECT * FROM `usuario` WHERE 1" ;
$result_pacientes = $db->consultar($query_pacientes,$db); 
?>
<table id="tabela-consultas">
    <thead>
        <td>
            Horário<?= $clinica ?>
        </td>
        <td>
            Tipo consulta
        </td>
        <td>
            Paciente
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
                <?php                
                $id = $ln['idUsuario'];
                $query_usuario = "SELECT * FROM `usuario` WHERE `id` = '{$id}' LIMIT 1";
                $result_usuario = $db->consultar($query_usuario,$db);
                $ln_usuario = $result_usuario->fetch_assoc();
                echo $ln_usuario['nome'];
                ?>
            </td>
            <td>
                <?php if($_SESSION['tipo_acesso'] != 2){ ?>
                <button type="button" id="editar_<?= $ln['id'] ?>" class="btn btn-primary botao-editar-consulta"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</button>
                <?php
                }
                $query_flag_anamnese = "SELECT `id` FROM `$banco_consulta` WHERE `idUsuario` = {$ln_usuario['id']}";
                if(($result_flag_anamnese = $db->consultar($query_flag_anamnese,$db)) && $_SESSION['tipo_acesso'] != 3 ) if($result_flag_anamnese->num_rows > 0){    
                ?>
                <button type="button" id="vizualiza-anamnese_<?= $ln_usuario['id'] ?>" class="btn btn-primary botao-vizualizar-anamnese"><i class="fa fa-eye" aria-hidden="true"></i> Ficha de Pré-avaliação</button>
                <?php 
                }
                ?>
                <?php if($ln['diagnostico'] != "" && ($_SESSION['tipo_acesso'] == 1 || $_SESSION['tipo_acesso'] == 4)){ ?>
                <button type="button" id="avaliar_<?= $ln['id_diagnostico'] ?>" class="btn btn-primary botao-avaliar-consulta"><i class="fa fa-certificate" aria-hidden="true"></i> Avaliar </button>
                <?php } ?>
            </td>
        </tr>

        <?php
        }
        ?>
    </tbody>
</table>
<link href='<?= URL_BASE ?>includes/dataTable/datatables.min.css' rel='stylesheet' />
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src='<?= URL_BASE ?>includes/dataTable/datatables.min.js'></script>
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
            url: '<?= URL_BASE ?>getConsulta.php',
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
                $("#editar-label-paciente").val(data[0].nome);
                $("#editar-paciente").val(data[0].idPaciente);
                $("#editar-label-atendente").val(data[0].nomeAluno);
                $("#editar-atendente").val(data[0].idAluno);
                $("#modal-body-consultas-admin").hide(200);
                setTimeout(function(){
                    $(".editar-consulta").show(300);                   
                    $("#editar-label-tipo-consulta").autocomplete({        
                        minLength: 0,
                        source: opcoes_editar,
                        select: function(event, ui) {
                            $("#editar-label-tipo-consulta").val(ui.item.label);
                            $("#editar-tipo-consulta").val(ui.item.value);            
                            return false;
                        }      
                    }).on('focus', function(event) {
                        var self = this;
                        $("#label-tipo-consulta").autocomplete("search", this.value);
                    }); 
                    $("#editar-label-atendente").autocomplete({        
                        minLength: 0,
                        source: alunos,
                        select: function(event, ui) {
                            $("#editar-label-atendente").val(ui.item.label);
                            $("#editar-atendente").val(ui.item.value);            
                            return false;
                        }      
                    }).on('focus', function(event) {
                        var self = this;
                        $("#editar-label-atendente").autocomplete("search", this.value);
                    });
                    $("#editar-label-paciente").autocomplete({        
                        minLength: 0,
                        source: pacientes_editar,
                        select: function(event, ui) {
                            $("#editar-label-paciente").val(ui.item.label);
                            $("#editar-paciente").val(ui.item.value);            
                            return false;
                        }      
                    }).on('focus', function(event) {
                        var self = this;
                        $("#label-paciente").autocomplete("search", this.value);
                    });
                    $(".botao-excluir-consulta").click(function(){
                        if(confirm("Tem certeza que deseja cancelar a consulta?")){
                            id = ($(this).attr("id").split("_"))[1];
                            $.post("<?= URL_BASE ?>controler/controler.php",{idConsulta:id,acao:"excluir-consulta"},function(){
                                $(".fecha-modal-consultas-admin").click();
                                setTimeout(function(){
                                    excluirEventoCalendario(id);                 
                                },100);
                                return 1;                
                            });
                        }else{
                            return 0;
                        }
                    });
                },50);                
            }                               
        });        
    }
    function getEditHorario(periodo,clinica,horario){        
        $.post("<?= URL_BASE ?>getPeriodo.php",{periodo:periodo,clinica:clinica,horario:horario},function(data){
            $("#editar-horario").html(data);            
        });
    }
    $(".botao-editar-consulta").click(function(){
        editarConsulta(($(this).attr('id').split("_"))[1]);
    });        
    $(".voltar-tabela-consultas").on("click",function(){
        $(".editar-consulta").hide(200);
        setTimeout(function(){
            $("#modal-body-consultas-admin").show(300);     
        },50);
    });
    $(".voltar-tabela-anamnese").click(function(){
        $("#anamnese-fisioterapia-body").hide(200);
        $("#anamnese-enfermagem-body").hide(200);
        setTimeout(function(){
            $("#modal-body-consultas-admin").show(300);     
        },50);
    });
    var opcoes_editar = [
        <?php
        while($ln_tipo = $result_tipo->fetch_assoc()){
            echo '{ label: "'.$ln_tipo['descricao'].'", value: "'.$ln_tipo['id'].'"},';
        }            
        ?>      
    ];
    var pacientes_editar = [
        <?php                              
        while($ln_pacientes = $result_pacientes->fetch_assoc()){ 
            echo '{ label: "'.$ln_pacientes['nome'].'", value: "'.$ln_pacientes['id'].'"},';
        }
        ?>
    ]
    var alunos = [
        <?php
        while($ln_alunos = $result_alunos->fetch_assoc()){
            echo '{ label: "'.$ln_alunos['nome'].'", value: "'.$ln_alunos['id'].'" },';
        }
        ?>
    ];

    
    $(".botao-avaliar-consulta").click(function(){
        var id = ($(this).attr("id").split("_"))[1];
        $.ajax({
            url: '<?= URL_BASE ?>/getAvaliacao.php',
            type: 'POST',
            data: {idAvaliacao: id},
            dataType: 'JSON',
            success: function(data){
                $("#idProntuario").val(data[0].id);
                $("#idConsulta").val(data[0].id_consulta);
                $("#cod_diagnostico").val(data[0].cod_diagnostico);
                $("#texto_diagnostico").val(data[0].texto_diagnostico);
                $("#nota_avaliacao").val(data[0].nota_avaliacao);
                $("#texto_avaliacao").val(data[0].texto_avaliacao);
                $("#avaliador").val(data[0].nome_avaliador);
                if(<?= $admin->getId() ?> != data[0].id_avaliador && data[0].flag_avaliacao == 0){
                    $("#botao-avaliar-consulta").hide();
                    $("#nota_avaliacao").attr("disabled",true);
                    $("#texto_avaliacao").attr("disabled",true);
                }else{
                    $("#botao-avaliar-consulta").show();
                    $("#nota_avaliacao").attr("disabled",false);
                    $("#texto_avaliacao").attr("disabled",false);
                }
                $("#modal-body-consultas-admin").hide(300);     
                setTimeout(function(){
                    $("#modal-body-avalia-consulta").show(300);   
                },50);
            }                               
        });
        
            
        $(".voltar-tabela-consultas-avaliacao").click(function(){
            $("#modal-body-avalia-consulta").hide(300);     
            setTimeout(function(){
                $("#modal-body-consultas-admin").show(300);     
            },50);
        });
    });
    $(".botao-vizualizar-anamnese").click(function(){
        var id_usuario = ($(this).attr("id").split("_"))[1];
        <?php
        if($clinica == "fisioterapia"){
            $banco_consulta = "anamnesefisio";
        ?>
        $.post('<?= URL_BASE ?>getAnamnese.php', {id_usuario: id_usuario, bancoConsulta: "<?= $banco_consulta; ?>"}, function(data){            
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
            var $radios = $('input:radio[name=alergia-fisioterapia]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].alergia+']').prop('checked', true);
            }
            $("#desc-alergia-fisio").val(data[0].descAlergia);
            var $radios = $('input:radio[name=medicamento-fisioterapia]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].medicamento+']').prop('checked', true);
            }
            $("#desc-medicamento-fisio").val(data[0].descMedicamento);
            var $radios = $('input:radio[name=fumo-fisioterapia]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].fumo+']').prop('checked', true);
            }
            $("#freq-fumo-fisio").val(data[0].freqFumo); 
            var $radios = $('input:radio[name=drogas-fisioterapia]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].drogas+']').prop('checked', true);
            }
            $("#freq-drogas-fisio").val(data[0].freqDrogas);            
            var $radios = $('input:radio[name=alcool-fisioterapia]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].bebidas+']').prop('checked', true);
            }
            $("#freq-alcool-fisio").val(data[0].freqBebidas); 
            var $radios = $('input:radio[name=exercicios-fisioterapia]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].exercicios+']').prop('checked', true);
            }
            $("#freq-exercicios-fisio").val(data[0].freqExercicios);
            var $radios = $('input:radio[name=recreacao-fisioterapia]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].recreacao+']').prop('checked', true);
            }
            $("#freq-recreacao-fisio").val(data[0].freqRecreacao);  
            var $radios = $('input:radio[name=animais-fisioterapia]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].animais+']').prop('checked', true);
            }
            $("#freq-animais-fisio").val(data[0].descAnimais);               
            var $radios = $('input:radio[name=posto-fisioterapia]');
            if($radios.is(':checked') === false) {
                $radios.filter('[value='+data[0].postos+']').prop('checked', true);
            }
            $("#doencas-familia").val(data[0].doencaFamilia);
            $("#tratamento-familia").val(data[0].tratamentoFamilia);
            $("#idUsuario").val(data[0].id_usuario);
        },"json");
        $("#modal-body-consultas-admin").hide(200);
        setTimeout(function(){
            $("#anamnese-fisioterapia-body").show(300);     
        },50);
        <?php
        }else{
            $banco_consulta = "anamneseenfermagem";
        ?>
        $.post('<?= URL_BASE ?>getAnamnese.php', {id_usuario:id_usuario, bancoConsulta: "<?= $banco_consulta; ?>"}, function(data){
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
        },"json");
        $("#modal-body-consultas-admin").hide(200);
        setTimeout(function(){
            $("#anamnese-enfermagem-body").show(300);     
        },50);
        <?php
        }
        ?>
    });
</script>