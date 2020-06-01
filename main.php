<?php require_once "init.php";
require_once DIR."includes/header/header.php"; 
require_once DIR."/classes/DB.php";
require_once DIR."/classes/usuarios.php";
$usuario = new Usuario("","","","","","","","","","","","","","","","","","","","","","","");
$usuario->validaSessao($db);
$id_usuario=$_SESSION['id'];
$query_consultas = "SELECT `a`.`id` AS `id`, `a`.`data_inicio` AS `data_inicio`,`a`.`data_fim` AS `data_fim`,`b`.`descricao` AS `descricao` FROM `consulta` AS `a` INNER JOIN `tipoconsulta` AS `b` ON `a`.`idTipoConsulta` = `b`.`id` WHERE `a`.`idUsuario` = '$id_usuario'";
$result = $db->consultar($query_consultas,$db);
while($ln = $result->fetch_assoc()){
    $response[] = array("title"=>$ln['descricao'],"start"=>$ln['data_inicio'],"end"=>$ln['data_fim'],"id"=>$ln['id']);
}    
if(isset($response)){
    $json = json_encode($response);
}else{
    $response[] = array("title"=>"","start"=>"","end"=>"","id"=>"");
    $json = json_encode($response);
}

$query_anamnsese_fisioterapia = "SELECT `idUsuario` FROM `anamnesefisio` WHERE `idUsuario` = ".$usuario->getId();
$mensagem_anamnese_fisio = 0;
$result_anamnese_fisioterapia = $db->consultar($query_anamnsese_fisioterapia,$db);
if($result_anamnese_fisioterapia->num_rows == 0) $mensagem_anamnese_fisio = 1;
$query_anamnsese_enfermagem = "SELECT `idUsuario` FROM `anamneseenfermagem` WHERE `idUsuario` = ".$usuario->getId();
$mensagem_anamnese_enfermagem = 0;
$result_anamnese_enfermagem = $db->consultar($query_anamnsese_enfermagem,$db);
if($result_anamnese_enfermagem->num_rows == 0) $mensagem_anamnese_enfermagem = 1;
include_once "includes/header/menu.php";
?>

