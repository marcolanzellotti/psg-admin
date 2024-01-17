<?php
require_once("../inc/functions.inc.php");
// Page config
define("TITLE", "Painel master");

if (issetPostFields(["name", "username", "password", "createMentor"])) {
    if (!($id = createMentor($_POST['name'], $_POST['username'], $_POST['password']))) {
        $error = "Erro ao criar mentor";
    }
    header("Location: manage-mentors.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Painel master</title>
    <?php require_once("inc/views/head.inc.php"); ?>
</head>

<body>
    <header>
        <?php require_once("inc/views/header.inc.php"); ?>
    </header>
    <main>
        <div class="container">
            <h5>Criar novo mentor</h5>
            <?php if (isset($error)) echo "<blockquote>$error</blockquote>"; ?>
            <br />
            <form method="POST" action="">
                <input type="hidden" name="createMentor">
                <div class="row">
                    <div class="col m6 s12 ">
                        <i class="material-icons">person</i> Nome
                    </div>
                    <div class="col m6 s12 ">
                        <input type="text" class="text" name="name" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col m6 s12 ">
                        Usuário
                    </div>
                    <div class="col m6 s12 ">
                        <input type="text" class="text" name="username" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col m6 s12">
                        <i class="material-icons">key</i>Senha
                    </div>
                    <div class="col m6 s12 input-field">
                        <input type="password" id="password" name="password" required>

                        <span toggle="#password" class="field-icon toggle-password"><span class="material-icons">visibility</span></span>
                    </div>
                    <div class="col s12">
                        <button type="submit" class="btn" name="save">Salvar <i class="material-icons">send</i></button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>

<?php require_once("inc/views/footer.inc.php"); ?>

</html>