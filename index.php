<?
define("URL_BASE", "");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">  
    <link rel="stylesheet" href="includes/fonts/TitilliumWeb-Bold.ttf"> 
    <title>Clínica - FHO|UNIARARAS</title>  
    <style>
    .header{
        height:105px;
        width:100%;
        background-color:#42576f;
        text-align: center;
        padding-top: 15px;
        max-height:200px;    
    }
    .logoFHO{
        vertical-align: middle;
    }
    .tituloClinica{
        color:white;
        font-size:25px;
        font-family: 'Titillium Web', sans-serif;
    }
    body{
        margin:0px;
    }
    .separador{
        height: 30px;
    }
    .container-login{
        margin-top:90px;
    }
    .texto-centro{
        display: block;
        text-align: center;
    }    
    .tituloColorido{
        color: #42576f;
    }
    .link-clinica{
        cursor:pointer;
        border-top: 1px solid rgba(0,0,0,0.3);    
        padding-top:10px;
    }
    .link-clinica:hover{
        color:#42576f;
    }
    .link-clinica h4{
        color:#42576f;
    }
    .formulario-login{
        padding-left:100px;
        padding-right:100px;
    }
    .container-clinicas{
        padding-left:5%;
    }
    .tipo-clinica{
        text-transform:capitalize;
    }
    .link{
        color:#337ab7 !important;
        cursor: pointer;
    }
    .separador-borda{
        margin-top:15px;
        border-top: 1px solid rgba(0,0,0,0.3);    
        margin-bottom:15px;
    }
    .botao{
        width: 100%;
        background-color: #337ab7;
    }
    .formulario-esqueceu-senha,.formulario-cadastro{
        display:none;
        padding-left:100px;
        padding-right:100px;
    }
    .label-campo{
        float:left;
    }
    </style>  
