<?php
require_once("../inc/conf.inc.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $next = true;

    if ($_POST['annotation'] == '') {
        $msg = 'O campo Anotações não pode estar vazio.';
        $next = false;
    }

    if ($next) {

        $annotation = $_POST['annotation'];

        $imagemNome = '';
        $urlDestino = '';

        $idUser = $_POST['idUser'];

        $createdBy = $_SESSION['idUser'];

        $path_info = pathinfo($_FILES['imagem']['name']);

        if ($path_info['basename'] != '' || $path_info['filename'] != '') {

            $imagemNome = $path_info['basename'];

            $timestamp = time(); // Obtém o timestamp atual

            // Cria uma string única combinando o nome do arquivo e o timestamp
            $stringUnica = $imagemNome . $timestamp;

            // Cria um hash MD5 da string única
            $hash = md5($stringUnica);

            $imagemTemp = $_FILES['imagem']['tmp_name'];

            $urlDestino = '././uploads/' . $hash . '.' . $path_info['extension'];

            $caminhoDestino = '../uploads/' . $hash . '.' . $path_info['extension'];

            move_uploaded_file($imagemTemp, $caminhoDestino);
        }

        $insertAnnotation = $con->query("INSERT INTO notes_daily (
                                            annotation, 
                                            file_name,
                                            url, 
                                            id_user,
                                            createdAt, 
                                            createdBy
                                    ) VALUES (
                                            '$annotation', 
                                            '$imagemNome', 
                                            '$urlDestino',
                                            '$idUser',
                                            NOW(), 
                                            $createdBy)");

        if ($insertAnnotation) {
            $retorno = [
                'error' => false,
                'msg' => 'Anotação cadastrada com sucesso!',
                'dados' => [
                    'annotation' => $annotation,
                    'file_name' => $imagemNome,
                    'url'       => $urlDestino,
                    'createdAt' => date('d/m/Y H:i:s'),
                    'idAnnotation' => $con->insert_id
                ]
            ];
        } else {
            $retorno = [
                'error' => true,
                'msg' => 'Error: Anotação não cadastrada com sucesso!'
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
