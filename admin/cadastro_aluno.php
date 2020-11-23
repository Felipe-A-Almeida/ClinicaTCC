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
    $query = "SELECT `a`.`id`,`a`.`ra`,`a`.`nome`,`b`.`descricao` AS `curso`, `a`.`telefone`,`a`.`email`,`c`.`descricao` AS `tipo_acesso` FROM `aluno` AS `a` INNER JOIN `curso` AS `b` ON `a`.`idCurso` = `b`.`id` INNER JOIN `tipoacessoaluno` AS `c` ON `a`.`tipo_acesso` = `c`.`id` WHERE 1";
}else{
    $query = "SELECT `a`.`id`,`a`.`ra`,`a`.`nome`,`b`.`descricao` AS `curso`, `a`.`telefone`,`a`.`email`,`c`.`descricao` AS `tipo_acesso` FROM `aluno` AS `a` INNER JOIN `curso` AS `b` ON `a`.`idCurso` = `b`.`id` INNER JOIN `tipoacessoaluno` AS `c` ON `a`.`tipo_acesso` = `c`.`id` WHERE `idCurso` = {$admin->getClinica()}";
}
$result_alunos = $db->consultar($query,$db);
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
    <div class="row" id="row-tabela-alunos">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="row notificacoes">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <?php                     
                    if($mensagem == "editar-sucesso"){
                    ?>
                    <div class="alert alert-success editar-sucesso texto-centro" role="alert">
                        O Aluno foi editado com sucesso!<span class="fechar-notificacao adireita">X</span>
                    </div>
                    <?php 
                    }else{
                        if($mensagem == "excluir-sucesso"){
                    ?>
                    <div class="alert alert-danger excluir-sucesso texto-centro" role="alert">
                        O Aluno foi excluído com sucesso!<span class="fechar-notificacao adireita">X</span>
                    </div>
                    <?php
                        }else{
                            if($mensagem == "cadastrar-sucesso"){
                    ?>
                        <div class="alert alert-success cadastrar-sucesso texto-centro" role="alert">
                            O Aluno foi cadastrado com sucesso!<span class="fechar-notificacao adireita">X</span>
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
                        Alunos 
                    </h2>
                </div>            
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <button type="button" id="botao-cadastrar-aluno" class="btn btn-primary adireita botao">Cadastrar Aluno</button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table class="table" id="tabela-alunos">
                        <thead>
                            <th>R.A.</th>
                            <th>Nome</th>
                            <th>Curso</th>
                            <th>Telefone</th>
                            <th>E-mail</th>                        
                            <th>Ações</th>
                        </thead>
                        <tbody>
                            <?php while($ln_alunos = $result_alunos->fetch_assoc()){ ?>
                            <tr>
                                <td><?= $ln_alunos['ra']; ?></td>
                                <td><?= $ln_alunos['nome']; ?></td>
                                <td><?= $ln_alunos['curso']; ?></td>
                                <td><?= $ln_alunos['telefone']; ?></td>
                                <td><?= $ln_alunos['email']; ?></td>
                                <td><button type="button" id="editar_<?= $ln_alunos['id'] ?>" class="btn btn-primary botao-editar-aluno"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</button></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>      
        </div>
    </div>
    <div class="row" id="cadastro-aluno">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <form action="../../controler/controler.php" method="POST">
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <h2>Cadastrar Aluno</h2>
                    </div>            
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <button type="button" id="botao-voltar-aluno" class="btn btn-primary adireita botao">Voltar</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label for="ra" class="label-campo"><span class="span-required">*</span>RA do aluno(a):</label>
                        <br>
                        <input type="text" name="ra" id="ra" class="form-control campo-formulario campo-texto" placeholder="" required>
                        <br>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label for="nome" class="label-campo"><span class="span-required">*</span>Nome do aluno(a):</label>
                        <br>
                        <input type="text" name="nome_aluno" id="nome_aluno" class="form-control campo-formulario campo-texto" placeholder="" required>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label for="curso" class="label-campo"><span class="span-required">*</span>Curso:</label>
                        <br>
                        <select name="curso" class="form-control">
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
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label for="periodo" class="label-campo"><span class="span-required">*</span>Período:</label>
                        <br>
                        <select name="periodo" class="form-control">
                            <option value="">Selecione um Período</option>
                            <option value="1º Período">1º Período</option>
                            <option value="2º Período">2º Período</option>
                            <option value="3º Período">3º Período</option>
                            <option value="4º Período">4º Período</option>
                            <option value="5º Período">5º Período</option>
                            <option value="6º Período">6º Período</option>
                            <option value="7º Período">7º Período</option>
                            <option value="8º Período">8º Período</option>
                            <option value="9º Período">9º Período</option>
                            <option value="10º Período">10º Período</option>
                        </select> 
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
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <label for="email" class="label-campo"><span class="span-required">*</span>E-mail do aluno(a):</label>
                        <br>
                        <input type="email" name="email" id="email" class="form-control campo-formulario campo-texto" autocomplete="username" placeholder="" required>
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
                <div class="separador"></div>                                                                  
                <div class="row">
                    <input type="hidden" name="acao" value="cadastrar-aluno-admin">
                    <button class="btn btn-primary botao botao-enviar-aluno">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL EDITAR ALUNO --> 
<div class="modal" tabindex="-1" role="dialog" id="modal-editar-aluno">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alunos</h5>
                <button type="button" class="fecha-modal-consultas-usuario btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-body-editar-aluno" class="conteudo-modal">      
                <div class="editar-aluno" class="row">
                    <div class="botao-voltar row">       
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <h3>Editar Aluno</h3>                                
                        </div>        
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <form id="exclui-aluno" method="POST" action="<?= URL_BASE ?>controler/controler.php">
                                <input type="hidden" name="acao" value="excluir-aluno">
                                <input type="hidden" id="excluir-idAluno" name="idAluno">
                                <button type="submit" class="btn btn-danger adireita" id="excluir-aluno"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Excluir Aluno</button>  
                            </form>
                        </div>
                    </div>
                    <br>
                    <form id="edita-aluno" method="POST" action="<?= URL_BASE ?>controler/controler.php">                            
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="editar-ra" class="label-campo"><span class="span-required">*</span>RA do aluno(a):</label>
                                <br>
                                <input type="text" name="ra" id="editar-ra" class="form-control campo-formulario campo-texto" placeholder="" required>
                                <br>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="editar-nome_aluno" class="label-campo"><span class="span-required">*</span>Nome do aluno(a):</label>
                                <br>
                                <input type="text" name="nome_aluno" id="editar_nome_aluno" class="form-control campo-formulario campo-texto" placeholder="" required>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="editar_curso" class="label-campo"><span class="span-required">*</span>Curso:</label>
                                <br>
                                <select name="curso" id="editar_curso" class="form-control">
                                    <option value="">Selecione um Curso</option>
                                    <?php
                                        $query_cursos = "SELECT * FROM `curso` WHERE 1";
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
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="editar_periodo" class="label-campo"><span class="span-required">*</span>Período:</label>
                                <br>
                                <select name="periodo" id="editar_periodo" class="form-control">
                                    <option value="">Selecione um Período</option>
                                    <option value="1º Período">1º Período</option>
                                    <option value="2º Período">2º Período</option>
                                    <option value="3º Período">3º Período</option>
                                    <option value="4º Período">4º Período</option>
                                    <option value="5º Período">5º Período</option>
                                    <option value="6º Período">6º Período</option>
                                    <option value="7º Período">7º Período</option>
                                    <option value="8º Período">8º Período</option>
                                    <option value="9º Período">9º Período</option>
                                    <option value="10º Período">10º Período</option>
                                </select> 
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="editar_telefone" class="label-campo"><span class="span-required">*</span>Telefone do aluno(a):</label>
                                <br>
                                <input type="text" name="telefone" id="editar_telefone" class="form-control campo-formulario campo-texto class-fone" placeholder="" required>
                                <br>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="editar_email" class="label-campo"><span class="span-required">*</span>E-mail do aluno(a):</label>
                                <br>
                                <input type="email" name="email" id="editar_email" class="form-control campo-formulario campo-texto" placeholder="" required>
                                <br>
                            </div>
                        </div>
                        <div class="separador"></div>                                                       
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">                           
                                <input type="hidden" name="acao" value="editar-aluno">
                                <input type="hidden" id="idAluno" name="idAluno">
                                <input type="submit" name="editar-aluno" class="btn btn-primary botao" value="Editar">
                            </div>
                        </div>
                    </form>
                </div>                                
            </div>
        </div>
    </div>
</div>
<button type="hidden" id="abre-modal-editar-aluno" data-toggle="modal" data-target="#modal-editar-aluno" hidden></button>


<?php require_once("../includes/footer/footer.php"); ?>

<script>
    $(document).ready(function(){
        $("#tabela-alunos").dataTable({
            "pageLength": 10,
            "language": {
                "lengthMenu": "Exibindo _MENU_ alunos por página",
                "zeroRecords": "Não há alunos registrados",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "Sem alunos registrados",
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
        $(".botao-editar-aluno").on("click",function(){
            $("#abre-modal-editar-aluno").click();
            var id_aluno = ($(this).attr("id").split("_"))[1];
            $.ajax({
                url: '<?= URL_BASE ?>getAluno.php',
                type: 'POST',
                data: {id: id_aluno},
                dataType: 'JSON',
                success: function(data){
                    $("#editar-ra").val(data[0].ra);
                    $("#editar_nome_aluno").val(data[0].nome);
                    $("#editar_curso").val(data[0].curso_id);
                    $("#editar_periodo").val(data[0].periodo);
                    $("#editar_telefone").val(data[0].telefone);
                    $("#editar_email").val(data[0].email);
                    $("#idAluno").val(data[0].id);
                    $("#excluir-idAluno").val(data[0].id);                    
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
        $("#botao-cadastrar-aluno").on("click",function(){
            $("#row-tabela-alunos").fadeOut(300);
            setTimeout(function(){
                $("#cadastro-aluno").fadeIn(300);
            },350);
        });
        $("#botao-voltar-aluno").on("click", function(){
            $("#cadastro-aluno").fadeOut(300);
            setTimeout(function(){
                $("#row-tabela-alunos").fadeIn(300);
            },350);
        });
        $(".fechar-notificacao").on("click", function(){
            $(this).parent().fadeOut(300);
        })
    });
</script>