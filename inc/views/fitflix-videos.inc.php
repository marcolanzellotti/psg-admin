<?php
if (issetPostFields(['url', 'createFitflixVideo', 'title'])) {

    $title = E($_POST['title']);
    $url = E($_POST['url']);
    $cats = E(implode(",", $_POST['cat'])); // TODO: CHANGE THIS
    $qAddFitflixVideo = $pCon->query("INSERT INTO fitflix_videos (title, url, cat) VALUES ('$title', '$url', '$cats')");
    if ($qAddFitflixVideo) {
        echo "Ok";
    } else {
    }
}
?>
<!--
<div class="container">
    <h5>Novo video</h5>
    <?php if (isset($error)) echo "<blockquote>$error</blockquote>"; ?>
    <br />
    <form method="POST" action="">
        <input type="hidden" name="createFitflixVideo">
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
            <p>Categorias</p>
            <?php
            $qCats = $pCon->query("SELECT * FROM cats");
            while ($cat = $qCats->fetch_assoc()) {
            ?>
                <p>
                    <label>
                        <input type="checkbox" name="cat[]" value="<?= $cat['id'] ?>">
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
    </div>
</div>
</div>
-->
<div class="container section">

    <h5>Videos</h5>

    <div class="collection">
        <?php
        $qVideos = $pCon->query("SELECT * FROM fitflix_videos");
        while ($fitflixVideo = $qVideos->fetch_assoc()) {
            echo "<a href=\"?view=edit_fitflix_video&fitflixVideo=$fitflixVideo[id]\" class=\"collection-item\">$fitflixVideo[title]</a>";
        }

        ?>
    </div>
</div>