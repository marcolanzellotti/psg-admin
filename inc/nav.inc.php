<?php
require_once  "inc/functions.inc.php";
requireLogin();
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    die();
}

$mentor = $_SESSION['mentor'];
$mentor = mysqli_escape_string($con, $mentor);
$loggedMentor = $con->query("SELECT * FROM mentors WHERE username='$mentor'")->fetch_assoc();
$master = $loggedMentor['master'];

if (isset($_GET['del'])) {
    $con->query("DELETE FROM subscriptions WHERE id=" . intval($_GET['del']));
    die(header("Location: ?view=subscriptions"));
}
if (isset($_GET['del_update'])) {
    $con->query("DELETE FROM weekly_updates WHERE" . ($master ? " 1 " : " mentor='$mentor' ") . "AND id=" . intval($_GET['del_update']));
    die(header("Location: ?view=weekly_updates"));
}

if (isset($_GET['deleteHabit'])) {
    $con->query("DELETE FROM habits WHERE" . ($master || $mentor == "marco" || $mentor == "julyane" ? " 1 " : " mentor='$mentor' ") . "AND id=" . intval($_GET['deleteHabit']));
    die(header("Location: ?view=habits"));
}


$viewUpdates = $master || $loggedMentor['view_updates'];
$viewHabits =   $loggedMentor['view_habits'];
$viewSelectAuthor =  $master || $loggedMentor['view_habits_author_selection'];
$viewSelectMentor =  $loggedMentor['view_habits_mentor_selection'];
$viewSubscriptions =  $master || $loggedMentor['view_subscriptions'];
$viewAnalysis =  $master || $loggedMentor['view_analysis'];
$viewPrivateInfo = $master || $loggedMentor['view_private_info'];
$viewWeeklyUpdates = $master || $loggedMentor['view_weekly_updates'];


if (isset($_POST['whatsapp_subscriptions'])) {
    setWhatsappSubscriptionUrl($_POST['whatsapp_subscriptions']);
}
if (isset($_POST['reset_psg_subscription_key'])) {
    resetPsgSubscriptionKey();
}

$whatsappSubscriptions = getWhatsappSubscriptionUrl();
$psgSubscriptionKey = getPsgSubscriptionKey();

$view = isset($_GET['view']) ? $_GET['view'] : "weekly_updates";

//////////////// CREATE MENTOR /////////////////////////////////////////////////
if (issetPostFields(["name", "username", "password", "createMentor"])) {
    if (!($id = createMentor($_POST['name'], $_POST['username'], $_POST['password'], '', '', '', ''))) {
        $error = "Erro ao criar mentor";
    }
    header("Location: /psg-admin/painel.php?view=edit_mentor&mentor=$id");
}

if (issetPostFields(["createLive", "title", "url"])) {
    $title = mysqli_escape_string($con, $_POST['title']);
    $url = mysqli_escape_string($con, $_POST['url']);
    $qCreateLive = $con->query("INSERT INTO lives (title, url) VALUES ('$title', '$url')");
    $id = $con->insert_id;
    header("Location: /psg-admin/painel.php?view=edit_live&live=$id");
}

if (issetPostFields(["updateLive", "title", "url"])) {
    if (!isset($_GET['live']))
        header("Location: /psg-admin/painel.php");
    $id = intval($_GET['live']);

    $title = mysqli_escape_string($con, $_POST['title']);

    $url = mysqli_escape_string($con, $_POST['url']);
    $qUpdateLive = $con->query("UPDATE lives SET title='$title', url='$url' WHERE id=$id");
    header("Location: /psg-admin/painel.php?view=edit_live&live=$id");
}


?>
<html>

<head>
    <title>Dados recebidos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Compiled and minified CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/imask"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</head>

<body>
    <div class="modal p1 modal-fixed-footer" id="modal1">
        <form id="save">

            <div id="modal1-content" class="modal-content">

            </div>
            <div class="modal-footer">
                <input type="submit" class="btn" value="Salvar">
                <input type="button" class="btn  red modal-close" value="Fechar">
            </div>
        </form>
    </div>
    <?php require_once("./inc/views/nav.inc.php"); ?>
    <?php
    // Pagination config
    $perPage = 40;
    $offset = isset($_GET['page']) ? (intval($_GET['page']) - 1) * $perPage : 0;
    ?>
    <?php
    if ($master && $view == "new_mentor")                 require_once("./inc/views/new-mentor.inc.php");
    if ($master && $view == "new_live")                   require_once("./inc/views/new-live.inc.php");
    if ($master && $view == "edit_live")                  require_once("./inc/views/edit-live.inc.php");
    if ($master && $view == "edit_mentor")                require_once("./inc/views/edit-mentor.inc.php");
    if ($master && $view == "master_area")                require_once("./inc/views/master-area.inc.php");
    if ($viewSubscriptions && $view == "subscriptions")   require_once("./inc/views/subscriptions.inc.php");
    if ($viewWeeklyUpdates && $view == "weekly_updates")  require_once("./inc/views/weekly-updates.inc.php");
    if ($viewUpdates && $view == "updates")               require_once("./inc/views/updates.inc.php");
    if ($viewAnalysis && $view == "analysis")             require_once("./inc/views/analysis.inc.php");
    if ($viewSelectAuthor && $view == "select_author")    require_once("./inc/views/select-author.inc.php");
    if ($viewSelectMentor && $view == "select_mentor")    require_once("./inc/views/select-mentor.inc.php");
    if ($viewHabits && $view == "habits")                 require_once("./inc/views/habits.inc.php");
    if ($viewHabits && $view == "habits2")                require_once("./inc/views/habits.inc.2.php");
    if ($master && $view == "renew_habits")               require_once("./inc/views/renew-habits.inc.php");
    if ($master && $view == "marathon")                   require_once("./inc/views/marathon.inc.php");

    ?>

</body>
<script src="assets/js/main.js"></script>
<script>
    $(document).ready(function() {
        $('.sidenav').sidenav();
        $('select').formSelect();
    });
</script>

</html>