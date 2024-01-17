<?php
if ($view == "master_area") {
    require_once("./inc/views/team.inc.php");
}
?>
<div class="container">
    <div class="row">
        <div class="col l6 m6 s12">
            <div class="section">
                <h5>Plataforma Fase 2</h5>
                <h6><a href="?view=trainings">Treinos</a></h6>
                <h6><a href="?view=fitflix_videos">Videos Fit Flix</a></h6>
                <h6><a href="?view=platform_lives">Lives</a></h6>
                <h6><a href="?view=upload_calendar">Calendário</a></h6>
                <h6><a href="?view=create_events">Criar Eventos</a></h6>
                <h6><a href="http://fase2.planosecagordura.com.br/receitas/admin/recipes.php">Portal de receitas</a></h6>
                <h6><a href="?view=platform_eliminates_more">Elimina+ <span class="red">(Em construção)</span></a></h6>
                <h6><a href="?view=platform_marathon">Maratona <span class="red">(Em construção)</span></a></h6>
                <br />
                <h6><a href="?view=platform_access">Verificar acessos</a></h6>
                <h6><a href="?view=platform_users">Usuários plataforma</a></h6>
                <h6><a href="?view=platform_2_users">Usuários plataforma (Sem acompanhamento)</a></h6>
                <br />
            </div>
        </div>
        <div class="col l6 m6 s12">
            <div class="section">
                <h5>Plataforma PSG 1</h5>
                <h6><a href="?view=members_access">Verificar acessos</a></h6>
                <h6><a href="?view=members">Usuários plataforma</a></h6>
                <h6><a href="?view=signature_users">Usuários assinatura</a></h6>

            </div>
        </div>
        <div class="col l6 m6 s12">
            <div class="section">
                <h5>Plataforma Treinamento Mentor</h5>
                <h6><a href="?view=register_categories">Cadastrar Categorias</a></h6>
                <h6><a href="?view=mentor_training">Cadastrar Videos</a></h6>
            </div>
        </div>
    </div>
