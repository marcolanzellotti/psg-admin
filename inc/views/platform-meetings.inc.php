<div class="container">
    <div class="row">
        <h5>Videos de Reuniões</h5>
        <?php
        $qTeams = $con->query("SELECT * FROM teams WHERE team_type = 1 AND deletedAt IS NULL");

        if ($qTeams->num_rows > 0) {
            while ($team = $qTeams->fetch_assoc()) { ?>
                <div class="col l4 m4 s12">
                    <h6><?php echo $team['title']; ?></h6>
                    <iframe width="100%" height="280" src="<?php echo $team['url']; ?>"></iframe>
                    <p><?php echo $team['description']; ?></p>
                </div>
            <?php
            }
        } else {
            ?>
            <div class="alert card yellow lighten-4 green-text text-darken-4" id="alert_box">
                <div class="card-content">
                    <p><i class="material-icons">check_circle</i>Nenhum video de reunião cadastrado no momento.</p>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="row center">
        <a href="painel.php" class="btn grey">Voltar <i class="material-icons">undo</i></a>
    </div>
</div>