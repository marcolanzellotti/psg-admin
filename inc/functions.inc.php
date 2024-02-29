<?php
require_once __DIR__ . "/conf.inc.php";

function requireNotLogin()
{
    if (isset($_SESSION['logged'])) {
        header("Location: painel.php");
        die();
    }
}
function requireLogin()
{
    if (!isset($_SESSION['logged'])) {
        header("Location: login.php");
        die();
    }
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
function issetGetFields(array $fields)
{
    foreach ($fields as $field) if (!in_array($field, array_keys($_GET))) return false;
    return true;
}
function authMentor($username, $password)
{
    global $con;
    $username = mysqli_escape_string($con, $username);
    $password = mysqli_escape_string($con, $password);

    $qAuth = $con->query("SELECT * FROM mentors WHERE username='$username' and password='$password'");
    $mentor = $qAuth->fetch_assoc();
    return $mentor;
}

function getMentors()
{
    global $con;
    return $con->query("SELECT * FROM mentors WHERE name != 'Master'");
}

function getMentor(int $id)
{
    global $con;
    $qMentor = $con->query("SELECT * FROM mentors WHERE id = $id");
    if (!$qMentor) return false;
    return $qMentor->fetch_assoc();
}

function updateMentor(int $id, array $data)
{
    global $con;
    $name = mysqli_escape_string($con, $data['name']);
    $username = mysqli_escape_string($con, $data['username']);
    $password = mysqli_escape_string($con, $data['password']);
    $email = mysqli_escape_string($con, $data['email']);
    $phone = mysqli_escape_string($con, $data['phone']);
    $qUpdateMentor = $con->query("UPDATE mentors SET name='$name', username='$username', email='$email', phone='$phone', password='$password' WHERE id=$id");

    return ($qUpdateMentor) ? $id : false;
}

function deleteMentor(int $id)
{
    global $con;
    $qDeleteMentor = $con->query("DELETE FROM mentors WHERE id=$id");
    return $qDeleteMentor;
}

function createMentor(string $name, string $username, string $email, string $phone, string $password, $level, $author)
{
    global $con;
    $name = mysqli_escape_string($con, $name);
    $username = mysqli_escape_string($con, $username);
    $email = mysqli_escape_string($con, $email);
    $phone = mysqli_escape_string($con, $phone);

    $password = mysqli_escape_string($con, $password);

    if ($level == "co-author") {
        $isCoAuthor = 1;
    } else {
        $isCoAuthor = 0;
    }
    $qCreateMentor = $con->query("INSERT INTO mentors (name, username, email, phone, password, is_co_author, author_id) VALUES ('$name', '$username', '$email', '$phone', '$password', $isCoAuthor, $author)");

    return ($qCreateMentor) ? $con->insert_id : false;
}

function createConsultant(string $name, string $username, string $email, string $phone, string $password, $level, $author)
{
    global $con;
    $name = mysqli_escape_string($con, $name);
    $username = mysqli_escape_string($con, $username);
    $email = mysqli_escape_string($con, $email);
    $phone = mysqli_escape_string($con, $phone);

    $password = mysqli_escape_string($con, $password);

    if ($level == "co-author") {
        $isCoAuthor = 1;
    } elseif ($level == "consultant") {
        $isCoAuthor = 0;
        $isConsultant = 1;
    } else {
        $isCoAuthor = 0;
    }

    $qCreateMentor = $con->query("INSERT INTO mentors (name, username, email, phone, password, is_co_author, author_id, is_consultant) VALUES ('$name', '$username', '$email', '$phone', '$password', $isCoAuthor, $author, $isConsultant)");

    return ($qCreateMentor) ? $con->insert_id : false;
}

function getWhatsappSubscriptionUrl()
{
    global $con;
    $qWhatsapp = $con->query("SELECT whatsapp_subscriptions FROM conf");
    if (!$qWhatsapp) return false;
    return $qWhatsapp->fetch_array()[0];
}

function getPsgSubscriptionKey()
{
    global $con;
    $qPsgSubscriptionKey = $con->query("SELECT psg_subscription_key FROM conf");
    if (!$qPsgSubscriptionKey) return false;
    return $qPsgSubscriptionKey->fetch_array()[0];
}
function resetPsgSubscriptionKey()
{
    global $con;
    $key = str_split("0123456789");
    shuffle($key);
    $key = implode("", $key);
    return $con->query("UPDATE conf SET psg_subscription_key='$key'");
}


function setWhatsappSubscriptionUrl(string $url)
{
    global $con;
    $url = mysqli_escape_string($con, $url);
    return $con->query("UPDATE conf SET whatsapp_subscriptions='$url'");
}

function getFormEntries($table)
{
    global $con;
    $table = mysqli_escape_string($con, $table);
    return $con->query("SELECT * FROM $table GROUP BY name ORDER BY id DESC LIMIT 300");
}

function searchFormEntries($table, $query)
{
    global $con;
    $table = mysqli_escape_string($con, $table);
    $query = mysqli_escape_string($con, $query);

    return $con->query("SELECT * FROM $table WHERE name LIKE '%$query%' OR phone LIKE '%$query%' ORDER BY id DESC LIMIT 300");
}

function deleteHabit(int $id)
{
    global $con;
    $qDeleteHabit = $con->query("DELETE FROM habits WHERE id=$id");
    return $qDeleteHabit;
}

function getSubscriptions()
{
    global $con;
    return $con->query("SELECT * FROM subscriptions ORDER BY id DESC");
}


function searchHabits($query, $mentor)
{
    global $con;
    $query = mysqli_escape_string($con, $query);
    $mentor = mysqli_escape_string($con, $mentor);
    return $con->query("SELECT * FROM habits WHERE mentor='$mentor' AND (name LIKE '%$query%' OR phone LIKE '%$query%') ORDER BY id DESC");
}

function getHabits($mentor)
{
    global $con;
    $mentor = mysqli_escape_string($con, $mentor);
    return $con->query("SELECT DISTINCT * FROM habits WHERE mentor='$mentor' GROUP BY name ORDER BY id DESC");
}

function formateDatePtBr($value)
{
    return (new DateTime($value))->format('d/m/Y H:i:s');
}
