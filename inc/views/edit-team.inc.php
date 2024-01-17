<?php

if (!isset($_GET['team']) && !isset($_GET['delete'])) {
    $error = "Id?";
} else {
    $id = intval($_GET['team']);
    $qTeam = $con->query("SELECT * FROM teams WHERE id=$id");
    $team = $qTeam->fetch_assoc();
    if (!$qTeam->num_rows) {
        $error = "Equipe não encontrada.";
    }
}

if (issetPostFields(["updatePlatformTeam", "title", "url", "description"])) {

    if (!isset($_GET['team']))
        header("Location: /psg-admin/painel.php");
    $id = intval($_GET['team']);

    $title = mysqli_escape_string($con, $_POST['title']);
    $url = mysqli_escape_string($con, $_POST['url']);
    $description  = mysqli_escape_string($con, $_POST['description']);
    $qupdatePlatformTeam = $con->query("UPDATE teams SET title='$title', url='$url', description='$description' WHERE id=$id");
    echo "<script>document.location.href=\" ?view=platform_team\"</script>";
}


?>
<div class="container">
    <h5>Editar Equipe</h5>
    <?php if (isset($error)) echo "<blockquote>$error</blockquote>";
    ?>
    <br />
    <form method="POST" action="">
        <input type="hidden" name="updatePlatformTeam">
        <div class="row">
            <div class="col m6 s12 input-field">
                <i class="material-icons prefix">edit</i>
                <select name="team_type" id="team_type">
                    <option value="0">Selecione um Tipo</option>
                    <option value="1" <?= $team['team_type'] == 1 ? 'selected' : ''; ?>>Reunião</option>
                    <option value="2" <?= $team['team_type'] == 2 ? 'selected' : ''; ?>>Treinamento</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 input-field">
                <i class="material-icons prefix">edit</i>
                <input type="text" value="<?= $team['title'] ?>" class="text" name="title" id="title" required>

                <label for="title">Título</label>
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 input-field">
                <i class="material-icons prefix">edit</i>
                <input type="text" value="<?= $team['description'] ?>" class="text" name="description" id="description" required>

                <label for="description">Título</label>
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 input-field">

                <i class="material-icons prefix">web</i>
                <input type="text" value="<?= $team['url'] ?>" class="text" name="url" id="url" required>
                <label for="url">Link</label>
            </div>
        </div>
        
        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn" name="save">Salvar <i class="material-icons">send</i></button>
                <a href="?view=platform_team" class="btn grey">Voltar <i class="material-icons">undo</i></a>
            </div>



        </div>
</div>