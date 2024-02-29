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
        <table class="striped small">
            <tr>
                <th>Feito</th>
                <th>Enviado</th>
                <th>Data</th>
                <th>Nome</th>
                <th>Data de Nascimento</th>
                <th>Altura</th>
                <th>Whatsapp</th>
                <th>Foco durante a semana</th>
                <th>Seguiu o planejamento</th>
                <!-- <th>Teria sido mais fácil com um planejamento personalizado</th> -->
                <th>Conseguiu beber a quantidade de água indicada</th>
                <th>Intestino funcionando normalmente</th>
                <th>Peso</th>
                <th>Cintura</th>
                <th>Abdômen</th>
                <th>Quadril</th>
                <th>Como foram os 7 dias</th>
                <th>Teria sido mais fácil com um acompanhamento individual?</th>
                <th>O que mudaria na vida com o corpo dos sonhos?</th>
                <th>Fez as 3 principais refeições do dia</th>
                <th>Precisa de estratégia individual para acelerar o resultado em:</th>
                <th>Planejamento adaptado a sua rotina com cardápio de todas as refeições do dia?</th>
                <th>Precisa da estratégia americana para não precisar fazer reposição hormonal?</th>
                <th>Ação</th>
            </tr>

            <?php

            $search = E($_POST['search_updates']);
            $completion = (isset($_POST['search_updates'])) ? "AND name LIKE '%$search%' OR phone like '%$search%'" : "";
            $qUpdates = $con->query("SELECT DISTINCT * FROM updates WHERE 1 $completion GROUP BY id ORDER BY id DESC LIMIT 500");
            $updates = [];

            while ($data = $qUpdates->fetch_assoc()) $updates[] = $data;

            $pageCount = ceil(count($updates) / $perPage) + 1;
            $updates = array_slice($updates, $offset, $perPage);

            foreach ($updates as $data) {
                $checkedDone = $data['done'] == 1 ? " checked" : "";
                $checkedSent = $data['sent_student_form'] == 1 ? " checked" : "";
            ?>
                <tr>
                    <td>
                        <p>
                            <label>
                                <input type="checkbox" <?= $checkedDone; ?> onchange="handleDoneUpdates(<?= $data['id']; ?>)" />
                                <span>Feito</span>
                            </label>
                        </p>
                    </td>
                    <td>
                        <p>
                            <label>
                                <input type="checkbox" <?= $checkedSent; ?> onchange="handleSentUpdates(<?= $data['id']; ?>)" />
                                <span>Enviado</span>
                            </label>
                        </p>
                    </td>
                    <?php
                    //foreach ($data as $key => $value) {
                    ?>

                    <td><?= $data['date']; ?></td>
                    <td><?= $data['name']; ?></td>
                    <td><?= $data['date_of_birth']; ?></td>
                    <td><?= $data['altura']; ?></td>
                    <td><?= $data['phone']; ?></td>
                    <td><?= $data['focus']; ?></td>
                    <td><?= $data['planning_followed']; ?></td>
                    <td><?= $data['water']; ?></td>
                    <td><?= $data['normal_intestine']; ?></td>
                    <td><?= $data['weight']; ?></td>
                    <td><?= $data['waist']; ?></td>
                    <td><?= $data['abdomen']; ?></td>
                    <td><?= $data['hip']; ?></td>
                    <td><?= $data['description']; ?></td>
                    <td><?= $data['individual']; ?></td>
                    <td><?= $data['life_change']; ?></td>
                    <td><?= $data['main_meals']; ?></td>
                    <td><?= $data['individual_strategy']; ?></td>
                    <td><?= $data['individual_strategy_menu']; ?></td>
                    <td><?= $data['individual_strategy_replacement']; ?></td>
                    <td><a class="red-text" href="?del_update=$data['id']">Excluir</a></td>
                </tr>
            <?php
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