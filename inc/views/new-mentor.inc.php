<?php
//////////////// CREATE MENTOR /////////////////////////////////////////////////

if (issetPostFields(["name", "username", "password", "createMentor"])) {
    $username = E($_POST['username']);
    $email = E($_POST['email']);
    $phone = E($_POST['phone']);
    $level = E($_POST['level']);
    $author = E($_POST['author']);

    $qUsername = $con->query("SELECT id FROM mentors WHERE username='$username'");
    if ($qUsername->num_rows) {
        $error = "Já existe um mentor com o mesmo nome de usuário";
    } elseif (!($id = createMentor($_POST['name'], $username, $email, $phone, $_POST['password'], $level, $author))) {
        $error = "Erro ao criar mentor";
    } else {

        echo "<script>document.location.href='/psg-admin/painel.php?view=edit_mentor&mentor=$id'</script>";
    }
}
?>
<div class="container z-depth-1" id="new-mentor">
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
                <i class="material-icons">text_fields</i> Usuário
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" name="username" required>
            </div>
        </div>
        <div class="row">

            <div class="col m6 s12 ">
                <i class="material-icons">email</i> Email
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" name="email" required>
            </div>
        </div>
        <div class="row">

            <div class="col m6 s12 ">
                <i class="material-icons">phone</i> Whatsapp
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" name="phone" id="whatsapp" required>
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

        <h5>Autor</h5>
        <?php
        $qAuthors = $con->query("SELECT * FROM mentors WHERE is_author=1");
        while ($author = $qAuthors->fetch_assoc()) {

            $checked = ($author['id'] == "8") ? "checked" : "";

        ?>
            <p>
                <label>
                    <input <?= $checked ?> value="<?= $author['id'] ?>" type="radio" name="author" />
                    <span><?= $author['name'] ?></span>
                </label>
            </p>
        <?php
        }
        ?>


        <h5>Nivel</h5>

        <p>
            <label>
                <input type="radio" name="level" value="mentor" id="" checked>
                <span>Mentor</span>
            </label>
        </p>
        <p>
            <label>
                <input type="radio" name="level" value="co-author" id="">
                <span>Co-autor</span>
            </label>
        </p>


    </form>
</div>