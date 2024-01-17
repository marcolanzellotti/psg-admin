<?php
if (isset($_GET['verify'])) {
    $user = intval($_GET['verify']);
    $qVerify = $con->query("UPDATE customers SET active=1 WHERE id=$user");
    $qUser = $con->query("SELECT * FROM customers WHERE id=$user");
    $user = $qUser->fetch_assoc();



    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); // enable SMTP
    //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "br174.hostgator.com.br";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "contato@planosecagordura.com.br";
    $mail->Password = "Lanz@226974";
    $mail->SetFrom("contato@planosecagordura.com.br");
    $mail->Subject = "Plataforma PSG Fase 2";
    $firstName = explode(" ", $user['name'])[0];
    $mail->Body = "Olá, $firstName<br />Seu acesso à plataforma do PSG Fase 2 foi <b>liberado</b>!<br/>Você já pode fazer o login <a href=\"https://fase2.planosecagordura.com.br/#login\">clicando aqui</a>";
    $mail->AddAddress($user['email']);
    $mail->AddAddress("ythalyson@gmail.com");
    //   $mail->Send();
}

if (isset($_GET['delete'])) {
    $user = intval($_GET['delete']);
    $qDelete = $con->query("DELETE FROM customers WHERE id=$user");
}

$search = E($_POST['search_access']);
$completion = (isset($_POST['search_access'])) ? "AND name LIKE '%$search%' OR phone like '%$search%'" : "";

$qUsers = $con->query("SELECT * FROM customers WHERE active=0 $completion ORDER BY id DESC");

?>
<div class="container" id="updates">
    <div class="scroll-x">
        <h5>Acessos plataforma (<?= $qUsers->num_rows ?> pendentes) </h5>
        <form action="?view=members_access" method="POST">
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

                <th>
                    Data de cadastro
                </th>
                <!-- <th>ID</th> -->
                <th>Email</th>
                <th>Telefone</th>
                <th>Senha</th>
                <td></td>
                <th></th>
                <td></td>
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
                        <a target="_blank" href="https://api.whatsapp.com/send?phone=<?= (substr($user['phone'], 0, 2) == "55" ? "" : "55") . $user['phone'] ?>" style="padding:3px 10px;background-color:limegreen;color:white;border-radius:3px;">Whatsapp</a>
                    </td>
                    <td>
                        <a href="?view=members_access&verify=<?= $user['id'] ?>" style="padding:3px 10px;background-color:#1a9af0;color:white;border-radius:3px;">Liberar</a>
                    </td>
                    <td>
                        <a href="?view=members_access&delete=<?= $user['id'] ?>" class="red" style="padding:3px 10px;color:white;border-radius:3px;">Excluir</a>

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