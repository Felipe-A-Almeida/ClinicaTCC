<?php require_once("includes/header/header.php"); ?>
    <div class="separador"></div>
    <div class="container container-login">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="row texto-centro">
                    <h1 class="tituloColorido">Acesso ao Sistema</h1>
                    <span class="tipo-clinica" ng-model="fisioterapia">(fisioterapia)</span>
                </div>
                <div class="separador"></div>
                <form method="POST" action="<?= URL_BASE ?>controler/controler.php" class="formulario-login">
                    <div class="row form-group">
                        <input type="text" name="cpf-login" id="cpf-login" class="form-control class-cpf campo-formulario campo-texto " placeholder="Digite seu CPF">
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
                        <a id="link-cadastro" href="cadastro.php?formulario=fisioterapia">
                            <button type="button" class="btn btn-primary botao botao-cadastrar"> Clique aqui para se cadastrar</button>
                        </a>
                    </div>                    
                </form>
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
<?php
require_once DIR."includes/footer/footer.php";
?>