<?php
require_once("inc/api-functions.inc.php");
requireAuth();
$mentor = loggedMentor();
if (0) {
    set("error", "missing permissions");
} elseif (isset($_GET['delete'])) {
    $qDeleteHabit = $con->query("DELETE FROM habits WHERE id='$delete' AND mentor='$mentor[username]' AND 0");
    if ($qDeleteHabit->affected_rows) {
        set("success", 1);
        set("message", "deleted");
    } else {
        set("success", 0);
        set("message", "not deleted");
    }
} elseif (isset($_GET['id']) && issetPostFields(['name', 'phone', 'mail'])) { //, 'difficult', 'try', 'height', 'weight', 'abdomen', 'hip', 'wanted_weight'])) {
    $id = intval($_GET['id']);
    $name = E($_POST['name']);
    $email = E($_POST['mail']);
    $phone = E($_POST['phone']);

    // $difficult = E($_POST['difficult']);
    // $try = E($_POST['try']);
    // $height = E($_POST['height']);
    // $weight = E($_POST['weight']);
    // $abdomen = E($_POST['abdomen']);
    // $hip = E($_POST['hip']);
    // $wanted_weight = E($_POST['wanted_weight']);


    //  $qUpdateHabit = $con->query("UPDATE habits SET name='$name', phone='$phone', difficult='$difficult', try='$try', height='$height', weight='$weight', abdomen='$abdomen', hip='$hip', wanted_weight='$wanted_weight' WHERE id=$id");
    $qUpdateHabit = $con->query("UPDATE habits SET name='$name', phone='$phone', mail='$email' WHERE id=$id");

    if ($qUpdateHabit) {
        set("success", 1);
    } else {
        set("success", 0);
        set("error", mysqli_error($con));
    }
} else {
    $perPage = 50;
    $offset = isset($_GET['page']) ? (intval($_GET['page']) - 1) * $perPage : 0;

    $search = isset($_POST['query']) ? E($_POST['query']) : "";

    $completion = ($search) ? "AND name LIKE '%$search%' OR phone like '%$search%'" : "";

    $qHabits = $con->query("SELECT * FROM habits WHERE (mentor='$mentor[username]' OR 1)" . (isset($_GET['id']) ? (" AND id=" . intval($_GET['id']) . " ") : "") . " $completion ORDER BY id DESC" . ((isset($_GET['all'])) ? "" : " LIMIT $offset, $perPage"));

    $habits = [];

    while ($habit = $qHabits->fetch_assoc()) $habits[] = $habit;

    set("success", 1);
    set("habits", $habits);
    set("count", count($habits));
}
res();
