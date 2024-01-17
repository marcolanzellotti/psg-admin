<?php
if (isset($_GET['done'])) {
    $id = intval($_GET['done']);
    $con->query("UPDATE renews SET done=1 WHERE id=$id");
    die("<script>document.location.href=\"painel.php?view=renew_habits\"</script>");
}

if (isset($_GET['done_sub'])) {
    $id = intval($_GET['done_sub']);
    $pCon->query("UPDATE users SET done_sub=1 WHERE id=$id");

    die("<script>document.location.href=\"painel.php?view=renew_habits\"</script>");
}
?>
<div class="container  scroll-x" id="habits">

    <h5>Renovação</h5>
    <div style="display: block;">
        <table>
            <tr>
                <th>Nome</th>
                <th>Whatsapp</th>
                <th>Tempo de renovação</th>
                <th></th>
            </tr>
            <?php
            $qRenews = $con->query("SELECT * FROM renews WHERE done=0");
            while ($renew = $qRenews->fetch_assoc()) {
                $qHabit = $con->query("SELECT * FROM habits WHERE mail='$renew[email]'");
                $habit = $qHabit->fetch_assoc();

            ?>
                <tr>
                    <td><?= $renew['name'] ?></td>
                    <td><?= $renew['phone'] ?></td>
                    <td><?= $renew['renew_time'] ?></td>
                    <td> <a class="z-depth-3" href="?view=renew_habits&done=<?= $renew['id'] ?>" style="padding:3px 10px;background-color:limegreen;color:white;border-radius:3px;">Feito</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <h5>Inscrição</h5>
    <div style="display: block;">
        <table>
            <tr>
                <th>Nome</th>
                <th>Whatsapp</th>
                <th>Tempo de inscrição</th>
                <th></th>
            </tr>
            <?php
            $qSubs = $pCon->query("SELECT * FROM users WHERE id>3123 AND done_sub=0   ORDER BY id DESC LIMIT 1");

            while ($sub = $qSubs->fetch_assoc()) {


            ?>
                <tr>
                    <td><?= $sub['name'] ?></td>

                    <td><?= $sub['phone'] ?></td>
                    <td><?= $sub['plan_months'] ?> meses</td>
                    <td> <a class="z-depth-3" href="?view=renew_habits&done_sub=<?= $sub['id'] ?>" style="padding:3px 10px;background-color:limegreen;color:white;border-radius:3px;">Feito</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <form action="?view=renew_habits" method="POST">
        <div class="row">
            <div class="col m6 s12 input-field">
                <input type="text" name="search_renew_habits" required>
                <label>Buscar nome / telefone</label>
            </div>
        </div>

    </form>
    <table class="striped small">
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Plano inicial</th>

            <th>Data inicio</th>
            <th>Renovação</th>
            <th>Data fim</th>
            <th>Meses para terminar</th>
        </tr>

        <?php
        function daysDistance($startDate)
        {

            $pattern = "/(\d+)\/(\d+)\/(\d+)/i";
            $replacement = "$3-$2-$1";
            $startDate = preg_replace($pattern, $replacement, $startDate);
            $endDate = date("Y-m-d");
            $difference = strtotime($endDate) - strtotime($startDate);
            $days = floor($difference / (60 * 60 * 24));
            return $days;
        }




        $search = E($_POST['search_renew_habits']);
        //    var_dump($loggedMentor);
        $completion = (isset($_POST['search_renew_habits'])) ? " AND name LIKE '%$search%' OR phone like '%$search%'" : "";
        $qHabits = $con->query("SELECT id, name, phone, plan, create_date, done_contacted, done_renewed, renew_time FROM habits WHERE create_date <> 'Indefinida' $completion ORDER BY id DESC");

        echo "SELECT id, name, phone, plan, create_date, done_contacted, done_renewed, renew_time FROM habits WHERE create_date <> 'Indefinida' $completion ORDER BY id DESC";

        $habits = [];
        //  var_dump($con);
        while ($row = $qHabits->fetch_assoc()) {

            $days = daysDistance($row['create_date']);
            // if ($days < 50) continue;
            $habits[] = $row;
        }


        $pageCount = ceil(count($habits) / $perPage) + 1;
        $habits = array_slice($habits, $offset, $perPage);
        foreach ($habits as $row) {
            $createDate = $row['create_date'];
            $days = daysDistance($createDate);
            $months = floor($days / 30);
            $name = $row['name'];
            $phone = $row['phone'];
            $formatedPhone = str_replace(['(', ')', '+', '-'], "", $phone);
            $message = "Mensagem de renovação";
            $contacted = $row['done_contacted'] == 1 ? " checked" : "";

            /////////////////////////////// RIPPED ///////////////////////////////
            // Data de ínicio 
            // if (!in_array("/", explode("", $createDate))) {
            //     $createDate = date("d/m/Y");
            // }

            $splited = explode("/", $createDate);
            $date    = (new DateTime("$splited[2]-$splited[1]-$splited[0]"));

            // Adiciona 2 meses a data
            if ($row['renew_time'] == 50) $row['renew_time'] = 0.5;

            $tmp = ($row['renew_time'] * 12) + $row['plan'];

            $newDate = $date->add(new DateInterval("P$tmp" . "M"));
            // Altera a nova data para o último dia do mês
            $lDayOfMonth = $newDate->modify('last day of this month');
            $endDate = $lDayOfMonth->format('d/m/Y'); // 2017-12-31
            ////////////////////////////////////////////////////////////////

            $renewed = $row['done_renewed'] == 1 ? " checked" : "";
            $monthsLeft = intval(daysDistance($endDate) / -30.417);
        ?>
            <tr>

                <td></td>
                <td><a href="https://api.whatsapp.com/send?phone=<?= $formatedPhone ?>&text=<?= $message ?>"><img src="assets/img/whatsapp-icon.svg" width="25"></a></td>
                <td>
                    <p>
                        <label>
                            <input type="checkbox" <?= $contacted  ?>onchange="handleDoneContacted(<?= $row['id']  ?>)" />
                            <span>Já falei</span>
                        </label>
                        <br />
                        <label>
                            <input type="checkbox" <?= $renewed  ?> onchange="handleDoneRenewed(<?= $row['id'] ?>)" />
                            <span>Renovado</span>
                        </label>
                    </p>
                </td>

                <td><?= $name  ?></td>
                <td><?= $phone  ?></td>
                <td>
                    <select data-id="<?= $row['id'] ?>" onchange="handleChangePlan(this)">
                        <option value="0">Não selecionado</option>
                        <?php
                        foreach ([6, 12, 24, 48, 1000] as $plan) {
                            $selected = $row['plan'] == $plan ? "selected" : "";
                            var_dump($row);
                            $term = $plan == 1000 ? "Vitalício" : "";
                            if (!$term) {
                                $term = $plan == 6 ? "6 Meses" : $term;
                            }
                            if (!$term) {
                                $term =  $plan / 12 . " anos";
                            }

                            echo "<option value=\"$plan\" $selected>$term</option>";
                        }
                        ?>

                    </select>
                </td>
                <td><?= $createDate  ?></td>
                <td>
                    <select data-id="<?= $row['id'] ?>" onchange="handleChangeRenewTime(this)">
                        <option value="0">Sem renovação</option>
                        <?php
                        $selected6 = $row['renew_time'] == 0.5 ? "selected" : "";
                        echo "<option value=\"50\" $selected6>6 Meses</option>";
                        for ($i = 1; $i <= 3; $i++) {
                            $selected = $row['renew_time'] == $i ? "selected" : "";

                            echo "<option value=\"$i\" $selected>$i anos</option>";
                        }

                        $selectedV = $row['renew_time'] == 100 ? "selected" : "";
                        ?>

                        <option value="100" <?= $selectedV  ?>>Vitalício</option>

                    </select>
                </td>
                <td><?= $endDate  ?></td>
                <td><?= $monthsLeft  ?></td>
            </tr>
        <?php } ?>

    </table>
    <ul class="pagination">
        <?php
        for ($counter = 1; $counter < $pageCount; $counter++) {
        ?>
            <li <?= $_GET['page'] == $counter ? " class=\"active\"" : "" ?>><a href="?view=renew_habits&page=<?= $counter ?>"><?= $counter ?></a></li>
        <?php
        }
        ?>
    </ul>
</div>