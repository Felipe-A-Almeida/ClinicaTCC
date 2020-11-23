<?php
require_once "../init.php";
require_once DIR."includes/header/header.php";
require_once DIR."/classes/DB.php";
$ano_atual = date("Y");
require_once DIR."/classes/admin.php";
$admin = new Admin("","","","","","","","","");
$admin->validaSessao($db);
$admin->setUsuario($admin->getId(),$db);
if($_SESSION['tipo_acesso'] == 3){
    $query = "SELECT `a`.`id`,`a`.`email`,`a`.`nome`,`a`.`cod_adm`,`b`.`descricao` AS `clinica`, `a`.`telefone`,`c`.`descricao` AS `tipo_acesso` FROM `adm` AS `a` INNER JOIN `curso` AS `b` ON `a`.`clinica` = `b`.`id` INNER JOIN `tipoacessoaluno` AS `c` ON `a`.`tipo_acesso` = `c`.`id` WHERE 1";
}else{
    $query = "SELECT `a`.`id`,`a`.`email`,`a`.`nome`,`a`.`cod_adm`,`b`.`descricao` AS `clinica`, `a`.`telefone`,`c`.`descricao` AS `tipo_acesso` FROM `adm` AS `a` INNER JOIN `curso` AS `b` ON `a`.`clinica` = `b`.`id` INNER JOIN `tipoacessoaluno` AS `c` ON `a`.`tipo_acesso` = `c`.`id` WHERE `clinica` = {$admin->getClinica()}";
}
$result_funcionarios = $db->consultar($query,$db);
if(isset($_SESSION['mensagem'])){
    $mensagem = $_SESSION['mensagem'];
    $_SESSION['mensagem'] = "none";

}else{
    $_SESSION['mensagem'] = "none";
    $mensagem = $_SESSION['mensagem'];
}
include_once "menu.php";

?>

