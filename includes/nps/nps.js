$("#link-sair").click(function(){
    $(".page-body").html($(".div-nps").html());
    $(".label-nota-nps").on("click",function(){
        $(".label-nota-nps").removeClass("label-nota-nps-selecionado");
        $(this).addClass("label-nota-nps-selecionado");
    });
    $(".botao-envia-nps").on("click",function(){
        var nota_nps = $("input[name=nota-utilidade]:checked").val();
        var comentario = $("#comentario-nps").val();
        if(nota_nps != ""){
            $(".page-body").fadeOut(300);
            setTimeout(function(){
                $(".div-agradecimento-nps").fadeIn(500);
            },310);
            setTimeout(function(){
                $.post("nps.php",{id_usuario:"<?= $id_usuario ?>", nota_nps: nota_nps, comentario: comentario}, function(){
                    window.location.href="sair.php";
                });
            },1500);
        }
    });
    $(".botao-pula-nps").on("click",function(){
        window.location.href="sair.php";
    })
});