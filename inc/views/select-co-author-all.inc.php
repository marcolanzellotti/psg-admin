<h5>Ficha de hábitos - Selecionar co-autor</h5>

<div class="container scroll-x" style="display: flex;flex-direction:row;">
    <button class="scroll-trigger scroll-right hide-on-med-and-down" onclick="handleScrollSelectMentor(1)">&gt;</button>
    <button class="scroll-trigger scroll-left hide-on-med-and-down" onclick="handleScrollSelectMentor(0)">&lt;</button>
    <?php if (1) { ?>
        <table class="striped small col" style="width: 30em;margin-bottom:1em;border:1px solid black;">
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
        <div class="col" style="height:14em;overflow:auto;flex:1;">
            <table class="striped small" style="width: 30em;margin-bottom:1em;border:1px solid black;">
                <thead>
                    <tr>
                        <th>Co-autor</th>
                        <th>Quantidade de mentores</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    $qMentors = $con->query("SELECT  name, id FROM mentors WHERE is_co_author=1 AND author_id=$loggedMentor[id] ORDER BY id");

                    while ($row = $qMentors->fetch_assoc()) {

                        $qCount = $con->query("SELECT id FROM mentors WHERE co_author_id=$row[id]");
                        $count = $qCount->num_rows;
                        echo "<tr><td>$row[name]</td><td>$count</td></tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>

</div>

<?php } ?>
<div class="container  scroll-x" id="select_mentor" style="padding-top: 10em;"> <!--  TODO: FIX THAT -->
    <form action="" method="POST">
        <div class="row">
            <div class="col m6 s12 input-field">
                <input type="text" name="search" required>
                <label>Buscar email / telefone</label>
            </div>
        </div>
    </form>
    <table class="striped small">
        <tr>

            <!-- <th>ID</th> -->

            <th>Feito</th>

            <th>Autor</th>
            <th>Selecionar Co-autor</th>

            <th>Mentor</th>
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

            <th>Sente sono após alguma refeição principal?</th>
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

        $completion = ($loggedMentor['master']) ? " OR author='Marco' " : "";
        if (isset($_POST['search'])) {
        }
        $search = E($_POST['search']);
        $searchCompletion = (isset($_POST['search'])) ? "AND (mail LIKE '%$search%' OR phone like '%$search%')" : "";
        // $qHabits = $con->query("SELECT * FROM habits WHERE author='$loggedMentor[name]'  OR habits.mentor IN (SELECT username FROM mentors WHERE co_author_id=$loggedMentor[id]) $completion ORDER BY id DESC");

        $qHabits = $con->query("SELECT * FROM habits  WHERE job <> ''  $completion $searchCompletion ORDER BY id DESC");


        $habits = [];
        while ($data = $qHabits->fetch_assoc()) $habits[] = $data;

        $pageCount = ceil(count($habits) / $perPage) + 1;
        $habits = array_slice($habits, $offset, $perPage);
        foreach ($habits as $data) {
            $completion = ($loggedMentor['name'] == "Master") ? " OR author_id=7 " : "";
            $mentors = $con->query("SELECT * FROM mentors WHERE is_co_author=1 AND id IN (SELECT id FROM mentors WHERE author_id=(SELECT id FROM mentors WHERE name='$data[author]'))  OR author_id=7");
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
               <select name=\"mentors\" onchange=\"handleChangeCoAuthor(this)\" data-id=\"$data[id]\">
               <option value=\"\">Selecionar</option>\n
               ";
            while ($mentor = $mentors->fetch_assoc()) {

                $selected = ($data['mentor'] == $mentor['username'] || $data['co_author'] == $con->query("SELECT id FROM mentors WHERE username='$mentor[username]'")->fetch_assoc()['id']) ? " selected" : "";

                echo "<option value=\"$mentor[username]\"$selected>$mentor[name]</option>\n";
            }
            if (!$data['mentor']) $data['mentor'] = "<b style=\"color:red;\">Não selecionado</b>";

            echo "
               </select>
            </td>
            <td>$data[mentor]</td>
            ";

            foreach ($data as $key => $value) {
                if (in_array($key, [
                    'done',
                    'author',
                    'id',
                    'mentor',
                    'co_author',
                    'done_author',
                    'done_mentor',
                    'done_contacted',
                    'done_renewed',
                    'renew_time',
                    'plan'
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

            echo "<td><a href=\"#\" data-target=\"modal1\"class=\"data-edit modal-trigger\" data-id=\"$data[id]\" data-formtype=\"habits\" >Editar</a></td>";
            echo "<td><a href=\"?view=select_author&deleteHabit=$data[id]\" class=\"red-text\">Excluir</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <ul class="pagination">
        <?php
        for ($counter = 1; $counter < $pageCount; $counter++) {
        ?>
            <li <?= $_GET['page'] == $counter ? " class=\"active\"" : "" ?>><a href="?view=select_co_author_all&page=<?= $counter ?>"><?= $counter ?></a></li>
        <?php
        }
        ?>
    </ul>
</div>