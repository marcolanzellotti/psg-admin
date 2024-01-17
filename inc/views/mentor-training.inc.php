<?php

$trainnings_mentors = $con->query("SELECT * FROM categories_trainning_mentor WHERE deletedBy IS NULL");

if (issetPostFields(['createTrainningMentor', 'category_trainning_mentor', 'title', 'url'])) {

    $idUser = $_SESSION['idUser'];
    $category_trainning_mentor =    E($_POST['category_trainning_mentor']);
    $title =                        E($_POST['title']);
    $url =                          E($_POST['url']);

    $qAddTeam = $con->query(
        "INSERT INTO trainning_mentor (
                                    category_trainning_mentor,
                                    title, 
                                    url, 
                                    createdAt, 
                                    createdBy
                            ) VALUES (
                                    '$category_trainning_mentor',
                                    '$title', 
                                    '$url', 
                                    NOW(), 
                                    $idUser
                            )"
    );

    if ($qAddTeam) {
        $ok = 1;
        $msg = "Registro inserido com sucesso!";
    } else {
        $ok = 0;
    }
}
?>
<div class="container">
    <h5>Cadastrar Videos de Treinamento Mentor</h5>
    <?php if (isset($error)) echo "<blockquote>$error</blockquote>"; ?>

    <?php if ($ok || $_SESSION['msg']) {
        if ($_SESSION['msg']) {
            $msg = $_SESSION['msg'];
        }
        echo '  <div class="alert card green lighten-4 green-text text-darken-4" id="alert_box">
                    <div class="card-content">
                        <p><i class="material-icons">check_circle</i>' . $msg . '</p>
                    </div>
                    <i class="material-icons" id="alert_close" aria-hidden="true">close</i>
                </div>';
        unset($_SESSION['msg']);
    }
    ?>
    <br />
    <form method="POST" action="">
        <input type="hidden" name="createTrainningMentor">
        <div class="row">
            <div class="col m6 s12 input-field">
                <i class="material-icons prefix">edit</i>
                <select name="category_trainning_mentor" id="category_trainning_mentor">
                    <option value="0">Selecione uma Categoria</option>
                    <?php
                    while ($trainning_mentor = $trainnings_mentors->fetch_assoc()) {
                    ?>
                        <option value="<?= $trainning_mentor['id']; ?>"><?= $trainning_mentor['title']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 input-field">
                <i class="material-icons prefix">edit</i>
                <input type="text" class="text" name="title" id="title" required>

                <label for="title">Título</label>
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 input-field">
                <i class="material-icons prefix">edit</i>
                <input type="text" class="text" name="url" id="url" required>

                <label for="url">URL <span style="font-size: 11px; font-style: italic;">(Trocar "/watch?v=" por "/embed/" mantendo o ID do seu vídeo)</span></label>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn" name="save">Salvar <i class="material-icons">send</i></button>
            </div>
        </div>
</div>
<div class="container">
    <div class="row">
        <div class="col l12 m12 s12">
            <h5>Videos de Treinamentos</h5>
            <?php
            $qTrainningMentor = $con->query("SELECT * FROM trainning_mentor WHERE deletedAt IS NULL");
            if ($qTrainningMentor->num_rows > 0) {
                while ($trainning_mentor = $qTrainningMentor->fetch_assoc()) { ?>
                    <div class="collection">
                        <div class="section" style="display: grid;">
                            <div class='collection-item'>
                                <a onclick="removeTrainningMentor('<?= $trainning_mentor['id']; ?>')" title="Excluir Treinamento Mentor" style='cursor: pointer; color: #f00'><i class='material-icons prefix'>close</i></a>
                                <a href="?view=edit_trainning_mentor&trainning_mentor=<?= $trainning_mentor['id']; ?>" title="Editar Treinamento Mentor" style='cursor: pointer; color: #000'><i class='material-icons prefix'>edit</i> <?= $trainning_mentor['title']; ?></a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p>Nenhuma registro encontrado.</p>";
            }

            ?>
        </div>
    </div>
</div>
<script>
    $('#alert_close').click(function() {
        $("#alert_box").fadeOut("slow", function() {});
    });

    function removeTrainningMentor(value) {

        let text;
        if (confirm("Deseja mesmo excluir esse registro?") == true) {
            window.location.href = "?view=delete_trainning_mentor&delete=" + value;
        }
    }
</script>