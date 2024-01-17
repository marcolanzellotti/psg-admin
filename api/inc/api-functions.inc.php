<?php
require_once("functions.inc.php");

$res = new stdClass();

function res()
{
    global $res;
    header("Content-Type: application/json");
    die(json_encode($res));
}

function set($key, $value)
{
    global $res;
    return $res->$key = $value;
}
function setRes($newRes)
{
    global $res;
    return $res = $newRes;
}

function requireAuth()
{
    if (!isset($_SESSION['logged'])) {
        set("error", "access denied");
        res();
    }
}

function requirePermissions(array $permissions)
{
}