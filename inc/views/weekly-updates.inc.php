<div class="container scroll-x">
    <h5>Atualização semanal</h5>
    <form action="?view=weekly_updates" method="POST">
        <div class="row">
            <div class="col m6 s12 input-field">
                <input type="text" name="search_weekly_updates" required>
                <label>Buscar nome / telefone</label>
            </div>
        </div>

    </form>
    <button class="scroll-trigger scroll-right hide-on-med-and-down" onclick="handleScrollWeeklyUpdates(1)">&gt;</button>
    <button class="scroll-trigger scroll-left hide-on-med-and-down" onclick="handleScrollWeeklyUpdates(0)">&lt;</button>
    <div class="scroll-x" id="weekly_updates">

        <!-- <a href="export.php?table=updates" target="_blank" rel="noopener noreferrer">Baixar planilha</a> -->
        <table class="striped small">
            <tr>
                <th></th>
                <th>Feito</th>
                <th>Enviado</th>
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
                $checkedSent = $data['sent'] == 1 ? " checked" : "";
                $checkedDone = $data['done'] == 1 ? " checked" : "";
                echo "


                <td>
        <p>
        <label>
        <input type=\"checkbox\"$checkedDone onchange=\"handleDoneWeeklyUpdates($data[id])\"/>
        <span>Feito</span>
        </label>
        </p>
        </td>
                        
<td>
        <p>
        <label>
        <input type=\"checkbox\"$checkedSent onchange=\"handleSentWeeklyUpdates($data[id])\"/>
        <span>Enviado</span>
        </label>
        </p>
        </td>
        ";
                foreach ($data as $key => $value) {
                    if (in_array($key, [
                        "done",
                        "sent",
                        "id"
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
                <li <?= $_GET['page'] == $counter ? " class=\"active\"" : "" ?>><a href="?view=weekly_updates&page=<?= $counter ?>"><?= $counter ?></a></li>
            <?php
            }
            ?>
        </ul>
    </div>

</div>