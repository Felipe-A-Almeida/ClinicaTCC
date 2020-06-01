<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    require_once "../init.php";
    require_once DIR."/classes/DB.php";
    $db = new DB();    
    if(isset($_POST['acao']) && ($_POST['acao'] == "cadastrar-usuario")){
        require_once DIR."/classes/usuarios.php";        
        $usuario = new Usuario("",$_POST['nome'], $_POST['RG'],$_POST['CPF'],$_POST['data-nascimento'],$_POST['naturalidade'],$_POST['telefone'],$_POST['nomePai'],$_POST['nomeMae'],$_POST['cartao-sus'],$_POST['profissao'],$_POST['tempoServico'],$_POST['email'],$_POST['senha'],$_POST['numero'],$_POST['complemento'],$_POST['cep'],$_POST['logradouro'],$_POST['bairro'],$_POST['cidade'],$_POST['estado'],$_POST['estado-civil'],$_POST['sexo']);
        if($usuario->cadastrar($db)){
            header("LOCATION: ".URL_BASE."main.php");
        }else{
            header("LOCATION: ".URL_BASE);
        }        
    }
    if(isset($_POST['cpf-login'])){
        require_once DIR."/classes/usuarios.php"; 
        $senha = md5($_POST['senha']);
        $cpf = limpaString($_POST['cpf-login']);
        $query = "SELECT * FROM `usuario` WHERE `cpf` = '$cpf' AND `senha` = '$senha'";
        echo $query;
        $result = $db->consultar($query,$db);
        if($ln = $result->fetch_assoc()){
            $usuario = new Usuario($ln['id'],$ln['nome'], $ln['rg'],$ln['cpf'],$ln['dataNascimento'],$ln['naturalidade'],$ln['telefone'],$ln['nomePai'],$ln['nomeMae'],$ln['cartaoSUS'],$ln['profissao'],$ln['tempoServico'],$ln['email'],$ln['senha'],$ln['numero'],$ln['complemento'],$ln['cep'],$ln['logradouro'],$ln['bairro'],$ln['cidade'],$ln['estado'],$ln['estadoCivil'],$ln['sexo']);        
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
        $queixaPrincipal = $_POST['queixa-principal'];
        $inicio = $_POST['inicio'];
        $doenca = $_POST['doenca'];
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
        $anamnese->inserirEnfermagem($db);
        header("Location: ../main.php");
    }

    if(isset($_POST['acao']) && ($_POST['acao'] == "cadastrar-anamnese-fisioterapia")){
        require_once DIR."/classes/anamneseFisioterapia.php"; 
        $id = "-";
        $idUsuario = $_POST['idUsuario'];
        $queixaPrincipal = $_POST['queixa-principal'];
        $inicio = $_POST['inicio'];        
        $exercicios = $_POST['exercicios'];
        $freqExercicios = $_POST['freq-exercicios'];
        $recreacao = $_POST['recreacao'];
        $descRecreacao = $_POST['freq-recreacao'];        
        $doencaFamilia = $_POST['doencas-familia'];
        $tratamentoFamilia = $_POST['tratamento-familia'];  
        echo "<br>".$idUsuario."<br>";
        $anamnese = new AnamneseFisioterapia($id, $idUsuario,$queixaPrincipal,$inicio,$exercicios,$freqExercicios,$recreacao,$descRecreacao,$doencaFamilia,$tratamentoFamilia);
        $anamnese->inserirFisioterapia($db);
        header("Location: ../main.php");
    }
    
    if(isset($_POST['acao']) && ($_POST['acao'] == "clinica-consulta-admin")){
        require_once DIR."/classes/consulta.php";
        $id="";
        $idUsuario = $_POST['paciente'];
        $idAluno = "";
        $idAdm = 1;
        $data = $_POST['data'];
        $horario = explode(" - ",$_POST['horario']);
        $hora_inicio = $horario[0];
        $hora_fim = $horario[1];
        $dataInicial = date("Y-m-d",strtotime($data)) . ":" . $hora_inicio;
        $dataFinal = date("Y-m-d",strtotime($data)) . ":" . $hora_fim;
        $idTipoConsulta = $_POST['tipo-consulta'];
        $consulta = new Consulta($id,$idUsuario,$idAluno,$idAdm,$dataInicial,$dataFinal,$idTipoConsulta);        
        $consulta->cadastrarConsulta($db);
        header("Location: ../admin/calendario/");
    }
    if(isset($_POST['acao']) && $_POST['acao'] == "cadastrar-aluno-admin"){
        require_once DIR."/classes/alunos.php";
        $id="";
        $ra = $_POST["ra"];
        $nome = $_POST["nome_aluno"];
        $idCurso = $_POST["curso"];
        $ano = $_POST["ano"];
        $telefone = limpaString($_POST['telefone']);
        $aluno = new Aluno($id,$ra,$nome,$idCurso,$ano,$telefone);        
        $aluno->cadastrarAluno($db);        
        header("Location: ../admin/cadastro_aluno/");
    }
    if(isset($_POST['acao']) && $_POST['acao'] == "cadastrar-adm-admin"){
        require_once DIR."/classes/admin.php";
        $id="";
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = md5($_POST["senha"]);
        $confirmaSenha = $_POST["confirmaSenha"];
        $telefone = limpaString($_POST['telefone']);
        $funcionario = new Admin($id,$nome,$email,$senha,$telefone);        
        $funcionario->cadastrarAdmin($db);        
        header("Location: ../admin/cadastro_funcionario/");
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
        $consulta = new Consulta($id,$idUsuario,$idAluno,$idAdm,$dataInicial,$dataFinal,$idTipoConsulta);        
        $consulta->cadastrarConsulta($db);
        header("Location: ../main.php");
    }
    if(isset($_POST['acao']) && $_POST['acao'] == "login-admin"){
        require_once DIR."/classes/admin.php"; 
        $senha = md5($_POST['senha']);
        $email = $_POST['email'];
        $query = "SELECT * FROM `adm` WHERE `email` = '$email' AND `senha` = '$senha'";
        $result = $db->consultar($query,$db);
        if($ln = $result->fetch_assoc()){
            $admin = new Admin($ln['id'],$ln['nome'],$ln['email'],$ln['senha'],$ln['telefone']);        
            $admin->sessao();            
            header("LOCATION: ".URL_BASE."admin/calendario/");
        }else{
            header("LOCATION: ".URL_BASE."admin");
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
        $consulta = new Consulta($id,$idUsuario,$idAluno,$idAdm,$dataInicial,$dataFinal,$idTipoConsulta);        
        $consulta->editarConsulta($db);
        header("Location: ../main.php");
    }
    if(isset($_POST['acao']) && $_POST['acao'] == "editar-consulta-admin"){
        require_once DIR."/classes/consulta.php";
        $id=$_POST['idConsulta'];
        $idUsuario = $_POST['usuario'];
        $idAluno = "";
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
        header("Location: ../calendario/");
    }
    if(isset($_POST['acao']) && ($_POST['acao'] == "editar-dados-usuario")){
        require_once DIR."/classes/usuarios.php";        
        $usuario = new Usuario("",$_POST['nome'], $_POST['RG'],$_POST['CPF'],$_POST['data-nascimento'],$_POST['naturalidade'],$_POST['telefone'],$_POST['nomePai'],$_POST['nomeMae'],$_POST['cartao-sus'],$_POST['profissao'],$_POST['tempoServico'],$_POST['email'],"",$_POST['numero'],$_POST['complemento'],$_POST['cep'],$_POST['logradouro'],$_POST['bairro'],$_POST['cidade'],$_POST['estado'],$_POST['estadoCivil'],$_POST['sexo']);
        $usuario->editar($id,$db);
        header("LOCATION: ".URL_BASE."main.php");               
    }
    if(isset($_POST['acao']) && ($_POST['acao'] == "editar-anamnese-fisioterapia")){
        require_once DIR."/classes/anamneseFisioterapia.php"; 
        $anamnese = new AnamneseFisioterapia("", $_POST['idUsuario'],$_POST['queixa-principal'],$_POST['inicio'],$_POST['exercicios'],$_POST['freq-exercicios'],$_POST['recreacao'],$_POST['freq-recreacao'],$_POST['doencas-familia'],$_POST['tratamento-familia']);
        $anamnese->editarAnamnese($db);
        header("Location: ../main.php");
    }
    if(isset($_POST['acao']) && ($_POST['acao'] == "editar-anamnese-enfermagem")){
        require_once DIR."/classes/anamneseEnfermagem.php"; 
        $id = "";
        $idUsuario = $_POST['idUsuario'];
        $queixaPrincipal = $_POST['queixa-principal'];
        $inicio = $_POST['inicio'];
        $doenca = $_POST['doenca'];
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
        header("Location: ../main.php");
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
