<?php
require_once __DIR__ . "/conf.inc.php";

$result = $con->query("DELETE FROM events WHERE id = {$_POST['value']}");

if($result){
    $_SESSION['msg'] = "Evento excluído com sucesso!";
    $_SESSION['style'] = "alert alert-danger";
}