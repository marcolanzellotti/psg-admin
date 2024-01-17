<?php

$search = E($_POST['search_access']);
$completion = (isset($_POST['search_access'])) ? "AND name LIKE '%$search%' OR phone like '%$search%'" : "";

// $qUsers = $pCon->query("SELECT name, email, phone FROM users WHERE 1 $completion GROUP BY email ORDER BY id DESC");

$id = intval($_GET['user']);
$qUser = $pCon->query("SELECT * FROM users WHERE id=$id");
$user = $qUser->fetch_assoc();
$qDiaries = $pCon->query("SELECT * FROM diary WHERE user_id=$id");


?>
<br />
<a href="?view=platform_diary">Voltar</a>
<div class="container diaries z-depth-3" id="">

    <p>
        <span style="font-size:18pt;">Diário de <b><?= $user['name'] ?></b></span> <a class="z-depth-3" target="_blank" href="https://api.whatsapp.com/send?phone=55<?= $user['phone'] ?>" style="padding:3px 10px;background-color:limegreen;color:white;border-radius:3px;">Whatsapp</a>

    </p>

    <?php
    while ($diary = $qDiaries->fetch_assoc()) {
        $question = $diary['question'] == 0 ? "alimentar" : "emocional";
    ?>
        <div class="diary">
            <span class="date">
                <i><?= $diary['create_date'] ?></i> <span class="right">(Questão <b><?= $question ?></b>)</span>
            </span>
            <p class="content">
                <?= $diary['content'] ?>

            </p>
        </div>
    <?php
    }
    ?>
</div>