<div class="separador"></div>
<div class="container">
    <div class="row" id="row-tabela-funcionario">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="row notificacoes">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <?php                     
                    if($mensagem == "editar-sucesso"){
                    ?>
                    <div class="alert alert-success editar-sucesso texto-centro" role="alert">
                        O Funcionário foi editado com sucesso!<span class="fechar-notificacao adireita">X</span>
                    </div>
                    <?php 
                    }else{
                        if($mensagem == "excluir-sucesso"){
                    ?>
                    <div class="alert alert-danger excluir-sucesso texto-centro" role="alert">
                        O Funcionário foi excluído com sucesso!<span class="fechar-notificacao adireita">X</span>
                    </div>
                    <?php
                        }else{
                            if($mensagem == "cadastrar-sucesso"){
                    ?>
                        <div class="alert alert-success cadastrar-sucesso texto-centro" role="alert">
                            O Funcionário foi cadastrado com sucesso!<span class="fechar-notificacao adireita">X</span>
                        </div>
                    <?php
                            }
                        }
                    }
                    ?>
                </div>               
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <h2>
                        Funcionários 
                    </h2>
                </div>            
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <button type="button" id="botao-cadastrar-funcionario" class="btn btn-primary adireita botao">Cadastrar Funcionário</button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table class="table" id="tabela-funcionarios">
                        <thead>
                            <th>Nome</th>
                            <th>Código</th>
                            <th>E-mail</th>
                            <th>Telefone</th>
                            <th>Clínica</th>                            
                            <th>Tipo de Acesso</th>    
                            <th>Ações</th>                        
                        </thead>
                        <tbody>
                            <?php while($ln_funcionarios = $result_funcionarios->fetch_assoc()){ ?>
                            <tr>
                                <td><?= $ln_funcionarios['nome']; ?></td>
                                <td><?= $ln_funcionarios['cod_adm']; ?></td>
                                <td><?= $ln_funcionarios['email']; ?></td>
                                <td><?= $ln_funcionarios['telefone']; ?></td>
                                <td><?= $ln_funcionarios['clinica']; ?></td>
                                <td><?= $ln_funcionarios['tipo_acesso']; ?></td>
                                <td><button type="button" id="editar_<?= $ln_funcionarios['id'] ?>" class="btn btn-primary botao-editar-funcionario"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</button></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>      
        </div>
    </div>
    <div class="row" id="cadastro-funcionario">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-8">
                <h2>Cadastrar Funcionário</h2>
            </div>            
            <div class="col-sm-12 col-md-4 col-lg-4">
                <button type="button" id="botao-voltar-funcionario" class="btn btn-primary adireita botao">Voltar</button>
            </div>    
        </div>
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
                            <label for="codigo" class="label-campo"><span class="span-required">*</span>Código(F ou P):</label>
                            <br>
                            <input type="text" name="codigo" id="codigo" class="form-control campo-formulario campo-texto" placeholder="" required>
                            <br>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="email" class="label-campo"><span class="span-required">*</span>E-mail:</label>
                            <br>
                            <input type="text" name="email" id="email" class="form-control campo-formulario campo-texto" placeholder="" required>
                            <br>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="telefone" class="label-campo"><span class="span-required">*</span>Telefone:</label>
                            <br>
                            <input type="text" name="telefone" id="telefone" class="form-control campo-formulario campo-texto class-fone" placeholder="" required>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="senha" class="label-campo"><span class="span-required">*</span>Senha:</label>
                            <br>
                            <input type="password" name="senha" id="senha-cadastro" class="form-control campo-formulario campo-texto" autocomplete="new-password" placeholder="" required>
                            <br>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="confirmar-senha" class="label-campo"><span class="span-required">*</span>Confirmar Senha:</label>
                            <br>
                            <input type="password" name="confirmar-senha" id="confirmaSenha-cadastro" class="form-control campo-formulario campo-texto" autocomplete="new-password" placeholder="" required>
                            <br>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">         
                            <label for="gerar-senha">Clique no botão para gerar uma senha aleatória:</label>               
                            <br>
                            <input type="button" name="gerar-senha" id="gerar-senha" class="btn btn-primary" value="Gerar senha">
                            <span id="senha-gerada" class="font-italic"></span>
                            <br>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <span><i>A senha deve conter pelo menos 6 caracteres e pelo menos 1 número</i></span>
                        </div>
                    </div>  
                    <div id="erro-senha" class="row form-group">
                        <div class="alert alert-danger" role="alert">
                            <span class="erro-senha">A senhas digitadas não correspondem ou são inválidas</span>
                        </div>
                    </div>                           
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="tipo_acesso" class="label-campo"><span class="span-required">*</span>Tipo de Acesso:</label>
                            <br>
                            <select name="tipo_acesso" id="tipo_acesso" class="form-control campo-formulario" required>
                                <option value="">Selecione uma opção</option>
                                <option value="1">Supervisor</option>
                                <option value="3">Administrador</option>
                                <option value="4">Coordenador</option>
                            </select>
                            <br>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <label for="clinica" class="label-campo"><span class="span-required">*</span>Curso:</label>
                            <br>
                            <select name="clinica" class="form-control">
                                <option value="">Selecione um Curso</option>
                                <?php
                                    if($_SESSION['tipo_acesso'] == 3) $query_cursos = "SELECT * FROM `curso` WHERE 1";
                                    else $query_cursos = "SELECT * FROM `curso` WHERE `id` ={$admin->getClinica()}";
                                    $result = $db->consultar($query_cursos,$db);
                                    while($ln = $result->fetch_assoc()){
                                ?>
                                <option value="<?php echo $ln['id'] ?>"><?php echo $ln['descricao'] ?></option>
                                <?php
                                        
                                    }
                                ?>
                            </select> 
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
</div>
<!-- MODAL EDITAR ALUNO --> 
<div class="modal" tabindex="-1" role="dialog" id="modal-editar-funcionario">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Funcionários</h5>
                <button type="button" class="fecha-modal-consultas-usuario btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-body-editar-funcionario" class="conteudo-modal">      
                <div class="editar-funcionario" class="row">
                    <div class="botao-voltar row">       
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <h3>Editar Funcionário</h3>                                
                        </div>        
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <form id="exclui-funcionario" method="POST" action="<?= URL_BASE ?>controler/controler.php">
                                <input type="hidden" name="acao" value="excluir-admin">
                                <input type="hidden" id="excluir-idFuncionario" name="id">
                                <button type="submit" class="btn btn-danger adireita" id="excluir-funcionario"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Excluir Funcionário</button>  
                            </form>
                        </div>
                    </div>
                    <br>
                    <form id="edita-funcionario" method="POST" action="<?= URL_BASE ?>controler/controler.php">                            
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="editar-nome" class="label-campo"><span class="span-required">*</span>Nome completo:</label>
                                <br>
                                <input type="text" name="editar-nome" id="editar_nome" class="form-control campo-formulario campo-texto" placeholder="" required>
                                <br>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="codigo" class="label-campo"><span class="span-required">*</span>Código(F ou P):</label>
                                <br>
                                <input type="text" name="editar-codigo" id="editar_codigo" class="form-control campo-formulario campo-texto" placeholder="" required>
                                <br>
                            </div>                             
                        </div>                        
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="editar-email" class="label-campo"><span class="span-required">*</span>E-mail:</label>
                                <br>
                                <input type="text" name="editar-email" id="editar_email" class="form-control campo-formulario campo-texto" placeholder="" required>
                                <br>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="editar-telefone" class="label-campo"><span class="span-required">*</span>Telefone:</label>
                                <br>
                                <input type="text" name="editar-telefone" id="editar_telefone" class="form-control campo-formulario campo-texto class-fone" placeholder="" required>
                                <br>
                            </div>                                                                  
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="tipo_acesso" class="label-campo"><span class="span-required">*</span>Tipo de Acesso:</label>
                                <br>
                                <select name="tipo_acesso" id="editar_tipo_acesso" class="form-control campo-formulario" required>
                                    <option value="">Selecione uma opção</option>
                                    <option value="1">Supervisor</option>
                                    <option value="3">Administrador</option>
                                    <option value="4">Coordenador</option>
                                </select>
                                <br>
                            </div> 
                        </div>
                        <div class="separador"></div>                                                       
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">                           
                                <input type="hidden" name="acao" value="editar-admin">
                                <input type="hidden" id="idFuncionario" name="idFuncionario">
                                <input type="submit" name="editar-funcionario" class="btn btn-primary botao" value="Editar">
                            </div>
                        </div>
                    </form>
                </div>                                
            </div>
        </div>
    </div>
</div>
<button type="hidden" id="abre-modal-editar-funcionario" data-toggle="modal" data-target="#modal-editar-funcionario" hidden></button>

<?php require_once("../includes/footer/footer.php"); ?>

<script>
    $(document).ready(function(){
        $("#tabela-funcionarios").dataTable({
            "pageLength": 10,
            "language": {
                "lengthMenu": "Exibindo _MENU_ funcionários por página",
                "zeroRecords": "Não há funcionários registrados",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "Sem funcionários registrados",
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
        $(".botao-editar-funcionario").on("click",function(){
            $("#abre-modal-editar-funcionario").click();
            var id_funcionario = ($(this).attr("id").split("_"))[1];
            $.ajax({
                url: '<?= URL_BASE ?>getFuncionario.php',
                type: 'POST',
                data: {id: id_funcionario},
                dataType: 'JSON',
                success: function(data){
                    $("#editar_nome").val(data[0].nome);
                    $("#editar_codigo").val(data[0].cod_adm);
                    $("#editar_email").val(data[0].email);
                    $("#editar_telefone").val(data[0].telefone); 
                    $("#editar_tipo_acesso").val(data[0].id_acesso);
                    $("#idFuncionario").val(data[0].id);
                    $("#excluir-idFuncionario").val(data[0].id);                    
                    var SPMaskBehavior = function (val) {
                        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                    },
                    spOptions = {
                        onKeyPress: function(val, e, field, options) {
                            field.mask(SPMaskBehavior.apply({}, arguments), options);
                        }
                    };
                    $('.class-fone').unmask();
                    $('.class-fone').mask(SPMaskBehavior, spOptions);
                }
            })
        });        
        $("#botao-cadastrar-funcionario").on("click",function(){
            $("#row-tabela-funcionario").fadeOut(300);
            setTimeout(function(){
                $("#cadastro-funcionario").fadeIn(300);
            },350);
        });
        $("#botao-voltar-funcionario").on("click", function(){
            $("#cadastro-funcionario").fadeOut(300);
            setTimeout(function(){
                $("#row-tabela-funcionario").fadeIn(300);
            },350);
        });
        $(".fechar-notificacao").on("click", function(){
            $(this).parent().fadeOut(300);
        })
    });
</script>