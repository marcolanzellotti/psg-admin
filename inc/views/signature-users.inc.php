<?php

$search = E($_POST['search_access']);
$completion = (isset($_POST['search_access'])) ? "AND name LIKE '%$search%' OR phone like '%$search%'" : "";



$qUsers = $psCon->query("SELECT * FROM users WHERE 1 $completion GROUP BY email ORDER BY id DESC");

if (isset($_GET['verify'])) {
    $user = intval($_GET['verify']);
    $qVerify = $psCon->query("UPDATE users SET active=1 WHERE id=$user");
    die("<script>document.location.href=\"painel.php?view=signature_users\"</script>");
} else if (isset($_GET['block'])) {
    $user = intval($_GET['block']);
    $qVerify = $psCon->query("UPDATE users SET active=0 WHERE id=$user");
    die("<script>document.location.href=\"painel.php?view=signature_users\"</script>");
}



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

                <th>Nome</th>
                <th>Data de cadastro</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Senha</th>
                <td></td>
                <!-- <th>Acesso</th>
                <th></th> -->
                <th></th>
            </tr>

            <?php

            while ($user = $qUsers->fetch_assoc()) {
            ?>
                <tr>
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
                        <?php
                        if ($user['active'] == 1) {
                        ?>
                            <a class="z-depth-3" href="?view=signature_users&block=<?= $user['id'] ?>" style="padding:3px 10px;background-color:red;color:white;border-radius:3px;">Bloquear</a>
                        <?php } else { ?>
                            <a class="z-depth-3 blue" href="?view=signature_users&verify=<?= $user['id'] ?>" style="padding:3px 10px;color:white;border-radius:3px;">Liberar</a>

                        <?php } ?>
                    </td>
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