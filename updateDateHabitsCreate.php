<?php
require_once  "inc/functions.inc.php";

$selectHabits = $con->query("SELECT * FROM habits WHERE create_date != 'Indefinida' AND created_at IS NULL");

$habits = [];

while ($row = $selectHabits->fetch_assoc()) {
    $habits[] = $row;
}

//var_dump($habits);die;

foreach ($habits as $key => $habit) {
    //var_dump($habit);die;
    $createAt = explode("/", $habit['create_date']);

    //if($habit['created_at'] != "" && $createAt[0] != 'Indefinida' && $createAt[0] != NULL) {
        $id = $habit['id'];
        $newDateCreateAt = $createAt[2] . "-" . $createAt[1] . "-" . $createAt[0];

        $qVerify = $con->query("UPDATE habits SET created_at = '$newDateCreateAt' WHERE id=$id");

        if($qVerify) {
            echo "Tudo deu certo.";
        }
    //}

}
