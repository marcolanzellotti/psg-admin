<?php
require_once("./inc/functions.inc.php");
if (isset($_GET['i'])) {
    $qRedirect = $con->query("SELECT * FROM redirects");
    $redirect = $qRedirect->fetch_assoc();
    $redirectUrl = $redirect['dest'];
    die(header("Location: $redirectUrl"));
}