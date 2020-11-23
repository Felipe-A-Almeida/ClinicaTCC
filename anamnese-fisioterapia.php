<?php 
require_once "init.php";
require_once DIR."includes/header/header.php"; 
require_once DIR."/classes/DB.php";
require_once DIR."/classes/usuarios.php";
$usuario = new Usuario("","","","","","","","","","","","","","","","","","","","","","","","");
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
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <a href="http://localhost/clinicaTcc/main.php?clinica=fisioterapia">
                <button class="btn btn-primary botao">
                    Voltar
                </button>
            </a>            
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
                    <input type="text" name="freq-recreacao" id="freq-recreacao" class="form-control freq-recreacao" placeholder="Com que frequência">                
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
        <div class="separador"></div>        
            <div class="row form-group"> 
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <input type="hidden" name="acao" id="acao" value="cadastrar-anamnese-fisioterapia">
                    <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $usuario->getId(); ?>">
                    <button class="btn btn-primary botao botao-enviar-cadastro">Cadastrar</button>
                </div>                
            </div> 
        </form>


    </div>

    