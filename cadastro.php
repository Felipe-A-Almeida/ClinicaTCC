<?php 
require_once "init.php";
require_once DIR."includes/header/header.php";

?>
<div class="separador"></div>
<div class="container container-cadastro">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="row texto-centro">
                <h1 class="tituloColorido">Cadastrar</h1>
                <span>Preencha os campos abaixo para completar o cadastro</span>
            </div>
        </div>
    </div>
    
    <fieldset>
    
        <legend>Dados Pessoais</legend>
        
        <div class="separador"></div>
        
        <form class="formulario-cadastro" method="POST" action="<?= URL_BASE ?>controler/controler.php">
            <div class="row form-group">  
                <div class="col-sm-12 col-md-6 col-lg-6">                       
                    <label for="nome" class="label-campo"><span class="span-required">*</span>Nome Completo:</label>
                    <br>
                    <input type="text" name="nome" id="nome" class="form-control campo-formulario campo-texto" placeholder="Digite seu Nome Completo" required>
                    <br>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">                         
                    <label for="RG" class="label-campo"><span class="span-required">*</span>RG:</label>
                    <br>
                    <input type="text" name="RG" id="RG" class="form-control campo-formulario campo-texto class-rg" placeholder="Digite seu RG" required>
                    <br>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-12 col-md-6 col-lg-6">  
                    <label for="CPF" class="label-campo"><span class="span-required">*</span>CPF:</label>
                    <br>
                    <input type="text" name="CPF" id="CPF" class="form-control campo-formulario campo-texto class-cpf" placeholder="Digite seu CPF" required>
                    <br>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">                   
                    <label for="data-nascimento" class="label-campo"><span class="span-required">*</span>Data de Nascimento:</label>
                    <br>
                    <input type="date" name="data-nascimento" id="data-nascimento" class="form-control campo-formulario campo-texto" placeholder="00/00/0000" required>
                    <br>
                </div>
            </div>
            <div class="row form-group">        
                <div class="col-sm-12 col-md-6 col-lg-6">                   
                    <label for="naturalidade" class="label-campo"><span class="span-required">*</span>Naturalidade:</label>
                    <br>
                    <select name="naturalidade" id="naturalidade" class="form-control campo-formulario" required>
                        <option selected="" value="">Selecione o Estado</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SR">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                    <br>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">                   
                    <label for="telefone" class="label-campo"><span class="span-required">*</span>Telefone:</label>
                    <br>
                    <input type="text" name="telefone" id="telefone" class="form-control campo-formulario campo-texto class-fone" placeholder="Digite seu Telefone" required>
                    <br>
                </div>
            </div>
        
            <div class="row form-group"> 
                <div class="col-sm-12 col-md-6 col-lg-6">                         
                    <label for="nomeMae" class="label-campo"><span class="span-required">*</span>Nome da mãe:</label>
                    <br>
                    <input type="text" name="nomeMae" id="nomeMae" class="form-control campo-formulario campo-texto" placeholder="Digite o nome da mãe" required>
                    <br>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">                         
                    <label for="nomePai" class="label-campo"><span class="span-required">*</span>Nome do pai:</label>
                    <br>
                    <input type="text" name="nomePai" id="nomePai" class="form-control campo-formulario campo-texto" placeholder="Digite o nome do pai" required>
                    <br>
                </div>
            </div>
            <div class="row form-group"> 
                <div class="col-sm-12 col-md-6 col-lg-6">  
                    <label for="cartao-sus" class="label-campo"><span class="span-required">*</span>Cartão SUS:</label>
                    <br>
                    <input type="text" name="cartao-sus" id="cartao-sus" class="form-control campo-formulario campo-texto class-cartaoSUS" placeholder="Digite número do cartão SUS" required>
                    <br>
                </div> 
                <div class="col-sm-12 col-md-3 col-lg-3">                       
                    <label for="profissao" class="label-campo"><span class="span-required">*</span>Profissão:</label>
                    <br>
                    <input type="text" name="profissao" id="profissao" class="form-control campo-formulario campo-texto" placeholder="Digite sua Profissão" required>
                    <br>
                </div>  
                <div class="col-sm-12 col-md-3 col-lg-3">                       
                    <label for="tempoServico" class="label-campo"><span class="span-required">*</span>Tempo de Serviço(meses):</label>
                    <br>                   
                    <input type="number" name="tempoServico" id="tempoServico" class="form-control campo-formulario campo-texto class-anos" required>                        
                    <br>
                </div>                  
            </div>
            <div class="row form-group">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="email" class="label-campo"><span class="span-required">*</span>Email:</label>
                    <br>                   
                    <input type="email" name="email" class="form-control" id="email">
                    <br>
                </div>            
                <div class="col-sm-12 col-md-3 col-lg-3">                       
                    <label for="sexo" class="label-campo"><span class="span-required">*</span>Sexo:</label>                    
                    <select name="sexo" id="sexo" class="form-control campo-formulario campo-texto">Masculino
                        <option value="">Selecione uma opção...</option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="O">Outros</option>                        
                    </select>
                    <br>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3">                       
                    <label for="estado-civil" class="label-campo"><span class="span-required">*</span>Estado Civil:</label>
                    <br>
                    <select name="estado-civil" id="estado-civil" class="form-control campo-formulario campo-texto">Masculino
                        <option value="">Selecione uma opção...</option>
                        <option value="solteiro">Solteiro(a)</option>
                        <option value="casado">Casado(a)</option>
                        <option value="divorciado">Divorciado(a)</option>
                        <option value="viuvo">Viúvo(a)</option>
                        <option value="separado">Separado</option>
                    </select>
                    <br>
                </div>    
            </div> 
            <div class="row form-group"> 
                <div class="col-sm-12 col-md-6 col-lg-6">  
                    <label for="senha" class="label-campo"><span class="span-required">*</span>Senha:</label>
                    <br>
                    <input type="password" name="senha" id="senha-cadastro" class="form-control campo-formulario campo-texto senha-cadastro" placeholder="Digite uma senha para acessar" required>
                    <br>
                    <span><i>A senha deve conter pelo menos 6 caracteres e pelo menos 1 número</i></span>
                </div> 
                <div class="col-sm-12 col-md-6 col-lg-6">  
                    <label for="confirmaSenha" class="label-campo"><span class="span-required">*</span>Confirmar Senha:</label>
                    <br>
                    <input type="password" name="confirmaSenha" id="confirmaSenha-cadastro" class="form-control campo-formulario campo-texto confirmaSenha-cadastro" placeholder="Digite novamente sua senha" required>
                    <br>
                </div>   
            </div> 
            <div id="erro-senha" class="row form-group">
                <div class="alert alert-danger" role="alert">
                    <span class="erro-senha">A senhas digitadas não correspondem ou são inválidas</span>
                    <input type="hidden" name="acao" value="envia-nova-senha">
                    <input type="hidden" name="token" value="<?= $token ?>">
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
                    <input type="text" name="cep" id="cep" class="form-control campo-formulario campo-texto class-cep" placeholder="Digite seu CEP" required>
                    <br>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-5">                     
                    <label for="logradouro" class="label-campo"><span class="span-required">*</span>Logradouro:</label>
                    <br>
                    <input type="text" name="logradouro" id="logradouro" class="form-control campo-formulario campo-texto" placeholder="Ex.: Rua, Avenida" required>
                    <br>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-5">                          
                    <label for="bairro" class="label-campo"><span class="span-required">*</span>Bairro:</label>
                    <br>
                    <input type="text" name="bairro" id="bairro" class="form-control campo-formulario campo-texto" placeholder="Digite seu Bairro" required>
                    <br>
                </div>
            </div>
            <div class="row form-group">                        
                <div class="col-sm-12 col-md-6 col-lg-6">  
                    <label for="cidade" class="label-campo"><span class="span-required">*</span>Cidade:</label>
                    <br>
                    <input type="text" name="cidade" id="cidade" class="form-control campo-formulario campo-texto" placeholder="Digite sua Cidade" required>
                    <br>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">                              
                    <label for="estado" class="label-campo"><span class="span-required">*</span>Estado:</label>
                    <br>
                    <select name="estado" id="estado" class="form-control campo-formulario" required>
                        <option selected="" value="">Selecione o Estado</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SR">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                    <br>
                </div>   
            </div>

            <div class="row form-group">  
                <div class="col-sm-12 col-md-6 col-lg-6">  
                        <label for="complemento" class="label-campo">Complemento:</label>
                        <br>
                        <input type="text" name="complemento" id="complemento" class="form-control campo-formulario campo-texto" placeholder="Digite seu Complemento">
                        <br>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">  
                    <label for="numero" class="label-campo">Número:</label>
                    <br>
                    <input type="text" name="numero" id="numero" class="form-control campo-formulario campo-texto" placeholder="">
                    <br>
                </div>
            </div>
            
        </fieldset>
            
        <div class="separador"></div>
                                                                  
        <div class="row form-group">
            <input type="hidden" name="acao" value="cadastrar-usuario">
            <button class="btn btn-primary botao botao-enviar-cadastro" id="botao-enviar-cadastro">Cadastrar</button>
        </div>
        <div class="row texto-centro">
            <a href="<?= URL_BASE ?>" class="link voltar-cadastro">Voltar</a>
        </div>    
    </form>
</div>
<div class="separador"></div>

<div class="separador"></div>

<?php require_once("includes/footer/footer.php"); ?>
