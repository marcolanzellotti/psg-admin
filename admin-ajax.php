<?php
require_once  "inc/functions.inc.php";
requireLogin();
$res = new stdClass();

$mentor = $_SESSION['mentor'];
$mentor = mysqli_escape_string($con, $mentor);
$loggedMentor = $con->query("SELECT * FROM mentors WHERE username='$mentor'")->fetch_assoc();
$master = $loggedMentor['master'];

if (issetGetFields([
    "mentor", "togglepermission"
])) {
    if (!$master) {
        $res->success = false;
        $res->error = "Access denied";
    } else {
        if (!in_array($_GET['togglepermission'], [
            "view_subscriptions",
            "view_updates",
            "view_weekly_updates",
            "view_habits",
            "view_analysis",
            "view_habits_author_selection",
            "view_habits_mentor_selection",
        ])) {
            $res->success = false;
            $res->error = "Invalid permission";
        } else {
            if (!$mentor_ = getMentor($_GET['mentor'])) {
                $res->success = false;
                $res->error = "Mentor not found";
            } else {
                $qTogglePermission = $con->query("UPDATE mentors SET $_GET[togglepermission] = NOT $_GET[togglepermission] WHERE id=$_GET[mentor]");
                if ($qTogglePermission) {
                    $res->success = true;
                    $res->mentor = $mentor_['name'];
                    $res->toggledpermission = $_GET['togglepermission'];
                    $res->newValue = !$mentor_[$_GET['togglepermission']];
                } else {
                    $res->success = false;
                    $res->error = mysqli_error($con);
                }
            }
        }
    }
} elseif (issetGetFields(["getSubscriptions"])) {
    if (!$loggedMentor['view_subscriptions'] && !$loggedMentor['master']) {
        $res->success = false;
        $res->error = "Access denied";
    } else {
        $qSubscriptions = $con->query("SELECT * FROM subscriptions ORDER BY id DESC" . ((isset($_GET['limit'])) ? " LIMIT " . intval($_GET['limit']) : ""));
        $arr = [];
        while ($subscription = $qSubscriptions->fetch_assoc()) {
            $subscription['symptoms'] = explode(", ", $subscription['symptoms']);
            array_push($arr, $subscription);
        }
        $res->success = true;
        $res->subscriptions = $arr;
    }
} elseif (issetGetFields(["getUpdates"])) {
    if (!$loggedMentor['view_updates'] && !$loggedMentor['master']) {
        $res->success = false;
        $res->error = "Access denied";
    } else {
        $qUpdates = $con->query("SELECT * FROM updates ORDER BY id DESC" . ((isset($_GET['limit'])) ? " LIMIT " . intval($_GET['limit']) : ""));
        $arr = [];
        while ($update = $qUpdates->fetch_assoc()) {
            $update['life_change'] = explode(", ", $update['life_change']);
            array_push($arr, $update);
        }
        $res->success = true;
        $res->updates = $arr;
    }
} elseif (issetGetFields(['toggleSentAnalysis'])) {
    if (!$loggedMentor['master'] && !in_array($loggedMentor['name'], ['marco', 'Marco', 'Administrativo2'])) {
        $res->success = false;
        $res->error = "Access denied";
    } else {
        $id = intval($_GET['toggleSentAnalysis']);
        $qSentAnalysis = $con->query("UPDATE updates SET sent_analysis = NOT sent_analysis WHERE id=$id");
        if ($qSentAnalysis) {
            $res->success = true;
        } else {
            $res->success = false;
            $res->error = mysqli_error($con);
        }
    }
} elseif (issetGetFields(['toggleMentorAuthor', 'mentor', 'author'])) {
    if (!$loggedMentor['master']) {
        $res->success = false;
        $res->error = "Access denied";
    } else {
        $mentor = intval($_GET['mentor']);
        $author = intval($_GET['author']);
        $qToggleMentorAuthor = $con->query("UPDATE mentors SET author_id=$author WHERE id=$mentor");
        if ($qToggleMentorAuthor) {
            $res->success = true;
        } else {
            $res->success = false;
            $res->error = mysqli_error($con);
        }
    }
} elseif (issetGetFields(['toggleHabitAuthor', 'author'])) {
    if (!$loggedMentor['master']) {
        $res->success = false;
        $res->error = "Access denied";
    } else {
        $habit = intval($_GET['toggleHabitAuthor']);
        $author = intval($_GET['author']);
        $qToggleHabitAuthor = $con->query("UPDATE habits SET author=$author WHERE id=$habit");
        var_dump($con);
        if ($qToggleHabitAuthor) {
            $res->success = true;
        } else {
            $res->success = false;
            $res->error = mysqli_error($con);
        }
    }
    #    
} elseif (issetGetFields(['toggleMentorCoAuthor', 'mentor', 'author'])) {
    if (!$loggedMentor['master'] && 0) {
        $res->success = false;
        $res->error = "Access denied";
    } else {
        $mentor = intval($_GET['mentor']);
        $author = intval($_GET['author']);
        $qToggleMentorAuthor = $con->query("UPDATE mentors SET co_author_id=$author WHERE id=$mentor");
        if ($qToggleMentorAuthor) {
            $res->success = true;
            //            $res->query = "UPDATE mentors SET co_author_id=$author WHERE id=$mentor";
        } else {
            $res->success = false;
            $res->error = mysqli_error($con);
        }
    }
} elseif (issetGetFields(['toggleHabitCoAuthor', 'habit', 'co_author'])) {
    if (!$loggedMentor['master'] && 0) {
        $res->success = false;
        $res->error = "Access denied";
    } else {
        $habit = intval($_GET['habit']);
        $coAuthor = intval($_GET['co_author']);
        $qToggleHabitCoAuthor = $con->query("UPDATE habits SET co_author=$coAuthor WHERE id=$habit");
        if ($qToggleHabitCoAuthor) {
            $res->changed = $habit;
            $res->success = true;
        } else {
            $res->success = false;
            $res->error = mysqli_error($con);
        }
    }
} elseif (issetGetFields(['toggleDoneContacted'])) {
    if (!$loggedMentor['master']) {
        $res->success = false;
        $res->error = "Access denied";
    } else {
        $id = intval($_GET['toggleDoneContacted']);
        $qToggleDoneContacted = $con->query("UPDATE habits SET done_contacted= NOT done_contacted WHERE id=$id");
        if ($qToggleDoneContacted->affected_rows) {
            $res->success = true;
        } else {
            $res->success = false;
            $res->error = mysqli_error($con);
        }
    }
} elseif (issetGetFields(['toggleDoneRenewed'])) {
    if (!$loggedMentor['master']) {
        $res->success = false;
        $res->error = "Access denied";
    } else {
        $id = intval($_GET['toggleDoneRenewed']);
        $qToggleDoneRenewed = $con->query("UPDATE habits SET done_renewed= NOT done_renewed WHERE id=$id");
        if ($qToggleDoneRenewed->affected_rows) {
            $res->success = true;
        } else {
            $res->success = false;
            $res->error = mysqli_error($con);
        }
    }
} elseif (issetGetFields(['changeRenewTime', 'newTime'])) {
    if (!$loggedMentor['master'] && 0) {
        $res->success = false;
        $res->error = "Access denied";
    } else {
        $id = intval($_GET['changeRenewTime']);
        $newTime = intval($_GET['newTime']);
        $query = "UPDATE habits SET renew_time=$newTime WHERE id=$id";
        $qChangeRenewTime = $con->query($query);
        if ($qChangeRenewTime->affected_rows) {
            $res->success = true;
        } else {
            $res->success = false;
            $res->query = $query;
            $res->error = mysqli_error($con);
        }
    }
} elseif (issetGetFields(['changePlan', 'newPlan'])) {
    if (!$loggedMentor['master'] && 0) {
        $res->success = false;
        $res->error = "Access denied";
    } else {
        $id = intval($_GET['changePlan']);
        $newPlan = intval($_GET['newPlan']);
        $query = "UPDATE habits SET plan=$newPlan WHERE id=$id";
        $qChangePlan = $con->query($query);
        if ($qChangePlan) {
            $res->success = true;
        } else {
            $res->success = false;
            $res->query = $query;
            $res->error = mysqli_error($con);
        }
    }
} else {
    $res->success = false;
    $res->error = "Invalid option";
}

header("Content-Type: application/json");
die(json_encode($res, JSON_UNESCAPED_UNICODE));
