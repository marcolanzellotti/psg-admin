<?php

$search = E($_POST['search_access']);
$completion = (isset($_POST['search_access'])) ? "AND name LIKE '%$search%' OR phone like '%$search%'" : "";
// $qUsers = $pCon->query("SELECT name, email, phone FROM users WHERE 1 $completion GROUP BY email ORDER BY id DESC");
$completion = $master ? "" : "(SELECT id FROM users WHERE email IN (SELECT mail FROM eudesa99_forms.habits WHERE mentor='$loggedMentor[username]')) AND id IN ";
# $query = "SELECT * FROM users WHERE id IN (SELECT user_id FROM diary)";
$query = "SELECT * FROM users WHERE id IN $completion (SELECT user_id FROM diary)";
$qUsers = $pCon->query($query);
?>
<div class="container" id="updates">
    <!-- 
    <form action="" method="POST">
        <div class="row">
            <div class="col m6 s12 input-field">
                <input type="text" name="search_access" required>
                <label>Buscar nome / telefone</label>
            </div>
        </div>
    </form> -->

    <h5>Diários</h5>
    <div class="scroll-x">


        <table class="striped small">
            <tr>

                <th>Nome</th>

                <th></th>
                <th></th>
            </tr>

            <?php

            while ($user = $qUsers->fetch_assoc()) {

                //  $qDiaryUser = $pCon->query("SELECT * FROM users WHERE id=$diary[user_id] $completion");
                //$user = $qDiaryUser->fetch_assoc();
                if (!$user) continue;
            ?>
                <tr>
                    <td>
                        <?= $user['name'] ?>
                    </td>

                    <td>
                        <a class="z-depth-3" href="?view=diary&user=<?= $user['id'] ?>" style="padding:3px 10px;background-color:#1a9af0;color:white;border-radius:3px;">Ver diário</a>
                    </td>
                    <td>
                        <a class="z-depth-3" target="_blank" href="https://api.whatsapp.com/send?phone=<?= $user['phone'] ?>" style="padding:3px 10px;background-color:limegreen;color:white;border-radius:3px;">Whatsapp</a>
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