<div class="separador"></div>
<div class="container">
    <?php if($mensagem_anamnese_fisio){  ?>
    <div class="aviso">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <span class="titulo-aviso">Atenção!!!</span>                
            </div>
        </div>        
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <span class="conteudo-aviso">Você ainda não preencheu a sua ficha de pré-atendimento de Fisioterapia. Clique no botão abaixo para preencher.</span>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4">
                <a href="anamnese-fisioterapia.php"><button  class="btn btn-primary botao">Clique aqui para preencher</button></a>
            </div>
        </div>
    </div>    
    <br>
    <?php } ?>
    <?php if($mensagem_anamnese_enfermagem){  ?>
    <div class="aviso">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <span class="titulo-aviso">Atenção!!!</span>                
            </div>
        </div>        
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <span class="conteudo-aviso">Você ainda não preencheu a sua ficha de pré-atendimento de Enfermagem. Clique no botão abaixo para preencher.</span>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4">
                <a href="anamnese-enfermagem.php"><button  class="btn btn-primary botao">Clique aqui para preencher</button></a>
            </div>
        </div>
    </div>
    <br>
    <?php } ?>
    <div class="separador"></div>
    <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-8">
            <div id="calendario">            
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="row" id="div-botao-cadastrar">
                <button class="btn btn-primary cadastrar-consulta botao ">+ Cadastrar Consulta</button>                
            </div>
            <div class="row" id="div-botao-cancelar">
                <button class="btn btn-primary botao" id="voltar-editar">Voltar</button>                
            </div>
            <br>
            <div class="row">
                <div class="cadastro-consulta">
                    <form id="cadastro-consulta" method="POST" action="<?= URL_BASE ?>controler/controler.php">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h3>Cadastrar Consulta</h3>
                                <h6 id="tipo_clinica">(Fisioterapia)</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="data">Data da consulta:</label><br>
                                <input type="date" name="data" class="form-control campo-texto">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="periodo">Período:</label><br>
                                <select name="periodo" id="periodo" class="form-control campo-texto">
                                    <option value="Manhã">Manhã</option>
                                    <option value="Tarde">Tarde</option>
                                    <option value="Noite">Noite</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">                            
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="horario">Horário:</label><br>
                                <div id="horario">
                                    
                                </div>
                            </div>                            
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="tipo-consulta">Tipo da consulta</label>
                                <div id="tipo-consulta">
                                    
                                </div>                                
                            </div>
                        </div>
                        <br>                                             
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input type="hidden" name="clinica-consulta-usuario" value="fisioterapia">
                                <input type="hidden" name="acao" value="cadastrar-consulta-usuario">
                                <input type="hidden" name="usuario" class="form-control campo-texto" value="<?php echo $_SESSION['id']; ?>">
                                <input type="submit" name="cadastrar-consulta" class="btn btn-primary botao" value="Cadastrar">
                            </div>
                        </div>
                    </form>                    
                </div>
                <div class="editar-consulta" class="row">
                    <form id="edita-consulta" method="POST" action="<?= URL_BASE ?>controler/controler.php">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h3>Editar Consulta</h3>                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="data">Data da consulta:</label><br>
                                <input type="date" id="editar-data" name="data" class="form-control campo-texto">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="periodo">Período:</label><br>
                                <select name="periodo" id="editar-periodo" class="form-control campo-texto">
                                    <option value="Manhã">Manhã</option>
                                    <option value="Tarde">Tarde</option>
                                    <option value="Noite">Noite</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">                            
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="editar-horario">Horário:</label><br>
                                <div id="editar-horario">
                                    
                                </div>
                            </div>                            
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="tipo-consulta">Tipo da consulta</label>
                                <div id="editar-tipo-consulta">
                                    
                                </div>  
                            </div>
                        </div>
                        <br>                                       
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <button class="btn btn-danger botao" id="cancelar-editar">Cancelar consulta</button>  
                                <br>      
                                <input type="hidden" name="clinica-consulta-usuario" value="fisioterapia">
                                <input type="hidden" name="acao" value="editar-consulta-usuario">
                                <input type="hidden" id="idConsulta" name="idConsulta">
                                <input type="hidden" name="usuario" class="form-control campo-texto" value="<?php echo $_SESSION['id']; ?>">
                                <br>
                                <input type="submit" name="editar-consulta" class="btn btn-primary botao" value="Editar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link href='includes/fullCalendar/packages/core/main.css' rel='stylesheet' />
<link href='includes/fullCalendar/packages/daygrid/main.css' rel='stylesheet' />
<link href='includes/fullCalendar/packages/timegrid/main.css' rel='stylesheet' />


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src='includes/fullCalendar/packages/core/main.js'></script>
<script src='includes/fullCalendar/packages/daygrid/main.js'></script>
<script src='includes/fullCalendar/packages/timegrid/main.js'></script>
<script src='includes/fullCalendar/packages/core/locales/pt-br.js'></script>
<script src='includes/fullCalendar/packages/interaction/main.js'></script>

