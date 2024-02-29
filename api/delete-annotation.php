<?php
require_once("../inc/conf.inc.php");

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idAnnotation = $_POST['idAnnotation'];

    $searchFileNoteDaily = $con->query("SELECT * FROM notes_daily WHERE id=$idAnnotation");

    $file_note_daily = $searchFileNoteDaily->fetch_assoc();
    $path_file = $file_note_daily['url'];

    $explode_path_file = explode('/', $path_file);

    $new_path_file = '../uploads/' . $explode_path_file[3];

    if (file_exists($new_path_file)) {
        unlink($new_path_file);
    }

    $qDeleteHabit = $con->query("DELETE FROM notes_daily WHERE id=$idAnnotation");

    if ($qDeleteHabit) {
        $retorno = [
            'error' => false,
            'msg' => 'Anotação excluida com sucesso!',
            'idAnnotation' => $idAnnotation
        ];
    } else {
        $retorno = [
            'error' => true,
            'msg' => 'Error: Anotação não excluida com sucesso!'
        ];
    }
}
echo json_encode($retorno);
