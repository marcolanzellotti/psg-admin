<?php
if (!isset($_GET['fitflixVideo']) && !isset($_GET['delete'])) {
    $error = "Id?";
} else {
    $id = intval($_GET['fitflixVideo']);
    $qVideo = $pCon->query("SELECT * FROM fitflix_videos WHERE id=$id");
    $video = $qVideo->fetch_assoc();
    if (!$qVideo->num_rows) {
        $error = "Video não encontrada";
    }
    if (isset($_GET['delete'])) {
        $pCon->query("DELETE FROM fitflix_videos WHERE id=" . intval($_GET['delete']));
        echo "<script>document.location.href=\"/psg-admin/painel.php?view=master_area\"</script>";
    }
}


if (issetPostFields(["updateFitflixVideo", "title", "url"])) {

    if (!isset($_GET['fitflixVideo']))
        header("Location: /psg-admin/painel.php");
    $id = intval($_GET['fitflixVideo']);

    $title = mysqli_escape_string($con, $_POST['title']);
    $url = mysqli_escape_string($con, $_POST['url']);
    $cat  = mysqli_escape_string($con, $_POST['cat']);
    $qUpdateFitflixVideo = $pCon->query("UPDATE fitflix_videos SET title='$title', url='$url', cat='$cat' WHERE id=$id");
    echo "<script>document.location.href=\"/psg-admin/painel.php?view=fitflix_videos\"</script>";
}


?>
<div class="container">
    <h5>Editar video</h5>
    <?php if (isset($error)) echo "<blockquote>$error</blockquote>";
    ?>
    <br />
    <form method="POST" action="">
        <input type="hidden" name="updateFitflixVideo">
        <div class="row">
            <div class="col m6">

                <img style="width:100%;" src="https://fase2.planosecagordura.com.br/fitflix/assets/img/covers/<?= $video['id'] ?>.png" alt="" class="responsive-image">
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 input-field">
                <i class="material-icons prefix">edit</i>
                <input type="text" value="<?= $video['title'] ?>" class="text" name="title" id="title" required>

                <label for="title">Título</label>
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 input-field">

                <i class="material-icons prefix">web</i>
                <input type="text" value="<?= $video['url'] ?>" class="text" name="url" id="url" required>
                <label for="url">Link</label>
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 input-field">
                <select name="cat">
                    <?php
                    $qCats = $pCon->query("SELECT * FROM cats");

                    while ($cat = $qCats->fetch_assoc()) {
                        $selected = $video['cat'] == $cat['id'] ? "selected" : "";
                        echo "<option value=\"$cat[id]\" $selected>$cat[name]</option>";
                    }
                    ?>
                </select>
                <label>Categoria</label>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn" name="save">Salvar <i class="material-icons">send</i></button>
                <a class="btn red" href="?view=edit_fitflix_video&delete=<?= $id ?>" name="save">Excluir <i class="material-icons">delete</i></a>
            </div>



        </div>
</div>