<div class="container scroll-x" id="platform">

    <h5>Gerenciamento de Plataforma</h5>
    <a href="painel.php?view=platform_marathon">Novo Cadastro</a>
    <table class="striped small">
        <tr>
            <th>Ações</th>
            <th>ID</th>
            <th>Plataforma</th>
            <th>Data</th>
            <th>Criado por</th>
        </tr>

        <?php

        $qPlatform = $pCon->query("SELECT * FROM platform_site");

        $platform = [];
        //  var_dump($con);
        while ($data = $qPlatform->fetch_assoc()) $platform[] = $data;

        foreach ($platform as $data) {
            echo "<tr>";
            echo "<td><i data-id=\"$data[id]\" data-formType=\"habits\" class=\"material-icons blue-text modal-trigger data-edit hoverable\" data-target=\"modal1\">edit</i></a></td>";
            echo "<td>$data[id]</td>";

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
</div>