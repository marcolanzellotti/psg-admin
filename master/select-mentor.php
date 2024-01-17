<?php
require_once("../inc/functions.inc.php");
// Page config
define("TITLE", "Painel master");

$mentor = $_SESSION['mentor'];
$loggedMentor = $con->query("SELECT * FROM mentors WHERE username='$mentor'")->fetch_assoc();

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
        <div class="container">
            <h5>Ficha de hábitos - Selecionar mentor</h5>
            <div class="scroll-x" id="select_mentor" style="padding-top: 10em;"> <!--  TODO: FIX THAT -->


                <?php if ($viewPrivateInfo) { ?>
                    <table class="striped small" style="width: 30em;margin-bottom:1em;border:1px solid black;">
                        <thead>
                            <tr>
                                <th>Preenchimentos recebidos</th>
                                <th>Dia</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $qCount = $con->query("SELECT COUNT(id) AS `count`, create_date FROM habits GROUP BY create_date ORDER BY id DESC LIMIT 4");

                            while ($row = $qCount->fetch_assoc()) {
                                echo "<tr><td>$row[count]</td><td>$row[create_date]</td></tr>";
                            }

                            ?>
                        </tbody>
                    </table>
                <?php } ?>
                <table class="striped small">
                    <tr>

                        <!-- <th>ID</th> -->

                        <th>Feito</th>

                        <th>Autor</th>

                        <th>Selecionar mentor</th>
                        <th>Data</th>
                        <th>Indicado por</th>
                        <th>Nome</th>
                        <?php if ($viewPrivateInfo) { ?>
                            <th>Email</th>
                        <?php } ?>

                        <th>Whatsapp</th>
                        <?php if ($viewPrivateInfo) { ?>
                            <th>Profissão</th> <!-- hide -->
                            <th>Área</th><!-- hide -->
                        <?php } ?>
                        <?php if ($viewPrivateInfo) { ?>
                            <th>Cidade / estado</th>
                        <?php } ?>
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
                        <?php if ($viewPrivateInfo) { ?>
                            <th>Instagram</th><!-- hide -->
                        <?php } ?>


                        <th>Que horas acorda</th>
                        <th>Qual período do dia a energia é mais baixa</th>
                        <th>Que horas almoça</th>
                        <th>Que horas janta</th>
                        <th>Que horas toma café da manhã</th>
                        <th>Lanches entre as refeições</th>
                        <th>Que horas vai dormir</th>
                        <th>Apoio da familia</th>
                        <th>Intestino funciona todo dia</th>
                        <th>Tem retenção de líquido</th>
                        <th>Faz atividade física</th>
                        <th>Faz uso de medicamentos</th>
                        <th>Possui alguma intolerância</th>
                        <th>Qual período do dia sente mais fome</th>
                        <th>Peso desejado</th>

                        <th></th>
                    </tr>

                    <?php

                    $completion = ($loggedMentor['name'] == "Master") ? " OR author='Marco' " : "";

                    $qHabits = $con->query("SELECT * FROM habits WHERE author='$loggedMentor[name]' $completion ORDER BY id DESC");
                    $habits = [];
                    while ($data = $qHabits->fetch_assoc()) $habits[] = $data;

                    $pageCount = ceil(count($habits) / $perPage) + 1;
                    $habits = array_slice($habits, $offset, $perPage);
                    foreach ($habits as $data) {
                        $completion = ($loggedMentor['name'] == "Master") ? " OR author_id=7 " : "";
                        $mentors = $con->query("SELECT * FROM mentors WHERE is_author=0 AND author_id=$loggedMentor[id] $completion");
                        //            if (!in_array($data['author'], ["Marco", "Julie"]) && !$master) continue;

                        $checked = $data['done_mentor'] == 1 ? " checked" : "";
                        echo "<tr>";
                        echo "
            <td>
                <p>
                    <label>
                        <input type=\"checkbox\"$checked onchange=\"handleDoneHabitSelectMentor($data[id])\"/>
                        <span>Feito</span>
                    </label>
                </p>
            </td>";
                        $checked = [];
                        $checked[$data['author']] = "checked";
                        echo "
            <td>
               $data[author]
            </td>
            <td>
               <select name=\"mentors\" onchange=\"handleChangeMentor(this)\" data-id=\"$data[id]\">
               <option value=\"\">Selecionar</option>\n
               ";
                        var_dump($con);
                        while ($mentor = $mentors->fetch_assoc()) {

                            $selected = ($data['mentor'] == $mentor['username']) ? " selected" : "";
                            echo "<option value=\"$mentor[username]\"$selected>$mentor[name]</option>\n";
                        }

                        echo "
               </select>
            </td>";

                        foreach ($data as $key => $value) {
                            if (in_array($key, [
                                'done',
                                'author',
                                'id',
                                'mentor',
                                'done_author',
                                'done_mentor',
                                'done_contacted',
                                'done_renewed'
                            ])) continue;
                            if (!$viewPrivateInfo && in_array($key, [
                                'job',
                                'work_area',
                                'instagram',
                                'mail',
                                'city'
                            ])) continue;
                            echo "<td>$value</td>";
                        }
                        echo "<td><a href=\"?view=select_author&deleteHabit=$data[id]\" class=\"red-text\">Excluir</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
                <ul class="pagination">
                    <?php
                    for ($counter = 1; $counter < $pageCount; $counter++) {
                    ?>
                        <li <?= $_GET['page'] == $counter ? " class=\"active\"" : "" ?>><a href="?view=select_mentor&page=<?= $counter ?>"><?= $counter ?></a></li>
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