<header>

    <!------------------------------ DROPDOWNS ----------------------------------->
    <ul class="dropdown-content" id="dropdown-psg">
        <li>
            <a href="/psg-admin/master/psg/subscriptions.php">Inscrições</a>
        </li>
        <li>
            <a href="/psg-admin/master/psg/updates.php">Atualizações</a>
        </li>
        <li>
            <a href="/psg-admin/master/psg/analysis.php">Análise</a>
        </li>
    </ul>


    <ul class="dropdown-content" id="dropdown-psg-mobile">
        <li>
            <a href="#">Inscrições</a>
        </li>
        <li>
            <a href="#">Atualizações</a>
        </li>
        <li>
            <a href="#">Análise</a>
        </li>
    </ul>


    <ul class="dropdown-content" id="dropdown-mentors">
        <li>
            <a href="/psg-admin/master/select-author.php">Selecionar autores</a>
        </li>
        <li>
            <a href="/psg-admin/master/select-mentor.php">Selecionar mentores</a>
        </li>
        <li>
            <a href="/psg-admin/master/weekly-update.php">Atualização semanal</a>
        </li>
    </ul>


    <ul class="dropdown-content" id="dropdown-mentors-mobile">
        <li>
            <a href="#">Selecionar autores</a>
        </li>
        <li>
            <a href="#">Selecionar mentores</a>
        </li>
    </ul>
    <!-----------------------------  END DROPDOWNS ------------------------------------->
    <div class="navbar-fixed">

        <nav>
            <div class=" nav-wrapper blue fixed-top">
                <a href="/psg-admin/master/" class="brand-logo">Master</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <li>
                        <a href="#" class="dropdown-trigger" data-target="dropdown-psg">
                            Sessão PSG
                            <i class="material-icons right">
                                arrow_drop_down
                            </i>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="dropdown-trigger" data-target="dropdown-mentors">
                            Sessão Fase 2
                            <i class="material-icons right">
                                arrow_drop_down
                            </i>
                        </a>
                    </li>


                    <li>
                        <a href="/psg-admin/master/redirects.php">
                            Redirecionamentos

                        </a>
                    </li>

                    <li>
                        <a href="/psg-admin/master/manage-mentors.php">
                            Gerenciar mentores

                        </a>
                    </li>


                    <li>
                        <a href="/psg-admin/?logout" class="red white-text"><i class="material-icons left white-text">exit_to_app</i>Sair</a>
                    </li>
                </ul>
            </div>
        </nav>

    </div>

    <ul class="sidenav" id="mobile-demo">
        <li>
            <a href="#" class="dropdown-trigger" data-target="dropdown-psg-mobile">
                Sessão PSG
                <i class="material-icons right">
                    arrow_drop_down
                </i>
            </a>
        </li>
        <li>
            <a href="?logout" class="red white-text"><i class="material-icons left white-text">exit_to_app</i>Sair</a>
        </li>
    </ul>
</header>