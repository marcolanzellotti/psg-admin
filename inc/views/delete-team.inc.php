<?php

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $con->query("UPDATE teams SET deletedAt = NOW() WHERE id=$id");
}

?>
<div class="container">
    <h5>Excluir Equipe</h5>
    <div class="alert card red lighten-4 red-text text-darken-4" id="alert_box">
        <div class="card-content">
            <p><i class="material-icons">check_circle</i>Excluído com sucesso.</p>
        </div>
    </div>
    <div class="row center">
        <div class="col s12">
            <a href="?view=platform_team" class="btn grey">Voltar <i class="material-icons">undo</i></a>
        </div>
    </div>
</div>