<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(isset($_POST['acao']) && $_POST['acao'] != ""){
    require_once "../init.php";
    require_once DIR."/classes/DB.php";
    $db = new DB();    
    if(isset($_POST['acao']) && ($_POST['acao'] == "cadastrar-usuario")){
        require_once DIR."/classes/usuarios.php";        
        $usuario = new Usuario("",$_POST['nome'], $_POST['RG'],$_POST['CPF'],$_POST['data-nascimento'],$_POST['naturalidade'],$_POST['telefone'],$_POST['nomePai'],$_POST['nomeMae'],$_POST['cartao-sus'],$_POST['profissao'],$_POST['tempoServico'],$_POST['email'],$_POST['senha'],$_POST['numero'],$_POST['complemento'],$_POST['cep'],$_POST['logradouro'],$_POST['bairro'],$_POST['cidade'],$_POST['estado'],$_POST['estado-civil'],$_POST['sexo'],'');
        if($usuario->cadastrar($db)){
            header("LOCATION: ".URL_BASE);
        }else{
            header("LOCATION: ".URL_BASE);
        }        
    }
    if(isset($_POST['acao']) && ($_POST['acao'] == "login")){
        print_r($_POST);
        require_once DIR."/classes/usuarios.php"; 
        $senha = $_POST['senha'];
        $senha = md5($senha);
        $cpf = limpaString($_POST['cpf-login']);
        $query = "SELECT * FROM `usuario` WHERE `cpf` = '$cpf' AND `senha` = '$senha'";
        echo $query;
        $result = $db->consultar($query,$db);
        if($ln = $result->fetch_assoc()){
            $usuario = new Usuario($ln['id'],$ln['nome'], $ln['rg'],$ln['cpf'],$ln['dataNascimento'],$ln['naturalidade'],$ln['telefone'],$ln['nomePai'],$ln['nomeMae'],$ln['cartaoSUS'],$ln['profissao'],$ln['tempoServico'],$ln['email'],$ln['senha'],$ln['numero'],$ln['complemento'],$ln['cep'],$ln['logradouro'],$ln['bairro'],$ln['cidade'],$ln['estado'],$ln['estadoCivil'],$ln['sexo'],'');        
            $usuario->sessao();    
            header("LOCATION: ".URL_BASE."main.php");
        }else{
            header("LOCATION: ".URL_BASE);
        }       
    }
    if(isset($_POST['acao']) && ($_POST['acao'] == "cadastrar-anamnese-enfermagem")){
        require_once DIR."/classes/anamneseEnfermagem.php"; 
        $id = "-";
        $idUsuario = $_POST['idUsuario'];
        $idConsulta = $_POST['idConsulta'];
        $queixaPrincipal = $_POST['queixa-principal'];
        $inicio = $_POST['inicio'];  
        $doenca = "";
        if(isset($_POST['doenca'])){
            foreach($_POST['doenca'] as $item){
                $doenca == "" ? $doenca = $item : $doenca = $doenca. "|".$item;
                echo $doenca;
            }
        }     
        $descDoenca = $_POST['desc-doencas'];
        $alergia = $_POST['alergia'];
        $descAlergia = $_POST['desc-alergia'];
        $medicamento = $_POST['medicamento'];
        $descMedicamento = $_POST['desc-medicamento'];
        $fumo = $_POST['fumo'];
        $freqFumo = $_POST['freq-fumo'];
        $drogas = $_POST['drogas'];
        $freqDrogas = $_POST['freq-drogas'];
        $bebidas = $_POST['alcool'];
        $freqBebidas = $_POST['freq-alcool'];
        $exercicios = $_POST['exercicios'];
        $freqExercicios = $_POST['freq-exercicios'];
        $recreacao = $_POST['recreacao'];
        $descRecreacao = $_POST['freq-recreacao'];
        $animais = $_POST['animais'];
        $descAnimais = $_POST['freq-animais'];
        $postos = $_POST['posto'];
        $doencaFamilia = $_POST['doencas-familia'];
        $tratamentoFamilia = $_POST['tratamento-familia'];    
        $anamnese = new AnamneseEnfermagem($id, $idUsuario,$idConsulta,$queixaPrincipal,$inicio,$doenca,$descDoenca,$alergia,$descAlergia,$medicamento,$descMedicamento,$fumo,$freqFumo,$drogas,$freqDrogas,$bebidas,$freqBebidas,$exercicios,$freqExercicios,$recreacao,$descRecreacao,$animais,$descAnimais,$postos,$doencaFamilia,$tratamentoFamilia);
        $anamnese->inserirEnfermagem($db);
        header("Location: ../main.php");
    }

    if(isset($_POST['acao']) && ($_POST['acao'] == "cadastrar-anamnese-fisioterapia")){
        require_once DIR."/classes/anamneseFisioterapia.php"; 
        $id = "-";
        $idUsuario = $_POST['idUsuario'];
        $queixaPrincipal = $_POST['queixa-principal'];
        $inicio = $_POST['inicio'];  
        $doenca = "";
        if(isset($_POST['doenca'])){
            foreach($_POST['doenca'] as $item){
                $doenca == "" ? $doenca = $item : $doenca = $doenca. "|".$item;
                echo $doenca;
            }
        }     
        $descDoenca = $_POST['desc-doencas'];
        $alergia = $_POST['alergia'];
        $descAlergia = $_POST['desc-alergia'];
        $medicamento = $_POST['medicamento'];
        $descMedicamento = $_POST['desc-medicamento'];
        $fumo = $_POST['fumo'];
        $freqFumo = $_POST['freq-fumo'];
        $drogas = $_POST['drogas'];
        $freqDrogas = $_POST['freq-drogas'];
        $bebidas = $_POST['alcool'];
        $freqBebidas = $_POST['freq-alcool'];
        $exercicios = $_POST['exercicios'];
        $freqExercicios = $_POST['freq-exercicios'];
        $recreacao = $_POST['recreacao'];
        $descRecreacao = $_POST['freq-recreacao'];
        $animais = $_POST['animais'];
        $descAnimais = $_POST['freq-animais'];
        $postos = $_POST['posto'];
        $doencaFamilia = $_POST['doencas-familia'];
        $tratamentoFamilia = $_POST['tratamento-familia'];    
        $anamnese = new AnamneseFisioterapia($id, $idUsuario,$queixaPrincipal,$inicio,$doenca,$descDoenca,$alergia,$descAlergia,$medicamento,$descMedicamento,$fumo,$freqFumo,$drogas,$freqDrogas,$bebidas,$freqBebidas,$exercicios,$freqExercicios,$recreacao,$descRecreacao,$animais,$descAnimais,$postos,$doencaFamilia,$tratamentoFamilia);
        $anamnese->inserirFisioterapia($db);
        header("Location: ../main.php");
    }
    
    if(isset($_POST['acao']) && ($_POST['acao'] == "clinica-consulta-admin")){
        require_once DIR."/classes/consulta.php";
        session_start();
        $id="";
        print_r($_SESSION);
        $idUsuario = $_POST['teste-paciente'];
        $idAluno = $_POST['teste-atendente'];
        $idAdm = $_SESSION['id_admin'];
        $data = $_POST['data'];
        $horario = explode(" - ",$_POST['horario']);
        $hora_inicio = $horario[0];
        $hora_fim = $horario[1];
        $dataInicial = date("Y-m-d",strtotime($data)) . ":" . $hora_inicio;
        $dataFinal = date("Y-m-d",strtotime($data)) . ":" . $hora_fim;
        $idTipoConsulta = $_POST['teste-tipo-consulta'];
        $consulta = new Consulta($id,$idUsuario,$idAluno,$idAdm,$dataInicial,$dataFinal,$idTipoConsulta);        
        $consulta->cadastrarConsulta($db);
        header("Location: ../admin/calendario/".$_POST['clinica']);
    }
    if(isset($_POST['acao']) && $_POST['acao'] == "cadastrar-aluno-admin"){
        require_once DIR."/classes/alunos.php";
        $id="";
        $ra = $_POST["ra"];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $nome = $_POST["nome_aluno"];
        $idCurso = $_POST["curso"];
        $ano = $_POST["periodo"];
        $telefone = limpaString($_POST['telefone']);
        $tipo_acesso = 2;
        $token = "";
        $aluno = new Aluno($id,$ra,$email,$senha,$nome,$idCurso,$ano,$telefone,$tipo_acesso,$token);        
        $aluno->cadastrarAluno($db);  
        session_start();
        $_SESSION['mensagem'] = "cadastrar-sucesso";      
        print_r($_SESSION);
        header("Location: ../admin/aluno/");
    }
    if(isset($_POST['acao']) && $_POST['acao'] == "cadastrar-adm-admin"){
        require_once DIR."/classes/admin.php";
        $id="";
        $nome = $_POST["nome"];
        $codigo = $_POST['codigo'];
        $email = $_POST["email"];
        $senha = md5($_POST["senha"]);
        $telefone = limpaString($_POST['telefone']);
        $tipo_acesso = $_POST['tipo_acesso'];
        $clinica = $_POST['clinica'];
        $token = "";
        $funcionario = new Admin($id,$codigo,$nome,$email,$senha,$telefone,$tipo_acesso,$clinica,$token);        
        $funcionario->cadastrarAdmin($db);  
        header("Location: ../admin/funcionario/");
    }
    if(isset($_POST['acao']) && $_POST['acao'] == "cadastrar-consulta-usuario"){
        require_once DIR."/classes/consulta.php";
        $id="";
        $idUsuario = $_POST['usuario'];
        $idAluno = "";
        $idAdm = "";
        $data = $_POST['data'];
        $horario = explode(" - ",$_POST['horario']);
        $hora_inicio = $horario[0];
        $hora_fim = $horario[1];
        $dataInicial = date("Y-m-d",strtotime($data)) . ":" . $hora_inicio;
        $dataFinal = date("Y-m-d",strtotime($data)) . ":" . $hora_fim;
        $idTipoConsulta = $_POST['tipo-consulta'];
        $clinica = $_POST['clinica-consulta-usuario'];
        $consulta = new Consulta($id,$idUsuario,$idAluno,$idAdm,$dataInicial,$dataFinal,$idTipoConsulta);        
        $consulta->cadastrarConsulta($db);
        $consulta->buscaId($db);
        $anamnese = $consulta->buscaAnamnese($clinica,$db);
        if($anamnese) 
            header("Location: ../main.php"); 
        else
            header("Location: ../anamnese-".$clinica.".php");
    }
    if(isset($_POST['acao']) && $_POST['acao'] == "login-admin"){
        require_once DIR."/classes/admin.php"; 
        $senha = md5($_POST['senha']);
        $codigo = $_POST['codigo'];
        $query = "SELECT * FROM `adm` WHERE `cod_adm` = '$codigo' AND `senha` = '$senha'";
        $result = $db->consultar($query,$db);
        if($ln = $result->fetch_assoc()){
            $admin = new Admin($ln['id'],$ln['codigo'],$ln['nome'],$ln['email'],$ln['senha'],$ln['telefone'],$ln['tipo_acesso'],$ln['clinica'],$ln['TOKEN']);
            $admin->sessao();     
            if($admin->getTipoAcesso() != 3 && $admin->getClinica() == 1 ){
                header("LOCATION: ".URL_BASE."admin/calendario/fisioterapia");
            }else{
                if($admin->getTipoAcesso() != 3 && $admin->getClinica() == 2 ){
                    header("LOCATION: ".URL_BASE."admin/calendario/enfermagem");
                }else{
                    header("LOCATION: ".URL_BASE."admin/calendario/");            
                }
            }
        }else{
            $query = "SELECT * FROM `aluno` WHERE `ra` = '$codigo' AND `senha` = '$senha'";
            $result_aluno = $db->consultar($query,$db);
            if($ln_aluno = $result_aluno->fetch_assoc()){
                $admin = new Admin($ln_aluno['id'],$ln_aluno['ra'],$ln_aluno['nome'],$ln_aluno['email'],$ln_aluno['senha'],$ln_aluno['telefone'],$ln_aluno['tipo_acesso'],$ln_aluno['idCurso'],$ln_aluno['TOKEN']);
                $admin->sessao();     
                if($admin->getTipoAcesso() != 3 && $admin->getClinica() == 1 ){
                    header("LOCATION: ".URL_BASE."admin/calendario/fisioterapia");
                }else{
                    if($admin->getTipoAcesso() != 3 && $admin->getClinica() == 2 ){
                        header("LOCATION: ".URL_BASE."admin/calendario/enfermagem");
                    }else{
                        header("LOCATION: ".URL_BASE."admin/calendario/");            
                    }
                }
            }else{
                header("LOCATION: ".URL_BASE."admin");
            }
        }       
    }
    if(isset($_POST['acao']) && $_POST['acao'] == "editar-consulta-usuario"){
        require_once DIR."/classes/consulta.php";
        $id=$_POST['idConsulta'];
        $idUsuario = $_POST['usuario'];
        $idAluno = "";
        $idAdm = "";
        $data = $_POST['data'];
        $horario = explode(" - ",$_POST['horario']);
        $hora_inicio = $horario[0];
        $hora_fim = $horario[1];
        $dataInicial = date("Y-m-d",strtotime($data)) . ":" . $hora_inicio;
        $dataFinal = date("Y-m-d",strtotime($data)) . ":" . $hora_fim;
        $idTipoConsulta = $_POST['tipo-consulta'];
        $clinica = $_POST['clinica-consulta-usuario'];
        $consulta = new Consulta($id,$idUsuario,$idAluno,$idAdm,$dataInicial,$dataFinal,$idTipoConsulta);        
        $consulta->editarConsulta($db);
        header("Location: ../main.php?clinica=".$clinica);
    }
    if(isset($_POST['acao']) && $_POST['acao'] == "editar-aluno"){
        require_once DIR."/classes/alunos.php";
        $id=$_POST['idAluno'];
        $ra = $_POST['ra'];
        $nome = $_POST['nome_aluno'];
        $curso = $_POST['curso'];
        $periodo = $_POST['periodo'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $tipo_acesso = 2;
        $aluno = new Aluno($id,$ra,$email,"",$nome,$curso,$periodo,$telefone,$tipo_acesso,"");    
        $aluno->atualizarAluno($db);
        session_start();
        $_SESSION['mensagem'] = "editar-sucesso";
        header("Location: ".URL_BASE."/admin/aluno/");
    }
    if(isset($_POST['acao']) && $_POST['acao'] == "editar-admin"){
        require_once DIR."/classes/admin.php";
        $id=$_POST['idFuncionario'];
        $nome = $_POST['editar-nome'];
        $codigo = $_POST['editar-codigo'];
        $telefone = $_POST['editar-telefone'];
        $email = $_POST['editar-email'];
        $tipo_acesso = $_POST['tipo_acesso'];
        echo $tipo_acesso;
        $aluno = new Admin($id,$codigo,$nome,$email,"",$telefone,$tipo_acesso,"","");    
        $aluno->atualizarAdmin($db);
        session_start();
        $_SESSION['mensagem'] = "editar-sucesso";
        header("Location: ".URL_BASE."/admin/funcionario/");
    }
    if(isset($_POST['acao']) && $_POST['acao'] == "editar-consulta-admin"){
        require_once DIR."/classes/consulta.php";
        $id=$_POST['idConsulta'];
        $idUsuario = $_POST['teste-paciente'];
        $idAluno = $_POST['teste-atendente'];
        $idAdm = $_POST['usuario'];
        $data = $_POST['data'];
        $horario = explode(" - ",$_POST['horario']);
        $hora_inicio = $horario[0];
        $hora_fim = $horario[1];
        $dataInicial = date("Y-m-d",strtotime($data)) . ":" . $hora_inicio;
        $dataFinal = date("Y-m-d",strtotime($data)) . ":" . $hora_fim;
        $idTipoConsulta = $_POST['tipo-consulta'];
        $consulta = new Consulta($id,$idUsuario,$idAluno,$idAdm,$dataInicial,$dataFinal,$idTipoConsulta);        
        $consulta->editarConsulta($db);
        header("Location: ../admin/calendario/");
    }
    if(isset($_POST['acao']) && $_POST['acao'] == "excluir-consulta"){
        require_once DIR."/classes/consulta.php";
        $id=$_POST['idConsulta'];
        $idUsuario = "";
        $idAluno = "";
        $idAdm = "";
        $data = "";
        $horario = "";
        $hora_inicio = "";
        $hora_fim = "";
        $dataInicial = "";
        $dataFinal = "";
        $idTipoConsulta = "";
        $consulta = new Consulta($id,$idUsuario,$idAluno,$idAdm,$dataInicial,$dataFinal,$idTipoConsulta);        
        $consulta->excluirConsulta($db);        
    }
    if(isset($_POST['acao']) && $_POST['acao'] == "excluir-aluno"){
        require_once DIR."classes/alunos.php";
        $id = $_POST['idAluno'];
        $aluno = new Aluno($id,"","","","","","","","","","");
        session_start();
        $_SESSION['mensagem'] = "excluir-sucesso";
        print_r($_SESSION);
        $aluno->excluirAluno($db);
        header("Location: ".URL_BASE."admin/aluno/");
    }
    if(isset($_POST['acao']) && $_POST['acao'] == "excluir-admin"){
        require_once DIR."classes/admin.php";
        $id = $_POST['id'];
        $aluno = new Admin($id,"","","","","","","","","","");
        session_start();
        $_SESSION['mensagem'] = "excluir-sucesso";
        print_r($_SESSION);
        $aluno->excluirAdmin($db);
        header("Location: ".URL_BASE."admin/funcionario/");
    }
    if(isset($_POST['acao']) && ($_POST['acao'] == "editar-dados-usuario")){
        require_once DIR."/classes/usuarios.php";        
        $usuario = new Usuario($_POST['idUsuario'],$_POST['nome'], $_POST['RG'],$_POST['CPF'],$_POST['data-nascimento'],$_POST['naturalidade'],$_POST['telefone'],$_POST['nomePai'],$_POST['nomeMae'],$_POST['cartao-sus'],$_POST['profissao'],$_POST['tempoServico'],$_POST['email'],"",$_POST['numero'],$_POST['complemento'],$_POST['cep'],$_POST['logradouro'],$_POST['bairro'],$_POST['cidade'],$_POST['estado'],$_POST['estadoCivil'],$_POST['sexo'],"");
        $usuario->editar($db);
        header("LOCATION: ".URL_BASE."dados.php");               
    }
    if(isset($_POST['acao']) && ($_POST['acao'] == "editar-anamnese-fisioterapia")){
        require_once DIR."/classes/anamneseFisioterapia.php"; 
        print_r($_POST);
        $id = "";
        $idUsuario = $_POST['idUsuario'];
        $idConsulta = $_POST['idConsultaFisio'];
        $queixaPrincipal = $_POST['queixa-principal'];
        $inicio = $_POST['inicio'];
        $doenca = "";
        if(isset($_POST['doenca'])){
            foreach($_POST['doenca'] as $item){
                $doenca == "" ? $doenca = $item : $doenca = $doenca. "|".$item;
                echo $doenca;
            }
        } 
        $descDoenca = $_POST['desc-doencas'];
        $alergia = $_POST['alergia'];
        $descAlergia = $_POST['desc-alergia'];
        $medicamento = $_POST['medicamento'];
        $descMedicamento = $_POST['desc-medicamento'];
        $fumo = $_POST['fumo'];
        $freqFumo = $_POST['freq-fumo'];
        $drogas = $_POST['drogas'];
        $freqDrogas = $_POST['freq-drogas'];
        $bebidas = $_POST['alcool'];
        $freqBebidas = $_POST['freq-alcool'];
        $exercicios = $_POST['exercicios'];
        $freqExercicios = $_POST['freq-exercicios'];
        $recreacao = $_POST['recreacao'];
        $descRecreacao = $_POST['freq-recreacao'];
        $animais = $_POST['animais'];
        $descAnimais = $_POST['freq-animais'];
        $postos = $_POST['posto'];
        $doencaFamilia = $_POST['doencas-familia'];
        $tratamentoFamilia = $_POST['tratamento-familia'];
        $anamnese = new AnamneseFisioterapia($id, $idUsuario,$queixaPrincipal,$inicio,$doenca,$descDoenca,$alergia,$descAlergia,$medicamento,$descMedicamento,$fumo,$freqFumo,$drogas,$freqDrogas,$bebidas,$freqBebidas,$exercicios,$freqExercicios,$recreacao,$descRecreacao,$animais,$descAnimais,$postos,$doencaFamilia,$tratamentoFamilia);
        $anamnese->editarAnamnese($db);        
        header("Location: ../dados.php");
    }
    if(isset($_POST['acao']) && ($_POST['acao'] == "editar-anamnese-enfermagem")){
        require_once DIR."/classes/anamneseEnfermagem.php"; 
        $id = "";
        $idUsuario = $_POST['idUsuario'];
        $queixaPrincipal = $_POST['queixa-principal'];
        $inicio = $_POST['inicio'];
        $doenca = "";
        if(isset($_POST['doenca'])){
            foreach($_POST['doenca'] as $item){
                $doenca == "" ? $doenca = $item : $doenca = $doenca. "|".$item;
                echo $doenca;
            }
        } 
        $descDoenca = $_POST['desc-doencas'];
        $alergia = $_POST['alergia'];
        $descAlergia = $_POST['desc-alergia'];
        $medicamento = $_POST['medicamento'];
        $descMedicamento = $_POST['desc-medicamento'];
        $fumo = $_POST['fumo'];
        $freqFumo = $_POST['freq-fumo'];
        $drogas = $_POST['drogas'];
        $freqDrogas = $_POST['freq-drogas'];
        $bebidas = $_POST['alcool'];
        $freqBebidas = $_POST['freq-alcool'];
        $exercicios = $_POST['exercicios'];
        $freqExercicios = $_POST['freq-exercicios'];
        $recreacao = $_POST['recreacao'];
        $descRecreacao = $_POST['freq-recreacao'];
        $animais = $_POST['animais'];
        $descAnimais = $_POST['freq-animais'];
        $postos = $_POST['posto'];
        $doencaFamilia = $_POST['doencas-familia'];
        $tratamentoFamilia = $_POST['tratamento-familia'];
        $anamnese = new AnamneseEnfermagem($id, $idUsuario,$queixaPrincipal,$inicio,$doenca,$descDoenca,$alergia,$descAlergia,$medicamento,$descMedicamento,$fumo,$freqFumo,$drogas,$freqDrogas,$bebidas,$freqBebidas,$exercicios,$freqExercicios,$recreacao,$descRecreacao,$animais,$descAnimais,$postos,$doencaFamilia,$tratamentoFamilia);
        $anamnese->editarAnamnese($db);        
        header("Location: ../dados.php");
    }
    if(isset($_POST['acao']) && ($_POST['acao'] == "envia-nova-senha")){
        require DIR."/classes/usuarios.php";
        $token = $_POST['token'];
        $senha = $_POST['senha'];
        $query = "SELECT * FROM `usuario` WHERE `TOKEN` = '$token'";
        $result = $db->consultar($query,$db);
        if($ln = $result->fetch_assoc()){
            $usuario = new Usuario($ln['id'],$ln['nome'], $ln['rg'],$ln['cpf'],$ln['dataNascimento'],$ln['naturalidade'],$ln['telefone'],$ln['nomePai'],$ln['nomeMae'],$ln['cartaoSUS'],$ln['profissao'],$ln['tempoServico'],$ln['email'],$ln['senha'],$ln['numero'],$ln['complemento'],$ln['cep'],$ln['logradouro'],$ln['bairro'],$ln['cidade'],$ln['estado'],$ln['estadoCivil'],$ln['sexo'],$token);
        }
        $usuario->alteraSenha($senha,$db);
        header("LOCATION: ".URL_BASE);
    }
    if(isset($_POST['acao']) && ($_POST['acao'] == "avaliar-consulta-admin")){
        require DIR."/classes/prontuario.php";
        $id_prontuario = $_POST['idProntuario'];
        $id_consulta = $_POST['idConsulta'];
        $cod_diagnostico = $_POST['cod_diagnostico'];
        $texto_diagnostico = $_POST['texto_diagnostico'];
        $nota_avaliacao = $_POST['nota_avaliacao'];
        $texto_avaliacao = $_POST['texto_avaliacao'];        
        $avaliador = $_POST['usuario'];
        $prontuario = new Prontuario($id_prontuario,$id_consulta,$cod_diagnostico,$texto_diagnostico,$nota_avaliacao,$texto_avaliacao,$avaliador);
        $prontuario->editarProntuario($db);
        header("Location: ../admin/calendario/");
    }    
}else{
    header("Location: ../index.php");
}
function limpaString($valor){
    $valor = trim($valor);
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(",", "", $valor);
    $valor = str_replace("-", "", $valor);
    $valor = str_replace("/", "", $valor);
    $valor = str_replace("(", "", $valor);
    $valor = str_replace(")", "", $valor);
    $valor = str_replace(" ", "", $valor);
    return $valor;
}
?>
