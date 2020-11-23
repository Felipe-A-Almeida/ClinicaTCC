<?php require_once "init.php";
require_once DIR."includes/header/header.php";
require_once DIR."/classes/DB.php";

$token = $_GET['token'];


 ?>

<div class="separador"></div>
    <div class="container container-recupera-senha">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="row texto-centro">
                    <h1 class="tituloColorido">Recuperar Senha</h1>
                    <span>Preencha os campos abaixo para recuperar a senha de acesso ao sistema</span>
                </div>
                <div class="separador"></div>
                <form method="POST" action="<?= URL_BASE ?>controler/controler.php" class="formulario-recupera-senha">
                    <div class="row form-group">
                        <input type="text" name="senha" id="senha" class="form-control campo-senha campo-texto " placeholder="Digite sua nova senha" required>
                        <br>
                        <span><i>A senha deve conter pelo menos 6 caracteres e pelo menos 1 número</i></span>
                    </div>
                    <div class="row form-group">
                        <input type="text" name="confirma-senha" id="confirma-senha" class="form-control campo-senha campo-formulario campo-texto" placeholder="Confirme sua nova senha" required>
                    </div>
                    <div id="erro-senha" class="row form-group">
                        <div class="alert alert-danger" role="alert">
                            <span class="erro-senha">Os campos acima estão diferentes</span>
                            <input type="hidden" name="acao" value="envia-nova-senha">
                            <input type="hidden" name="token" value="<?= $token ?>">
                        </div>
                    </div>                    
                    <div class="row form-group">
                        <button class="btn btn-primary botao botao-enviar-recupera-senha" disabled>Acessar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once DIR."includes/footer/footer.php";
?>

<script>
    $("#senha, #confirma-senha").keyup(function(){
        if($("#senha").val() == "" || $("#confirma-senha").val() == "" || $("#senha").val() != $("#confirma-senha").val() || $("#senha").val().length < 6 || $("#confirma-senha").val().length < 6 || !(/\d/.test($("#senha").val())) || !(/\d/.test($("#confirma-senha").val()))){
            $("#erro-senha").show(500);
            $(".botao-enviar-recupera-senha").prop('disabled', true);
        }else{            
            $("#erro-senha").hide(500);
            $(".botao-enviar-recupera-senha").prop('disabled', false);
        }
    })
</script>

