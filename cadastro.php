<?php require_once("includes/header/header.php"); ?>
<div class="separador"></div>
<div class="container container-cadastro">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="row texto-centro">
                <h1 class="tituloColorido">Acesso ao Sistema</h1>
                <span class="tipo-clinica">(<?= $_GET['formulario'] ?>)</span>
            </div>
        </div>
    </div>
    
    <fieldset>
    
        <legend>Dados Pessoais</legend>
        
        <div class="separador"></div>
        
        <form class="formulario-cadastro" method="POST" action="<?= URL_BASE ?>controller.php">
            <div class="row form-group">  
                <div class="col-sm-12 col-md-6 col-lg-6">                       
                    <label for="nome" class="label-campo">Nome Completo:</label>
                    <br>
                    <input type="text" name="nome" id="nome" class="form-control campo-formulario campo-texto" placeholder="Digite seu Nome Completo">
                    <br>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">                         
                    <label for="RG" class="label-campo">RG:</label>
                    <br>
                    <input type="text" name="RG" id="RG" class="form-control campo-formulario campo-texto class-rg" placeholder="Digite seu RG">
                    <br>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-12 col-md-6 col-lg-6">  
                    <label for="CPF" class="label-campo">CPF:</label>
                    <br>
                    <input type="text" name="CPF" id="CPF" class="form-control campo-formulario campo-texto class-cpf" placeholder="Digite seu CPF">
                    <br>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">                   
                    <label for="data-nascimento" class="label-campo">Data de Nascimento:</label>
                    <br>
                    <input type="date" name="data-nascimento" id="data-nascimento" class="form-control campo-formulario campo-texto" placeholder="00/00/0000">
                    <br>
                </div>
            </div>
            <div class="row form-group">        
                <div class="col-sm-12 col-md-6 col-lg-6">                   
                    <label for="naturalidade" class="label-campo">Naturalidade:</label>
                    <br>
                    <select name="naturalidade" id="naturalidade" class="form-control campo-formulario">
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
                    <label for="telefone" class="label-campo">Telefone:</label>
                    <br>
                    <input type="text" name="telefone" id="telefone" class="form-control campo-formulario campo-texto class-fone" placeholder="Digite seu Telefone">
                    <br>
                </div>
            </div>
        
            <div class="row form-group"> 
                <div class="col-sm-12 col-md-6 col-lg-6">                         
                    <label for="filiacao" class="label-campo">Filiação:</label>
                    <br>
                    <input type="text" name="filiacao" id="filiacao" class="form-control campo-formulario campo-texto" placeholder="Digite o nome da Filiação">
                    <br>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">  
                    <label for="cartao-sus" class="label-campo">Cartão SUS:</label>
                    <br>
                    <input type="text" name="cartao-sus" id="cartao-sus" class="form-control campo-formulario campo-texto class-cartaoSUS" placeholder="Digite número do cartão SUS">
                    <br>
                </div>   
            </div> 
            
        </fieldset>
            
        <div class="separador"></div>
        
        <fieldset>
        
            <legend>Endereço</legend>
            
            <div class="row form-group">   
                <div class="col-sm-12 col-md-2 col-lg-2">                       
                    <label for="cep" class="label-campo">CEP:</label>
                    <br>
                    <input type="text" name="cep" id="cep" class="form-control campo-formulario campo-texto class-cep" placeholder="Digite seu CEP">
                    <br>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-5">                     
                    <label for="logradouro" class="label-campo">Logradouro:</label>
                    <br>
                    <input type="text" name="logradouro" id="logradouro" class="form-control campo-formulario campo-texto" placeholder="Ex.: Rua, Avenida">
                    <br>
                </div>
                <div class="col-sm-12 col-md-5 col-lg-5">                          
                    <label for="bairro" class="label-campo">Bairro:</label>
                    <br>
                    <input type="text" name="bairro" id="bairro" class="form-control campo-formulario campo-texto" placeholder="Digite seu Bairro">
                    <br>
                </div>
            </div>
            <div class="row form-group">                        
                <div class="col-sm-12 col-md-6 col-lg-6">  
                    <label for="cidade" class="label-campo">Cidade:</label>
                    <br>
                    <input type="text" name="cidade" id="cidade" class="form-control campo-formulario campo-texto" placeholder="Digite sua Cidade">
                    <br>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">                              
                    <label for="estado" class="label-campo">Estado:</label>
                    <br>
                    <select name="estado" id="estado" class="form-control campo-formulario">
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
            </div>
            
        </fieldset>
            
        <div class="separador"></div>
        
        <div class="row form-group">  
            <div class="col-sm-12 col-md-6 col-lg-6">                       
                <label for="email" class="label-campo">E-mail:</label>
                <br>
                <input type="email" name="nome" id="nome" class="form-control campo-formulario campo-texto" placeholder="Digite seu Nome Completo">
                <br>
            </div>            
        </div>                                                            
        <div class="row form-group">
            <input type="hidden" name="acao" value="cadastrar-usuario-<?= $_GET['formulario'] ?>">
            <button class="btn btn-primary botao botao-enviar-cadastro">Cadastrar</button>
        </div>
        <div class="row texto-centro">
            <a href="../" class="link voltar-cadastro">Voltar</a>
        </div>    
    </form>
</div>

<?php require_once("includes/footer/footer.php"); ?>