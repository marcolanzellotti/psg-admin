<?php
if (!isset($_GET['training']) && !isset($_GET['delete'])) {
    $error = "Id?";
} else {
    $id = intval($_GET['training']);
    $qTraining = $pCon->query("SELECT * FROM trainings WHERE id=$id");
    $training = $qTraining->fetch_assoc();

    if (!$qTraining->num_rows) {
        $error = "Treino não encontrado";
    }
    if (isset($_GET['delete'])) {
        $pCon->query("DELETE FROM trainings WHERE id=" . intval($_GET['delete']));
        echo "<script>document.location.href=\"/psg-admin/painel.php?view=trainings\"</script>";
    }
}

if (issetPostFields(["updateTraining", "title", "url"])) {

    if (!isset($_GET['training']))
        header("Location: /psg-admin/painel.php");
    $id = intval($_GET['training']);

    $title = mysqli_escape_string($con, $_POST['title']);
    $url = mysqli_escape_string($con, $_POST['url']);
    $qUpdateTraining = $pCon->query("UPDATE trainings SET title='$title', url='$url' WHERE id=$id");
    echo "<script>document.location.href=\" /psg-admin/painel.php?view=edit_training&training=$id\"</script>";
}


?>
<div class="container">
    <h5>Editar treino</h5>
    <?php if (isset($error)) echo "<blockquote>$error</blockquote>"; ?>
    <br />
    <form method="POST" action="">
        <input type="hidden" name="updateTraining">
        <div class="row">
            <div class="col m6 s12 input-field">
                <i class="material-icons prefix">edit</i>
                <input type="text" value="<?= $training['title'] ?>" class="text" name="title" id="title" required>

                <label for="title">Título</label>
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 input-field">

                <i class="material-icons prefix">web</i>
                <input type="text" value="<?= $training['url'] ?>" class="text" name="url" id="url" required>
                <label for="url">Link</label>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn" name="save">Salvar <i class="material-icons">send</i></button>
                <a class="btn red" href="?view=edit_training&delete=<?= $id ?>" name="save">Excluir <i class="material-icons">delete</i></a>
                <a class="btn blue" href="?view=trainings" name="save">Voltar</a>
            </div>



        </div>
</div>