<nav class="nav-extended blue">

    <div class="nav-wrapper blue">
        <a href="?view=profile"><b><?= $loggedMentor['name'] ?></b></a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

        <ul class="right hide-on-med-and-down">
            <?php if ($loggedMentor['name'] == "Julyane") {
            ?>
                <li><a href="?view=new_mentor">Adicionar mentor</a></li>
            <?php } ?>
            <?php if ($loggedMentor['name'] == "Julyane") {
            ?>
                <li><a href="?view=mentors">Mentores</a></li>
            <?php } ?>

            <?php if ($master) { ?>
                <li><a href="?view=master_area">Painel master</a></li>
                <li class="green"><a href="/psg-admin/master">Painel master (<b>em construção</b>)</a></li>
            <?php } ?>

            <?php if ($viewSubscriptions) { ?>
                <li><a href="?view=platform_team">Equipe</a></li>
            <?php } ?>

            <?php if ($viewSubscriptions) { ?>
                <li><a href="?view=subscriptions">PSG - Inscrições</a></li>
            <?php } ?>

            <?php if ($viewUpdates) { ?>
                <li><a href="?view=updates">PSG - Atualizações</a></li>
            <?php } ?>

            <?php if ($viewAnalysis) { ?>
                <li><a href="?view=analysis">PSG - Análise</a></li>
            <?php } ?>

            <?php if ($viewSelectAuthor || in_array($loggedMentor['name'], ['marco', 'Marco', 'Administrativo2'])) { ?>
                <li><a href="?view=select_author">Selecionar autores</a></li>
            <?php } ?>

            <?php if ($viewSelectMentor || in_array($loggedMentor['name'], ['Marco'])) { ?>
                <li><a href="?view=select_mentor">Selecionar co-autores</a></li>
            <?php } ?>

            <?php
            if ($loggedMentor['name'] == "Administrativo2") {
            ?>

                <li><a href="?view=select_co_author_all">Selecionar co-autores</a></li>
                <li><a href="?view=select_mentor_all">Selecionar mentores</a></li>
            <?php
            }
            ?>
            <li><a href="?view=routine_eliminates_more">Criar Rotina</a></li>
            <?php if ($viewSelectMentor2) { ?>
                <li><a href="?view=select_mentor2">Selecionar mentores</a></li>
            <?php } ?>
            <?php if ($viewHabits && (!$loggedMentor['is_co_author'] || 1)) { ?>
                <li><a href="?view=habits">Fase 2 - Ficha de hábitos</a></li>
            <?php } ?>
            <?php if ($viewWeeklyUpdates) { ?>
                <li><a href="?view=weekly_updates">Fase 2 - Atualização semanal</a></li>
            <?php } ?>
            <?php if ($master || in_array($loggedMentor['name'], ['marco', 'Marco', 'Administrativo2'])) { ?>
                <li><a href="?view=renew_habits">Fase 2 - Renovação</a></li>
            <?php } ?>
            <?php if ($master || in_array($loggedMentor['name'], ['marco', 'Marco', 'Administrativo2'])) { ?>
                <li><a href="?view=add_habits">Fase 2 - Cadastrar aluna</a></li>
            <?php } ?>
            <?php if (!in_array($loggedMentor['name'], ['Administrativo2', 'Administrativo'])) { ?>
                <li><a href="?view=platform_diary">Fase 2 - Diários</a></li>
            <?php } ?>
            <?php if (1) { ?>
                <li><a href="?view=profile">Perfil</a></li>
            <?php } ?>

            <li class="red"><a href="?logout"><i class="material-icons">exit_to_app</i>Sair</a></li>

        </ul>


    </div>

</nav>
<ul class="sidenav sidenav-close" id="mobile-demo">
    <?php if ($master) { ?>
        <li><a href="?view=master_area">Painel master</a></li>
        <li class="green white-text"><a href="/psg-admin/master">Painel master (<b>em construção</b>)</a></li>
    <?php } ?>

    <?php if ($viewSubscriptions) { ?>
                <li><a href="?view=platform_team">Equipe</a></li>
            <?php } ?>

    <?php if ($viewSubscriptions) { ?>
        <li><a href="?view=subscriptions">PSG - Inscrições</a></li>
    <?php } ?>
    <?php if ($viewUpdates) { ?>
        <li><a href="?view=updates">PSG - Atualizações</a></li>
    <?php } ?>
    <?php if ($viewAnalysis) { ?>
        <li><a href="?view=analysis">PSG - Análise</a></li>
    <?php } ?>
    <?php if ($viewSelectAuthor || in_array($loggedMentor['name'], ['marco', 'Marco', 'Administrativo2'])) { ?>
        <li><a href="?view=select_author">Selecionar autores</a></li>
    <?php } ?>
    <?php if ($viewSelectMentor) { ?>
        <li><a href="?view=select_mentor">Selecionar mentores</a></li>
    <?php } ?>
    <?php if ($viewSelectMentor2) { ?>
        <li><a href="?view=select_mentor2">Selecionar mentores</a></li>
    <?php } ?>
    <li><a href="?view=routine_eliminates_more">Criar Rotina</a></li>
    <?php if ($viewHabits && !$loggedMentor['is_co_author']) { ?>
        <li><a href="?view=habits">Fase 2 - Ficha de hábitos</a></li>
    <?php } ?>
    <?php if ($viewWeeklyUpdates) { ?>
        <li><a href="?view=weekly_updates">Fase 2 - Atualização semanal</a></li>
    <?php } ?>
    <?php if ($master) { ?>
        <li><a href="?view=renew_habits">Fase 2 - Renovação</a></li>
    <?php } ?>

    <?php if (1) { ?>
        <li><a href="?view=profile">Perfil</a></li>
    <?php } ?>
    <li class="red"><a href="?logout"><i class="material-icons">exit_to_app</i>Sair</a></li>

</ul>

</ul>