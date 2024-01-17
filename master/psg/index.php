<?php
require_once("../inc/functions.inc.php");
// Page config
define("TITLE", "Painel master");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Painel master</title>
    <?php require_once("inc/views/head.inc.php"); ?>
</head>

<body>
    <header>
        <?php require_once("inc/views/header.inc.php"); ?>
    </header>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems, {});

        var elems = document.querySelectorAll('.dropdown-trigger');
        var instances = M.Dropdown.init(elems, {
            hover: false
        });
    });
</script>

</html>