<?php
require_once "../init.php";
require_once DIR."includes/header/header.php";
require_once DIR."/classes/DB.php";
include_once "menu.php";
$ano_atual = date("Y");
require_once DIR."/classes/admin.php";
$admin = new Admin("","","","","");
$admin->validaSessao($db);
?>

<div class="separador"></div>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <form action="../../controler/controler.php" method="POST">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label for="nome" class="label-campo"><span class="span-required">*</span>Nome completo:</label>
                        <br>
                        <input type="text" name="nome" id="nome" class="form-control campo-formulario campo-texto" placeholder="" required>
                        <br>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label for="email" class="label-campo"><span class="span-required">*</span>E-mail:</label>
                        <br>
                        <input type="text" name="email" id="email" class="form-control campo-formulario campo-texto" placeholder="" required>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label for="senha" class="label-campo"><span class="span-required">*</span>Senha:</label>
                        <br>
                        <input type="text" name="senha" id="senha" class="form-control campo-formulario campo-texto">
                        <br>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label for="confirmaSenha" class="label-campo"><span class="span-required">*</span>Confirmar Senha:</label>
                        <br>
                        <input type="text" name="confirmaSenha" id="confirmaSenha" class="form-control campo-formulario campo-texto">
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label for="telefone" class="label-campo"><span class="span-required">*</span>Telefone do aluno(a):</label>
                        <br>
                        <input type="text" name="telefone" id="telefone" class="form-control campo-formulario campo-texto class-fone" placeholder="" required>
                        <br>
                    </div>
                </div>
                <div class="separador"></div>                                                                  
                <div class="row">
                    <input type="hidden" name="acao" value="cadastrar-adm-admin">
                    <button class="btn btn-primary botao botao-enviar-aluno">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once("../includes/footer/footer.php"); ?>