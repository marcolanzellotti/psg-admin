<?php

if (!isset($_GET['category']) && !isset($_GET['delete'])) {
    $error = "Id?";
} else {
    $id = intval($_GET['category']);
    $qCategory = $con->query("SELECT * FROM categories_trainning_mentor WHERE id=$id");
    $category = $qCategory->fetch_assoc();
    if (!$qCategory->num_rows) {
        $error = "Categoria não encontrada.";
    }
}

if (issetPostFields(["updateCategory", "title"])) {

    if (!isset($_GET['category']))
        header("Location: /psg-admin/painel.php");
    $id = intval($_GET['category']);

    $title = mysqli_escape_string($con, $_POST['title']);
    $qupdateCategory = $con->query("UPDATE categories_trainning_mentor SET title='$title' WHERE id=$id");
    echo "<script>document.location.href=\" ?view=register_categories\"</script>";
}


?>
<div class="container">
    <h5>Editar Categoria do Treinamento</h5>
    <?php if (isset($error)) echo "<blockquote>$error</blockquote>";
    ?>
    <br />
    <form method="POST" action="">
        <input type="hidden" name="updateCategory">
        <div class="row">
            <div class="col m6 s12 input-field">
                <i class="material-icons prefix">edit</i>
                <input type="text" value="<?= $category['title'] ?>" class="text" name="title" id="title" required>

                <label for="title">Nome da Categoria</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn" name="save">Salvar <i class="material-icons">send</i></button>
                <a href="?view=register_categories" class="btn grey">Voltar <i class="material-icons">undo</i></a>
            </div>
        </div>
    </form>
</div>