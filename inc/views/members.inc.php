<?php

$search = E($_POST['search_access']);
$completion = (isset($_POST['search_access'])) ? "AND name LIKE '%$search%' OR phone like '%$search%'" : "";




if (isset($_GET['verify'])) {
    $user = intval($_GET['verify']);
    $qVerify = $con->query("UPDATE customers SET active=1 WHERE id=$user");
    die("<script>document.location.href=\"painel.php?view=members\"</script>");
} else if (isset($_GET['block'])) {
    $user = intval($_GET['block']);
    $qVerify = $con->query("UPDATE customers SET active=0 WHERE id=$user");
    die("<script>document.location.href=\"painel.php?view=members\"</script>");
}

$qUsers = $con->query("SELECT * FROM customers WHERE 1 $completion ORDER BY id DESC LIMIT 500");
$qUsersCount = $con->query("SELECT * FROM customers");

?>
<style>
    /* #sub,
    #not-sub {
        display: none;
    }

    #sub:target,
    #not-sub:target {
        display: block;
    } */
</style>
<div class="container" id="updates">
    <div class="scroll-x">
        <h5>Compradores Fase 1 (<?= $qUsersCount->num_rows ?> total) </h5>
        <form action="" method="POST">
            <div class="row">
                <div class="col m6 s12 input-field">
                    <input type="text" name="search_access" required>
                    <label>Buscar nome / telefone</label>
                </div>
            </div>
        </form>
        <div>
            <a href="export.php?option=not-sub-users" target="_blank">Exportar fichas não preenchidas</a><br />
            <a href="export.php?option=sub-users" target="_blank">Exportar fichas preenchidas</a>
        </div>
        <div>
            <a href="painel.php?view=import_number_spreadsheet">Importar planilha</a>
        </div>
        <div id="not-sub">

            <table class="striped small">
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Data de cadastro</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Senha</th>
                    <th>Preencheu a ficha</th>
                    <!-- <th>Acesso</th>
                <th></th> -->
                    <th>Acesso</th>
                    <th></th>
                </tr>

                <?php
                

                while ($user = $qUsers->fetch_assoc()) {
                    $qSub = $con->query("SELECT * FROM subscriptions WHERE mail='$user[email]'  AND RIGHT(REPLACE(REPLACE(REPLACE(REPLACE(phone, '+55', ''), '(', ''), ')', ''), '-', ''), 8) IN (SELECT RIGHT(REPLACE(REPLACE(REPLACE(REPLACE(phone, '+55', ''), '(', ''), ')', ''), '-', ''), 8) FROM customers)");

                    if ($qSub->num_rows) {
                        //                        continue;
                        $sub = "<span style=\"padding:3px 10px;background-color:limegreen;color:white;border-radius:3px;\">Sim</span>";
                    } else {

                        $sub = "<span style=\"padding:3px 10px;background-color:red;color:white;border-radius:3px;\">Não</span>";
                    }
                ?>
                    <tr>
                        <td>
                            <a href="?view=edit_customers&customer=<?= $user['id'] ?>"><i class="material-icons">edit</i></a>
                        </td>
                        <td>
                            <?= $user['name'] ?>
                        </td>
                        <td>
                            <?= date('d/m/Y', $user['create_time']) ?>
                        </td>
                        <td>
                            <?= $user['email'] ?>
                        </td>
                        <td>
                            <?= $user['phone'] ?>
                        </td>
                        <td>
                            <?= $user['password'] ?>
                        </td>
                        <td>
                            <?= $sub ?>
                        </td>
                        <th>
                            <?php
                            if ($user['active'] == 1) {
                            ?>
                                <a class="z-depth-3" href="?view=members&block=<?= $user['id'] ?>" style="padding:3px 10px;background-color:red;color:white;border-radius:3px;">Bloquear</a>
                            <?php } else { ?>
                                <a class="z-depth-3 blue" href="?view=members&verify=<?= $user['id'] ?>" style="padding:3px 10px;color:white;border-radius:3px;">Liberar</a>

                            <?php } ?>
                        </th>
                        <!-- <th>
                        <?= $user['verified'] ? "  <span style=\"padding:3px 10px;background-color:limegreen;color:white;border-radius:3px;\">Verificado</a>" : " <span style=\"padding:3px 10px;background-color:#f44336;color:white;border-radius:3px;\">Não verificado</a>"; ?>
                    </th> -->
                        <td>
                            <a class="z-depth-3" target="_blank" href="https://api.whatsapp.com/send?phone=<?= $user['phone'] ?>" style="padding:3px 10px;background-color:limegreen;color:white;border-radius:3px;">Whatsapp</a>
                        </td>
                        <!-- <td>
                        <a href="?view=platform_users&delete=<?= $user['id'] ?>" class="red" style="padding:3px 10px;color:white;border-radius:3px;">Excluir</a>

                    </td> -->

                    </tr>
                <?php
                }
                ?>
            </table>
        </div>

        <!-- <ul class="pagination">
            <?php
            for ($counter = 1; $counter < $pageCount; $counter++) {
            ?>
                <li <?= $_GET['page'] == $counter ? " class=\"active\"" : "" ?>><a href="?view=updates&page=<?= $counter ?>"><?= $counter ?></a></li>
            <?php
            }
            ?>
        </ul> -->
    </div>

</div>