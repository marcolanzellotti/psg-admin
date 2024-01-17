<?php

$qTrainings = $pCon->query("SELECT * FROM trainings ORDER BY id");
$trainings = [];
while ($training = $qTrainings->fetch_assoc()) $trainings[explode(" ", $training['title'])[1]] = $training;
ksort($trainings);

if (issetPostFields(['url', 'createTraining', 'title'])) {
    $title = E($_POST['title']);
    $url = E($_POST['url']);

    $qAddTraining = $pCon->query("INSERT INTO trainings (title, url) VALUES ('$title', '$url')");
    if ($qAddTraining) {
        echo "Ok";
    }
}
?>
<div class="container">
    <h5>Novo treino</h5>
    <?php if (isset($error)) echo "<blockquote>$error</blockquote>"; ?>
    <br />
    <form method="POST" action="">
        <input type="hidden" name="createTraining">
        <div class="row">
            <div class="col m6 s12 input-field">
                <i class="material-icons prefix">edit</i>
                <input type="text" class="text" name="title" id="title" required>

                <label for="title">Título</label>
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 input-field">
                <i class="material-icons prefix">web</i>
                <input type="text" class="text" name="url" id="url" required>
                <label for="url">Link</label>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn" name="save">Salvar <i class="material-icons">send</i></button>
            </div>
        </div>
</div>
<div class="container section">

    <h5>Treinos</h5>

    <div class="collection">
        <?php

        foreach ($trainings as $training) {
            echo "<a href=\"?view=edit_training&training=$training[id]\" class=\"collection-item\">$training[title]</a>";
        }

        ?>
    </div>
</div>