</div>
<div class="container section">
    <?php
    if (issetPostFields(['grupo_psg_7d', 'grupo_psg_7d_save_group'])) {
        $url = E($_POST['grupo_psg_7d']);
        file_put_contents("../7dpsg/url.inc", $url);
    }
    $url = file_get_contents("../7dpsg/url.inc", true);
    ?>
    <h5>Grupo PSG 7D</h5> (<a target='_blank' href="<?= $url ?>">https://planosecagordura.com.br/7dpsg</a>)
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

<div class="container section">
    <?php
    if (issetPostFields(['grupo_psg_7d_l', 'grupo_psg_7d_l_save_group'])) {
        $url = E($_POST['grupo_psg_7d_l']);
        file_put_contents("../7dpsg_l/url.inc", $url);
    }
    $url = file_get_contents("../7dpsg_l/url.inc", true);
    ?>
    <h5>Grupo PSG 7D - L</h5> (<a target='_blank' href="<?= $url ?>">https://planosecagordura.com.br/7dpsg_l</a>)
    <form action="" method="POST">
        <div class="row">
            <input type="hidden" value="<?= $redirect['id'] ?>" name="id">
            <input type="text" name="grupo_psg_7d_l" class="col m6 s12" value="<?= $url ?>" id="">
            <button class="btn waves-effect waves-light col" type="submit" value="submit" name="grupo_psg_7d_l_save_group">Salvar
                <i class="material-icons right">send</i>
            </button>

        </div>
    </form>
</div>

<div class="container section">
    <?php
    if (issetPostFields(['grupo_psg_7d_a', 'grupo_psg_7d_a_save_group'])) {
        $url = E($_POST['grupo_psg_7d_a']);
        file_put_contents("../7dpsg_a/url.inc", $url);
    }
    $url = file_get_contents("../7dpsg_a/url.inc", true);
    ?>
    <h5>Grupo PSG 7D - A</h5> (<a target='_blank' href="<?= $url ?>">https://planosecagordura.com.br/7dpsg_a</a>)
    <form action="" method="POST">
        <div class="row">
            <input type="hidden" value="<?= $redirect['id'] ?>" name="id">
            <input type="text" name="grupo_psg_7d_a" class="col m6 s12" value="<?= $url ?>" id="">
            <button class="btn waves-effect waves-light col" type="submit" value="submit" name="grupo_psg_7d_a_save_group">Salvar
                <i class="material-icons right">send</i>
            </button>

        </div>
    </form>
</div>

<div class="container section">
    <?php
    if (issetPostFields(['mentoria', 'redirect_save_live'])) {
        $url = E($_POST['mentoria']);
        file_put_contents("../mentoria/url.inc", $url);
    }
    $url = file_get_contents("../mentoria/url.inc", true);
    ?>
    <h5>Mentoria PSG 7D</h5> (<a target="_blank" href="<?= $url ?>">https://planosecagordura.com.br/mentoria</a>)
    <form action="" method="POST">
        <div class="row">
            <input type="hidden" value="<?= $redirect['id'] ?>" name="id">
            <input type="text" name="mentoria" class="col m6 s12" value="<?= $url ?>" id="">
            <button class="btn waves-effect waves-light col" type="submit" value="submit" name="redirect_save_live">Salvar
                <i class="material-icons right">send</i>
            </button>

        </div>
    </form>
</div>

<!-- 
<div class="container section">
    <?php
    if (issetPostFields(['redirect', 'redirect_save_live'])) {
        $url = E($_POST['redirect']);
        $qUpdateRedirect = $con->query("UPDATE redirects SET dest='$url' WHERE id=2");
    }

    $qRedirect = $con->query("SELECT * FROM redirects WHERE id=2");

    $redirect = $qRedirect->fetch_assoc();
    $redirectUrl = $redirect['dest'];


    ?>
    <h5>Treinamento mentores</h5> (<a target="_blank" href="https://planosecagordura.com.br/mentoria/">https://planosecagordura.com.br/mentoria/</a>)
    <form action="" method="POST">
        <div class="row">
            <input type="hidden" value="<?= $redirect['id'] ?>" name="id">
            <input type="text" name="redirect" class="col m6 s12" value="<?= $redirectUrl ?>" id="">
            <button class="btn waves-effect waves-light col" type="submit" value="submit" name="redirect_save_live">Salvar
                <i class="material-icons right">send</i>
            </button>

        </div>
    </form>
</div>


<div class="container section">
    <?php
    if (issetPostFields(['redirect', 'redirect_save_live'])) {
        $url = E($_POST['redirect']);
        $qUpdateRedirect = $con->query("UPDATE redirects SET dest='$url' WHERE id=2");
    }

    $qRedirect = $con->query("SELECT * FROM redirects WHERE id=2");

    $redirect = $qRedirect->fetch_assoc();
    $redirectUrl = $redirect['dest'];


    ?>
    <h5>Live PSG Fase 2</h5> (<a target="_blank" href="https://planosecagordura.com.br/mentoria/">https://planosecagordura.com.br/mentoria/</a>)
    <form action="" method="POST">
        <div class="row">
            <input type="hidden" value="<?= $redirect['id'] ?>" name="id">
            <input type="text" name="redirect" class="col m6 s12" value="<?= $redirectUrl ?>" id="">
            <button class="btn waves-effect waves-light col" type="submit" value="submit" name="redirect_save_live">Salvar
                <i class="material-icons right">send</i>
            </button>

        </div>
    </form>
</div> -->



<div class="container section">
    <?php
    if (issetPostFields(['promo_url', 'save_promo_url'])) {
        $url = E($_POST['promo_url']);
        file_put_contents("../promo/url.inc", $url);
    }
    $url = file_get_contents("../promo/url.inc", true);
    ?>
    <h5>Grupo Promo</h5>(<a target="_blank" href="<?= $url ?>">https://planosecagordura.com.br/promo/</a>)
    <form action="" method="POST">
        <div class="row">
            <input type="text" name="promo_url" class="col m6 s12" value="<?= $url ?>" id="">
            <button class="btn waves-effect waves-light col" type="submit" value="submit" name="save_promo_url">Salvar
                <i class="material-icons right">send</i>
            </button>

        </div>
    </form>
</div><!--CONTAINER PROMO-->


<!--<div class="container section">
    <?php
    if (issetPostFields(['phase2_url', 'save_phase2_url'])) {
        $url = E($_POST['phase2_url']);
        file_put_contents("../fase-2/url.inc", $url);
    }
    $url = file_get_contents("../fase-2/url.inc", true);
    $key = file_get_contents("../fase-2/key.inc", true);
    ?>
    <h5>Grupo Fase 2</h5>(<a target="_blank" href="https://planosecagordura.com.br/fase-2?k=<?= $key ?>">https://planosecagordura.com.br/fase-2?k=<?= $key ?></a>)
    <form action="" method="POST">
        <div class="row">
            <input type="text" name="phase2_url" class="col m6 s12" value="<?= $url ?>" id="">
            <button class="btn waves-effect waves-light col" type="submit" value="submit" name="save_phase2_url">Salvar
                <i class="material-icons right">send</i>
            </button>

        </div>
    </form>
</div>--><!-- GRUPO FASE 2-->

<div class="container section">
    <?php
    if (issetPostFields(['mentory_password', 'save_mentory_password'])) {
        $password = E($_POST['mentory_password']);
        file_put_contents("./mpasswd.txt", $password);
    }
    $password = file_get_contents("./mpasswd.txt", true);
    ?>
    <h5>Senha plataforma Maratona</h5>
    (<a target='_blank' href="https://planosecagordura.com.br/maratona_">https://planosecagordura.com.br/maratona_</a>)
    <form action="" method="POST">
        <div class="row">
            <input type="text" name="mentory_password" class="col m6 s12" value="<?= $password ?>" id="">
            <button class="btn waves-effect waves-light col" type="submit" value="submit" name="save_mentory_password">Salvar
                <i class="material-icons right">send</i>
            </button>

        </div>
    </form>
</div>
<div class="container section">
    <?php
    if (issetPostFields(['trainning_mentor', 'save_trainning_mentor'])) {
        $password = E($_POST['trainning_mentor']);
        file_put_contents("./tpasswd.txt", $password);
    }
    $password = file_get_contents("./tpasswd.txt", true);
    ?>
    <h5>Senha plataforma Treinamento Mentor</h5>
    (<a target='_blank' href="https://planosecagordura.com.br/treinamento-mentor">https://planosecagordura.com.br/treinamento-mentor</a>)
    <form action="" method="POST">
        <div class="row">
            <input type="text" name="trainning_mentor" class="col m6 s12" value="<?= $password ?>" id="">
            <button class="btn waves-effect waves-light col" type="submit" value="submit" name="save_trainning_mentor">Salvar
                <i class="material-icons right">send</i>
            </button>

        </div>
    </form>
</div>
<div class="container section">
    <?php
    if (issetPostFields(['turbo_url', 'save_turbo_url'])) {
        $url = E($_POST['turbo_url']);
        file_put_contents("../psgturbo/url.inc", $url);
    }
    $url = file_get_contents("../psgturbo/url.inc", true);
    ?>
    <h5>Grupo PSG Turbo</h5>(<a target="_blank" href="https://planosecagordura.com.br/psgturbo/">https://planosecagordura.com.br/psgturbo/</a>)
    <form action="" method="POST">
        <div class="row">
            <input type="text" name="turbo_url" class="col m6 s12" value="<?= $url ?>" id="">
            <button class="btn waves-effect waves-light col" type="submit" value="submit" name="save_turbo_url">Salvar
                <i class="material-icons right">send</i>
            </button>

        </div>
    </form>
</div>


<!-- 
<div class="container section">
    <?php
    if (issetPostFields(['central_password', 'save_central_password'])) {
        $password = E($_POST['central_password']);
        file_put_contents("../central/inc/p4ss.inc", $password);
    }
    $password = file_get_contents("../central/inc/p4ss.inc", true);
    ?>
    <h5>Senha central</h5>
    <form action="" method="POST">
        <div class="row">
            <input type="text" name="central_password" class="col m6 s12" value="<?= $password ?>" id="">
            <button class="btn waves-effect waves-light col" type="submit" value="submit" name="save_central_password">Salvar
                <i class="material-icons right">send</i>
            </button>

        </div>
    </form>
</div> -->


<!-- 
<div class="container section">
    <h5>Link ficha de inscrição PSG</h5>
    <form action="" method="POST">
        <div class="row">
            <div class="col m6 s12">
                <a href="https://www.planosecagordura.com.br/formularios/inscricao.php?key=<?= $psgSubscriptionKey ?>">
                    https://www.planosecagordura.com.br/formularios/inscricao.php?key=<?= $psgSubscriptionKey ?>
                </a>
            </div>
            <button class="btn waves-effect waves-light col" type="submit" value="submit" name="reset_psg_subscription_key">Gerar novo endereço
                <i class="material-icons right">send</i>
            </button>

        </div>
    </form>
</div> -->



<div class="container section">
    <h5>Autores <a href="?view=new_mentor" class="secondary-content"><i class="material-icons">add_box</i> Novo</a>
    </h5>
    <div class="collection">
        <?php
        $qMentors = $con->query("SELECT * FROM mentors WHERE is_author=1");
        while ($mentor = $qMentors->fetch_assoc()) {
            echo "<a href=\"?view=edit_mentor&mentor=$mentor[id]\" class=\"collection-item\">$mentor[name]</a>";
        }

        ?>
    </div>
</div>

<div class="container section">
    <h5>Co-Autores <a href="?view=new_mentor" class="secondary-content"><i class="material-icons">add_box</i> Novo</a>
    </h5>
    <div class="collection">
        <?php
        $qMentors = $con->query("SELECT * FROM mentors WHERE is_co_author=1");
        while ($mentor = $qMentors->fetch_assoc()) {
            echo "<a href=\"?view=edit_mentor&mentor=$mentor[id]\" class=\"collection-item\">$mentor[name]</a>";
        }

        ?>
    </div>
</div>

<div class="container section">
    <h5>Mentores <a href="?view=new_mentor" class="secondary-content"><i class="material-icons">add_box</i> Novo</a>
    </h5>
    <div class="collection">
        <?php
        $qMentors = $con->query("SELECT * FROM mentors WHERE is_author=0 AND is_co_author=0");
        while ($mentor = $qMentors->fetch_assoc()) {
            echo "<a href=\"?view=edit_mentor&mentor=$mentor[id]\" class=\"collection-item\">$mentor[name]</a>";
        }

        ?>
    </div>
</div>



<!-- 

<div class="container section">
    <h5>Lives gravadas <a href="?view=new_live" class="secondary-content"><i class="material-icons">add_box</i> Novo</a>
    </h5>
    <div class="collection">
        <?php
        $qLives = $con->query("SELECT * FROM lives");

        while ($live = $qLives->fetch_assoc()) {
            echo "<a href=\"?view=edit_live&live=$live[id]\" class=\"collection-item\">$live[title]</a>";
        }
        ?>
    </div>
</div> -->
