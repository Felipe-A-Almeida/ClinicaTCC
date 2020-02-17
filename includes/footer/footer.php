<script src="includes/jquery/jquery-3.4.1.min.js"></script>    
    <script src="includes/angular/angular.min.js"></script>

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
    </script>
</body>
</html>