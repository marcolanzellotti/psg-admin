<?php
require_once("../../inc/functions.inc.php");
// Page config
define("TITLE", "Painel master");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Painel master</title>
    <?php require_once("../inc/views/head.inc.php"); ?>
</head>

<body>
    <header>
        <?php require_once("../inc/views/header.inc.php"); ?>
    </header>
    </div>
    <main>
        <div class="container">
            <h5>Análise</h5>
            <form action="" method="POST">
                <div class="row">
                    <div class="col m6 s12 input-field">
                        <input type="text" name="search_analysis" required>
                        <label>Buscar nome / telefone</label>
                    </div>
                </div>

            </form>
            <div class="scroll-x" id="common">

                <!-- <a href="export.php?table=analysis" target="_blank" rel="noopener noreferrer">Baixar planilha</a> -->

                <table class="striped small">
                    <tr>
                        <th>Feito</th>
                        <?php
                        if ($loggedMentor['master'] || in_array($loggedMentor['name'], ['marco', 'Marco'])) echo "<th>Enviado</th>";
                        ?>
                        <th>Data de atualização</th>
                        <th>Nome</th>
                        <th>Altura</th>
                        <th>Data de nascimento</th>

                        <th>Whatsapp</th>

                        <th>Peso inicio</th>
                        <th>Cintura inicio</th>
                        <th>Abdômem inicio</th>
                        <th>Quadril inicio</th>

                        <th>Peso atual</th>
                        <th>Cintura atual</th>
                        <th>Abdômem atual</th>
                        <th>Quadril atual</th>

                    </tr>

                    <?php
                    $completion = (isset($_POST['search_analysis'])) ? "WHERE s.name LIKE '%$_POST[search_analysis]%' OR s.phone LIKE '%$_POST[search_analysis]%'" : "";;


                    $analysis = [];
                    $qAnalysis =  $con->query(
                        "SELECT DISTINCT  u.id, u.date, u.done_analysis, u.sent_analysis, s.name, s.height, s.born, s.phone, s.weight AS old_weight, s.waist AS old_waist, s.abdomen AS old_abdomen, s.hip AS old_hip, u.weight AS new_weight, u.waist AS new_waist, u.abdomen AS new_abdomen, u.hip AS new_hip FROM subscriptions s JOIN updates u ON u.phone = s.phone $completion GROUP BY u.name, u.date  ORDER BY u.id DESC"
                    );
                    while ($data = $qAnalysis->fetch_assoc()) $analysis[] = $data;

                    $pageCount = ceil(count($analysis) / $perPage) + 1;
                    $analysis = array_slice($analysis, $offset, $perPage);
                    foreach ($analysis as $data) {

                        echo "<tr>";

                        $checked = $data['done_analysis'] == 1 ? " checked" : "";
                        echo "<td>
            <p>
            <label>
            <input type=\"checkbox\"$checked onchange=\"handleDoneAnalysis($data[id])\"/>
            <span>Feito</span>
            </label>
            </p>
            </td>";


                        if ($loggedMentor['master'] || in_array($loggedMentor['name'], ['marco', 'Marco'])) {
                            $sentAnalysis = $data['sent_analysis'] == 1 ? " checked" : "";

                            echo "<td>
            <p>
            <label>
            <input type=\"checkbox\"$sentAnalysis onchange=\"handleSentAnalysis($data[id])\"/>
            <span>Enviado</span>
            </label>
            </p>
            </td>";
                        }


                        foreach ($data as $key => $value) {
                            if (in_array($key, ["done_analysis", "sent_analysis", "id"])) continue;
                            elseif (0) {
                            } else {
                                switch ($key) {
                                    case "new_hip":
                                        $diff = intval($data['new_hip']) - intval($data['old_hip']);
                                        if ($diff > 0) {
                                            echo "<td class=\"red-text\">$value (+$diff)</td>";
                                        } else {
                                            echo "<td class=\"green-text\">$value ($diff)</td>";
                                        }
                                        break;
                                    case "new_weight":
                                        $diff = intval($data['new_weight']) - intval($data['old_weight']);
                                        if ($diff > 0) {
                                            echo "<td class=\"red-text\">$value (+$diff)</td>";
                                        } else {
                                            echo "<td class=\"green-text\">$value ($diff)</td>";
                                        }
                                        break;
                                    case "new_abdomen":
                                        $diff = intval($data['new_abdomen']) - intval($data['old_abdomen']);
                                        if ($diff > 0) {
                                            echo "<td class=\"red-text\">$value (+$diff)</td>";
                                        } else {
                                            echo "<td class=\"green-text\">$value ($diff)</td>";
                                        }
                                        break;
                                    case "new_waist":
                                        $diff = intval($data['new_waist']) - intval($data['old_waist']);
                                        if ($diff > 0) {
                                            echo "<td class=\"red-text\">$value (+$diff)</td>";
                                        } else {
                                            echo "<td class=\"green-text\">$value ($diff)</td>";
                                        }
                                        break;
                                    default:
                                        echo "<td>$value</td>";
                                        break;
                                }
                            }
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
                <ul class="pagination">
                    <?php
                    for ($counter = 1; $counter < $pageCount; $counter++) {
                    ?>
                        <li <?= $_GET['page'] == $counter ? " class=\"active\"" : "" ?>><a href="?view=analysis&page=<?= $counter ?>"><?= $counter ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </main>
</body>

<?php require_once("../inc/views/footer.inc.php"); ?>

</html>