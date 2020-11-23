<?php
require_once "../init.php";
require_once DIR."includes/header/header.php";
require_once DIR."/classes/DB.php";
include_once "menu.php";
require_once DIR."/classes/admin.php";
$admin = new Admin("","","","","","","","","");
$admin->validaSessao($db);
$admin->setUsuario($admin->getId(),$db);
$query = "SELECT `a`.`id` AS `id`, `a`.`nome` AS `nome`, `a`.`ra` AS `ra`, `b`.`descricao` AS `curso`,`a`.`telefone` AS `telefone`,`c`.`descricao` AS `acesso`, `a`.`anoInicio` AS `anoInicio` FROM `aluno` AS `a` INNER JOIN `curso` AS `b` ON `a`.`idCurso` = `b`.`id` INNER JOIN `tipoacessoaluno` AS `c` ON `a`.`tipo_acesso` = `c`.`id` WHERE `a`.`idCurso` = {$admin->getClinica()}";
$result = $db->consultar($query,$db);
?>
<div class="separador"></div>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="texto-centro">
                <h1 class="tituloColorido">Lista de Alunos</h1>
            </div>
        </div>
    </div>
    <div class="separador"></div>
    <div class="row">
        <div class="col-sm-12 col-md-3 col-lg-3"></div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="texto-centro">
                <button class="btn btn-primary cadastrar-aluno botao ">+ Cadastrar Aluno</button>                
            </div>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3"></div>
    </div>
    <div class="separador"></div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <table id="tabela-consultas">
                <thead>
                    <td>
                        Nome
                    </td>
                    <td>
                        R.A.
                    </td>
                    <td>
                        Curso
                    </td>
                    <td>
                        Telefone
                    </td>
                    <td>
                        Acesso
                    </td>
                    <td>
                        Ano de início
                    </td>
                    <td>
                        Ação
                    </td>
                </thead>
                <tbody>
                    <?php
                    while($ln = $result->fetch_assoc()){ ?>
                    <tr>
                        <td>
                            <?= $ln['nome'] ?>
                        </td>
                        <td>
                            <?= $ln['ra'] ?>
                        </td>
                        <td>
                            <?= $ln['curso'] ?>
                        </td>
                        <td>
                            <?= $ln['telefone'] ?>
                        </td>                        
                        <td>
                            <?= $ln['acesso'] ?>
                        </td>
                        <td>
                            <?= $ln['anoInicio'] ?>
                        </td>
                        <td>
                            <button type="button" id="editar_<?= $ln['id'] ?>" class="btn btn-primary botao-editar-consulta"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</button>
                        </td>
                    </tr>

                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<link href='<?= URL_BASE ?>includes/dataTable/datatables.min.css' rel='stylesheet' />
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src='<?= URL_BASE ?>includes/dataTable/datatables.min.js'></script>
<script>
    $("#tabela-consultas").dataTable({
        "language": {
            "lengthMenu": "Exibindo _MENU_ consultas por página",
            "zeroRecords": "Não há consultas marcadas",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Sem consultas agendadas",
            "infoFiltered": "(Total: _MAX_)",
            "search":"Pesquisar",
            "oPaginate": {
                "sFirst":    "Primeiro",
                "sPrevious": "Anterior",
                "sNext":     "Próximo",
                "sLast":     "Último"
            },
        }
    });
</script>
