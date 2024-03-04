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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>
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
    <div class="row">
        <div class="col m6 s12 mt-2">
            <a href="export.php?option=renewHabits" target="_blank" class="btn btn-success">Gerar Planilha</a><br />
        </div>
    </div>
    <table class="striped small">
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th>Nome</th>
            <th>Diário</th>
            <th>Telefone</th>
            <th>Plano inicial</th>
            <th>Data inicio</th>
            <th></th>
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

        $completion = (isset($_POST['search_renew_habits'])) ? " AND name LIKE '%$search%' OR phone like '%$search%'" : "";

        $qHabits = $con->query("SELECT id, name, phone, plan, create_date, done_contacted, done_renewed, renew_time 
                                FROM habits 
                                WHERE create_date <> 'Indefinida' $completion 
                                ORDER BY created_at DESC");

        //echo "SELECT id, name, phone, plan, create_date, done_contacted, done_renewed, renew_time FROM habits WHERE create_date <> 'Indefinida' $completion ORDER BY id DESC";

        $habits = [];
        //  var_dump($con);
        while ($row = $qHabits->fetch_assoc()) {

            $days = daysDistance($row['create_date']);
            // if ($days < 50) continue;
            $habits[] = $row;
        }


        $pageCount = ceil(count($habits) / $perPage) + 1;
        $habits = array_slice($habits, $offset, $perPage);
        $arrayRenovacao = [];
        foreach ($habits as $habit) {
            $vetorRenovacao['id'] = $habit['id'];
            $vetorRenovacao['createDate'] = $habit['create_date'];
            $vetorRenovacao['plan'] = $habit['plan'];

            $createDate = $habit['create_date'];
            $days = daysDistance($createDate);
            $months = floor($days / 30);

            $vetorRenovacao['name'] = $habit['name'];

            $name = $habit['name'];

            $vetorRenovacao['phone'] = $habit['phone'];

            $phone = $habit['phone'];

            $formatedPhone = str_replace(['(', ')', '+', '-'], "", $phone);
            $vetorRenovacao['formatedPhone'] = $formatedPhone;
            $message = "Mensagem de renovação";
            $vetorRenovacao['message'] = $message;
            $contacted = $habit['done_contacted'] == 1 ? " checked" : "";

            $vetorRenovacao['contacted'] = $contacted;

            /////////////////////////////// RIPPED ///////////////////////////////
            // Data de ínicio 
            // if (!in_array("/", explode("", $createDate))) {
            //     $createDate = date("d/m/Y");
            // }

            $splited = explode("/", $createDate);
            $date    = (new DateTime("$splited[2]-$splited[1]-$splited[0]"));


            $vetorRenovacao['renew_time'] = $habit['renew_time'];

            // Adiciona 2 meses a data
            if ($habit['renew_time'] == 50) $habit['renew_time'] = 0.5;

            $tmp = ($habit['renew_time'] * 12) + $habit['plan'];

            $newDate = $date->add(new DateInterval("P$tmp" . "M"));
            //var_dump($newDate);die;
            // Altera a nova data para o último dia do mês
            $lDayOfMonth = $newDate->modify('last day of this month');
            $endDate = $lDayOfMonth->format('d/m/Y'); // 2017-12-31
            ////////////////////////////////////////////////////////////////

            $vetorRenovacao['endDate'] = $endDate;

            $renewed = $habit['done_renewed'] == 1 ? " checked" : "";

            $vetorRenovacao['renewed'] = $renewed;

            $monthsLeft = intval(daysDistance($endDate) / -30.417);

            $vetorRenovacao['monthsLeft'] = $monthsLeft;

            array_push($arrayRenovacao, $vetorRenovacao);
        }

        // usort($arrayRenovacao, function ($a, $b) {
        //     return $a['create_date'] - $b['create_date'];
        // });

        foreach ($arrayRenovacao as $row) {
        ?>
            <tr id="row-<?= $row['id']; ?>">

                <td>
                    <a style="color: #F00;" onclick="deleteHabits(<?= $row['id']; ?>)">
                        <i class="material-icons" style="cursor: pointer;">delete</i>
                    </a>
                </td>
                <td>
                    <a href="https://api.whatsapp.com/send?phone=<?= $row['formatedPhone']; ?>&text=<?= $row['message']; ?>"><img src="assets/img/whatsapp-icon.svg" width="25"></a>
                </td>
                <td>
                    <p>
                        <label>
                            <input type="checkbox" <?= $row['contacted']; ?> onchange="handleDoneContacted(<?= $row['id']  ?>)" />
                            <span>Já falei</span>
                        </label>
                        <br />
                        <label>
                            <input type="checkbox" <?= $row['renewed']; ?> onchange="handleDoneRenewed(<?= $row['id'] ?>)" />
                            <span>Renovado</span>
                        </label>
                    </p>
                </td>

                <td><?= $row['name'];  ?></td>
                <td>
                    <a class="waves-effect waves-light btn-small modal-trigger" href="#modal2_<?= $row['id'] ?>" title="Lançar Anotações de : <?= $row['name'];  ?>">
                        <i class="material-icons">comment</i>
                    </a>
                </td>
                <td><?= $row['phone'];  ?></td>
                <td>
                    <select data-id="<?= $row['id'] ?>" onchange="handleChangePlan(this)">
                        <option value="0">Não selecionado</option>
                        <?php
                        foreach ([6, 12, 24, 48, 1000] as $plan) {
                            $selected = $row['plan'] == $plan ? "selected" : "";
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
                <td id="date_create_<?= $row['id'] ?>">
                    <?= $row['createDate']; ?>
                </td>
                <td>
                    <a class="waves-effect waves-light btn-small modal-trigger" href="#modalDate_<?= $row['id'] ?>" title="Alterar data de criação">
                        <i class="material-icons">date_range</i>
                    </a>
                </td>
                <td>
                    <select data-id="<?= $row['id'] ?>" onchange="handleChangeRenewTime(this)">
                        <option value="0">Sem renovação</option>
                        <?php
                        if ($row['renew_time'] == 50) $row['renew_time'] = 0.5;
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
                <td><?= $row['endDate'];  ?></td>
                <td><?= $row['monthsLeft'];  ?></td>
            </tr>
            <div id="modal2_<?= $row['id'] ?>" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <h5><i class="material-icons">comment</i> Informações Adicionais</h5>
                    <span><i class="material-icons">person</i> <?= $row['name'];  ?></span>
                    <span id="resposta"></span>
                    <form action="" method="post" class="col s12" id="formSaveAnnotation" enctype="multipart/form-data">
                        <input type="hidden" name="idUser" value="<?= $row['id'];  ?>">
                        <input type="hidden" name="nameUser" value="<?= $row['name'];  ?>">
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="annotation" name="annotation" class="materialize-textarea" required></textarea>
                                <label for="textarea1">Anotações</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>Anexar Arquivo</span>
                                    <input type="file" class="btn" id="fileAnnotation">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <h5>Anotações</h5>
                            <ul class="collapsible" id="myAnnotations_<?= $row['id'];  ?>">
                                <?php
                                $annotations = $con->query("SELECT * FROM notes_daily WHERE id_user = {$row['id']}");
                                while ($annotation = $annotations->fetch_assoc()) {
                                ?>
                                    <li id="row-<?= $annotation['id']; ?>">
                                        <div class="collapsible-header" style="display: flex; justify-content: space-between;">
                                            <div style="display: flex; justify-content: space-between;">

                                                <div>
                                                    <a onclick="deleteAnnotation(<?= $annotation['id'];  ?>)" title="Excluir Anotação de: <?= $row['name'];  ?>" style="color: #F00">
                                                        <i class="material-icons">clear</i>
                                                    </a>
                                                </div>
                                                <div>
                                                    <i class="material-icons">library_books</i><?= $annotation['annotation'] ?>
                                                </div>
                                            </div>
                                            <div><?= date("d/m/Y H:i:s", strtotime($annotation['createdAt'])) ?></div>
                                        </div>
                                        <div class="collapsible-body">
                                            <div style="display: flex; justify-content: space-between;">
                                                <div><?= $annotation['annotation'] ?></div>
                                                <?php
                                                if ($annotation['url'] != '') {
                                                ?>
                                                    <div><a href="<?= $annotation['url']; ?>" download><i class="material-icons">cloud_download</i></a></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn" id="btnSaveAnnotation" onclick="saveAnnotarion(<?= $row['id'];  ?>);">Salvar</button>
                    <input type="button" class="btn  red modal-close" value="Fechar">
                </div>
            </div>
            <div id="modalDate_<?= $row['id'] ?>" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <h5><i class="material-icons">comment</i> Alterar Data</h5>
                    <form action="" method="post" class="col s12" id="formSaveDateCreate" enctype="multipart/form-data">
                        <input type="hidden" name="idUser" value="<?= $row['id'];  ?>">
                        <input type="hidden" name="idHabits" value="<?= $row['id'];  ?>">
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="dateCreate" class="datepicker" id="dataInput" placeholder="##/##/####">
                                <label for="textarea1">Data Criação</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn" id="btnSaveDateCreate" onclick="SaveDateCreate(<?= $row['id']; ?>);">Salvar</button>
                    <input type="button" class="btn  red modal-close" value="Fechar">
                </div>
            </div>
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

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var dataInput = document.getElementById('dataInput');
    
    // Aplicar a máscara de data (DD/MM/AAAA)
    Inputmask("99/99/9999").mask(dataInput);
  });
</script>