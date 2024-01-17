<?php
require_once("../../inc/functions.inc.php");
// Page config
define("TITLE", "Painel master");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ficha de inscrição</title>
    <?php require_once("../inc/views/head.inc.php"); ?>
</head>

<body>
    <header>
        <?php require_once("../inc/views/header.inc.php"); ?>
    </header>
    <main>
        <div id="subscriptions" class="container">
            <h5>Inscrições</h5>

            <form action="" method="POST">
                <div class="row">
                    <div class="col m6 s12 input-field">
                        <input type="text" name="search_subscriptions" required>
                        <label>Buscar nome / telefone</label>
                    </div>
                </div>

            </form>
            <div class="scroll-x">

                <!-- <a href="export.php?table=subscriptions" target="_blank" rel="noopener noreferrer">Baixar planilha</a> -->

                <table class="striped  small">
                    <tr>
                        <th>Data</th>
                        <th>Indicado por</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Whatsapp</th>
                        <th>Profissão</th>
                        <th>Área</th>
                        <th>Cidade / estado</th>
                        <th>Dificuldades</th>
                        <th>Tentativas</th>
                        <th>Quantidade de água por dia</th>
                        <th>Problemas de saúde</th>
                        <th>Sintomas</th>
                        <th>Data de nascimento</th>
                        <th>Altura</th>
                        <th>Peso</th>
                        <th>Cintura</th>
                        <th>Abdômen</th>
                        <th>Quadril</th>
                        <th>Porque decidiu mudar</th>
                        <th>Porque decidiu se inscrever</th>
                        <th>Informações adicionais</th>
                        <th></th>
                    </tr>

                    <?php

                    //            $subscriptions = (isset($_POST['search_subscriptions']))    ?   searchFormEntries("subscriptions",  $_POST['search_subscriptions']) :   getFormEntries("subscriptions");

                    $completion = (isset($_POST['search_subscriptions'])) ? "AND name LIKE '%$_POST[search_subscriptions]%' OR phone like '%$_POST[search_subscriptions]%'" : "";
                    $qSubscriptions = $con->query("SELECT DISTINCT * FROM subscriptions WHERE 1 $completion GROUP BY name, create_date ORDER BY id DESC");
                    $subscriptions = [];

                    while ($data = $qSubscriptions->fetch_assoc()) $subscriptions[] = $data;

                    $pageCount = ceil(count($subscriptions) / $perPage) + 1;
                    $subscriptions = array_slice($subscriptions, $offset, $perPage);
                    foreach ($subscriptions as $data) {
                        echo "<tr>";
                        foreach ($data as $key => $value) {
                            if (in_array($key, ["id", "mentor"])) continue;
                            echo "<td>$value</td>";
                        }
                        echo "<td><a class=\"red-text confirm\" href=\"?del=$data[id]\">Excluir</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <ul class="pagination">
                    <?php
                    for ($counter = 1; $counter < $pageCount; $counter++) {
                    ?>
                        <li <?= $_GET['page'] == $counter ? " class=\"active\"" : "" ?>><a href="?view=subscriptions&page=<?= $counter ?>"><?= $counter ?></a></li>
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