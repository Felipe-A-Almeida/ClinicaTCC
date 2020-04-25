<?php require_once("../includes/header/header.php");
require_once DIR."/classes/DB.php";
$query_consultas = "SELECT * FROM `consulta` WHERE 1";
$result = $db->consultar($query_consultas,$db);
while($ln = $result->fetch_assoc()){
    $response[] = array("title"=>'Teste',"start"=>$ln['data_inicio'],"end"=>$ln['data_fim']);
}    
$json = json_encode($response);
echo $json;
include_once "menu.php";
?>

<div class="separador"></div>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-8">
            <div id="calendario">            
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="row">
                <button class="btn btn-primary cadastrar-consulta botao ">+ Cadastrar Consulta</button>                
            </div>
            <br>
            <div class="row">
                <div class="cadastro-consulta">
                    <form id="cadastro-consulta" method="POST" action="<?= URL_BASE ?>controler/controler.php">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <h3>Cadastrar Consulta</h3>
                                <h6>(Fisioterapia)</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="data">Data inicial:</label><br>
                                <input type="date" name="data" class="form-control campo-texto">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="periodo">Data inicial:</label><br>
                                <select name="periodo" class="form-control campo-texto">
                                    <option value="manha">Manhã</option>
                                    <option value="tarde">Tarde</option>
                                    <option value="noite">Noite</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">                            
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="hora-inicio">Hora inicial:</label><br>
                                <input type="time" name="hora-inicio" class="form-control campo-texto">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="hora-fim">Hora final:</label><br>
                                <input type="time" name="hora-fim" class="form-control campo-texto">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="tipo-consulta">Tipo da consulta</label>
                                <select name="tipo-consulta" class="form-control">
                                    <option value="">Selecione um serviço</option>
                                    <?php
                                        $query_tipo_consulta = "SELECT * FROM `tipoconsulta` WHERE 1";
                                        $result_tipo_consulta = $db->consultar($query_tipo_consulta,$db);
                                        while($ln_tipo_consulta = $result_tipo_consulta->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $ln_tipo_consulta['id'] ?>"><?php echo $ln_tipo_consulta['descricao'] ?></option>
                                    <?php
                                            
                                        }
                                    ?>
                                </select> 
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="nome_paciente">Nome do Paciente</label>
                                <input type="text" name="nome_paciente" id="nome_paciente" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input type="hidden" name="clinica-consulta-admin" class="form-control campo-texto" value="fisioterapia">
                                <input type="submit" name="cadastrar-consulta" class="btn btn-primary botao" value="Cadastrar">
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link href='../includes/fullCalendar/packages/core/main.css' rel='stylesheet' />
<link href='../includes/fullCalendar/packages/daygrid/main.css' rel='stylesheet' />
<link href='../includes/fullCalendar/packages/timegrid/main.css' rel='stylesheet' />


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src='../includes/fullCalendar/packages/core/main.js'></script>
<script src='../includes/fullCalendar/packages/daygrid/main.js'></script>
<script src='../includes/fullCalendar/packages/timegrid/main.js'></script>
<script src='../includes/fullCalendar/packages/core/locales/pt-br.js'></script>
<script src='../includes/fullCalendar/packages/interaction/main.js'></script>

<script>

    document.addEventListener('DOMContentLoaded', function() {
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
                    alert('clicked custom button 1!');
                }
            },
            Enfermagem: {
                text: 'Enfermagem',
                click: function() {
                    alert('clicked custom button 2!');
                }
            }
        },
        events:<?php echo $json; ?>,
        dayClick: function() {
            alert("FOI");
        },
        eventClick: function(info) {
            console.log(info)
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
            $( "#nome_paciente" ).autocomplete({
                source: function( request, response ) {
                // Fetch data
                $.ajax({
                    url: "../controler/consulta-pacientes.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        nome: request.term
                    },
                    success: function( data ) {
                        response( data );
                        console.log(data);
                    }
                });
                },
                select: function (event, ui) {
                // Set selection
                $('#nome_paciente').val(ui.item.nome); // display the selected text
                //$('#selectuser_id').val(ui.item.value); // save selected id to input
                return false;
                }
            });                                                      
        }
    });
});

</script>