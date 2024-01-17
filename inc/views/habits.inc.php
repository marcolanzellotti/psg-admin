<div class="container  scroll-x" id="habits">

    <h5>Ficha de hábitos</h5>

    <form action="?view=habits" method="POST">
        <div class="row">
            <div class="col m6 s12 input-field">
                <input type="text" name="search_habits" required>
                <label>Buscar nome / telefone / email</label>
            </div>
        </div>

    </form>
    <table class="striped small">
        <tr>

            <!-- <th>ID</th> -->
            <th></th>

            <th></th>

            <th></th>
            <th>Data</th>
            <th>Autor</th>


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


        </tr>

        <?php
        $search = E($_POST['search_habits']);
        //    var_dump($loggedMentor);
        $completion = (isset($_POST['search_habits'])) ? "AND name LIKE '%$search%' OR phone like '%$search%' OR mail LIKE '%$search%'" : "";
        $completion1 = $master ? "WHERE 1" : "WHERE mentor='$loggedMentor[username]'";
        $qHabits = $con->query("SELECT * FROM habits $completion1 $completion ORDER BY id DESC");

        $habits = [];
        //  var_dump($con);
        while ($data = $qHabits->fetch_assoc()) $habits[] = $data;

        $pageCount = ceil(count($habits) / $perPage) + 1;
        $habits = array_slice($habits, $offset, $perPage);
        foreach ($habits as $data) {
            echo "<tr>";
            if ($loggedMentor['master']) {
                echo "<td><i data-id=\"$data[id]\" data-formType=\"habits\" class=\"material-icons blue-text modal-trigger data-edit hoverable\" data-target=\"modal1\">edit</i></a></td>";
            } else {
                echo "<td></td>";
            }

            echo "<td><!--<a href=\"?deleteHabit=$data[id]\" class=\"red-text  confirm\"><i class=\"material-icons hoverable\">delete</i> </a> --></td>";
            // if ($master) {
            //     $checked = [];
            //     $checked[$data['author']] = "checked";
            //     echo "<td><p>
            //         <label>
            //           <input name=\"group-$data[id]\" $checked[Marco] data-id=\"$data[id]\" data-author=\"Marco\" onchange=\"handleMarcoJulie(this)\" type=\"radio\"  />
            //           <span>Marco</span>
            //         </label> 
            //       </p>
            //       <p>
            //         <label>
            //           <input name=\"group-$data[id]\" $checked[Julie] data-id=\"$data[id]\" data-author=\"Julie\" onchange=\"handleMarcoJulie(this)\" type=\"radio\" />
            //           <span>Julie</span>
            //         </label>
            //       </p></td>";
            // } else if (!$master) {
            // }

            $checked = $data['done'] == 1 ? " checked" : "";
            echo "
                <td> 
                    <p>
                        <label>
                            <input type=\"checkbox\"$checked onchange=\"handleDoneHabits($data[id])\"/>
                            <span>Feito</span>
                    </label>
                    </p>
                </td>";

            foreach ($data as $key => $value) {
                if (in_array($key, [
                    'done',
                    //   'author',
                    'co_author',
                    'mentor',
                    'id',
                    'done_mentor',
                    'done_author',
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
                if ($key == "phone") $value = str_replace(['+55', ')', '(', '-', ' '], "", $value);
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
            <li <?= $_GET['page'] == $counter ? " class=\"active\"" : "" ?>><a href="?view=habits&page=<?= $counter ?>"><?= $counter ?></a></li>
        <?php
        }
        ?>
    </ul>
</div>