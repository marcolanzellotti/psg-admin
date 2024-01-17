<div class="container  scroll-x" id="habits">

    <h5>Alunas VIP</h5>

    <form action="?view=vip_members" method="POST">
        <div class="row">
            <div class="col m6 s12 input-field">
                <input type="text" name="search_habits" required>
                <label>Buscar nome / telefone</label>
            </div>
        </div>

    </form>
    <table class="striped small">
        <tr>
            <th></th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Data fim renovação</th>
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


        $search = E($_POST['search_habits']);
        //    var_dump($loggedMentor);
        $completion = (isset($_POST['search_habits'])) ? "AND name LIKE '%$search%' OR phone like '%$search%'" : "";
        $qHabits = $con->query("SELECT * FROM habits WHERE mentor='$loggedMentor[username]' $completion ORDER BY id DESC");

        $habits = [];
        //  var_dump($con);
        while ($data = $qHabits->fetch_assoc()) $habits[] = $data;

        $pageCount = ceil(count($habits) / $perPage) + 1;
        $habits = array_slice($habits, $offset, $perPage);
        foreach ($habits as $data) {

            $createDate = $data['create_date'];
            $days = daysDistance($createDate);
            $months = floor($days / 30);

            $splited = explode("/", $createDate);
            $date    = (new DateTime("$splited[2]-$splited[1]-$splited[0]"));

            // Adiciona 2 meses a data
            $tmp = $data['renew_time'] * 12;
            $newDate = $date->add(new DateInterval("P$tmp" . "M"));

            // Altera a nova data para o último dia do mês
            $lDayOfMonth = $newDate->modify('last day of this month');


            $endDate = $lDayOfMonth->format('d/m/Y'); // 2017-12-31

            echo "<tr>";
            echo "<td> <p>
      <label>
        <input type=\"checkbox\" />
        <span>VIP</span>
      </label>
    </p></td>";
            echo "<td>" . $data['name'] . "</td>";
            echo "<td>" . $data['phone'] . "</td>";
            echo "<td>" . $endDate . "</td>";
            echo "</tr>";
        }

        ?>
    </table>
    <ul class="pagination">
        <?php
        for ($counter = 1; $counter < $pageCount; $counter++) {
        ?>
            <li <?= $_GET['page'] == $counter ? " class=\"active\"" : "" ?>><a href="?view=vip_members&page=<?= $counter ?>"><?= $counter ?></a></li>
        <?php
        }
        ?>
    </ul>
</div>