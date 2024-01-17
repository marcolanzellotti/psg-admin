<?php

if (issetPostFields(['url', 'createPlatformTeam', 'title', 'description'])) {

    $idUser = $_SESSION['idUser'];
    $title = E($_POST['title']);
    $url = E($_POST['url']);
    $description = E($_POST['description']);
    $team_type = E($_POST['team_type']);

    $qAddTeam = $con->query(
        "INSERT INTO teams (
                                    title, 
                                    url, 
                                    description, 
                                    team_type,
                                    createdAt, 
                                    createdBy
                            ) VALUES (
                                    '$title', 
                                    '$url', 
                                    '$description', 
                                    $team_type, 
                                    NOW(), 
                                    $idUser)"
    );

    if ($qAddTeam) {
        $ok = 1;
        $msg = "Cadastro feito com sucesso!";
    } else {
        $ok = 0;
    }
}
?>
<div class="container">
    <h5>Nova Equipe</h5>
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
        <input type="hidden" name="createPlatformTeam">
        <div class="row">
            <div class="col m6 s12 input-field">
                <i class="material-icons prefix">edit</i>
                <select name="team_type" id="team_type">
                    <option value="0">Selecione um Tipo</option>
                    <option value="1">Reunião</option>
                    <option value="2">Treinamento</option>
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
                <input type="text" class="text" name="description" id="description" required>

                <label for="description">Descrição</label>
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
<div class="container">
    <div class="row">
        <div class="col l6 m6 s12">
            <h5>Videos de Reuniões</h5>
            <?php
            $qTeams = $con->query("SELECT * FROM teams WHERE team_type = 1 AND deletedAt IS NULL");

            while ($team = $qTeams->fetch_assoc()) { ?>
                <div class="collection">
                    <div class="section" style="display: grid;">
                        <div class='collection-item'>
                            <a href="?view=delete_team&delete=<?= $team['id']; ?>" title="Excluir Equipe" style='cursor: pointer; color: #f00'><i class='material-icons prefix'>close</i></a>
                            <a href="?view=edit_team&team=<?= $team['id']; ?>" title="Editar Equipe" style='cursor: pointer; color: #000'><i class='material-icons prefix'>edit</i> <?= $team['title']; ?></a>
                        </div>
                    </div>
                </div>
            <?php
            }

            ?>
        </div>
        <div class="col l6 m6 s12">
            <h5>Videos de Treinamentos</h5>
            <?php
            $qTeams = $con->query("SELECT * FROM teams WHERE team_type = 2 AND deletedAt IS NULL");

            while ($team = $qTeams->fetch_assoc()) { ?>
                <div class="collection">
                    <div class="section" style="display: grid;">
                        <div class='collection-item'>
                            <a href="?view=delete_team&delete=<?= $team['id']; ?>" title="Excluir Equipe" style='cursor: pointer; color: #f00'><i class='material-icons prefix'>close</i></a>
                            <a href="?view=edit_team&team=<?= $team['id']; ?>" title="Editar Equipe" style='cursor: pointer; color: #000'><i class='material-icons prefix'>edit</i> <?= $team['title']; ?></a>
                        </div>
                    </div>
                </div>
            <?php
            }

            ?>
        </div>
    </div>
</div>
<script>
    $('#alert_close').click(function() {
        $("#alert_box").fadeOut("slow", function() {});
    });
</script>