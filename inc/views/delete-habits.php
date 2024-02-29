<?php

include '../functions.inc.php';

$idHabits = $_POST['idHabits'];

$return = deleteHabit($idHabits);

var_dump($return);die;