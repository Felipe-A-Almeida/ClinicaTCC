<div class="row">
    <div class="div-menu-admin">
        <navbar id="admin-menu">
            <ul class="menu-horizontal">
                <a href="../calendario/"><li class="menu-item">Calendário</li></a>
                <?php if($_SESSION['tipo_acesso'] != 2){ ?>
                    <a href="../aluno/"><li class="menu-item">Alunos</li></a>
                    <a href="../funcionario/"><li class="menu-item">Funcionários</li></a>
                <?php
                }
                ?>
                <a href="../sair.php"><li class="menu-item">Sair</li></a>
            </ul>
        </navbar>
    </div>
</div>