<?php
$qMentor = $con->query("SELECT * FROM mentors WHERE username='$_SESSION[mentor]'");
$mentor = $qMentor->fetch_assoc();


if (issetPostFields(["name", "username", "password"])) {
    if ($updatedMentorId = updateMentor(intval($mentor['id']), [
        "name" => $_POST['name'],
        "username" => $_POST['username'],
        "email" => $_POST['email'],
        "phone" => $_POST['phone'],
        "password" => $_POST['password']
    ])) {
        $mentor = getMentor(intval($mentor['id']));
    } else {
        $error = "Erro ao salvar mentor";
    }
}

?>
<div class="container">
    <h5>Perfil</h5>
    <?php if (isset($error)) echo "<blockquote>$error</blockquote>"; ?>
    <br />
    <form method="POST" action="">
        <div class="row">
            <div class="col m6 s12 ">
                <i class="material-icons">person</i> Nome
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" name="name" value="<?= $mentor['name'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 ">
                Usuário
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" name="username" value="<?= $mentor['username'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 ">
                Email
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" name="email" value="<?= $mentor['email'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 ">
                Whatsapp
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" id="whatsapp" name="phone" value="<?= $mentor['phone'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12">
                <i class="material-icons">key</i>Senha
            </div>
            <div class="col m6 s12 input-field">
                <input type="password" id="password" name="password" value="<?= $mentor['password'] ?>" required>

                <span toggle="#password" class="field-icon toggle-password"><span class="material-icons">visibility</span></span>
            </div>
        </div>


        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn" name="save">Salvar <i class="material-icons">send</i></button>

            </div>

        </div>


    </form>
</div>