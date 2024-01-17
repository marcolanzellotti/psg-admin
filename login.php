<?php

require_once  "inc/functions.inc.php";
session_start();
requireNotLogin();
if (isset($_POST['username']) && isset($_POST['password'])) {

    $mentor = authMentor($_POST['username'], $_POST['password']);
    //var_dump($mentor);
    if ($mentor) {
        $_SESSION['idUser'] = $mentor['id'];
        $_SESSION['mentor'] = $mentor['username'];
        $_SESSION['logged'] = 1;
        header("Location: painel.php");
    } else {
        $error = "Usuário ou senha inválidos";
    }
}
?>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/imask"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciamento</title>
    <style>
        body {
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <header>

    </header>
    <main>
        <div class="container  login">
            <h4 class="center">Área restrita<i class="material-icons">lock</i></h4>
            <?php
            if (isset($error)) {
                echo "<blockquote class=\"red white-text p1\">$error</blockquote>";
            }
            ?>
            <div class="row">
                <form action="" method="POST" style="width: 80%;">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">person</i>
                            <input id="user" required type="text" name="username" class="validate" value="master">
                            <label for="user">Usuário</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">

                            <i class="material-icons prefix">key</i>
                            <input id="password" required type="password" name="password" class="validate" value="Lanz@226974">
                            <span toggle="#password" class="field-icon toggle-password"><span class="material-icons">visibility</span></span>
                            <label for="password">Senha</label>
                        </div>
                    </div>

                    <div class="row">
                        <button type="submit" class="btn blue">Login <i class="material-icons right">send</i></button>

                    </div>

                </form>
            </div>
        </div>
    </main>
    <script src="assets/js/main.js"></script>

</body>

</html>