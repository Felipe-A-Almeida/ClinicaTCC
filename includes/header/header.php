<?php
define("URL_BASE","http://localhost/tcc/");
define("DIR","C:/xampp/htdocs/tcc/");
require_once DIR."/classes/DB.php";
$db = new DB();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">  
    <link href="<?= URL_BASE ?>includes/fonts/TitilliumWeb-Bold.ttf"> 
    <link rel="stylesheet" href="<?= URL_BASE ?>includes/css/style.css">
    <title>Clínica - FHO|UNIARARAS</title>  
</head>
<body>
    <header>
        <div class="header">
            <img src="<?= URL_BASE ?>images/logoFHO.png" alt="Logo da FHO UNIARARAS" class="logoFHO">
            &emsp;
            <span class="tituloClinica">Acesso às Clínicas</span>
        </div>
    </header>