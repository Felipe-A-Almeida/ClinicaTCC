<link rel="stylesheet" href="includes/jQueryUI/jquery-ui.min.css">
<script src="includes/jquery/jquery-3.4.1.min.js"></script>    
<script src="includes/jQueryUI/jquery-ui.min.js"></script>

<input name="tipo-consulta" id="tipo-consulta">
<script>
    $( function() {
        $( "#tipo-consulta" ).autocomplete({
            source: ['teste','teste2']
        });
    })
</script>
