<?php
    define("URL_BASE","http://localhost/tcc/");
    define("DIR","C:/xampp/htdocs/tcc/");
    require_once DIR."/classes/DB.php";
    $db = new DB();    
    if(isset($_POST['nome'])){
        require_once DIR."/classes/usuarios.php";        
        
        $usuario = new Usuario("",$_POST['nome'], $_POST['RG'],$_POST['CPF'],$_POST['data-nascimento'],$_POST['naturalidade'],$_POST['telefone'],$_POST['nomePai'],$_POST['nomeMae'],$_POST['cartao-sus'],$_POST['email'],$_POST['senha'],$_POST['cep'],$_POST['logradouro'],$_POST['bairro'],$_POST['cidade'],$_POST['estado'],$_POST['complemento']);
        print_r($db->getSql());
        $usuario->cadastrar($db);

    }
    if(isset($_POST['cpf-login'])){
        require_once DIR."/classes/usuarios.php"; 
        $senha = md5($_POST['senha']);
        $cpf = limpaString($_POST['cpf-login']);
        $query = "SELECT `senha`,`cpf` FROM `usuario` WHERE `cpf` = '$cpf' AND `senha` = '$senha'";
        $result = $db->consultar($query,$db);
        $ln = $result->fetch_assoc();
        echo $query;
        print_r($ln);
        
        
    }
    if(isset($_POST['acao']) && ($_POST['acao'] == "cadastrar-anamnese-enfermagem")){
        require_once DIR."/classes/anamneseEnfermagem.php"; 
        $id = "-";
        $idUsuario = 1;
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
    }

    if(isset($_POST['acao']) && ($_POST['acao'] == "cadastrar-anamnese-fisioterapia")){
        require_once DIR."/classes/anamneseFisioterapia.php"; 
        $id = "-";
        $idUsuario = 1;
        $queixaPrincipal = $_POST['queixa-principal'];
        $inicio = $_POST['inicio'];        
        $exercicios = $_POST['exercicios'];
        $freqExercicios = $_POST['freq-exercicios'];
        $recreacao = $_POST['recreacao'];
        $descRecreacao = $_POST['freq-recreacao'];        
        $doencaFamilia = $_POST['doencas-familia'];
        $tratamentoFamilia = $_POST['tratamento-familia'];    
        $anamnese = new AnamneseFisioterapia($id, $idUsuario,$queixaPrincipal,$inicio,$exercicios,$freqExercicios,$recreacao,$descRecreacao,$doencaFamilia,$tratamentoFamilia);
        $anamnese->inserirFisioterapia($db);
    }
    if(isset($_POST['clinica-consulta-admin'])){
        require_once DIR."/classes/consulta.php";
        $id="";
        $idUsuario = "";
        $idAluno = "";
        $idAdm = 1;
        $data = $_POST['data'];
        $hora_inicio = $_POST['hora-inicio'];
        $hora_fim = $_POST['hora-fim'];
        $dataInicial = date("Y-m-d",strtotime($data)) . ":" . $hora_inicio;
        $dataFinal = date("Y-m-d",strtotime($data)) . ":" . $hora_fim;
        $idTipoConsulta = $_POST['tipo-consulta'];
        $consulta = new Consulta($id,$idUsuario,$idAluno,$idAdm,$dataInicial,$dataFinal,$idTipoConsulta);        
        $consulta->cadastrarConsulta($db);
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