<?php
require_once("conf.inc.php");
function loggedMentor()
{
    global $con;
    $mentor = $_SESSION['mentor'];
    $qMentor = $con->query("SELECT * FROM mentors WHERE username='$mentor'");
    return $qMentor->fetch_assoc();
}

function E($string)
{
    global $con;
    return mysqli_escape_string($con, $string);
}

function issetPostFields(array $fields)
{
    foreach ($fields as $field) if (!in_array($field, array_keys($_POST))) return false;
    return true;
}