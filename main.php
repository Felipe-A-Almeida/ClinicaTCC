<?php require_once "init.php";
require_once DIR."includes/header/header.php"; 
require_once DIR."/classes/DB.php";
require_once DIR."/classes/usuarios.php";
$usuario = new Usuario("","","","","","","","","","","","","","","","","","","","","","","","");
$usuario->validaSessao($db);
$id_usuario=$_SESSION['id'];


$query_anamnsese_fisioterapia = "SELECT `idUsuario` FROM `anamnesefisio` WHERE `idUsuario` = ".$usuario->getId();
$mensagem_anamnese_fisio = 0;
$result_anamnese_fisioterapia = $db->consultar($query_anamnsese_fisioterapia,$db);
if($result_anamnese_fisioterapia->num_rows == 0) $mensagem_anamnese_fisio = 1;
$query_anamnsese_enfermagem = "SELECT `idUsuario` FROM `anamneseenfermagem` WHERE `idUsuario` = ".$usuario->getId();
$mensagem_anamnese_enfermagem = 0;
$result_anamnese_enfermagem = $db->consultar($query_anamnsese_enfermagem,$db);
if($result_anamnese_enfermagem->num_rows == 0) $mensagem_anamnese_enfermagem = 1;
?>
<div class="page-body">
<?php
include_once "includes/header/menu.php";
?>

    <div class="separador"></div>
    <div class="container">    
        <div id="div-botoes-clinica">
            <div class="row">
                <h1>SELECIONE UMA CLÍNICA</h1>
            </div>
            <br>
            <div class="row">            
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <a href="main.php?clinica=fisioterapia">
                        <button  class="btn btn-primary botao botao-clinica">Fisioterapia</button>
                    </a>                
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <a href="main.php?clinica=enfermagem">
                        <button  class="btn btn-primary botao botao-clinica">Enfermagem</button>
                    </a>                
                </div>
            </div>
        </div>
        <?php if($mensagem_anamnese_fisio && isset($_GET['clinica']) && $_GET['clinica'] == 'fisioterapia'){  ?>
        <div class="separador"></div>
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
        <?php if($mensagem_anamnese_enfermagem && isset($_GET['clinica']) && $_GET['clinica'] == 'enfermagem'){  ?>
        <div class="separador"></div>
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
        <?php 
        if(isset($_GET['clinica'])){

            $clinica = $_GET['clinica'];
            
            $query_tipo = "SELECT * FROM `tipoconsulta` WHERE `tipo` = '$clinica'";
            $result_tipo = $db->consultar($query_tipo,$db);

            $query_consultas = "SELECT `a`.`id` AS `id`, `a`.`data_inicio` AS `data_inicio`,`a`.`data_fim` AS `data_fim`,`b`.`descricao` AS `descricao` FROM `consulta` AS `a` INNER JOIN `tipoconsulta` AS `b` ON `a`.`idTipoConsulta` = `b`.`id` WHERE `a`.`idUsuario` = '$id_usuario' AND `tipo` = '$clinica'";
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
        ?>
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
                                    <h6 id="tipo_clinica">(<?= ucfirst($_GET['clinica']) ?>)</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label for="data">Data da consulta:</label><br>
                                    <input type="date" name="data" class="form-control campo-texto" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label for="periodo">Período:</label><br>
                                    <select name="periodo" id="periodo" class="form-control campo-texto" required>
                                        <option value="Manhã">Manhã</option>
                                        <option value="Tarde">Tarde</option>
                                        <option value="Noite">Noite</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">                            
                                <div class="col-sm-12 col-md-12 col-lg-12" required>
                                    <label for="horario">Horário:</label><br>
                                    <div id="horario">
                                        
                                    </div>
                                </div>                            
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label for="tipo-consulta">Tipo da consulta</label>
                                    <input name="label-tipo-consulta" id="label-tipo-consulta" class="form-control" required>
                                    <input type="hidden" name="tipo-consulta" id="tipo-consulta" class="form-control"  required>                                
                                </div>
                            </div>
                            <br>                                             
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <input type="hidden" name="clinica-consulta-usuario" value="<?= $_GET['clinica']?>">
                                    <input type="hidden" name="acao" value="cadastrar-consulta-usuario">
                                    <input type="hidden" name="usuario" class="form-control campo-texto" value="<?php echo $_SESSION['id']; ?>">
                                    <input type="submit" name="cadastrar-consulta" class="btn btn-primary botao" value="Cadastrar">
                                </div>
                            </div>
                        </form>                    
                    </div>                
                </div>
            </div>
        </div>
        <button type="hidden" id="abre-modal-consultas-usuario" data-toggle="modal" data-target="#modal-consultas-usuario" hidden></button>
        <?php 
        }
        ?>
    </div>
    <div class="separador"></div>
    <div class="separador"></div>


    <!--  =======================================================================================================  -->
    <!--  MODAL CCONSULTAS =======================================================================================================  -->
    <div class="modal" tabindex="-1" role="dialog" id="modal-consultas-usuario">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Consultas</h5>
            <button type="button" class="fecha-modal-consultas-usuario btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <!--  MODAL ANAMNESE ENFERMAGEM=========================================================================================================  -->
        <div id="anamnese-enfermagem-body">
            <div class="form-editar-enfermagem">
                <div class="separador"></div>
                <div class="botao-voltar row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <button class="btn btn-primary voltar-tabela-anamnese"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;VOLTAR</button>
                    </div>                
                </div>   
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="row texto-centro">
                            <h1 class="tituloColorido">Ficha de Pré-Avaliação</h1>
                            <span class="tipo-clinica">Enfermagem</span>
                        </div>
                    </div>
                </div>
                <div class="separador"></div>
                <form class="formulario-cadastro" method="POST" action="<?= URL_BASE ?>controler/controler.php">
                    <fieldset>    
                        <legend>Histórico da Doença Atual(HDA)</legend>
                        <div class="separador"></div>        
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="queixa-principal"><span class="span-required">*</span>Queixas Principais:</label>
                                <br>
                                <textarea name="queixa-principal" id="queixa-principal-enfermagem" class="form-control" required></textarea>
                            </div>                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-4 col-lg-4">  
                                <label for="inicio">Início:</label>
                                <br>
                                <input type="date" name="inicio" class="form-control" id="inicio-enfermagem">
                            </div>                                
                        </div>
                    </fieldset>
                    <fieldset>    
                        <legend>História Patológica Regressa</legend>
                        <div class="separador"></div>        
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="doenca">Possui Alguma Doença:</label>
                                <br>
                                <input type="checkbox" name="doenca[]" id="doenca" value="cardiopatia">Cardiopatia
                                <input type="checkbox" name="doenca[]" id="doenca" value="hipertensao">Hipertensão
                                <input type="checkbox" name="doenca[]" id="doenca" value="diabetes">Diabetes
                                <input type="checkbox" name="doenca[]" id="doenca" value="cancer">Câncer
                                <input type="checkbox" name="doenca[]" id="doenca" value="outros">Outros<input type="text" name="desc-doencas" id="desc-doencas" class="form-control desc-doencas">
                            </div>                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="alergias">Possui alguma alergia?</label>
                                <br>
                                <input type="radio" name="alergia" value="0">Não
                                <input type="radio" name="alergia" value="1">Sim    
                                <input type="text" name="desc-alergia" id="desc-alergia" class="form-control desc-alergia">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="medicamento">Faz uso de algum medicamento?</label>
                                <br>
                                <input type="radio" name="medicamento" value="0">Não
                                <input type="radio" name="medicamento" value="1">Sim    
                                <input type="text" name="desc-medicamento" id="desc-medicamento" class="form-control desc-medicamento">                
                            </div>                                
                        </div>
                    </fieldset>
                    <fieldset>    
                        <legend>História Social</legend>
                        <div class="separador"></div>        
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="fumo">Você fuma?</label>
                                <br>
                                <br>
                                <input type="radio" name="fumo" value="0">Não
                                <input type="radio" name="fumo" value="1">Sim    
                                <input type="text" name="freq-fumo" id="freq-fumo" class="form-control freq-fumo" placeholder="Quantidade por dia">   
                            </div>                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="drogas">Você usa drogas ilícitas?</label>
                                <br>
                                <input type="radio" name="drogas" value="0">Não
                                <input type="radio" name="drogas" value="1">Sim    
                                <input type="text" name="freq-drogas" id="freq-drogas" class="form-control freq-drogas" placeholder="Frequência de uso">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="alcool">Você ingere bebidas alcóolicas?</label>
                                <br>
                                <input type="radio" name="alcool" value="0">Não
                                <input type="radio" name="alcool" value="1">Sim    
                                <input type="text" name="freq-alcool" id="freq-alcool" class="form-control freq-alcool" placeholder="Frequência de uso">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="exercicios">Você pratica exercícios físicos?</label>
                                <br>
                                <input type="radio" name="exercicios" value="0">Não
                                <input type="radio" name="exercicios" value="1">Sim    
                                <input type="text" name="freq-exercicios" id="freq-exercicios" class="form-control freq-exercicios" placeholder="Com que frequência">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="recreacao">Você pratica alguma recreação ou lazer?</label>
                                <br>
                                <input type="radio" name="recreacao" value="0">Não
                                <input type="radio" name="recreacao" value="1">Sim    
                                <input type="text" name="freq-recreacao" id="freq-recreacao-enfermagem" class="form-control freq-recreacao" placeholder="Com que frequência">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="animais">Você possui animais domésticos?</label>
                                <br>
                                <input type="radio" name="animais" value="0">Não
                                <input type="radio" name="animais" value="1">Sim    
                                <input type="text" name="freq-animais" id="freq-animais" class="form-control freq-animais" placeholder="Quais animais">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="posto">Há postos de saúde na região onde reside?</label>
                                <br>
                                <input type="radio" name="posto" value="0">Não
                                <input type="radio" name="posto" value="1">Sim                                    
                            </div>                                
                        </div>
                    </fieldset>
                    <fieldset>    
                        <legend>História Familiar</legend>
                        <div class="separador"></div>        
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="doencas-familia">Há alguma doença relacionada na familia:</label>
                                <input type="text" name="doencas-familia" id="doencas-familia-enfermagem" class="form-control doencas-familia" placeholder="Caso não haja, deixe o campo em branco"> 
                            </div>                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="tratamento-familia">Foi feito algum tratamento? Se sim, especifique:</label>
                                <input type="text" name="tratamento-familia" id="tratamento-familia-enfermagem" class="form-control tratamento-familia" placeholder="Caso não haja, deixe o campo em branco"> 
                            </div>                           
                        </div>            
                    </fieldset>
                    <div class="separador"></div>        
                    <div class="row form-group"> 
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="hidden" name="acao" id="acao" value="editar-anamnese-enfermagem">
                            <input type="hidden" name="idUsuario" id="idUsuario-enfermagem">
                            <input type="hidden" name="idConsulta" id="idConsulta-enfermagem">
                            <button class="btn btn-primary botao botao-enviar-cadastro">Cadastrar</button>
                        </div>                
                    </div> 
                </form>
            </div>
        </div>
    <!-- ===================================================================================================================================  -->
    <!--  MODAL ANAMNESE FISIOTERAPIA=======================================================================================================  -->
        <div id="anamnese-fisioterapia-body">
            <div class="form-editar-fisioterapia">
                <div class="separador"></div>
                <div class="botao-voltar row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <button class="btn btn-primary voltar-tabela-anamnese"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;VOLTAR</button>
                    </div>                
                </div>            
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="row texto-centro">
                            <h1 class="tituloColorido">Ficha de Pré-Avaliação</h1>
                            <span class="tipo-clinica">Fisioterapia</span>
                        </div>
                    </div>
                </div>
                <div class="separador"></div>            
                <form class="formulario-cadastro" method="POST" action="<?= URL_BASE ?>controler/controler.php">
                    <fieldset>    
                        <legend>Histórico da Doença Atual(HDA)</legend>
                        <div class="separador"></div>        
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="queixa-principal"><span class="span-required">*</span>Queixas Principais:</label>
                                <br>
                                <textarea name="queixa-principal" id="queixa-principal" class="form-control" required></textarea>
                            </div>                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-4 col-lg-4">  
                                <label for="inicio">Início:</label>
                                <br>
                                <input type="date" name="inicio" class="form-control" id="inicio">
                            </div>                                
                        </div>
                    </fieldset>   
                    <fieldset>    
                        <legend>História Patológica Regressa</legend>
                        <div class="separador"></div>        
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="doenca">Possui Alguma Doença:</label>
                                <br>
                                <input type="checkbox" name="doenca[]" id="doenca" value="cardiopatia">Cardiopatia
                                <input type="checkbox" name="doenca[]" id="doenca" value="hipertensao">Hipertensão
                                <input type="checkbox" name="doenca[]" id="doenca" value="diabetes">Diabetes
                                <input type="checkbox" name="doenca[]" id="doenca" value="cancer">Câncer
                                <input type="checkbox" name="doenca[]" id="doenca" value="outros">Outros<input type="text" name="desc-doencas" id="desc-doencas-fisio" class="form-control desc-doencas">
                            </div>                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="alergias">Possui alguma alergia?</label>
                                <br>
                                <input type="radio" name="alergia" value="0">Não
                                <input type="radio" name="alergia" value="1">Sim    
                                <input type="text" name="desc-alergia" id="desc-alergia-fisio" class="form-control desc-alergia">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="medicamento">Faz uso de algum medicamento?</label>
                                <br>
                                <input type="radio" name="medicamento" value="0">Não
                                <input type="radio" name="medicamento" value="1">Sim    
                                <input type="text" name="desc-medicamento" id="desc-medicamento-fisio" class="form-control desc-medicamento">                
                            </div>                                
                        </div>
                    </fieldset>     
                    <fieldset>    
                        <legend>História Social</legend>
                        <div class="separador"></div>        
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="fumo">Você fuma?</label>
                                <br>
                                <br>
                                <input type="radio" name="fumo" value="0">Não
                                <input type="radio" name="fumo" value="1">Sim    
                                <input type="text" name="freq-fumo" id="freq-fumo-fisio" class="form-control freq-fumo" placeholder="Quantidade por dia">   
                            </div>                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="drogas">Você usa drogas ilícitas?</label>
                                <br>
                                <input type="radio" name="drogas" value="0">Não
                                <input type="radio" name="drogas" value="1">Sim    
                                <input type="text" name="freq-drogas" id="freq-drogas-fisio" class="form-control freq-drogas" placeholder="Frequência de uso">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="alcool">Você ingere bebidas alcóolicas?</label>
                                <br>
                                <input type="radio" name="alcool" value="0">Não
                                <input type="radio" name="alcool" value="1">Sim    
                                <input type="text" name="freq-alcool" id="freq-alcool-fisio" class="form-control freq-alcool" placeholder="Frequência de uso">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="exercicios">Você pratica exercícios físicos?</label>
                                <br>
                                <input type="radio" name="exercicios" value="0">Não
                                <input type="radio" name="exercicios" value="1">Sim    
                                <input type="text" name="freq-exercicios" id="freq-exercicios-fisio" class="form-control freq-exercicios" placeholder="Com que frequência">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="recreacao">Você pratica alguma recreação ou lazer?</label>
                                <br>
                                <input type="radio" name="recreacao" value="0">Não
                                <input type="radio" name="recreacao" value="1">Sim    
                                <input type="text" name="freq-recreacao" id="freq-recreacao-fisio" class="form-control freq-recreacao" placeholder="Com que frequência">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="animais">Você possui animais domésticos?</label>
                                <br>
                                <input type="radio" name="animais" value="0">Não
                                <input type="radio" name="animais" value="1">Sim    
                                <input type="text" name="freq-animais" id="freq-animais-fisio" class="form-control freq-animais" placeholder="Quais animais">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="posto">Há postos de saúde na região onde reside?</label>
                                <br>
                                <input type="radio" name="posto" value="0">Não
                                <input type="radio" name="posto" value="1">Sim                                    
                            </div>                                
                        </div>
                    </fieldset>
                    <fieldset>    
                        <legend>História Familiar</legend>
                        <div class="separador"></div>        
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="doencas-familia">Há alguma doença relacionada na familia:</label>
                                <input type="text" name="doencas-familia" id="doencas-familia" class="form-control doencas-familia" placeholder="Caso não haja, deixe o campo em branco"> 
                            </div>                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="tratamento-familia">Foi feito algum tratamento? Se sim, especifique:</label>
                                <input type="text" name="tratamento-familia" id="tratamento-familia" class="form-control tratamento-familia" placeholder="Caso não haja, deixe o campo em branco"> 
                            </div>                           
                        </div>            
                    </fieldset>
                    <fieldset>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input type="hidden" name="acao" id="acao" value="editar-anamnese-fisioterapia">
                                <input type="hidden" name="idUsuario" id="idUsuario">
                                <input type="hidden" id="idConsultaFisio" name="idConsultaFisio">
                                <button class="btn btn-primary botao botao-enviar-cadastro">Editar</button>
                            </div>                
                        </div> 
                    </fieldset>
                </form>
            </div>
        </div>
    <!--  =======================================================================================================  -->
        <!--  MODAL EDITA CCONSULTAS ================================================================================  -->

        <div id="modal-body-editar-consultas-usuario" class="conteudo-modal">      
            <div class="editar-consulta" class="row">
                <div class="botao-voltar row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <button class="btn btn-primary voltar-tabela-consultas"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;VOLTAR</button>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <button class="btn btn-danger adireita" id="cancelar-editar"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Cancelar consulta</button>  
                    </div>
                </div>
                <br>
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
                            <input name="label-tipo-consulta" id="editar-label-tipo-consulta" class="form-control">
                            <input type="hidden" name="tipo-consulta" id="editar-tipo-consulta" class="form-control">
                        </div>
                    </div>
                    <br>                                       
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">                           
                            <input type="hidden" name="clinica-consulta-usuario" value="<?= $_GET['clinica']; ?>">
                            <input type="hidden" name="acao" value="editar-consulta-usuario">
                            <input type="hidden" id="idConsulta" name="idConsulta">
                            <input type="hidden" name="usuario" class="form-control campo-texto" value="<?php echo $_SESSION['id']; ?>">
                            <input type="submit" name="editar-consulta" class="btn btn-primary botao" value="Editar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--  =======================================================================================================  -->
        <div id="modal-body-consultas-usuario" class="conteudo-modal">      

        </div>      
        </div>
    </div>
    </div>    
</div>
<?php include DIR."/includes/nps/nps.html" ?>


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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
    <?php if(isset($_GET['clinica'])){ ?>
    var opcoes = [
        <?php
        while($ln_tipo = $result_tipo->fetch_assoc()){
            echo '{ label: "'.$ln_tipo['descricao'].'", value: "'.$ln_tipo['id'].'"},';
        }            
        ?>      
    ];
    $( "#label-tipo-consulta" ).autocomplete({
        source: opcoes,
        minLength: 0,
        select: function(event, ui) {
            $( "#label-tipo-consulta" ).val(ui.item.label);
            $( "#tipo-consulta" ).val(ui.item.value);           
            return false;
        },        
    })
    .on('focus', function(event) {
        var self = this;
        $("#label-tipo-consulta").autocomplete( "search", this.value);
    });         
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
            center: 'prev,today,next',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },        
        events:<?php echo $json; ?>,                
    });    
    calendar.on('dateClick', function(info) {
        var data = info.dateStr;
        clinica = $("#tipo_clinica").html();
        $.post("tabela_consultas.php", {data: data,clinica: clinica,opcoes:opcoes }, function(response){
            $("#modal-body-consultas-usuario").html(response);
            $("#abre-modal-consultas-usuario").click();
        })
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
                $(".fecha-modal-consultas-usuario").click();
                setTimeout(function(){
                    evento = calendar.getEventById(id);
                    evento.remove();
                },100);
                return 1;                
            });
        }else{
            return 0;
        }
    });
    $("#modal-consultas-usuario").on("hide.bs.modal",function(){
        $(".editar-consulta").hide(200);
        setTimeout(function(){
            $("#modal-body-consultas-usuario").show(300);     
        },50);    
    });   
    
    function getHorario(periodo,clinica){
        $.post("getPeriodo.php",{periodo:periodo,clinica:clinica},function(data){
            $("#horario").html(data);
        });
    }
    <?php } ?>

    <?php include DIR."/includes/nps/nps.js" ?>

});

</script>