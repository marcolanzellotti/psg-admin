<?php
require_once("inc/api-functions.inc.php");
requireAuth();
$mentor = loggedMentor();
if (!$mentor['view_weekly_updates']) {
    set("error", "missing permissions");
} else {
    $perPage = 20;
    $offset = isset($_GET['page']) ? (intval($_GET['page']) - 1) * $perPage : 0;


    $search = isset($_POST['query']) ? E($_POST['query']) : "";
    $completion = ($search) ? "AND name LIKE '%$search%' OR phone like '%$search%'" : "";



    $qWeeklyUpdates = $con->query("SELECT * FROM weekly_updates WHERE mentor='$mentor[username]'" . (isset($_GET['id']) ? (" AND id=" . intval($_GET['id']) . " ") : "") . " $completion ORDER BY id DESC LIMIT $offset, $perPage ");
    $weeklyUpdates = [];
    while ($habit = $qWeeklyUpdates->fetch_assoc()) $weeklyUpdates[] = $habit;

    set("success", 1);
    set("weeklyUpdates", $weeklyUpdates);
    set("count", count($weeklyUpdates));
}
res();