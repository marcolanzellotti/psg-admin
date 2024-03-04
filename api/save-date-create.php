<?php
require_once("../inc/conf.inc.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $next = true;

    if ($_POST['dateCreate'] == '') {
        $msg = 'O campo Data Criação não pode estar vazio.';
        $next = false;
    }

    if ($next) {

        $dateCreate = $_POST['dateCreate'];

        $dateExplode = explode('/', $_POST['dateCreate']);
        
        $dateNewExplode = $dateExplode[2] . "-" . $dateExplode[1] . "-" . $dateExplode[0];

        $idUser = $_POST['idUser'];

        $createdBy = $_SESSION['idUser'];

        $updateDateCreate = $con->query("UPDATE habits SET create_date = '$dateCreate', created_at = '$dateNewExplode' WHERE id='$idUser'");

        if ($updateDateCreate) {
            $retorno = [
                'error' => false,
                'msg' => 'Data de criação alterada com sucesso!',
                'dados' => [
                    'create_date' => $dateCreate,
                    'idHabits' => $idUser
                ]
            ];
        } else {
            $retorno = [
                'error' => true,
                'msg' => 'Error: Data de criação não alterada com sucesso!'
            ];
        }
    } else {
        $retorno = [
            'error' => true,
            'msg' => $msg
        ];
    }
    echo json_encode($retorno);
}
