<?php
require_once  "inc/functions.inc.php";

require("../../PHPMailer-master/src/PHPMailer.php");
require("../../PHPMailer-master/src/SMTP.php");


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

// if ($master) die(header("Location: master"));
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
$viewHabits =   $loggedMentor['view_habits'] || $master;
$viewSelectAuthor =  $master || $loggedMentor['view_habits_author_selection'];
$viewSelectMentor =  $loggedMentor['view_habits_mentor_selection'];
$viewSelectMentor2 =  $loggedMentor['is_co_author'];
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


if (!isset($_GET['view'])) {
    $view = "panel";
}

if (!isset($_GET['view']) && $master) {
    $view = "master_area";
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
    <link rel="stylesheet" href="assets/css/custom.css">
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
    

    if (($master || 1) && $view == "new_mentor")                    require_once("./inc/views/new-mentor.inc.php");

    if ($master && $view == "new_live")                             require_once("./inc/views/new-live.inc.php");

    if ($master && $view == "edit_live")                            require_once("./inc/views/edit-live.inc.php");

    if ($master && $view == "edit_team")                            require_once("./inc/views/edit-team.inc.php");

    if ($master && $view == "edit_trainning_mentor")                 require_once("./inc/views/edit-trainning-mentor.inc.php");

    if ($master && $view == "edit_category")                        require_once("./inc/views/edit-category.inc.php");

    if ($master && $view == "delete_team")                          require_once("./inc/views/delete-team.inc.php");

    if ($master && $view == "delete_category")                      require_once("./inc/views/delete-category.inc.php");

    if ($master && $view == "delete_trainning_mentor")              require_once("./inc/views/delete-trainning-mentor.inc.php");

    if (($master || 1) && $view == "edit_mentor")                   require_once("./inc/views/edit-mentor.inc.php");

    if ($master && $view == "master_area")                          require_once("./inc/views/master-area.inc.php");

    if ($viewSubscriptions && $view == "subscriptions")             require_once("./inc/views/subscriptions.inc.php");

    if ($viewWeeklyUpdates && $view == "weekly_updates")            require_once("./inc/views/weekly-updates.inc.php");

    if ($viewUpdates && $view == "updates")                         require_once("./inc/views/updates.inc.php");

    if ($viewAnalysis && $view == "analysis")                       require_once("./inc/views/analysis.inc.php");

    if ($view == "select_author")                                   require_once("./inc/views/select-author.inc.php");

    if (($viewSelectMentor || 1) && $view == "select_mentor")       require_once("./inc/views/select-mentor.inc.php");

    if ($view == "routine_eliminates_more")                         require_once("./inc/views/routine-eliminates-more.inc.php");
    
    if ($viewSelectMentor2 && $view == "select_mentor2")            require_once("./inc/views/select-mentor-2.inc.php");

    if ($viewHabits && $view == "habits")                           require_once("./inc/views/habits.inc.php");

    if ($viewHabits && $view == "habits2")                          require_once("./inc/views/habits.inc.2.php");

    if (($master || 1) && $view == "renew_habits")                  require_once("./inc/views/renew-habits.inc.php");

    if ($view == "profile")                                         require_once("./inc/views/profile.inc.php");

    if ($view == "mentors")                                         require_once("./inc/views/mentors.inc.php");

    if ($master && $view == "marathon")                             require_once("./inc/views/marathon.inc.php");

    if ($view == "trainings")                                       require_once("./inc/views/trainings.inc.php");

    if ($master && $view == "edit_training")                        require_once("./inc/views/edit-trainings.inc.php");

    if ($view == "fitflix_videos")                                  require_once("./inc/views/fitflix-videos.inc.php");

    if ($view == "edit_fitflix_video")                              require_once("./inc/views/edit-fitflix-video.inc.php");

    if ($view == "platform_lives")                                  require_once("./inc/views/platform-lives.inc.php");

    if ($view == "platform_team")                                   require_once("./inc/views/platform-team.inc.php");

    if ($view == "platform_meetings")                               require_once("./inc/views/platform-meetings.inc.php");

    if ($view == "platform_trainings")                   require_once("./inc/views/platform-trainings.inc.php");

    if ($view == "platform_marathon")                   require_once("./inc/views/platform-marathon.inc.php");

    if ($view == "platform_marathon_list")                   require_once("./inc/views/platform-marathon-list.inc.php");

    if ($view == "platform_eliminates_more")                   require_once("./inc/views/platform-eliminates-more.inc.php");

    if ($view == "mentor_training")                   require_once("./inc/views/mentor-training.inc.php");

    if ($view == "register_categories")                   require_once("./inc/views/register-categories.inc.php");

    if ($master && $view == "edit_live")                   require_once("./inc/views/edit-platform-lives.inc.php");

    if ($view == "platform_access")                   require_once("./inc/views/platform-access.inc.php");

    if ($view == "platform_users")                   require_once("./inc/views/platform-users.inc.php");

    if ($view == "platform_diary")                   require_once("./inc/views/platform-diary.inc.php");

    if ($view == "diary")                   require_once("./inc/views/diary.inc.php");

    if ($view == "vip_members")                   require_once("./inc/views/vip-members.inc.php");

    if ($view == "add_habits")                   require_once("./inc/views/add-habits.inc.php");

    if ($view == "edit_habits")                   require_once("./inc/views/edit-habits.inc.php");

    if ($view == "signature_users")                   require_once("./inc/views/signature-users.inc.php");

    if ($view == "members")                   require_once("./inc/views/members.inc.php");

    if ($view == "members_access")                   require_once("./inc/views/members-access.inc.php");

    if ($view == "edit_subscriptions")                   require_once("./inc/views/edit-subscriptions.inc.php");

    if ($view == "edit_customers")                   require_once("./inc/views/edit-customer.inc.php");

    if ($view == "edit_platform_users")                   require_once("./inc/views/edit-platform-users.inc.php");

    if ($view == "platform_2_users")                   require_once("./inc/views/platform-2-users.inc.php");

    if ($view == "upload_contacts")                   require_once("./inc/views/upload-contacts.inc.php");

    if ($view == "select_co_author_all")                   require_once("./inc/views/select-co-author-all.inc.php");

    if ($view == "select_mentor_all")                   require_once("./inc/views/select-mentor-all.inc.php");

    if ($view == "panel") {
        require_once("./inc/views/panel.inc.php");
    }

    if ($view == "upload_calendar")                   require_once("./inc/views/upload-calendar.inc.php");

    if ($view == "create_events")                   require_once("./inc/views/create-events.inc.php");
    
    if ($view == "list_events")                   require_once("./inc/views/list-events.inc.php");

    if ($view == "import_number_spreadsheet")                   require_once("./inc/views/import-number-spreadsheet.inc.php");
    ?>

</body>
<script src="assets/js/main.js"></script>
<script src="assets/js/custom.js"></script>
<script>
    $(document).ready(function() {
        $('.sidenav').sidenav()
        $('select').formSelect()
        $('.materialboxed').materialbox()
        const formats = {
            br: '+55(00)00000-0000',
            au: '+61(00) 0000 0000',
            pt: '+351 000 000 000',
            us: '+1 (000) 000-000'
        }

        let currentFormat = "br"
        var element = document.getElementById("whatsapp");
        let mask;
        let maskOptions = {
            mask: formats[currentFormat]
        };
        if (element) {
            mask = IMask(element, maskOptions);

        }

        const handleSetFormat = (e) => {
            format = e.selectedOptions[0].dataset.format
            currentFormat = format
            mask.updateOptions({
                mask: formats[currentFormat]
            })


        }
    });
</script>

</html>