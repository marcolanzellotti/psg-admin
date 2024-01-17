<?php
require_once("../inc/functions.inc.php");
// Page config
define("TITLE", "Painel master");

$mentor = $_SESSION['mentor'];
$mentor = mysqli_escape_string($con, $mentor);
$loggedMentor = $con->query("SELECT * FROM mentors WHERE username='$mentor'")->fetch_assoc();
$master = $loggedMentor['master'];

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
    <main>
        <div class="container" id="weekly_updates">
            <h5>Atualização semanal</h5>
            <form action="?view=weekly_updates" method="POST">
                <div class="row">
                    <div class="col m6 s12 input-field">
                        <input type="text" name="search_weekly_updates" required>
                        <label>Buscar nome / telefone</label>
                    </div>
                </div>

            </form>
            <div class="scroll-x">

                <!-- <a href="export.php?table=updates" target="_blank" rel="noopener noreferrer">Baixar planilha</a> -->
                <table class="striped small">
                    <tr>
                        <th></th>
                        <th>Feito</th>
                        <th>Mentor</th>
                        <th>Data</th>
                        <th>Nome</th>
                        <th>Whatsapp</th>
                        <th>Foco durante a semana</th>
                        <th>Conseguiu beber a quantidade de água indicada</th>
                        <th>Intestino funcionando normalmente</th>
                        <th>Peso</th>
                        <th>Cintura</th>
                        <th>Abdômen</th>
                        <th>Quadril</th>
                        <th>Final de semana terá refeições livres</th>
                        <th>Dificuldades</th>
                        <th>Observações da semana</th>
                        <th></th>
                    </tr>

                    <?php

                    $completion = (isset($_POST['search_weekly_updates'])) ? "AND name LIKE '%$_POST[search_weekly_updates]%' OR phone like '%$_POST[search_weekly_updates]%'" : "";
                    $qWeeklyUpdates = $con->query("SELECT DISTINCT * FROM weekly_updates" . ($master ? " WHERE 1 " : " WHERE mentor='$mentor' ") . " $completion GROUP BY name, date ORDER BY id DESC LIMIT 500");
                    $weeklyUpdates = [];
                    while ($data = $qWeeklyUpdates->fetch_assoc()) $weeklyUpdates[] = $data;

                    $pageCount = ceil(count($weeklyUpdates) / $perPage) + 1;
                    $weeklyUpdates = array_slice($weeklyUpdates, $offset, $perPage);
                    foreach ($weeklyUpdates as $data) {
                        echo "<tr>";

                        echo "<td><a href=\"?del_update=$data[id]\" class=\"red-text confirm\"><i class=\"material-icons\">delete</i> </a></td>";

                        $checked = $data['done'] == 1 ? " checked" : "";
                        echo "<td>
        <p>
        <label>
        <input type=\"checkbox\"$checked onchange=\"handleDoneWeeklyUpdates($data[id])\"/>
        <span>Feito</span>
        </label>
        </p>
        </td>";
                        foreach ($data as $key => $value) {
                            if (in_array($key, [
                                "done",
                                "id"
                            ])) continue;
                            echo "<td>$value</td>";
                        }

                        echo "</tr>";
                    }
                    ?>
                </table>

                <ul class="pagination">
                    <?php
                    for ($counter = 1; $counter < $pageCount; $counter++) {
                    ?>
                        <li <?= $_GET['page'] == $counter ? " class=\"active\"" : "" ?>><a href="?view=weekly_updates&page=<?= $counter ?>"><?= $counter ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>

        </div>
    </main>
</body>

<?php require_once("inc/views/footer.inc.php"); ?>

</html>