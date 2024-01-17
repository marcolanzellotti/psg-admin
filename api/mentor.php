<?php
require_once("inc/api-functions.inc.php");
requireAuth();
$mentor = loggedMentor();
set("name", $mentor['name']);
set("master", $mentor['master']);
set("username", $mentor['username']);
res();