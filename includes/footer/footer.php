    <script src="<?= URL_BASE ?>includes/jquery/jquery-3.4.1.min.js"></script>    
    <script src="<?= URL_BASE ?>includes/angular/angular.min.js"></script>
    <script src="<?= URL_BASE ?>includes/jQueryMask/dist/jquery.mask.min.js"></script>

    <script>
        $(".link-clinica").on("click",function(){
            var tipoClinica = ($(this).find("a").attr("class").split("-"))[1];
            $(".tipo-clinica").html("("+tipoClinica+")");
            $("#link-cadastro").attr("href","cadastro.php?formulario="+tipoClinica);
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
        $(document).ready(function(){
            $(".class-rg").mask('00.000.000-0', {reverse: true});
            $('.class-cpf').mask('000.000.000-00', {reverse: true});
            var SPMaskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };
            $('.class-fone').mask(SPMaskBehavior, spOptions);
            $(".class-cartaoSUS").mask("000.0000.0000.0000");
            $(".class-cep").mask("00000-000");
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
                            alert(json.logradouro);
							$("#bairro").val(json.bairro);
							$("#cidade").val(json.localidade);
                            $("#complemento").val(json.complemento);
                            $("#estado").val(json.uf);
					}
			});
		}					
	});	
        });
    </script>
</body>
</html>