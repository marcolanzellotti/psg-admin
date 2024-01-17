<?php
if (isset($_GET['deleteHabitAuthor'])) {
    $con->query("DELETE FROM habits WHERE" . ($master || $mentor == "marco" || $mentor == "julyane" ? " 1 " : " mentor='$mentor' ") . "AND id=" . intval($_GET['deleteHabitAuthor']));
    die("<script>document.location.href='?view=select_author'</script>");
}
?>
<div class="container">

    <h5>Ficha de hábitos - Selecionar autor</h5>
    <form action="?view=select_author" method="POST">
        <div class="row">
            <div class="col m6 s12 input-field">
                <input type="text" name="search" required>
                <label>Buscar nome / telefone</label>
            </div>
        </div>

    </form>
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
    <div class="  scroll-x" id="select_author">
        <button class="scroll-trigger scroll-right hide-on-med-and-down" onclick="handleScrollSelectAuthor(1)">&gt;</button>
        <button class="scroll-trigger scroll-left hide-on-med-and-down" onclick="handleScrollSelectAuthor(0)">&lt;</button>


        <table class="striped small">
            <tr>

                <!-- <th>ID</th> -->
                <th>

                </th>
                <th></th>
                <th>Feito</th>

                <th>Autor</th>
                <th>Co-autor</th>
                <th>Data</th>
                <th>Mentor</th>
                <th>Indicado por</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Whatsapp</th>
                <th>Profissão</th> <!-- hide -->
                <th>Área</th><!-- hide -->
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
                <th>Instagram</th><!-- hide -->
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
            $search = E($_POST['search']);
            $completion = (isset($_POST['search'])) ? "AND (name LIKE '%$search%' OR phone like '%$search%')" : "";

            $qHabits = $con->query("SELECT * FROM habits  WHERE 1 $completion  GROUP BY name, phone ORDER BY id DESC LIMIT 500");

            $habits = [];

            while ($data = $qHabits->fetch_assoc()) $habits[] = $data;

            $pageCount = ceil(count($habits) / $perPage) + 1;
            $habits = array_slice($habits, $offset, $perPage);
            foreach ($habits as $data) {
                //if (!in_array($data['author'], ["Marco", "Julyane"]) && !$master) continue;

                $checked = $data['done_author'] == 1 ? " checked" : "";
                echo "<tr>";
                echo "<td><td><a href=\"?view=select_author&deleteHabitAuthor=$data[id]\" class=\"red-text\"><i class=\"material-icons\">delete</i></a><i data-id=\"$data[id]\" data-formType=\"habits\" class=\"material-icons blue-text modal-trigger data-edit hoverable\" data-target=\"modal1\">edit</i></a></td>";

                echo "
            <td>
                <p>
                    <label>
                        <input type=\"checkbox\"$checked onchange=\"handleDoneHabitSelectAuthor($data[id])\"/>
                        <span>Feito</span>
                    </label>
                </p>
            </td>";
                $checked = [];
                $checked[$data['author']] = "checked";
                echo "
            <td>";
                $authors = $con->query("SELECT * FROM mentors WHERE is_author=1");
                while ($author = $authors->fetch_assoc()) {
                    $name = $author['name'];
                    echo "
               <p>
                <label>
                   <input name=\"group-$data[id]\" $checked[$name] data-id=\"$data[id]\" data-author=\"$name\" onchange=\"handleMarcoJulie(this)\" type=\"radio\"  />
                   <span>$name</span>
                 </label>
             </p>
               ";
                }

                $coAuthor = ($con->query("SELECT name FROM mentors WHERE id=$data[co_author]"))->fetch_assoc()['name'];
                if (!$coAuthor) $coAuthor = "<b style=\"color:red;\">Não selecionado</b>";
                echo "<td>$coAuthor</td>";
                echo "</td>";

                foreach ($data as $key => $value) {
                    if (in_array($key, [
                        'done',
                        'author',
                        'co_author',
                        'id',
                        'done_author',
                        'done_mentor',
                        'done_contacted',
                        'done_renewed',
                        'done_sub',
                        'renew_time',
                        'plan'
                    ])) continue;
                    // if (!$master && in_array($key, [
                    //     'job',
                    //     'work_area',
                    //     'instagram',
                    //     'mail',
                    //     'city'
                    // ])) continue;
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
                <li <?= $_GET['page'] == $counter ? " class=\"active\"" : "" ?>><a href="?view=select_author&page=<?= $counter ?>"><?= $counter ?></a></li>
            <?php
            }
            ?>
        </ul>
    </div>
</div>