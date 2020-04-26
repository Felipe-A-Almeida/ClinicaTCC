<?php
require_once("../includes/header/header.php");
require_once DIR."/classes/DB.php";
include_once "menu.php";
$ano_atual = date("Y");
?>

<div class="separador"></div>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <form action="../../controler/controler.php" method="POST">
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
                        <label for="ano" class="label-campo"><span class="span-required">*</span>Ano de início no curso:</label>
                        <br>
                        <select name="ano" class="form-control">
                            <option value="">Selecione um Ano</option>
                            <?php
                                $i = 8;                                
                                while($i>=0){
                                    $ano = $ano_atual - $i;
                            ?>
                            <option value="<?php echo $ano; ?>"><?php echo $ano ?></option>
                            <?php
                                    $i--;
                                }
                            ?>
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
                </div>
                <div class="separador"></div>                                                                  
                <div class="row">
                    <input type="hidden" name="acao" value="cadastrar-aluno">
                    <button class="btn btn-primary botao botao-enviar-aluno">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once("../includes/footer/footer.php"); ?>