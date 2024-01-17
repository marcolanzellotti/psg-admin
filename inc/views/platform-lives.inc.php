<?php
if (issetPostFields(['url', 'createPlatformLive', 'title'])) {

    $title = E($_POST['title']);
    $url = E($_POST['url']);
    $cat = E($_POST['cat'][0]);
    $qAddLive = $pCon->query("INSERT INTO lives (title, url, cat) VALUES ('$title', '$url', '$cat')");
    if ($qAddLive) {
        echo "Ok";
    } else {
    }
}
?>
<div class="container">
    <h5>Nova live</h5>
    <?php if (isset($error)) echo "<blockquote>$error</blockquote>"; ?>
    <br />
    <form method="POST" action="">
        <input type="hidden" name="createPlatformLive">
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
            <p>Categoria</p>
            <?php
            $qCats = $pCon->query("SELECT * FROM lives_cats");
            while ($cat = $qCats->fetch_assoc()) {
            ?>
                <p>
                    <label>
                        <input type="radio" name="cat[]" value="<?= $cat['id'] ?>">
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
<div class="container section">

    <h5>Lives</h5>

    <div class="collection">
        <?php
        $qLives = $pCon->query("SELECT * FROM lives");
        while ($live = $qLives->fetch_assoc()) {
            echo "<a href=\"?view=edit_live&live=$live[id]\" class=\"collection-item\">$live[title]</a>";
        }

        ?>
    </div>
</div>