<?php
require_once("../inc/functions.inc.php");
// Page config
define("TITLE", "Painel master");
if (issetPostFields(["name", "username", "password", "createMentor"])) {
    $username = E($_POST['username']);
    $qMentor = $con->query("SELECT * FROM mentors WHERE username = '$username'");
    if ($qMentor->num_rows) {
        $error = "Já existe um mentor com o mesmo nome de usuário";
    } elseif (!($id = createMentor($_POST['name'], $_POST['username'], $_POST['password']))) {
        $error = "Erro ao criar mentor";
    } else {
        header("Location: manage-mentors.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gerenciar mentores</title>
    <?php require_once("inc/views/head.inc.php"); ?>
</head>

<body>
    <header>
        <?php require_once("inc/views/header.inc.php"); ?>
    </header>
    <main>
        <div class="container small z-depth-3 p1 mt1 white" style="padding-right:2em;">
            <h5>Criar novo mentor</h5>
            <?php if (isset($error)) echo "<blockquote>$error</blockquote>"; ?>
            <br />
            <form method="POST" action="">
                <input type="hidden" name="createMentor">
                <div class="row">

                    <div class="col s12 input-field">
                        <i class="material-icons prefix">person</i>
                        <label for="name">Nome</label>
                        <input type="text" class="text" id="name" name="name" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 input-field">
                        <i class="material-icons prefix">person</i>
                        <label for="username">Nome de usuário</label>
                        <input type="text" class="text" name="username" id="username" required>
                    </div>
                </div>

                <div class="row">

                    <div class="col s12 input-field">
                        <i class="material-icons prefix">key</i>
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" required>

                        <span toggle="#password" class="field-icon toggle-password"><span class="material-icons">visibility</span></span>
                    </div>
                    <div class="col s12">
                        <button type="submit" class="btn" name="save">Salvar <i class="material-icons">send</i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="container section small">
            <h5>Mentores</h5>
            <div class="collection">
                <?php
                $mentors = getMentors();
                foreach ($mentors as $mentor) {
                    echo "<a href=\"edit-mentor.php?id=$mentor[id]\" class=\"collection-item\">$mentor[name]</a>";
                }

                ?>
            </div>
        </div>

    </main>
</body>

<?php require_once("inc/views/footer.inc.php"); ?>

</html>