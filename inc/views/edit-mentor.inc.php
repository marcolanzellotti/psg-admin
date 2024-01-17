<?php
$mentor = getMentor(intval($_GET['mentor']));
if (isset($_GET['toggleauthor'])) {
    $con->query("UPDATE mentors SET is_author = NOT is_author, view_habits_mentor_selection = NOT view_habits_mentor_selection WHERE id=$mentor[id]");
    echo "<script>document.location.href=\"painel.php?view=edit_mentor&mentor=$mentor[id]\"</script>";
    $mentor = getMentor(intval($_GET['mentor']));
}
if (isset($_GET['togglecoauthor'])) {
    $con->query("UPDATE mentors SET is_co_author = NOT is_co_author WHERE id=$mentor[id]");
    echo "<script>document.location.href=\"painel.php?view=edit_mentor&mentor=$mentor[id]\"</script>";
    $mentor = getMentor(intval($_GET['mentor']));
}


if (issetPostFields(["name", "username", "password"])) {
    if ($updatedMentorId = updateMentor(intval($_GET['mentor']), [
        "name" => $_POST['name'],
        "username" => $_POST['username'],
        "email" => $_POST['email'],
        "phone" => $_POST['phone'],
        "password" => $_POST['password']
    ])) {
        $mentor = getMentor(intval($_GET['mentor']));
    } else {
        $error = "Erro ao salvar mentor";
    }
} else if (isset($_GET['delete'])) {
    $mentorId = intval($_GET['delete']);
    $qMentor = $con->query("SELECT * FROM mentors WHERE id=$mentorId");
    $mentor = $qMentor->fetch_assoc();
    if (!$mentor) {
    }

    $qCoAuthor = $con->query("SELECT * FROM mentors WHERE id=$mentor[co_author_id]");
    $coAuthor = $qCoAuthor->fetch_assoc();

    $email = $coAuthor['email'];

    $message = "<h3>Lista das alunas que pertenciam a(o) mentor(a) $mentor[name]</h3><br /><br />";
    $qHabits = $con->query("SELECT * FROM habits WHERE mentor='$mentor[username]'");

    $message .= "<table>";
    while ($habit = $qHabits->fetch_assoc()) {
        $message .= "<tr>";
        $message .= "<td>$habit[name]</td><td>$habit[phone]</td>";
        $message .= "</tr>";
    }
    $message .= "</table>";

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); // enable SMTP
    //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "br174.hostgator.com.br";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "contato@planosecagordura.com.br";
    $mail->Password = "Lanz@822153";
    $mail->SetFrom("contato@planosecagordura.com.br");
    $mail->Subject = "Atualizacao do seu acesso";
    $mail->Body = $message;
    $mail->AddAddress("mlanzellotti.rj@gmail.com");
    $mail->AddAddress("mlanzellotti.rj@gmail.com");
    $mail->AddAddress($email);

    if (!($mail->Send())) {
        die($mail->ErrorInfo);
    }


    $con->query("UPDATE habits SET mentor='' WHERE mentor='$mentor[username]'");

    $con->query("DELETE FROM mentors WHERE id=$mentorId");
    echo "<script>document.location.href=\"\"</script>";
}
?>
<div class="container">
    <h5>Editar mentor</h5>
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

            <?php
            $terms = [
                "view_subscriptions" => "Acesso inscrições (PSG)",
                "view_updates" => "Acesso atualizações (PSG)",
                "view_analysis" => "Acesso análise (PSG)",
                "view_weekly_updates" => "Acesso atualização semanal",
                "view_habits" => "Acesso ficha de hábitos"
            ];
            foreach ($terms as $key => $value) {
                $checked = $mentor[$key] ? "checked" : "";
                echo "
                <p>
                    <label>
                        <input type=\"checkbox\" $checked data-mentor=\"$mentor[id]\" data-permission=\"$key\" onchange=\"handleTogglePermission(this)\"/>
                        <span>$value</span>
                    </label>
                </p>
                ";
            }
            ?>
        </div>
        <?php

        if (($loggedMentor['master'] || 1) && !$mentor['is_author']) {
        ?>
            <div class="row">

                <div class="col s12">
                    <h5>Autor</h5>



                    <?php
                    $authors = $con->query("SELECT * FROM mentors WHERE is_author=1");
                    while ($author = $authors->fetch_assoc()) {

                        $checked = ($author['id'] == $mentor['author_id']) ? "checked" : "";
                        echo "
   <p>
    <label>
       <input  $checked data-author=\"$author[id]\" data-mentor=\"$mentor[id]\" onchange=\"handleToggleMentorAuthor(this)\" type=\"radio\"  name=\"aauthor\"/>
       <span>$author[name]</span>
     </label>
 </p>
   ";
                    }
                    ?>


                </div>

            </div>
            <?php
            if (($loggedMentor['master'] || 1) && !$mentor['is_co_author']) {  ?>
                <div class="row">

                    <div class="col s12">
                        <h5>Co-Autor</h5>


                        <?php
                        $co_authors = $con->query("SELECT * FROM mentors WHERE is_co_author='1' AND author_id=$mentor[author_id]");
                        if ($co_authors) {
                            while ($co_author = $co_authors->fetch_assoc()) {

                                $checked = ($co_author['id'] == $mentor['co_author_id']) ? "checked" : "";
                                echo "
   <p>
    <label>
       <input $checked data-co-author=\"$co_author[id]\" data-mentor=\"$mentor[id]\" onchange=\"handleToggleMentorCoAuthor(this)\" type=\"radio\"  name=\"coAAuthor\"/>
       <span>$co_author[name]</span>
     </label>
 </p>
   ";
                            }
                        }
                        ?>

                    </div>

                </div>
        <?php
            }
        }
        ?>
        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn" name="save">Salvar <i class="material-icons">send</i></button>
                <a class="btn red" href="?view=edit_mentor&delete=<?= $mentor['id'] ?>" name="save">Excluir <i class="material-icons">delete</i></a>
                <?php
                if ($master) {
                    if (!$mentor['is_author']) {
                        echo "<a class=\"btn blue\" href=\"?view=edit_mentor&mentor=$mentor[id]&toggleauthor\" name=\"save\">Definir como autor</a>";
                    } else {
                        echo "<a class=\"btn red\" href=\"?view=edit_mentor&mentor=$mentor[id]&toggleauthor\" name=\"save\">Remover como autor</a>";
                    }
                }
                if (!$mentor['is_co_author']) {
                    echo " <a class=\"btn blue\" href=\"?view=edit_mentor&mentor=$mentor[id]&togglecoauthor\" name=\"save\">Definir como co-autor</a>";
                } else {
                    echo " <a class=\"btn red\" href=\"?view=edit_mentor&mentor=$mentor[id]&togglecoauthor\" name=\"save\">Definir como mentor</a>";
                }
                ?>
            </div>

        </div>


    </form>
</div>