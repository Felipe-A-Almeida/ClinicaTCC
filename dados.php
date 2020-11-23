<?php 
require_once "init.php";
require_once DIR."includes/header/header.php"; 
require_once DIR."/classes/DB.php";
require_once DIR."/classes/usuarios.php";
require_once DIR."/classes/anamneseFisioterapia.php";
require_once DIR."/classes/anamneseEnfermagem.php";


$usuario = new Usuario("","","","","","","","","","","","","","","","","","","","","","","","");
$usuario->validaSessao($db);
$id_usuario=$_SESSION['id'];
$usuario->setUsuario($id_usuario,$db);
$anamnese_enfermagem = new AnamneseEnfermagem("","","","","","","","","","","","","","","","","","","","","","","","","");
$anamnese_enfermagem->setAnamnese($usuario->getId(),$db);
$anamnese_fisioterapia = new AnamneseFisioterapia("","","","","","","","","","","","","","","","","","","","","","","","","");
$anamnese_fisioterapia->setAnamnese($usuario->getId(),$db);

?>
<div class="page-body">
<?php
include_once "includes/header/menu.php";
?>
    <div class="separador"></div>
    <div class="container">    
        <div class="separador"></div>
        <div class="form-editar-dados form-editar">
            <fieldset>    
                <div class="row">
                    <div class="col-sm-12 col-md-7 col-lg-7">
                        <legend>Dados Pessoais</legend>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5">
                        <div class="botoes-anamnese">
                            <button button type="button" class="btn btn-primary" id="editar-anamnese-fisioterapia" <?php if($anamnese_fisioterapia->getId() == ""){ echo "hidden"; } ?>>Editar Ficha de Fisioterapia</button>
                            <button button type="button" class="btn btn-primary" id="editar-anamnese-enfermagem" <?php if($anamnese_enfermagem->getId() == ""){ echo "hidden"; } ?>>Editar Ficha de Enfermagem</button>
                        </div>  
                    </div>
                </div>                      
                <div class="separador"></div>        
                <form class="formulario-editar" method="POST" action="<?= URL_BASE ?>controler/controler.php">
                    <div class="row form-group">  
                        <div class="col-sm-12 col-md-6 col-lg-6">                       
                            <label for="nome" class="label-campo"><span class="span-required">*</span>Nome Completo:</label>
                            <br>
                            <input type="text" name="nome" id="nome" class="form-control campo-formulario campo-texto" placeholder="Digite seu Nome Completo" value="<?= $usuario->getNome(); ?>" required>
                            <br>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">                         
                            <label for="RG" class="label-campo"><span class="span-required">*</span>RG:</label>
                            <br>
                            <input type="text" name="RG" id="RG" class="form-control campo-formulario campo-texto class-rg" placeholder="Digite seu RG" value="<?= $usuario->getRg(); ?>" required>
                            <br>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6 col-lg-6">  
                            <label for="CPF" class="label-campo"><span class="span-required">*</span>CPF:</label>
                            <br>
                            <input type="text" name="CPF" id="CPF" class="form-control campo-formulario campo-texto class-cpf" placeholder="Digite seu CPF" value="<?= $usuario->getCpf() ?>" required>
                            <br>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">                   
                            <label for="data-nascimento" class="label-campo"><span class="span-required">*</span>Data de Nascimento:</label>
                            <br>
                            <input type="date" name="data-nascimento" id="data-nascimento" class="form-control campo-formulario campo-texto" placeholder="00/00/0000" value="<?= $usuario->getDataNascimento(); ?>" required>
                            <br>
                        </div>
                    </div>
                    <div class="row form-group">        
                        <div class="col-sm-12 col-md-6 col-lg-6">                   
                            <label for="naturalidade" class="label-campo"><span class="span-required">*</span>Naturalidade:</label>
                            <br>
                            <select name="naturalidade" id="naturalidade" class="form-control campo-formulario" required>
                                <option selected="" value="">Selecione o Estado</option>
                                <option value="AC" <?php if($usuario->getNaturalidade() == "AC"){ echo "selected"; } ?>>Acre</option>
                                <option value="AL" <?php if($usuario->getNaturalidade() == "AL"){ echo "selected"; } ?>>Alagoas</option>
                                <option value="AP" <?php if($usuario->getNaturalidade() == "AP"){ echo "selected"; } ?>>Amapá</option>
                                <option value="AM" <?php if($usuario->getNaturalidade() == "AM"){ echo "selected"; } ?>>Amazonas</option>
                                <option value="BA" <?php if($usuario->getNaturalidade() == "BA"){ echo "selected"; } ?>>Bahia</option>
                                <option value="CE" <?php if($usuario->getNaturalidade() == "CE"){ echo "selected"; } ?>>Ceará</option>
                                <option value="DF" <?php if($usuario->getNaturalidade() == "DF"){ echo "selected"; } ?>>Distrito Federal</option>
                                <option value="ES" <?php if($usuario->getNaturalidade() == "ES"){ echo "selected"; } ?>>Espírito Santo</option>
                                <option value="GO" <?php if($usuario->getNaturalidade() == "GO"){ echo "selected"; } ?>>Goiás</option>
                                <option value="MA" <?php if($usuario->getNaturalidade() == "MA"){ echo "selected"; } ?>>Maranhão</option>
                                <option value="MT" <?php if($usuario->getNaturalidade() == "MT"){ echo "selected"; } ?>>Mato Grosso</option>
                                <option value="MS" <?php if($usuario->getNaturalidade() == "MS"){ echo "selected"; } ?>>Mato Grosso do Sul</option>
                                <option value="MG" <?php if($usuario->getNaturalidade() == "MG"){ echo "selected"; } ?>>Minas Gerais</option>
                                <option value="PA" <?php if($usuario->getNaturalidade() == "PA"){ echo "selected"; } ?>>Pará</option>
                                <option value="PB" <?php if($usuario->getNaturalidade() == "PB"){ echo "selected"; } ?>>Paraíba</option>
                                <option value="PR" <?php if($usuario->getNaturalidade() == "PR"){ echo "selected"; } ?>>Paraná</option>
                                <option value="PE" <?php if($usuario->getNaturalidade() == "PE"){ echo "selected"; } ?>>Pernambuco</option>
                                <option value="PI" <?php if($usuario->getNaturalidade() == "PI"){ echo "selected"; } ?>>Piauí</option>
                                <option value="RJ" <?php if($usuario->getNaturalidade() == "RJ"){ echo "selected"; } ?>>Rio de Janeiro</option>
                                <option value="RS" <?php if($usuario->getNaturalidade() == "RS"){ echo "selected"; } ?>>Rio Grande do Sul</option>
                                <option value="RN" <?php if($usuario->getNaturalidade() == "RN"){ echo "selected"; } ?>>Rio Grande do Norte</option>
                                <option value="RO" <?php if($usuario->getNaturalidade() == "RO"){ echo "selected"; } ?>>Rondônia</option>
                                <option value="RR" <?php if($usuario->getNaturalidade() == "RR"){ echo "selected"; } ?>>Roraima</option>
                                <option value="SC" <?php if($usuario->getNaturalidade() == "SC"){ echo "selected"; } ?>>Santa Catarina</option>
                                <option value="SP" <?php if($usuario->getNaturalidade() == "SP"){ echo "selected"; } ?>>São Paulo</option>
                                <option value="SR" <?php if($usuario->getNaturalidade() == "SR"){ echo "selected"; } ?>>Sergipe</option>
                                <option value="TO" <?php if($usuario->getNaturalidade() == "TO"){ echo "selected"; } ?>>Tocantins</option>
                            </select>
                            <br>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">                   
                            <label for="telefone" class="label-campo"><span class="span-required">*</span>Telefone:</label>
                            <br>
                            <input type="text" name="telefone" id="telefone" class="form-control campo-formulario campo-texto class-fone" placeholder="Digite seu Telefone" value="<?= $usuario->getTelefone() ?>" required>
                            <br>
                        </div>
                    </div>
                
                    <div class="row form-group"> 
                        <div class="col-sm-12 col-md-6 col-lg-6">                         
                            <label for="nomeMae" class="label-campo"><span class="span-required">*</span>Nome da mãe:</label>
                            <br>
                            <input type="text" name="nomeMae" id="nomeMae" class="form-control campo-formulario campo-texto" placeholder="Digite o nome da mãe" value="<?= $usuario->getNomeMae(); ?>" required>
                            <br>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">                         
                            <label for="nomePai" class="label-campo"><span class="span-required">*</span>Nome do pai:</label>
                            <br>
                            <input type="text" name="nomePai" id="nomePai" class="form-control campo-formulario campo-texto" placeholder="Digite o nome do pai" value="<?= $usuario->getNomePai(); ?>" required>
                            <br>
                        </div>
                    </div>
                    <div class="row form-group"> 
                        <div class="col-sm-12 col-md-6 col-lg-6">  
                            <label for="cartao-sus" class="label-campo"><span class="span-required">*</span>Cartão SUS:</label>
                            <br>
                            <input type="text" name="cartao-sus" id="cartao-sus" class="form-control campo-formulario campo-texto class-cartaoSUS" placeholder="Digite número do cartão SUS" value="<?= $usuario->getCartaoSUS(); ?>" required>
                            <br>
                        </div> 
                        <div class="col-sm-12 col-md-3 col-lg-3">                       
                            <label for="profissao" class="label-campo"><span class="span-required">*</span>Profissão:</label>
                            <br>
                            <input type="text" name="profissao" id="profissao" class="form-control campo-formulario campo-texto" placeholder="Digite sua Profissão" value="<?= $usuario->getProfissao() ?>" required>
                            <br>
                        </div>  
                        <div class="col-sm-12 col-md-3 col-lg-3">                       
                            <label for="tempoServico" class="label-campo"><span class="span-required">*</span>Tempo de Serviço(meses):</label>
                            <br>                   
                            <input type="number" name="tempoServico" id="tempoServico" class="form-control campo-formulario campo-texto class-anos" value="<?= $usuario->getTempoServico(); ?>" required>                        
                            <br>
                        </div>                  
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="email" class="label-campo"><span class="span-required">*</span>Email:</label>
                            <br>                   
                            <input type="email" name="email" class="form-control" id="email" value="<?= $usuario->getEmail(); ?>">
                            <br>
                        </div>            
                        <div class="col-sm-12 col-md-3 col-lg-3">                       
                            <label for="sexo" class="label-campo"><span class="span-required">*</span>Sexo:</label>                    
                            <select name="sexo" id="sexo" class="form-control campo-formulario campo-texto">
                                <option value="">Selecione uma opção...</option>
                                <option value="M" <?php if($usuario->getSexo() == "M"){ echo "selected"; } ?>>Masculino</option>
                                <option value="F" <?php if($usuario->getSexo() == "F"){ echo "selected"; } ?>>Feminino</option>
                                <option value="O" <?php if($usuario->getSexo() == "O"){ echo "selected"; } ?>>Outros</option>                        
                            </select>
                            <br>
                        </div>
                        <div class="col-sm-12 col-md-3 col-lg-3">                       
                            <label for="estado-civil" class="label-campo"><span class="span-required">*</span>Estado Civil:</label>
                            <br>
                            <select name="estadoCivil" id="estadoCivil" class="form-control campo-formulario campo-texto">
                                <option value="">Selecione uma opção...</option>
                                <option value="solteiro" <?php if($usuario->getEstadoCivil() == "solteiro"){ echo "selected"; } ?>>Solteiro(a)</option>
                                <option value="casado" <?php if($usuario->getEstadoCivil() == "casado"){ echo "selected"; } ?>>Casado(a)</option>
                                <option value="divorciado" <?php if($usuario->getEstadoCivil() == "divorciado"){ echo "selected"; } ?>>Divorciado(a)</option>
                                <option value="viuvo" <?php if($usuario->getEstadoCivil() == "viuvo"){ echo "selected"; } ?>>Viúvo(a)</option>
                                <option value="separado" <?php if($usuario->getEstadoCivil() == "separado"){ echo "selected"; } ?>>Separado</option>
                            </select>
                            <br>
                        </div>    
                    </div>                           
                </fieldset>
                    
                <div class="separador"></div>
                <hr>
                <fieldset>
                
                    <legend>Endereço</legend>
                    
                    <div class="row form-group">   
                        <div class="col-sm-12 col-md-2 col-lg-2">                       
                            <label for="cep" class="label-campo"><span class="span-required">*</span>CEP:</label>
                            <br>
                            <input type="text" name="cep" id="cep" class="form-control campo-formulario campo-texto class-cep" placeholder="Digite seu CEP" value="<?= $usuario->getCEP(); ?>" required>
                            <br>
                        </div>
                        <div class="col-sm-12 col-md-5 col-lg-5">                     
                            <label for="logradouro" class="label-campo"><span class="span-required">*</span>Logradouro:</label>
                            <br>
                            <input type="text" name="logradouro" id="logradouro" class="form-control campo-formulario campo-texto" placeholder="Ex.: Rua, Avenida" value="<?= $usuario->getLogradouro(); ?>" required>
                            <br>
                        </div>
                        <div class="col-sm-12 col-md-5 col-lg-5">                          
                            <label for="bairro" class="label-campo"><span class="span-required">*</span>Bairro:</label>
                            <br>
                            <input type="text" name="bairro" id="bairro" class="form-control campo-formulario campo-texto" placeholder="Digite seu Bairro" value="<?= $usuario->getBairro(); ?>" required>
                            <br>
                        </div>
                    </div>
                    <div class="row form-group">                        
                        <div class="col-sm-12 col-md-6 col-lg-6">  
                            <label for="cidade" class="label-campo"><span class="span-required">*</span>Cidade:</label>
                            <br>
                            <input type="text" name="cidade" id="cidade" class="form-control campo-formulario campo-texto" placeholder="Digite sua Cidade" value="<?= $usuario->getCidade(); ?>" required>
                            <br>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">                              
                            <label for="estado" class="label-campo"><span class="span-required">*</span>Estado:</label>
                            <br>
                            <select name="estado" id="estado" class="form-control campo-formulario" required>
                            <option selected="" value="">Selecione o Estado</option>
                                <option value="AC" <?php if($usuario->getEstado() == "AC"){ echo "selected"; } ?>>Acre</option>
                                <option value="AL" <?php if($usuario->getEstado() == "AL"){ echo "selected"; } ?>>Alagoas</option>
                                <option value="AP" <?php if($usuario->getEstado() == "AP"){ echo "selected"; } ?>>Amapá</option>
                                <option value="AM" <?php if($usuario->getEstado() == "AM"){ echo "selected"; } ?>>Amazonas</option>
                                <option value="BA" <?php if($usuario->getEstado() == "BA"){ echo "selected"; } ?>>Bahia</option>
                                <option value="CE" <?php if($usuario->getEstado() == "CE"){ echo "selected"; } ?>>Ceará</option>
                                <option value="DF" <?php if($usuario->getEstado() == "DF"){ echo "selected"; } ?>>Distrito Federal</option>
                                <option value="ES" <?php if($usuario->getEstado() == "ES"){ echo "selected"; } ?>>Espírito Santo</option>
                                <option value="GO" <?php if($usuario->getEstado() == "GO"){ echo "selected"; } ?>>Goiás</option>
                                <option value="MA" <?php if($usuario->getEstado() == "MA"){ echo "selected"; } ?>>Maranhão</option>
                                <option value="MT" <?php if($usuario->getEstado() == "MT"){ echo "selected"; } ?>>Mato Grosso</option>
                                <option value="MS" <?php if($usuario->getEstado() == "MS"){ echo "selected"; } ?>>Mato Grosso do Sul</option>
                                <option value="MG" <?php if($usuario->getEstado() == "MG"){ echo "selected"; } ?>>Minas Gerais</option>
                                <option value="PA" <?php if($usuario->getEstado() == "PA"){ echo "selected"; } ?>>Pará</option>
                                <option value="PB" <?php if($usuario->getEstado() == "PB"){ echo "selected"; } ?>>Paraíba</option>
                                <option value="PR" <?php if($usuario->getEstado() == "PR"){ echo "selected"; } ?>>Paraná</option>
                                <option value="PE" <?php if($usuario->getEstado() == "PE"){ echo "selected"; } ?>>Pernambuco</option>
                                <option value="PI" <?php if($usuario->getEstado() == "PI"){ echo "selected"; } ?>>Piauí</option>
                                <option value="RJ" <?php if($usuario->getEstado() == "RJ"){ echo "selected"; } ?>>Rio de Janeiro</option>
                                <option value="RS" <?php if($usuario->getEstado() == "RS"){ echo "selected"; } ?>>Rio Grande do Sul</option>
                                <option value="RN" <?php if($usuario->getEstado() == "RN"){ echo "selected"; } ?>>Rio Grande do Norte</option>
                                <option value="RO" <?php if($usuario->getEstado() == "RO"){ echo "selected"; } ?>>Rondônia</option>
                                <option value="RR" <?php if($usuario->getEstado() == "RR"){ echo "selected"; } ?>>Roraima</option>
                                <option value="SC" <?php if($usuario->getEstado() == "SC"){ echo "selected"; } ?>>Santa Catarina</option>
                                <option value="SP" <?php if($usuario->getEstado() == "SP"){ echo "selected"; } ?>>São Paulo</option>
                                <option value="SR" <?php if($usuario->getEstado() == "SR"){ echo "selected"; } ?>>Sergipe</option>
                                <option value="TO" <?php if($usuario->getEstado() == "TO"){ echo "selected"; } ?>>Tocantins</option>
                            </select>
                            <br>
                        </div>   
                    </div>

                    <div class="row form-group">  
                        <div class="col-sm-12 col-md-6 col-lg-6">  
                                <label for="complemento" class="label-campo">Complemento:</label>
                                <br>
                                <input type="text" name="complemento" id="complemento" class="form-control campo-formulario campo-texto" placeholder="Digite seu Complemento" value="<?= $usuario->getComplemento(); ?>">
                                <br>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">  
                            <label for="numero" class="label-campo">Número:</label>
                            <br>
                            <input type="text" name="numero" id="numero" class="form-control campo-formulario campo-texto" placeholder="" value="<?= $usuario->getNumero(); ?>">
                            <br>
                        </div>
                    </div>
                    
                </fieldset>
                    
                <div class="separador"></div>
                                                                        
                <div class="row form-group">
                    <input type="hidden" name="acao" value="editar-dados-usuario">
                    <input type="hidden" name="idUsuario" value="<?= $id_usuario ?>">
                    <button class="btn btn-primary botao botao-enviar-editar">Salvar</button>
                </div>               
            </form>
        </div>
        <!--  DIV ANAMNESE FISIOTERAPIA=======================================================================================================  -->
        <div id="anamnese-fisioterapia-body">
            <div class="form-editar-fisioterapia">
                <div class="separador"></div>
                <div class="botao-voltar row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <button class="btn btn-primary voltar-anamnese-fisioterapia-editar"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;VOLTAR</button>
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
                                <textarea name="queixa-principal" id="queixa-principal" class="form-control" required><?= $anamnese_fisioterapia->getQueixaPrincipal() ?></textarea>
                            </div>                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-4 col-lg-4">  
                                <label for="inicio">Início:</label>
                                <br>
                                <input type="date" name="inicio" class="form-control" id="inicio" value="<?= date("Y-m-d",strtotime($anamnese_fisioterapia->getInicio())); ?>">
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
                                <input type="checkbox" name="doenca[]" id="doenca" value="cardiopatia" <?php if(strpos($anamnese_fisioterapia->getDoenca(), "cardiopatia") !== false){ echo "checked"; } ?>>Cardiopatia
                                <input type="checkbox" name="doenca[]" id="doenca" value="hipertensao" <?php if(strpos($anamnese_fisioterapia->getDoenca(), "hipertensao") !== false){ echo "checked"; } ?>>Hipertensão
                                <input type="checkbox" name="doenca[]" id="doenca" value="diabetes" <?php if(strpos($anamnese_fisioterapia->getDoenca(), "diabetes") !== false){ echo "checked"; } ?>>Diabetes
                                <input type="checkbox" name="doenca[]" id="doenca" value="cancer" <?php if(strpos($anamnese_fisioterapia->getDoenca(), "cancer") !== false){ echo "checked"; } ?>>Câncer
                                <input type="checkbox" name="doenca[]" id="doenca" value="outros" <?php if(strpos($anamnese_fisioterapia->getDoenca(), "outros") !== false){ echo "checked"; } ?>>Outros<input type="text" name="desc-doencas" id="desc-doencas-fisio" class="form-control desc-doencas" value="<?= $anamnese_fisioterapia->getDescDoenca() ?>">
                            </div>                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="alergias">Possui alguma alergia?</label>
                                <br>
                                <input type="radio" name="alergia" value="0" <?php if($anamnese_fisioterapia->getAlergia() == "0"){ echo "checked"; } ?>>Não
                                <input type="radio" name="alergia" value="1" <?php if($anamnese_fisioterapia->getAlergia() == "1"){ echo "checked"; } ?>>Sim    
                                <input type="text" name="desc-alergia" id="desc-alergia-fisio" class="form-control desc-alergia" value="<?= $anamnese_fisioterapia->getDescAlergia() ?>">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="medicamento">Faz uso de algum medicamento?</label>
                                <br>
                                <input type="radio" name="medicamento" value="0" <?php if($anamnese_fisioterapia->getMedicamento() == "0"){ echo "checked"; } ?>>Não
                                <input type="radio" name="medicamento" value="1" <?php if($anamnese_fisioterapia->getMedicamento() == "1"){ echo "checked"; } ?>>Sim    
                                <input type="text" name="desc-medicamento" id="desc-medicamento-fisio" class="form-control desc-medicamento" value="<?= $anamnese_fisioterapia->getDescMedicamento() ?>">                
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
                                <input type="radio" name="fumo" value="0" <?php if($anamnese_fisioterapia->getFumo() == "0"){ echo "checked"; } ?>>Não
                                <input type="radio" name="fumo" value="1" <?php if($anamnese_fisioterapia->getFumo() == "1"){ echo "checked"; } ?>>Sim    
                                <input type="text" name="freq-fumo" id="freq-fumo-fisio" class="form-control freq-fumo" placeholder="Quantidade por dia" value="<?= $anamnese_fisioterapia->getFreqFumo() ?>">   
                            </div>                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="drogas">Você usa drogas ilícitas?</label>
                                <br>
                                <input type="radio" name="drogas" value="0" <?php if($anamnese_fisioterapia->getDrogas() == "0"){ echo "checked"; } ?>>Não
                                <input type="radio" name="drogas" value="1" <?php if($anamnese_fisioterapia->getDrogas() == "1"){ echo "checked"; } ?>>Sim    
                                <input type="text" name="freq-drogas" id="freq-drogas-fisio" class="form-control freq-drogas" placeholder="Frequência de uso" value="<?= $anamnese_fisioterapia->getFreqDrogas() ?>">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="alcool">Você ingere bebidas alcóolicas?</label>
                                <br>
                                <input type="radio" name="alcool" value="0" <?php if($anamnese_fisioterapia->getBebidas() == "0"){ echo "checked"; } ?>>Não
                                <input type="radio" name="alcool" value="1" <?php if($anamnese_fisioterapia->getBebidas() == "1"){ echo "checked"; } ?>>Sim    
                                <input type="text" name="freq-alcool" id="freq-alcool-fisio" class="form-control freq-alcool" placeholder="Frequência de uso" value="<?= $anamnese_fisioterapia->getFreqBebidas() ?>">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="exercicios">Você pratica exercícios físicos?</label>
                                <br>
                                <input type="radio" name="exercicios" value="0" <?php if($anamnese_fisioterapia->getExercicios() == "0"){ echo "checked"; } ?>>Não
                                <input type="radio" name="exercicios" value="1" <?php if($anamnese_fisioterapia->getExercicios() == "1"){ echo "checked"; } ?>>Sim    
                                <input type="text" name="freq-exercicios" id="freq-exercicios-fisio" class="form-control freq-exercicios" placeholder="Com que frequência" value="<?= $anamnese_fisioterapia->getFreqExercicios() ?>">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="recreacao">Você pratica alguma recreação ou lazer?</label>
                                <br>
                                <input type="radio" name="recreacao" value="0" <?php if($anamnese_fisioterapia->getRecreacao() == "0"){ echo "checked"; } ?>>Não
                                <input type="radio" name="recreacao" value="1" <?php if($anamnese_fisioterapia->getRecreacao() == "1"){ echo "checked"; } ?>>Sim    
                                <input type="text" name="freq-recreacao" id="freq-recreacao-fisio" class="form-control freq-recreacao" placeholder="Com que frequência" value="<?= $anamnese_fisioterapia->getDescRecreacao() ?>">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="animais">Você possui animais domésticos?</label>
                                <br>
                                <input type="radio" name="animais" value="0" <?php if($anamnese_fisioterapia->getAnimais() == "0"){ echo "checked"; } ?>>Não
                                <input type="radio" name="animais" value="1" <?php if($anamnese_fisioterapia->getAnimais() == "1"){ echo "checked"; } ?>>Sim    
                                <input type="text" name="freq-animais" id="freq-animais-fisio" class="form-control freq-animais" placeholder="Quais animais" value="<?= $anamnese_fisioterapia->getDescAnimais() ?>">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="posto">Há postos de saúde na região onde reside?</label>
                                <br>
                                <input type="radio" name="posto" value="0" <?php if($anamnese_fisioterapia->getPostos() == "0"){ echo "checked"; } ?>>Não
                                <input type="radio" name="posto" value="1" <?php if($anamnese_fisioterapia->getPostos() == "1"){ echo "checked"; } ?>>Sim                                    
                            </div>                                
                        </div>
                    </fieldset>
                    <fieldset>    
                        <legend>História Familiar</legend>
                        <div class="separador"></div>        
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="doencas-familia">Há alguma doença relacionada na familia:</label>
                                <input type="text" name="doencas-familia" id="doencas-familia" class="form-control doencas-familia" placeholder="Caso não haja, deixe o campo em branco" value="<?= $anamnese_fisioterapia->getDoencaFamilia() ?>"> 
                            </div>                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="tratamento-familia">Foi feito algum tratamento? Se sim, especifique:</label>
                                <input type="text" name="tratamento-familia" id="tratamento-familia" class="form-control tratamento-familia" placeholder="Caso não haja, deixe o campo em branco" value="<?= $anamnese_fisioterapia->getTratamentoFamilia() ?>"> 
                            </div>                           
                        </div>            
                    </fieldset>
                    <fieldset>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input type="hidden" name="acao" id="acao" value="editar-anamnese-fisioterapia">
                                <input type="hidden" name="idUsuario" id="idUsuario" value="<?= $id_usuario ?>">
                                <input type="hidden" id="idConsultaFisio" name="idConsultaFisio">
                                <button class="btn btn-primary botao botao-enviar-cadastro">Salvar</button>
                            </div>                
                        </div> 
                    </fieldset>
                </form>
            </div>
        </div>
        <!--  =======================================================================================================  -->
        <!--  DIV ANAMNESE ENFERMAGEM=========================================================================================================  -->
        <div id="anamnese-enfermagem-body">
            <div class="form-editar-enfermagem">
                <div class="separador"></div>
                <div class="botao-voltar row">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <button class="btn btn-primary voltar-anamnese-enfermagem-editar"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;VOLTAR</button>
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
                                <textarea name="queixa-principal" id="queixa-principal-enfermagem" class="form-control" required><?= $anamnese_enfermagem->getQueixaPrincipal() ?></textarea>
                            </div>                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-4 col-lg-4">  
                                <label for="inicio">Início:</label>
                                <br>
                                <input type="date" name="inicio" class="form-control" id="inicio-enfermagem" value="<?= date("Y-m-d",strtotime($anamnese_enfermagem->getInicio())) ?>"> 
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
                                <input type="checkbox" name="doenca[]" id="doenca" value="cardiopatia" <?php if(strpos($anamnese_enfermagem->getDoenca(), "cardiopatia") !== false){ echo "checked"; } ?>>Cardiopatia
                                <input type="checkbox" name="doenca[]" id="doenca" value="hipertensao" <?php if(strpos($anamnese_enfermagem->getDoenca(), "hipertensao") !== false){ echo "checked"; } ?>>Hipertensão
                                <input type="checkbox" name="doenca[]" id="doenca" value="diabetes" <?php if(strpos($anamnese_enfermagem->getDoenca(), "diabetes") !== false){ echo "checked"; } ?>>Diabetes
                                <input type="checkbox" name="doenca[]" id="doenca" value="cancer" <?php if(strpos($anamnese_enfermagem->getDoenca(), "cancer") !== false){ echo "checked"; } ?>>Câncer
                                <input type="checkbox" name="doenca[]" id="doenca" value="outros" <?php if(strpos($anamnese_enfermagem->getDoenca(), "outros") !== false){ echo "checked"; } ?>>Outros<input type="text" name="desc-doencas" id="desc-doencas" class="form-control desc-doencas" <?= $anamnese_enfermagem->getDescDoenca(); ?>>
                            </div>                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="alergias">Possui alguma alergia?</label>
                                <br>
                                <input type="radio" name="alergia" value="0" <?php if($anamnese_enfermagem->getAlergia() == "0"){ echo "checked"; } ?>>Não
                                <input type="radio" name="alergia" value="1" <?php if($anamnese_enfermagem->getAlergia() == "1"){ echo "checked"; } ?>>Sim    
                                <input type="text" name="desc-alergia" id="desc-alergia" class="form-control desc-alergia" value="<?= $anamnese_enfermagem->getDescAlergia() ?>">
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="medicamento">Faz uso de algum medicamento?</label>
                                <br>
                                <input type="radio" name="medicamento" value="0" <?php if($anamnese_enfermagem->getMedicamento() == "0"){ echo "checked"; } ?>>Não
                                <input type="radio" name="medicamento" value="1" <?php if($anamnese_enfermagem->getMedicamento() == "1"){ echo "checked"; } ?>>Sim    
                                <input type="text" name="desc-medicamento" id="desc-medicamento" class="form-control desc-medicamento" value="<?= $anamnese_enfermagem->getDescMedicamento() ?>">
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
                                <input type="radio" name="fumo" value="0" <?php if($anamnese_enfermagem->getFumo() == "0"){ echo "checked"; } ?>>Não
                                <input type="radio" name="fumo" value="1" <?php if($anamnese_enfermagem->getFumo() == "1"){ echo "checked"; } ?>>Sim    
                                <input type="text" name="freq-fumo" id="freq-fumo" class="form-control freq-fumo" placeholder="Quantidade por dia" value="<?= $anamnese_enfermagem->getFreqFumo(); ?>">
                            </div>                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="drogas">Você usa drogas ilícitas?</label>
                                <br>
                                <input type="radio" name="drogas" value="0" <?php if($anamnese_enfermagem->getDrogas() == "0"){ echo "checked"; } ?>>Não
                                <input type="radio" name="drogas" value="1" <?php if($anamnese_enfermagem->getDrogas() == "1"){ echo "checked"; } ?>>Sim    
                                <input type="text" name="freq-drogas" id="freq-drogas" class="form-control freq-drogas" placeholder="Frequência de uso" value="<?= $anamnese_enfermagem->getFreqDrogas(); ?>">
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="alcool">Você ingere bebidas alcóolicas?</label>
                                <br>
                                <input type="radio" name="alcool" value="0" <?php if($anamnese_enfermagem->getBebidas() == "0"){ echo "checked"; } ?>>Não
                                <input type="radio" name="alcool" value="1" <?php if($anamnese_enfermagem->getBebidas() == "1"){ echo "checked"; } ?>>Sim    
                                <input type="text" name="freq-alcool" id="freq-alcool" class="form-control freq-alcool" placeholder="Frequência de uso" value="<?= $anamnese_enfermagem->getFreqBebidas() ?>">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="exercicios">Você pratica exercícios físicos?</label>
                                <br>
                                <input type="radio" name="exercicios" value="0" <?php if($anamnese_enfermagem->getExercicios() == "0"){ echo "checked"; } ?>>Não
                                <input type="radio" name="exercicios" value="1" <?php if($anamnese_enfermagem->getExercicios() == "1"){ echo "checked"; } ?>>Sim    
                                <input type="text" name="freq-exercicios" id="freq-exercicios" class="form-control freq-exercicios" placeholder="Com que frequência" value="<?= $anamnese_enfermagem->getFreqExercicios() ?>">
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="recreacao">Você pratica alguma recreação ou lazer?</label>
                                <br>
                                <input type="radio" name="recreacao" value="0" <?php if($anamnese_enfermagem->getRecreacao() == "0"){ echo "checked"; } ?>>Não
                                <input type="radio" name="recreacao" value="1" <?php if($anamnese_enfermagem->getRecreacao() == "1"){ echo "checked"; } ?>>Sim    
                                <input type="text" name="freq-recreacao" id="freq-recreacao-enfermagem" class="form-control freq-recreacao" placeholder="Com que frequência" value="<?= $anamnese_enfermagem->getDescRecreacao() ?>">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="animais">Você possui animais domésticos?</label>
                                <br>
                                <input type="radio" name="animais" value="0" <?php if($anamnese_enfermagem->getAnimais() == "0"){ echo "checked"; } ?>>Não
                                <input type="radio" name="animais" value="1" <?php if($anamnese_enfermagem->getAnimais() == "1"){ echo "checked"; } ?>>Sim    
                                <input type="text" name="freq-animais" id="freq-animais" class="form-control freq-animais" placeholder="Quais animais" value="<?= $anamnese_enfermagem->getDescAnimais() ?>">                
                            </div>                                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="posto">Há postos de saúde na região onde reside?</label>
                                <br>
                                <input type="radio" name="posto" value="0" <?php if($anamnese_enfermagem->getPostos() == "0"){ echo "checked"; } ?>>Não
                                <input type="radio" name="posto" value="1" <?php if($anamnese_enfermagem->getPostos() == "1"){ echo "checked"; } ?>>Sim                                    
                            </div>                                
                        </div>
                    </fieldset>
                    <fieldset>    
                        <legend>História Familiar</legend>
                        <div class="separador"></div>        
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="doencas-familia">Há alguma doença relacionada na familia:</label>
                                <input type="text" name="doencas-familia" id="doencas-familia-enfermagem" class="form-control doencas-familia" placeholder="Caso não haja, deixe o campo em branco" value="<?= $anamnese_enfermagem->getDoencaFamilia(); ?>"> 
                            </div>                
                        </div>
                        <div class="row form-group"> 
                            <div class="col-sm-12 col-md-12 col-lg-12">  
                                <label for="tratamento-familia">Foi feito algum tratamento? Se sim, especifique:</label>
                                <input type="text" name="tratamento-familia" id="tratamento-familia-enfermagem" class="form-control tratamento-familia" placeholder="Caso não haja, deixe o campo em branco" value="<?= $anamnese_enfermagem->getTratamentoFamilia(); ?>"> 
                            </div>                           
                        </div>            
                    </fieldset>
                    <div class="separador"></div>        
                    <div class="row form-group"> 
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="hidden" name="acao" id="acao" value="editar-anamnese-enfermagem">
                            <input type="hidden" name="idUsuario" id="idUsuario-enfermagem" value="<?= $id_usuario ?>">
                            <button class="btn btn-primary botao botao-enviar-cadastro">Salvar</button>
                        </div>                
                    </div> 
                </form>
            </div>
        </div>
        <!-- ===================================================================================================================================  -->
        <div class="separador"></div>    
    </div>
</div>
<?php include DIR."includes/nps/nps.html"; ?>
<?php require_once("includes/footer/footer.php"); ?>
<script>
    $(document).ready(function(){
        $(".botao-editar").click(function(){  
            $(".form-editar").fadeOut(500);
            if($(this).attr("id") == "editar-dados"){
                if($(".form-editar-dados").is(":visible")){
                    $(".form-editar-dados").fadeOut(500);
                }else{
                    $(".form-editar-dados").fadeIn(500);
                }
            }else{
                if($(this).attr("id") == "editar-anamnese-fisioterapia"){
                    if($(".form-editar-fisioterapia").is(":visible")){
                        $(".form-editar-fisioterapia").fadeOut(500);
                    }else{
                        $(".form-editar-fisioterapia").fadeIn(500);
                    }
                }else{
                    if($(this).attr("id") == "editar-anamnese-enfermagem"){
                        if($(".form-editar-enfermagem").is(":visible")){
                            $(".form-editar-enfermagem").fadeOut(500);
                        }else{
                            $(".form-editar-enfermagem").fadeIn(500);
                        }
                    }
                }
            }
        });
        <?php include DIR."includes/nps/nps.js"; ?>
    })
</script>