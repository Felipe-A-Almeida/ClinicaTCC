<?php
require_once "init.php";
require_once DIR."/classes/DB.php";
$db = new DB();

if(isset($_POST['usuario'])){
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    
    header('Content-type: application/json');
    $senha_criptografada = md5($senha);
    $query = "SELECT * FROM `aluno` WHERE `ra` = '$usuario' AND `senha` = '$senha_criptografada' LIMIT 1";
    $result = $db->consultar($query,$db);
    if($ln = $result->fetch_assoc()){
        $conteudo = array('usuario'=>$ln['nome'],'senha' => $ln['senha'],'token' => $ln['TOKEN'],'id'=>$ln['id']);
        $resposta = json_encode($conteudo);
        echo $resposta;
        http_response_code(201);
    }
}else{
    if(isset($_POST['idAluno'])){
        $idAluno = (int) $_POST['idAluno'];
        $query = "SELECT `a`.`id` AS `id`,`a`.`data_inicio` AS `inicio`,`a`.`data_fim` AS `fim`,`d`.`id` AS `idUsuario`,`b`.`nome` AS `nomeAluno`,`b`.`idCurso` as `idCurso`,`c`.`descricao` AS `tipoConsulta`,`d`.`nome` AS `nomeUsuario` FROM `consulta` AS `a` INNER JOIN `aluno` AS `b` ON `a`.`idAluno` = `b`.`id` INNER JOIN `tipoconsulta` AS `c` ON `a`.`idTipoConsulta` = `c`.`id` INNER JOIN `usuario` AS `d` ON `a`.`idUsuario` = `d`.`id` LEFT JOIN `prontuario` AS `e` ON `a`.`id` = `e`.`id_consulta` WHERE `idAluno` = $idAluno AND `e`.`cod_diagnostico` is NULL";        
        $result = $db->consultar($query,$db);       
        $flag_anamnese = 0;
        while($ln = $result->fetch_assoc()){ 
            if($ln['idCurso'] == 1){
                $tabela = "anamnesefisio";
            } 
            if($ln['idCurso'] == 2){
                $tabela = "anamneseenfermagem";
            }           
            $query_anamnese = "SELECT `id` FROM {$tabela} WHERE `idUsuario` = {$ln['idUsuario']}"; 
            $result_anamnese = $db->consultar($query_anamnese,$db);
            if($result_anamnese->num_rows > 0){
                $flag_anamnese = 1;
            }
            $query_historico = "SELECT `a`.`id` AS `idConsulta`, `a`.`data_inicio` AS `data_inicio`,`b`.`cod_diagnostico` AS `cod_diagnostico`,`b`.`texto_diagnostico` AS `texto_diagnostico`, `b`.`nota_avaliacao` AS `nota_avaliacao`, `b`.`texto_avaliacao` AS `texto_avaliacao`, `d`.`nome` AS `avaliador`, `c`.`descricao` AS `tipoConsulta` FROM `consulta` AS `a` INNER JOIN `prontuario` AS `b` ON `a`.`id` = `b`.`id_consulta` INNER JOIN `tipoConsulta` AS `c` ON `a`.`idTipoConsulta` = `c`.`id` INNER JOIN `adm` AS `d` ON `d`.`id` = `b`.`id_avaliador` WHERE `a`.`idUsuario` = {$ln['idUsuario']}";
            $texto_historico = "";
            if($result_historico = $db->consultar($query_historico,$db)){
                if($result_historico->num_rows > 0){
                    while($ln_historico = $result_historico->fetch_assoc()){
                        $data_consulta = date("d/m/Y",strtotime($ln_historico['data_inicio']));
                        $texto_historico .= "Data da Consulta: {$data_consulta} \n";
                        $texto_historico .= "Tipo de Consulta: {$ln_historico['tipoConsulta']}\n";
                        $texto_historico .= "Diagnóstico: {$ln_historico['cod_diagnostico']}\n";
                        $texto_historico .= "Comentários: {$ln_historico['texto_diagnostico']}\n";
                        $texto_historico .= "Avaliado por: {$ln_historico['avaliador']}\n";
                        $texto_historico .= "Nota avaliativa: {$ln_historico['nota_avaliacao']}\n";
                        $texto_historico .= "Comentários do avaliador: {$ln_historico['texto_avaliacao']}\n";
                        $texto_historico .= "_________________________________________________________________";
                    }
                }
            }
            $data_total = date("d/m/y H:i:s",strtotime($ln['inicio'])) . " - " . date("H:i:s",strtotime($ln['fim']));
            $conteudo = array('idConsulta'=>$ln['id'],'idUsuario'=>$ln['idUsuario'], 'nomeUsuario'=>$ln['nomeUsuario'],'idAluno'=>$idAluno,'nomeAluno'=>$ln['nomeAluno'],'dataConsulta'=>$data_total,'tipoConsulta'=>$ln['tipoConsulta'],'idCurso'=>$ln['idCurso'],'flagAnamnese'=>$flag_anamnese,'historico'=>$texto_historico);
            $resposta = json_encode($conteudo);
            echo $resposta;
        };
        
        http_response_code(201);

    }else{
        if(isset($_POST['acao']) && $_POST['acao'] == "ver_anamnese_enfermagem"){
            $idUsuario = (int) $_POST['idUsuario'];                   
            $query = "SELECT `a`.`id` AS `id`,`a`.`idUsuario` AS `idUsuario`,`a`.`queixaPrincipal` AS `queixaPrincipal`, `a`.`inicio` AS `inicio`, `a`.`doenca` AS `doenca`,`a`.`descDoenca` AS `descDoenca`,`a`.`alergia` AS `alergia`,`a`.`descAlergia` AS `descAlergia`,`a`.`medicamento` AS `medicamento`,`a`.`descMedicamento` AS `descMedicamento`, `a`.`fumo` AS `fumo`,`a`.`bebidas` AS `bebidas`,`a`.`freqBebidas`, `a`.`freqFumo`,`a`.`drogas` AS `drogas`, `a`.`freqDrogas` AS `freqDrogas`,`a`.`bebidas` AS `bebidas`, `a`.`freqBebidas` AS `freqBebidas`, `a`.`exercicios` AS `exercicios`, `a`.`freqExercicios` AS `freqExercicios`, `a`.`recreacao` AS `recreacao`, `a`.`descRecreacao` AS `descRecreacao`, `a`.`animais` AS `animais`,`a`.`descAnimais`,`a`.`postos` AS `postos`,`a`.`doencaFamilia` AS `doencaFamilia`,`a`.`tratamentoFamilia` AS `tratamentoFamilia`,`b`.`nome` AS `nomeUsuario` FROM `anamneseenfermagem` AS `a` INNER JOIN `usuario` AS `b` ON `a`.`idUsuario` = `b`.`id` WHERE `idUsuario` = $idUsuario";
            $result = $db->consultar($query,$db);
            $alergia = "";
            $medicamento = "";
            $fumo = "";
            $bebidas = "";
            $drogas = "";
            $exercicios = "";
            $recreacao = "";
            $animais = "";
            $postos = "";
            while($ln = $result->fetch_assoc()){  
                $doenca = (explode("outros",$ln['doenca']))[0];
                if($doenca != ""){
                    $doenca .="|";
                }
                $doenca .=$ln['descDoenca'];
                $ln['alergia'] == "1" ? $alergia = "Sim - ".$ln['descAlergia'] : $alergia = "Não";
                $ln['medicamento'] == "1" ? $medicamento = "Sim - ".$ln['descMedicamento'] : $medicamento = "Não";
                $ln['fumo'] == "1" ? $fumo = "Sim - ".$ln['freqFumo'] : $fumo = "Não";
                $ln['bebidas'] == "1" ? $bebidas = "Sim - ".$ln['freqBebidas'] : $bebidas = "Não";
                $ln['drogas'] == "1" ? $drogas = "Sim - ".$ln['freqDrogas'] : $drogas = "Não";
                $ln['exercicios'] == "1" ? $exercicios = "Sim - ".$ln['freqExercicios'] : $exercicios = "Não";
                $ln['recreacao'] == "1" ? $recreacao = "Sim - ".$ln['descRecreacao'] : $recreacao = "Não";
                $ln['animais'] == "1" ? $animais = "Sim - ".$ln['descAnimais'] : $animais = "Não";
                $ln['postos'] == "1" ? $postos = "Sim" : $postos = "Não";

                $conteudo = array(
                    'id'=>$ln['id'],
                    'idUsuario'=>$ln['idUsuario'],
                    'nomeUsuario'=>$ln['nomeUsuario'],
                    'queixaPrincipal'=>$ln['queixaPrincipal'],
                    'inicio'=>date("d/m/Y",strtotime($ln['inicio'])),
                    'doenca'=>$doenca,
                    'descDoenca'=>"",
                    'alergia'=>$alergia,
                    'descAlergia'=>"",
                    'medicamento'=>$medicamento,
                    'descMedicamento'=>$ln['descMedicamento'],
                    'fumo'=>$fumo,
                    'freqFumo'=>$ln['freqFumo'],     
                    'bebidas'=>$bebidas,
                    'freqBebidas'=>$ln['freqBebidas'],
                    'drogas'=>$drogas,
                    'freqDrogas'=>$ln['freqDrogas'],
                    'exercicios'=>$exercicios,
                    'freqExercicios'=>$ln['freqExercicios'],
                    'recreacao'=>$recreacao,
                    'descRecreacao'=>$ln['descRecreacao'],
                    'animais'=>$animais,
                    'descAnimais'=>$ln['descAnimais'],
                    'postos'=>$postos,
                    'doencaFamilia'=>$ln['doencaFamilia'],
                    'tratamentoFamilia'=>$ln['tratamentoFamilia'],     
                );
                $resposta = json_encode($conteudo);
                echo $resposta;
            };
            http_response_code(201);
        }else{
            if(isset($_POST['acao']) && $_POST['acao'] == "ver_anamnese_fisio"){
                $idUsuario = (int) $_POST['idUsuario'];                   
                $query = "SELECT `a`.`id` AS `id`,`a`.`idUsuario` AS `idUsuario`,`a`.`queixaPrincipal` AS `queixaPrincipal`, `a`.`inicio` AS `inicio`, `a`.`doenca` AS `doenca`,`a`.`descDoenca` AS `descDoenca`,`a`.`alergia` AS `alergia`,`a`.`descAlergia` AS `descAlergia`,`a`.`medicamento` AS `medicamento`,`a`.`descMedicamento` AS `descMedicamento`, `a`.`fumo` AS `fumo`,`a`.`bebidas` AS `bebidas`,`a`.`freqBebidas`, `a`.`freqFumo`,`a`.`drogas` AS `drogas`, `a`.`freqDrogas` AS `freqDrogas`,`a`.`bebidas` AS `bebidas`, `a`.`freqBebidas` AS `freqBebidas`, `a`.`exercicios` AS `exercicios`, `a`.`freqExercicios` AS `freqExercicios`, `a`.`recreacao` AS `recreacao`, `a`.`descRecreacao` AS `descRecreacao`, `a`.`animais` AS `animais`,`a`.`descAnimais`,`a`.`postos` AS `postos`,`a`.`doencaFamilia` AS `doencaFamilia`,`a`.`tratamentoFamilia` AS `tratamentoFamilia`,`b`.`nome` AS `nomeUsuario` FROM `anamnesefisio` AS `a` INNER JOIN `usuario` AS `b` ON `a`.`idUsuario` = `b`.`id` WHERE `idUsuario` = $idUsuario";
                $result = $db->consultar($query,$db);
                $alergia = "";
                $medicamento = "";
                $fumo = "";
                $bebidas = "";
                $drogas = "";
                $exercicios = "";
                $recreacao = "";
                $animais = "";
                $postos = "";
                while($ln = $result->fetch_assoc()){  
                    $doenca = (explode("outros",$ln['doenca']))[0];
                    if($doenca != ""){
                        $doenca .="|";
                    }
                    $doenca .=$ln['descDoenca'];
                    $ln['alergia'] == "1" ? $alergia = "Sim - ".$ln['descAlergia'] : $alergia = "Não";
                    $ln['medicamento'] == "1" ? $medicamento = "Sim - ".$ln['descMedicamento'] : $medicamento = "Não";
                    $ln['fumo'] == "1" ? $fumo = "Sim - ".$ln['freqFumo'] : $fumo = "Não";
                    $ln['bebidas'] == "1" ? $bebidas = "Sim - ".$ln['freqBebidas'] : $bebidas = "Não";
                    $ln['drogas'] == "1" ? $drogas = "Sim - ".$ln['freqDrogas'] : $drogas = "Não";
                    $ln['exercicios'] == "1" ? $exercicios = "Sim - ".$ln['freqExercicios'] : $exercicios = "Não";
                    $ln['recreacao'] == "1" ? $recreacao = "Sim - ".$ln['descRecreacao'] : $recreacao = "Não";
                    $ln['animais'] == "1" ? $animais = "Sim - ".$ln['descAnimais'] : $animais = "Não";
                    $ln['postos'] == "1" ? $postos = "Sim" : $postos = "Não";

                    $conteudo = array(
                        'id'=>$ln['id'],
                        'idUsuario'=>$ln['idUsuario'],
                        'nomeUsuario'=>$ln['nomeUsuario'],
                        'queixaPrincipal'=>$ln['queixaPrincipal'],
                        'inicio'=>date("d/m/Y",strtotime($ln['inicio'])),
                        'doenca'=>$doenca,
                        'descDoenca'=>$ln['descDoenca'],
                        'alergia'=>$alergia,
                        'descAlergia'=>$ln['descAlergia'],
                        'medicamento'=>$medicamento,
                        'descMedicamento'=>$ln['descMedicamento'],
                        'fumo'=>$fumo,
                        'freqFumo'=>$ln['freqFumo'],     
                        'bebidas'=>$bebidas,
                        'freqBebidas'=>$ln['freqBebidas'],
                        'drogas'=>$drogas,
                        'freqDrogas'=>$ln['freqDrogas'],
                        'exercicios'=>$exercicios,
                        'freqExercicios'=>$ln['freqExercicios'],
                        'recreacao'=>$recreacao,
                        'descRecreacao'=>$ln['descRecreacao'],
                        'animais'=>$animais,
                        'descAnimais'=>$ln['descAnimais'],
                        'postos'=>$postos,
                        'doencaFamilia'=>$ln['doencaFamilia'],
                        'tratamentoFamilia'=>$ln['tratamentoFamilia'],     
                    );
                    $resposta = json_encode($conteudo);
                    echo $resposta;
                    http_response_code(201);
                };
                
            }else{
                if(isset($_POST['acao']) && $_POST['acao'] == "envia_diagnostico"){
                    $codDiagnostico = $_POST['diagnostico'];
                    $textoDiagnostico = $_POST['textoDiagnostico'];
                    $idConsulta = (int) $_POST['idConsulta'];
                    $query = "INSERT INTO `prontuario` (`cod_diagnostico`,`texto_diagnostico`,`id_consulta`) VALUES ('$codDiagnostico','$textoDiagnostico','$idConsulta')";
                    echo $query;
                    $db->inserir($query,$db);
                    echo "1";
                    http_response_code(201);
                }
            }
        }
    }
}


?>