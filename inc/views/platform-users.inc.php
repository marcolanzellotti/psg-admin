<?php
if (isset($_GET['verify'])) {
    $user = intval($_GET['verify']);
    $qVerify = $pCon->query("UPDATE users SET verified=1 WHERE id=$user");
}

$search = E($_POST['search_access']);
$completion = (isset($_POST['search_access'])) ? "AND name LIKE '%$search%' OR phone like '%$search%'" : "";

if (isset($_GET['delete'])) {
    $user = intval($_GET['delete']);
    $qDelete = $pCon->query("DELETE FROM users WHERE id=$user");
}

$qUsers = $pCon->query("SELECT * FROM users WHERE 1 $completion GROUP BY email ORDER BY id DESC");

?>
<div class="container" id="updates">
    <div class="scroll-x">
        <h5>Usuários da plataforma (<?= $qUsers->num_rows ?> total) </h5>
        <form action="" method="POST">
            <div class="row">
                <div class="col m6 s12 input-field">
                    <input type="text" name="search_access" required>
                    <label>Buscar nome / telefone</label>
                </div>
            </div>
        </form>
        <table class="striped small">
            <tr>

                <th></th>
                <th>Nome</th>
                <th>Data de cadastro</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Senha</th>
                <th>Acesso</th>
                <th></th>
                <th></th>
            </tr>

            <?php

            while ($user = $qUsers->fetch_assoc()) {
            ?>
                <tr>
                    <td>
                        <a href="?view=edit_platform_users&edit=<?= $user['id'] ?>"><i class="material-icons">edit</i></a>
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
                    <th>
                        <?= $user['verified'] ? "  <span style=\"padding:3px 10px;background-color:limegreen;color:white;border-radius:3px;\">Verificado</a>" : " <span style=\"padding:3px 10px;background-color:#f44336;color:white;border-radius:3px;\">Não verificado</a>"; ?>
                    </th>
                    <td>
                        <a class="z-depth-3" target="_blank" href="https://api.whatsapp.com/send?phone=<?= $user['phone'] ?>" style="padding:3px 10px;background-color:limegreen;color:white;border-radius:3px;">Whatsapp</a>
                    </td>
                    <td>
                        <a href="?view=platform_users&delete=<?= $user['id'] ?>" class="red" style="padding:3px 10px;color:white;border-radius:3px;">Excluir</a>

                    </td>

                </tr>
            <?php
            }
            ?>
        </table>
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