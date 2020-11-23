<?php
require_once "../init.php";
require_once DIR."includes/header/header.php";
?>
    <div class="separador"></div>
    <div class="container container-login">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="row texto-centro">
                    <h1 class="tituloColorido">Acesso ao Sistema</h1>
                    <span class="tipo-clinica" ng-model="fisioterapia">(Administrador)</span>
                </div>  
                <div class="separador"></div>
                <form method="POST" action="<?= URL_BASE ?>controler/controler.php" class="formulario-login-admin">
                    <div class="row form-group">
                        <input type="text" name="codigo" id="codigo" class="form-control campo-formulario campo-texto " placeholder="Digite seu código">
                    </div>
                    <div class="row form-group">
                        <input type="password" name="senha" id="senha" class="form-control campo-senha campo-formulario campo-texto" placeholder="Digite sua Senha">
                    </div>
                    <div class="row form-group">
                        <button class="btn btn-primary botao botao-enviar">Acessar</button>
                    </div>
                    <input type="hidden" name="acao" value="login-admin">
                    <div class="row texto-centro">
                        <span>Esqueceu sua senha?<a class="link esqueceu-senha"> Clique aqui</a></span>
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
        </div>
    </div>
    <div class="separador"></div>
<?php
require_once DIR."includes/footer/footer.php";
?>
 
