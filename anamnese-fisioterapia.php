<?php 
require_once "init.php";
require_once DIR."includes/header/header.php"; 
require_once DIR."/classes/DB.php";
require_once DIR."/classes/usuarios.php";
$usuario = new Usuario("","","","","","","","","","","","","","","","","","","","","","","");
$usuario->validaSessao($db);
$id_usuario=$_SESSION['id'];


?>
<div class="separador"></div>
<div class="container container-anamnese">
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
                    <textarea class="form-control" name="queixa-principal" id="queixa-principal" required></textarea>
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
            <legend>História Social</legend>
            <div class="separador"></div>                
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
                    <input type="text" name="freq-recreacao" id="freq-recreacao" class="form-control freq-recreacao" placeholder="Com que frequência">                
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
            <div class="row form-group"> 
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <input type="hidden" name="acao" id="acao" value="cadastrar-anamnese-fisioterapia">
                    <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $usuario->getId(); ?>">
                    <button class="btn btn-primary botao botao-enviar-cadastro">Cadastrar</button>
                </div>                
            </div> 
        </fieldset>
    </form>


    </div>

    