<script>

    document.addEventListener('DOMContentLoaded', function() {
    $("#periodo").on("change",function(){
        periodo = $(this).val();
        clinica = $("#tipo_clinica").html();
        getHorario(periodo,clinica);
    });
    $("#editar-periodo").on("change",function(){
        periodo = $(this).val();
        clinica = $("#tipo_clinica").html();
        getEditHorario(periodo,clinica);
    });
    var calendarEl = document.getElementById('calendario');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'interaction','dayGrid','timeGrid' ],
        selectable:true,
        header: {
            left: 'title',
            center: 'Fisioterapia,Enfermagem',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        customButtons: {
            Fisioterapia: {
                text: 'Fisioterapia',
                click: function() {
                    $("#tipo_clinica").html("(Fisioterapia)");
                    $("#button-tipo-clinica").val("fisioterapia");
                    if($(".cadastro-consulta").is(':visible')){
                        $(".cadastrar-consulta").click();
                        setTimeout(function(){$(".cadastrar-consulta").click()},500);                           
                    }
                    $.post("getConsultas.php",{tipo:"Fisioterapia",id_usuario: <?php echo $id_usuario * 4801000 ?>},function(data){
                        var obj = jQuery.parseJSON(data);
                        var eventSources = calendar.getEventSources(); 
                        var len = eventSources.length;
                        for (var i = 0; i < len; i++) { 
                            eventSources[i].remove(); 
                        } 
                        $(obj).each(function(){
                            calendar.addEvent(this); 
                        })
                    });
                }
            },
            Enfermagem: {
                text: 'Enfermagem',
                click: function() {
                    $("#tipo_clinica").html("(Enfermagem)");
                    $("#button-tipo-clinica").val("enfermagem");
                    if($(".cadastro-consulta").is(':visible')){
                        $(".cadastrar-consulta").click();
                        setTimeout(function(){$(".cadastrar-consulta").click()},500);
                    }
                    $.post("getConsultas.php",{tipo:"Enfermagem",id_usuario: <?php echo $id_usuario * 4801000 ?>},function(data){
                        var obj = jQuery.parseJSON(data);
                        var eventSources = calendar.getEventSources(); 
                        var len = eventSources.length;
                        for (var i = 0; i < len; i++) {
                            eventSources[i].remove(); 
                        }
                        calendar.addEvent(obj); 
                    });
                }                
            }
        },
        events:<?php echo $json; ?>,
        dayClick: function() {
            alert("FOI");
        },
        eventClick: function(info) {
            editarConsulta(info.event.id);
            if($(".cadastro-consulta").is(':visible')){
                $(".cadastrar-consulta").click();
            };
            $("#div-botao-cadastrar").hide(500);
            setTimeout(function(){
                $("#div-botao-cancelar").show(500);
            },100);
            // change the border color just for fun
            info.el.style.borderColor = 'red';
        }
    });    
    calendar.render();
    calendar.setOption('locale', 'pt-br');
    $(".cadastrar-consulta").on("click",function(){
        if($(".cadastro-consulta").is(':visible')){
            $(".cadastro-consulta").hide(500);            
        }else{
            $(".cadastro-consulta").show(500);
            clinica = $("#tipo_clinica").html();
            periodo = $("#periodo").val();
            $.post("getPeriodo.php",{periodo:periodo,clinica:clinica},function(data){
                $("#horario").html(data);
            });
            $.post("getTipoConsulta.php",{clinica:clinica},function(data){
                $("#tipo-consulta").html(data);
            });
        }
    });
    $("#voltar-editar").on("click",function(){
        $("#div-botao-cancelar").hide(500);
        setTimeout(function(){
            $("#div-botao-cadastrar").show(500);
        },100);
        $(".editar-consulta").hide(500);     
    });
    $("#cancelar-editar").on("click",function(){
        if(confirm("Tem certeza que deseja cancelar a consulta?")){
            id = $("#idConsulta").val();
            $.post("controler/controler.php",{idConsulta:id,acao:"excluir-consulta"},function(){
                return 1;
            });
        }else{
            return 0;
        }
    });
    function getHorario(periodo,clinica){        
        $.post("getPeriodo.php",{periodo:periodo,clinica:clinica},function(data){
            $("#horario").html(data);
        });
    }
    function getEditHorario(periodo,clinica,horario){        
        $.post("getPeriodo.php",{periodo:periodo,clinica:clinica,horario:horario},function(data){
            $("#editar-horario").html(data);            
        });
    }
    function editarConsulta(id){
        $.ajax({
            url: 'getConsulta.php',
            type: 'POST',
            data: {id:id},
            dataType: 'JSON',
            success: function(data){
                $("#editar-data").val(data[0].data_inicio) ;  
                $("#editar-periodo").val(data[0].periodo) ;
                getEditHorario(data[0].periodo,data[0].clinica,data[0].horario);
                $.post("getTipoConsulta.php",{clinica:data[0].clinica,tipo:data[0].idTipo},function(data){
                    $("#editar-tipo-consulta").html(data);
                });
                $("#editar-tipo-consulta").val(data[0].idTipo);
                $("#idConsulta").val(data[0].id);
                $(".editar-consulta").show(500);     
            }                               
        });
    }
});

</script>