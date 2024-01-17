<?php
if ($view == "panel") {
    require_once("./inc/views/team.inc.php");
}
if ($loggedMentor['admin'] && $loggedMentor['name'] != "Administrativo2") {
?>
    <div class="container section">
        <h3>Plataforma PSG 1</h3>
        <h5><a href="?view=members_access">Verificar acessos</a></h5>
        <h5><a href="?view=members">Usuários plataforma</a></h5>
        <h5><a href="?view=signature_users">Usuários assinatura</a></h5>
    </div>

    <div class="container section">
        <?php
        if (issetPostFields(['grupo_psg_7d', 'grupo_psg_7d_save_group'])) {
            $url = E($_POST['grupo_psg_7d']);
            file_put_contents("../7dpsg/url.inc", $url);
            $_SESSION['msg'] = "<p style='color: green;'>Novo grupo criado com sucesso.</p> ";
        }
        $url = file_get_contents("../7dpsg/url.inc", true);

        ?>
        <h5>Grupo PSG 7D</h5> (<a target='_blank' href="<?= $url ?>">https://planosecagordura.com.br/7dpsg</a>)
        <?php
        if ($_SESSION['msg']) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>                                                                                                                
        <form action="" method="POST">
            <div class="row">
                <input type="hidden" value="<?= $redirect['id'] ?>" name="id">
                <input type="text" name="grupo_psg_7d" class="col m6 s12" value="<?= $url ?>" id="">
                <button class="btn waves-effect waves-light col" type="submit" value="submit" name="grupo_psg_7d_save_group">Salvar
                    <i class="material-icons right">send</i>
                </button>

            </div>
        </form>
    </div>


<?php

} elseif ($loggedMentor['name'] == "Administrativo2") {
?>
    <div class="container section">

        <h3>Plataforma Fase 2</h3>

        <br />
        <h5><a href="?view=platform_access">Verificar acessos</a></h5>
        <h5><a href="?view=platform_users">Usuários plataforma</a></h5>
        <h5><a href="?view=platform_2_users">Usuários plataforma (Sem acompanhamento)</a></h5>
        <!-- <h5><a href="http://fase2.planosecagordura.com.br/receitas/admin/recipes.2.php">Portal de receitas</a></h5> -->
    <?php
} elseif ($loggedMentor['name'] == "Julyane") {

    ?>
        <div class="container section">
            <h3>Plataforma Fase 2</h3>
            <h5><a href="?view=trainings">Treinos</a></h5>
            <h5><a href="?view=fitflix_videos">Videos Fit Flix</a></h5>
            <h5><a href="?view=platform_lives">Lives</a></h5>
            <h5><a href="http://fase2.planosecagordura.com.br/receitas/admin/recipes.php">Portal de receitas</a></h5>
            <h5><a href="?view=upload_calendar">Calendário</a></h5>
            <br />

            <h5><a href="?view=platform_users">Usuários plataforma</a></h5>



        </div>
    <?php
}
    ?>
    </div>