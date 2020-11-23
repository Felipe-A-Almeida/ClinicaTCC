<?php
require_once "init.php";
require_once DIR."/classes/DB.php";
require_once DIR."/classes/admin.php";
$db = new DB();
$usuario = new Admin("","","","","","","","","","","","","","","","","","","","","","","","");
$usuario->validaSessao($db);
$id_usuario=$_POST['id_usuario'];
$usuario->setUsuario($id_usuario,$db);
if($_POST['bancoConsulta'] == "anamnesefisio"){
    require_once DIR."/classes/anamneseFisioterapia.php";
    $anamnese = new AnamneseFisioterapia("","","","","","","","","","","","","","","","","","","","","","","","","");
    $anamnese->setAnamnese($id_usuario,$db);
    $return_arr[] = array(
        "id" => $anamnese->getId(),
        "id_usuario" => $anamnese->getIdUsuario(),
        "queixa_principal" => $anamnese->getQueixaPrincipal(),
        "inicio" => $anamnese->getInicio(),
        "doenca" => $anamnese->getDoenca(),
        "descDoenca" => $anamnese->getDescDoenca(),
        "alergia" => $anamnese->getAlergia(),
        "descAlergia" => $anamnese->getDescAlergia(),
        "medicamento" => $anamnese->getMedicamento(),
        "descMedicamento" => $anamnese->getDescMedicamento(),
        "fumo" => $anamnese->getFumo(),
        "freqFumo" => $anamnese->getFreqFumo(),
        "drogas" => $anamnese->getDrogas(),
        "freqDrogas" => $anamnese->getFreqDrogas(),
        "bebidas" => $anamnese->getBebidas(),
        "freqBebidas" => $anamnese->getFreqBebidas(),
        "exercicios" => $anamnese->getExercicios(),
        "freqExercicios" => $anamnese->getFreqExercicios(),
        "recreacao" => $anamnese->getRecreacao(),
        "freqRecreacao" => $anamnese->getDescRecreacao(),
        "animais" => $anamnese->getAnimais(),
        "descAnimais" => $anamnese->getDescAnimais(),
        "postos" => $anamnese->getPostos(),
        "doencaFamilia" => $anamnese->getDoencaFamilia(),
        "tratamentoFamilia" => $anamnese->getTratamentoFamilia(),  
    );
}else{
    require_once DIR."/classes/anamneseEnfermagem.php";
    $anamnese = new AnamneseEnfermagem("","","","","","","","","","","","","","","","","","","","","","","","","");
    $anamnese->setAnamnese($id_usuario,$db);
    $return_arr[] = array(
        "id" => $anamnese->getId(),
        "id_usuario" => $anamnese->getIdUsuario(),
        "queixa_principal" => $anamnese->getQueixaPrincipal(),
        "inicio" => $anamnese->getInicio(),
        "doenca" => $anamnese->getDoenca(),
        "descDoenca" => $anamnese->getDescDoenca(),
        "alergia" => $anamnese->getAlergia(),
        "descAlergia" => $anamnese->getDescAlergia(),
        "medicamento" => $anamnese->getMedicamento(),
        "descMedicamento" => $anamnese->getDescMedicamento(),
        "fumo" => $anamnese->getFumo(),
        "freqFumo" => $anamnese->getFreqFumo(),
        "drogas" => $anamnese->getDrogas(),
        "freqDrogas" => $anamnese->getFreqDrogas(),
        "bebidas" => $anamnese->getBebidas(),
        "freqBebidas" => $anamnese->getFreqBebidas(),
        "exercicios" => $anamnese->getExercicios(),
        "freqExercicios" => $anamnese->getFreqExercicios(),
        "recreacao" => $anamnese->getRecreacao(),
        "freqRecreacao" => $anamnese->getDescRecreacao(),
        "animais" => $anamnese->getAnimais(),
        "descAnimais" => $anamnese->getDescAnimais(),
        "postos" => $anamnese->getPostos(),
        "doencaFamilia" => $anamnese->getDoencaFamilia(),
        "tratamentoFamilia" => $anamnese->getTratamentoFamilia(),  
    );
}

    
// Encoding array in JSON format
echo json_encode($return_arr);
?>