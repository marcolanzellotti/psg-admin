<?php

if (!isset($_GET['trainning_mentor']) && !isset($_GET['delete'])) {
    $error = "Id?";
} else {
    $id = intval($_GET['trainning_mentor']);
    $qTrainningMentor = $con->query("SELECT * FROM trainning_mentor WHERE id=$id");
    $trainning_mentor = $qTrainningMentor->fetch_assoc();
    
    if (!$qTrainningMentor->num_rows) {
        $error = "Treinamento não encontrado.";
    }
}

$trainnings_categories = $con->query("SELECT * FROM categories_trainning_mentor WHERE deletedBy IS NULL");

if (issetPostFields(["updateTrainningMentor", 'category_trainning_mentor', 'title', 'url'])) {

    if (!isset($_GET['category']))
        header("Location: /psg-admin/painel.php");
    $id = intval($_GET['trainning_mentor']);

    $title = mysqli_escape_string($con, $_POST['title']);
    $category_trainning_mentor = mysqli_escape_string($con, $_POST['category_trainning_mentor']);
    $url = mysqli_escape_string($con, $_POST['url']);
    $qupdateCategory = $con->query("UPDATE trainning_mentor SET category_trainning_mentor='$category_trainning_mentor', title='$title', url='$url'  WHERE id=$id");
    
    if($qupdateCategory){
        $_SESSION['msg'] = "Registro alterado com sucesso.";
        echo "<script>document.location.href=\" ?view=mentor_training\"</script>";
    }

}
?>
<div class="container">
    <h5>Editar Video de Treinamento Mentor</h5>
    <?php if (isset($error)) echo "<blockquote>$error</blockquote>"; ?>

    <?php if ($ok) echo '<div class="alert card green lighten-4 green-text text-darken-4" id="alert_box">
                            <div class="card-content">
                                <p><i class="material-icons">check_circle</i>' . $msg . '</p>
                            </div>
                            <i class="material-icons" id="alert_close" aria-hidden="true">close</i>
                        </div>';
    ?>
    <br />
    <form method="POST" action="">
        <input type="hidden" name="updateTrainningMentor">
        <div class="row">
            <div class="col m6 s12 input-field">
                <i class="material-icons prefix">edit</i>
                <select name="category_trainning_mentor" id="category_trainning_mentor">
                    <option value="0">Selecione uma Categoria</option>
                    <?php
                    $selected = "";
                    while ($trainning_category = $trainnings_categories->fetch_assoc()) {
                        if($trainning_category['id'] == $trainning_mentor['category_trainning_mentor']){
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                    ?>

                        <option value="<?= $trainning_category['id']; ?>" <?= $selected; ?>><?= $trainning_category['title']; ?></option>

                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 input-field">
                <i class="material-icons prefix">edit</i>
                <input type="text" class="text" name="title" id="title" required value="<?php echo $trainning_mentor['title']; ?>">

                <label for="title">Título</label>
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 input-field">
                <i class="material-icons prefix">edit</i>
                <input type="text" class="text" name="url" id="url" required value="<?= $trainning_mentor['url']; ?>">

                <label for="url">URL <span style="font-size: 11px; font-style: italic;">(Trocar "/watch?v=" por "/embed/" mantendo o ID do seu vídeo)</span></label>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn" name="save">Salvar <i class="material-icons">send</i></button>
            </div>
        </div>
</div>