</head>
<body>
    <header>
        <div class="header">
            <img src="images/logoFHO.png" alt="Logo da FHO UNIARARAS" class="logoFHO">
            &emsp;
            <span class="tituloClinica">Acesso às Clínicas</span>
        </div>
    </header>
    <div class="separador"></div>
    <div class="container container-login">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="row texto-centro">
                    <h1 class="tituloColorido">Acesso ao Sistema</h1>
                    <span class="tipo-clinica">(fisioterapia)</span>
                </div>
                <div class="separador"></div>
                <div class="formulario-login">
                    <div class="row form-group">
                        <input type="text" name="cpf" id="cpf" class="form-control cpf-mask campo-formulario campo-texto " placeholder="Digite seu CPF">
                    </div>
                    <div class="row form-group">
                        <input type="password" name="senha" id="senha" class="form-control campo-senha campo-formulario campo-texto" placeholder="Digite sua Senha">
                    </div>
                    <div class="row form-group">
                        <button class="btn btn-primary botao botao-enviar">Acessar</button>
                    </div>
                    <div class="row texto-centro">
                        <span>Esqueceu sua senha?<a class="link esqueceu-senha"> Clique aqui</a></span>
                    </div>
                    <div class="separador-borda"></div>
                    <div class="row texto-centro">
                        <span>Não possui um cadastro?</span>
                        <br>
                        <button class="btn btn-primary botao botao-cadastrar"> Clique aqui para se cadastrar</button>
                    </div>                    
                </div>
                <div class="formulario-esqueceu-senha">
                    <div class="row form-group texto-centro">                        
                        <input type="email" name="email" id="email" class="form-control campo-formulario campo-texto" placeholder="Digite seu E-mail">
                        <br>
                        <div class="row form-group">
                            <button class="btn btn-primary botao botao-enviar-email">Enviar E-mail</button>
                        </div>
                        <div class="row texto-centro">
                            <a class="link voltar-esqueci-senha">Voltar</a>
                        </div>
                    </div>
                </div>
                <div class="formulario-cadastro">
                    <div class="row form-group texto-centro">                        
                        <label for="nome" class="label-campo">Nome completo:</label>
                        <br>
                        <input type="text" name="nome" id="nome" class="form-control campo-formulario campo-texto" placeholder="Digite seu Nome Completo">
                        <br>
                    </div>
                    <div class="row form-group texto-centro">                        
                        <label for="RG" class="label-campo">RG:</label>
                        <br>
                        <input type="text" name="RG" id="RG" class="form-control campo-formulario campo-texto" placeholder="Digite seu RG">
                        <br>
                    </div>
                    <div class="row form-group texto-centro">
                        <label for="CPF" class="label-campo">CPF:</label>
                        <br>
                        <input type="text" name="CPF" id="CPF" class="form-control campo-formulario campo-texto" placeholder="Digite seu CPF">
                        <br>
                    </div>
                    <div class="row form-group texto-centro">                        
                        <label for="data-nascimento" class="label-campo">Data de Nascimento:</label>
                        <br>
                        <input type="date" name="data-nascimento" id="data-nascimento" class="form-control campo-formulario campo-texto" placeholder="00/00/0000">
                        <br>
                    </div>
                    <div class="row form-group texto-centro">                        
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
                    <div class="row form-group texto-centro">                        
                        <label for="telefone" class="label-campo">Telefone:</label>
                        <br>
                        <input type="text" name="telefone" id="telefone" class="form-control campo-formulario campo-texto" placeholder="Digite seu Telefone">
                        <br>
                    </div>
                    <div class="row form-group texto-centro">                        
                        <label for="filiacao" class="label-campo">Filiação:</label>
                        <br>
                        <input type="text" name="filiacao" id="filiacao" class="form-control campo-formulario campo-texto" placeholder="Digite o nome da Filiação">
                        <br>
                    </div>
                    <div class="row form-group texto-centro">                        
                        <label for="cartao-sus" class="label-campo">Cartão SUS:</label>
                        <br>
                        <input type="text" name="cartao-sus" id="cartao-sus" class="form-control campo-formulario campo-texto" placeholder="Digite número do cartão SUS">
                        <br>
                    </div>    
                    <div class="row form-group texto-centro">                        
                        <label for="cep" class="label-campo">CEP:</label>
                        <br>
                        <input type="text" name="cep" id="cep" class="form-control campo-formulario campo-texto" placeholder="Digite seu CEP">
                        <br>
                    </div>
                    <div class="row form-group texto-centro">                        
                        <label for="logradouro" class="label-campo">Logradouro:</label>
                        <br>
                        <input type="text" name="logradouro" id="logradouro" class="form-control campo-formulario campo-texto" placeholder="Ex.: Rua, Avenida">
                        <br>
                    </div>
                    <div class="row form-group texto-centro">                        
                        <label for="bairro" class="label-campo">Bairro:</label>
                        <br>
                        <input type="text" name="bairro" id="bairro" class="form-control campo-formulario campo-texto" placeholder="Digite seu Bairro">
                        <br>
                    </div>
                    <div class="row form-group texto-centro">                        
                        <label for="cidade" class="label-campo">Cidade:</label>
                        <br>
                        <input type="text" name="cidade" id="cidade" class="form-control campo-formulario campo-texto" placeholder="Digite sua Cidade">
                        <br>
                    </div>
                    <div class="row form-group texto-centro">                        
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
                    <div class="row form-group">
                        <button class="btn btn-primary botao botao-enviar-cadastro">Cadastrar</button>
                    </div>
                    <div class="row texto-centro">
                        <a class="link voltar-cadastro">Voltar</a>
                    </div>
                </div>
            </div>      
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="row texto-centro">
                    <h1 class="tituloColorido">Selecione a Clínica Desejada</h1>
                </div>
                <div class="separador"></div>
                <div class="container-clinicas">
                    <div class="row link-clinica">
                        <a class="link-fisioterapia">
                            <h4>Clínica de Fisioterapia</h4>
                            <span>Clique aqui para acessar a clínica de fisioterapia</span>
                        </a>
                    </div>
                    <div class="separador"></div>
                    <div class="row link-clinica">
                        <a class="link-enfermagem">
                            <h4>Clínica de Enfermagem</h4>
                            <span>Clique aqui para acessar a clínica de enfermagem</span>
                        </a>
                    </div>
                </div>
            </div>      
        </div>
    </div>    
    <div class="separador"></div>

    <script src="includes/jquery/jquery-3.4.1.min.js"></script>    

    <script>
        $(".link-clinica").on("click",function(){
            var tipoClinica = ($(this).find("a").attr("class").split("-"))[1];
            $(".tipo-clinica").html("("+tipoClinica+")");
        });
        $(".esqueceu-senha").on("click",function(){
            $(".formulario-login").fadeOut(200)
            setTimeout(function(){
                $(".formulario-esqueceu-senha").fadeIn(200);
            },200);
        });
        $(".voltar-esqueci-senha").on("click",function(){
            $(".formulario-esqueceu-senha").fadeOut(200);
            setTimeout(function(){
                $(".formulario-login").fadeIn(200);
            },200);
        });
        $(".botao-cadastrar").on("click",function(){
            $(".formulario-login").fadeOut(200)
            setTimeout(function(){
                $(".formulario-cadastro").fadeIn(200);
            },200);
        });
        $(".voltar-cadastro").on("click",function(){
            $(".formulario-cadastro").fadeOut(200);
            setTimeout(function(){
                $(".formulario-login").fadeIn(200);
            },200);
        });
    </script>
</body>
</html>