    <script src="<?= URL_BASE ?>includes/jquery/jquery-3.4.1.min.js"></script>    
    <script src="<?= URL_BASE ?>includes/angular/angular.min.js"></script>
    <script src="<?= URL_BASE ?>includes/jQueryMask/dist/jquery.mask.min.js"></script>
    <script src="<?= URL_BASE ?>includes/jQueryUI/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script  src="<?= URL_BASE ?>includes/dataTable/datatables.min.js"></script>



    <script>      
        $("#senha-cadastro, #confirmaSenha-cadastro").keyup(function(){
            if($("#senha-cadastro").val() == "" || $("#confirmaSenha-cadastro").val() == "" || $("#senha-cadastro").val() != $("#confirmaSenha-cadastro").val() || $("#senha-cadastro").val().length < 6 || $("#confirmaSenha-cadastro").val().length < 6 || !(/\d/.test($("#senha-cadastro").val())) || !(/\d/.test($("#confirmaSenha-cadastro").val()))){
                $("#erro-senha").show(500);
                $("#botao-enviar-cadastro").prop('disabled', true);
            }else{         
                $("#erro-senha").hide(500);
                $("#botao-enviar-cadastro").prop('disabled', false);
            }
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
        $(".botao-enviar-email").on("click",function(){
            $(".row-botao-enviar-email").fadeOut(200);
            setTimeout(function(){
                $(".row-spinner-enviar-email").fadeIn(200);
            },300);
            if($("#email").val() != "" && validacaoEmail($("#email").val())){
                var email = $("#email").val();
                var funcao = "esqueceu-senha";
                var jqxhr = $.post( "includes/functions/email.php",{email:email,funcao:funcao}, function() {
                    console.log("Sucesso!");
                })
                .done(function(data) {
                    if(data) alert("E-mail enviado com sucesso!");
                    else alert("Usuário não existe");
                    $(".row-spinner-enviar-email").fadeOut(20);                    
                    $(".voltar-esqueci-senha").click();
                    setTimeout(function(){
                        $(".row-botao-enviar-email").fadeIn(20);                        
                    },100);                    
                    
                })
                .fail(function() {
                    alert("Erro de envio");
                    $(".row-spinner-enviar-email").fadeOut(200);
                    setTimeout(function(){
                        $(".row-botao-enviar-email").fadeIn(200);
                    },300);
                });                
            }
        });        
        $(document).ready(function(){            
            $(".class-rg").mask('00.000.000-Z', {reverse: true,translation: {
                'Z': {
                    pattern: /[a-z0-9]/, optional: true
                }
            }, clearIfNotMatch: true});
            $('.class-cpf').mask('000.000.000-00', {reverse: true, clearIfNotMatch: true});
            var SPMaskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                },
                clearIfNotMatch:true,
            };
            $('.class-fone').mask(SPMaskBehavior, spOptions);
            $(".class-cartaoSUS").mask("000.0000.0000.0000",{clearIfNotMatch: true});
            $(".class-cep").mask("00000-000",{clearIfNotMatch: true});
            $(".class-cep").blur(function(){
                var cep = $(this).val().replace(/[^0-9]/, '');
                if(cep){
                    var url = 'https://viacep.com.br/ws/' + cep + '/json/';                
                    $.ajax({
                        url: url,
                        dataType: 'jsonp',
                        crossDomain: true,
                        contentType: "application/json",
                        success : function(json){
                            $("#logradouro").val(json.logradouro);
                            $("#bairro").val(json.bairro);
                            $("#cidade").val(json.localidade);
                            $("#complemento").val(json.complemento);
                            $("#estado").val(json.uf);
                        }
                    });
                }					
            });	
            $("#editar-anamnese-enfermagem").on("click",function(){
                $(".form-editar-dados").fadeOut(200);                
                setTimeout(function(){
                    $("#anamnese-enfermagem-body").fadeIn(200);
                },210);
                $(".voltar-anamnese-enfermagem-editar").on("click",function(){
                    $("#anamnese-enfermagem-body").fadeOut(200);
                    setTimeout(function(){
                        $(".form-editar-dados").fadeIn(200);
                    },210);
                });
            });   
            $("#editar-anamnese-fisioterapia").on("click",function(){
                $(".form-editar-dados").fadeOut(200);                
                setTimeout(function(){
                    $("#anamnese-fisioterapia-body").fadeIn(200);
                },210);
                $(".voltar-anamnese-fisioterapia-editar").on("click",function(){
                    $("#anamnese-fisioterapia-body").fadeOut(200);
                    setTimeout(function(){
                        $(".form-editar-dados").fadeIn(200);
                    },210);
                });
            });   
            
        });
        $("#gerar-senha").on("click",function(){
            var senha = Math.random().toString(36).slice(-10);
            $("#senha-gerada").html("&nbsp;" + senha);
        });
        function validacaoEmail(field) {
            usuario = field.substring(0, field.indexOf("@"));
            dominio = field.substring(field.indexOf("@")+ 1, field.length);
            
            if ((usuario.length >=1) &&
                (dominio.length >=3) && 
                (usuario.search("@")==-1) && 
                (dominio.search("@")==-1) &&
                (usuario.search(" ")==-1) && 
                (dominio.search(" ")==-1) &&
                (dominio.search(".")!=-1) &&      
                (dominio.indexOf(".") >=1)&& 
                (dominio.lastIndexOf(".") < dominio.length - 1)) {
                    return true;
            }
            else{
                alert("E-mail invalido");
                return false;
            }
        }
        
    </script>
</body>
</html>