<div class="container">
    <h5>Atualizações</h5>
    <form action="?view=updates" method="POST">
        <div class="row">
            <div class="col m6 s12 input-field">
                <input type="text" name="search_updates" required>
                <label>Buscar nome / telefone</label>
            </div>
        </div>
    </form>

    <button class="scroll-trigger scroll-right hide-on-med-and-down" onclick="handleScrollUpdates(1)">&gt;</button>
    <button class="scroll-trigger scroll-left hide-on-med-and-down" onclick="handleScrollUpdates(0)">&lt;</button>
    <div class="scroll-x" id="updates">

        <!-- <div style="width:40em;margin:1em;border:1px solid black;">
            <canvas id="lifeChangesChart"></canvas>
        </div>

        <div style="width:40em;margin:1em;border:1px solid black;">
            <canvas id="planningFollowedChart"></canvas>
        </div> -->
        <table class="striped small">
            <tr>

                <th>Feito</th>


                <!-- <th>ID</th> -->
                <th>Data</th>
                <th>Nome</th>
                <th>Data de Nascimento</th>
                <th>Altura</th>
                <th>Whatsapp</th>
                <th>Foco durante a semana</th>
                <th>Seguiu o planejamento</th>
                <th>Teria sido mais fácil com um planejamento personalizado</th>
                <th>Conseguiu beber a quantidade de água indicada</th>
                <th>Intestino funcionando normalmente</th>
                <th>Peso</th>
                <th>Cintura</th>
                <th>Abdômen</th>
                <th>Quadril</th>
                <th>Como foram os 7 dias</th>
                <th>Teria sido mais fácil com um acompanhamento individual</th>
                <th>O que mudaria na vida com o corpo dos sonhos</th>
                <th>Fez as 3 principais refeições do dia</th>
                <th>Precisa de estratégia individual para acelerar o resultado em:</th>
                <th></th>

            </tr>

            <?php

            $search = E($_POST['search_updates']);
            $completion = (isset($_POST['search_updates'])) ? "AND name LIKE '%$search%' OR phone like '%$search%'" : "";
            $qUpdates = $con->query("SELECT DISTINCT * FROM updates WHERE 1 $completion GROUP BY id ORDER BY id DESC LIMIT 500");
            $updates = [];

            while ($data = $qUpdates->fetch_assoc()) $updates[] = $data;

            $pageCount = ceil(count($updates) / $perPage) + 1;
            $updates = array_slice($updates, $offset, $perPage);

            var_dump($updates);die;
            foreach ($updates as $data) {
                echo "<tr>";
                $checked = $data['done'] == 1 ? " checked" : "";
                echo "<td>
                <p>
                <label>
                <input type=\"checkbox\"$checked onchange=\"handleDoneUpdates($data[id])\"/>
                <span>Feito</span>
                </label>
                 </p>
                </td>";

                foreach ($data as $key => $value) {
                    if (in_array($key, [
                        "id",
                        "done",
                        "done_analysis",
                        "sent_analysis",
                        "mentor",
                        "suggestion"
                    ])) continue;
                    echo "<td>$value</td>";
                }
                echo "<td><a class=\"red-text\" href=\"?del_update=$data[id]\">Excluir</a></td>\n";
                echo "</tr>";
            }
            ?>
        </table>
        <ul class="pagination">
            <?php
            for ($counter = 1; $counter < $pageCount; $counter++) {
            ?>
                <li <?= $_GET['page'] == $counter ? " class=\"active\"" : "" ?>><a href="?view=updates&page=<?= $counter ?>"><?= $counter ?></a></li>
            <?php
            }
            ?>
        </ul>
    </div>

</div>