<?php
require_once("../inc/conf.inc.php");

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userAction = $_SESSION['idUser'];
    $user = $_POST['user'];
    $is_active = $_POST['is_active'];

    if($is_active == 'inactive') {
        $is_active_value = 0;
        $text = 'desativado';
    } else {
        $is_active_value = 1;
        $text = 'ativado';
    }

    $qUpdateIsActiveUser = $pCon->query("UPDATE users SET is_active = $is_active_value, modified_at = NOW(), modified_by = $userAction WHERE id = $user;");

    if ($qUpdateIsActiveUser) {
        $retorno = [
            'error' => false,
            'msg' => "Usuário {$text} com sucesso!"
        ];
    } else {
        $retorno = [
            'error' => true,
            'msg' => 'Error: Usuário não alterado!'
        ];
    }
}
echo json_encode($retorno);
