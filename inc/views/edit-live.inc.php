<?php
if (!isset($_GET['live']) && !isset($_GET['delete'])) {
    $error = "Id?";
} else {
    $id = intval($_GET['live']);
    $qLive = $pCon->query("SELECT * FROM lives WHERE id=$id");
    $live = $qLive->fetch_assoc();
    if (!$qLive->num_rows) {
        $error = "Live não encontrada";
    }
    if (isset($_GET['delete'])) {
        $pCon->query("DELETE FROM lives WHERE id=" . intval($_GET['delete']));
        echo "<script>document.location.href=\"/psg-admin/painel.php?view=platform_lives\"</script>";
    }
}

if (issetPostFields(["updatePlatformLive", "title", "url"])) {

    if (!isset($_GET['live']))
        header("Location: /psg-admin/painel.php");
    $id = intval($_GET['live']);

    $title = mysqli_escape_string($con, $_POST['title']);
    $url = mysqli_escape_string($con, $_POST['url']);
    $cat  = mysqli_escape_string($con, $_POST['cat'][0]);
    $qUpdatePlatformLive = $pCon->query("UPDATE lives SET title='$title', url='$url', cat='$cat' WHERE id=$id");
    echo "<script>document.location.href=\" /psg-admin/painel.php?view=edit_live&live=$id\"</script>";
}


?>
<div class="container">
    <h5>Editar gravação de live</h5>
    <?php if (isset($error)) echo "<blockquote>$error</blockquote>";
    ?>
    <br />
    <form method="POST" action="">
        <input type="hidden" name="updatePlatformLive">
        <div class="row">
            <div class="col m6 s12 input-field">
                <i class="material-icons prefix">edit</i>
                <input type="text" value="<?= $live['title'] ?>" class="text" name="title" id="title" required>

                <label for="title">Título</label>
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 input-field">

                <i class="material-icons prefix">web</i>
                <input type="text" value="<?= $live['url'] ?>" class="text" name="url" id="url" required>
                <label for="url">Link</label>
            </div>
        </div>
        <div class="row">
            <p>Categoria</p>
            <?php
            $qCats = $pCon->query("SELECT * FROM lives_cats");
            while ($cat = $qCats->fetch_assoc()) {
                $checked = $live['cat'] == $cat['id'] ? "checked" : "";
            ?>
                <p>
                    <label>
                        <input type="radio" name="cat[]" value="<?= $cat['id'] ?>" <?= $checked ?>>
                        <span><?= $cat['name'] ?></span>
                    </label>
                </p>
            <?php
            }
            ?>
        </div>
        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn" name="save">Salvar <i class="material-icons">send</i></button>
                <a class="btn red" href="?view=edit_live&delete=<?= $id ?>" name="save">Excluir <i class="material-icons">delete</i></a>
            </div>



        </div>
</div>