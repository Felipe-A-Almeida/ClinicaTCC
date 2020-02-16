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
    <div class="separador"></div>
    <div class="formulario-cadastro">
        <div class="row form-group">  
            <div class="col-sm-12 col-md-6 col-lg-6">                       
                <label for="nome" class="label-campo">Nome completo:</label>
                <br>
                <input type="text" name="nome" id="nome" class="form-control campo-formulario campo-texto" placeholder="Digite seu Nome Completo">
                <br>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">                         
                <label for="RG" class="label-campo">RG:</label>
                <br>
                <input type="text" name="RG" id="RG" class="form-control campo-formulario campo-texto" placeholder="Digite seu RG">
                <br>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-12 col-md-6 col-lg-6">  
                <label for="CPF" class="label-campo">CPF:</label>
                <br>
                <input type="text" name="CPF" id="CPF" class="form-control campo-formulario campo-texto" placeholder="Digite seu CPF">
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
                    <option value="Acre">Acre</option>
                    <option value="Alagoas">Alagoas</option>
                    <option value="Amapá">Amapá</option>
                    <option value="Amazonas">Amazonas</option>
                    <option value="Bahia">Bahia</option>
                    <option value="Ceará">Ceará</option>
                    <option value="Distrito Federal">Distrito Federal</option>
                    <option value="Espírito Santo">Espírito Santo</option>
                    <option value="Goiás">Goiás</option>
                    <option value="Maranhão">Maranhão</option>
                    <option value="Mato Grosso">Mato Grosso</option>
                    <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                    <option value="Minas Gerais">Minas Gerais</option>
                    <option value="Pará">Pará</option>
                    <option value="Paraíba">Paraíba</option>
                    <option value="Paraná">Paraná</option>
                    <option value="Pernambuco">Pernambuco</option>
                    <option value="Piauí">Piauí</option>
                    <option value="Rio de Janeiro">Rio de Janeiro</option>
                    <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                    <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                    <option value="Rondônia">Rondônia</option>
                    <option value="Roraima">Roraima</option>
                    <option value="Santa Catarina">Santa Catarina</option>
                    <option value="São Paulo">São Paulo</option>
                    <option value="Sergipe">Sergipe</option>
                    <option value="Tocantins">Tocantins</option>
                </select>
                <br>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">                   
                <label for="telefone" class="label-campo">Telefone:</label>
                <br>
                <input type="text" name="telefone" id="telefone" class="form-control campo-formulario campo-texto" placeholder="Digite seu Telefone">
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
                <input type="text" name="cartao-sus" id="cartao-sus" class="form-control campo-formulario campo-texto" placeholder="Digite número do cartão SUS">
                <br>
            </div>   
        </div> 
        <div class="row form-group">   
            <div class="col-sm-12 col-md-2 col-lg-2">                       
                <label for="cep" class="label-campo">CEP:</label>
                <br>
                <input type="text" name="cep" id="cep" class="form-control campo-formulario campo-texto" placeholder="Digite seu CEP">
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
                    <option value="Acre">Acre</option>
                    <option value="Alagoas">Alagoas</option>
                    <option value="Amapá">Amapá</option>
                    <option value="Amazonas">Amazonas</option>
                    <option value="Bahia">Bahia</option>
                    <option value="Ceará">Ceará</option>
                    <option value="Distrito Federal">Distrito Federal</option>
                    <option value="Espírito Santo">Espírito Santo</option>
                    <option value="Goiás">Goiás</option>
                    <option value="Maranhão">Maranhão</option>
                    <option value="Mato Grosso">Mato Grosso</option>
                    <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                    <option value="Minas Gerais">Minas Gerais</option>
                    <option value="Pará">Pará</option>
                    <option value="Paraíba">Paraíba</option>
                    <option value="Paraná">Paraná</option>
                    <option value="Pernambuco">Pernambuco</option>
                    <option value="Piauí">Piauí</option>
                    <option value="Rio de Janeiro">Rio de Janeiro</option>
                    <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                    <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                    <option value="Rondônia">Rondônia</option>
                    <option value="Roraima">Roraima</option>
                    <option value="Santa Catarina">Santa Catarina</option>
                    <option value="São Paulo">São Paulo</option>
                    <option value="Sergipe">Sergipe</option>
                    <option value="Tocantins">Tocantins</option>
                </select>
                <br>
            </div>   
        </div>                                                     
        <div class="row form-group">
            <button class="btn btn-primary botao botao-enviar-cadastro">Cadastrar</button>
        </div>
        <div class="row texto-centro">
            <a href="index.php" class="link voltar-cadastro">Voltar</a>
        </div>    
    </div>
</div>