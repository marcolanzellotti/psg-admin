<?php
require_once  "inc/functions.inc.php";

requireLogin();

$mentor = $_SESSION['mentor'];
$mentor = mysqli_escape_string($con, $mentor);
$loggedMentor = $con->query("SELECT * FROM mentors WHERE username='$mentor'")->fetch_assoc();
$master = $loggedMentor['master'];


if ($_GET['deleteHabits']) {
    $idHabits = intval($_GET['deleteHabits']);

    $return = deleteHabit($idHabits);
}

header("Content-Type: application/json");
die(json_encode($res, JSON_UNESCAPED_UNICODE));
