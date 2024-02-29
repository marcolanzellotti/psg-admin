<?php
$consultant = getMentor(intval($_GET['consultant']));

if (isset($_GET['toggleauthor'])) {
    $con->query("UPDATE mentors SET is_author = NOT is_author, view_habits_mentor_selection = NOT view_habits_mentor_selection WHERE id=$consultant[id]");
    echo "<script>document.location.href=\"painel.php?view=edit_mentor&mentor=$consultant[id]\"</script>";
    $consultant = getMentor(intval($_GET['consultant']));
}
if (isset($_GET['togglecoauthor'])) {
    $con->query("UPDATE mentors SET is_co_author = NOT is_co_author WHERE id=$consultant[id]");
    echo "<script>document.location.href=\"painel.php?view=edit_mentor&mentor=$consultant[id]\"</script>";
    $consultant = getMentor(intval($_GET['consultant']));
}
if (isset($_GET['togglementhor'])) {
    $con->query("UPDATE mentors SET is_mentor = NOT is_mentor WHERE id=$consultant[id]");
    echo "<script>document.location.href=\"painel.php?view=edit_mentor&mentor=$consultant[id]\"</script>";
    $consultant = getMentor(intval($_GET['consultant']));
}


if (issetPostFields(["name", "username", "password"])) {
    if ($updatedMentorId = updateMentor(intval($_GET['consultant']), [
        "name" => $_POST['name'],
        "username" => $_POST['username'],
        "email" => $_POST['email'],
        "phone" => $_POST['phone'],
        "password" => $_POST['password']
    ])) {
        $consultant = getMentor(intval($_GET['consultant']));
    } else {
        $error = "Erro ao salvar mentor";
    }
} else if (isset($_GET['delete'])) {
    $consultantId = intval($_GET['delete']);
    $qMentor = $con->query("SELECT * FROM mentors WHERE id=$consultantId");
    $consultant = $qMentor->fetch_assoc();
    if (!$consultant) {
    }

    $qCoAuthor = $con->query("SELECT * FROM mentors WHERE id=$consultant[co_author_id]");
    $coAuthor = $qCoAuthor->fetch_assoc();

    $email = $coAuthor['email'];

    $message = "<h3>Lista das alunas que pertenciam a(o) consultor(a) $consultant[name]</h3><br /><br />";
    $qHabits = $con->query("SELECT * FROM habits WHERE mentor='$consultant[username]'");

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


    $con->query("UPDATE habits SET mentor='' WHERE mentor='$consultant[username]'");

    $con->query("DELETE FROM mentors WHERE id=$consultantId");
    echo "<script>document.location.href=\"\"</script>";
}

//var_dump($consultant);die;
?>
<div class="container">
    <h5>Editar Consultor</h5>
    <?php if (isset($error)) echo "<blockquote>$error</blockquote>"; ?>
    <br />
    <form method="POST" action="">
        <div class="row">
            <div class="col m6 s12 ">
                <i class="material-icons">person</i> Nome
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" name="name" value="<?= $consultant['name'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 ">
                Usuário
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" name="username" value="<?= $consultant['username'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 ">
                Email
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" name="email" value="<?= $consultant['email'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 ">
                Whatsapp
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" id="whatsapp" name="phone" value="<?= $consultant['phone'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12">
                <i class="material-icons">key</i>Senha
            </div>
            <div class="col m6 s12 input-field">
                <input type="password" id="password" name="password" value="<?= $consultant['password'] ?>" required>

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
                $checked = $consultant[$key] ? "checked" : "";
                echo "
                <p>
                    <label>
                        <input type=\"checkbox\" $checked data-mentor=\"$consultant[id]\" data-permission=\"$key\" onchange=\"handleTogglePermission(this)\"/>
                        <span>$value</span>
                    </label>
                </p>
                ";
            }
            ?>
        </div>
        <?php

        if (($loggedMentor['master'] || 1) && !$consultant['is_author']) {
        ?>
            <div class="row">

                <div class="col s12">
                    <h5>Autor</h5>



                    <?php
                    $authors = $con->query("SELECT * FROM mentors WHERE is_author=1");
                    while ($author = $authors->fetch_assoc()) {

                        $checked = ($author['id'] == $consultant['author_id']) ? "checked" : "";
                        echo "
   <p>
    <label>
       <input  $checked data-author=\"$author[id]\" data-mentor=\"$consultant[id]\" onchange=\"handleToggleMentorAuthor(this)\" type=\"radio\"  name=\"aauthor\"/>
       <span>$author[name]</span>
     </label>
 </p>
   ";
                    }
                    ?>


                </div>

            </div>
            <?php
            if (($loggedMentor['master'] || 1) && !$consultant['is_co_author']) {  ?>
                <div class="row">

                    <div class="col s12">
                        <h5>Co-Autor</h5>


                        <?php
                        $co_authors = $con->query("SELECT * FROM mentors WHERE is_co_author='1' AND author_id=$consultant[author_id]");
                        if ($co_authors) {
                            while ($co_author = $co_authors->fetch_assoc()) {

                                $checked = ($co_author['id'] == $consultant['co_author_id']) ? "checked" : "";
                                echo "<p>
                                        <label>
                                            <input $checked data-co-author=\"$co_author[id]\" data-mentor=\"$consultant[id]\" onchange=\"handleToggleMentorCoAuthor(this)\" type=\"radio\"  name=\"coAAuthor\"/>
                                            <span>$co_author[name]</span>
                                            </label>
                                      </p>";
                            }
                        }
                        ?>

                    </div>

                </div>
                <div class="row">

                    <div class="col s12">
                        <h5>Mentor</h5>


                        <?php
                        $mentors = $con->query("SELECT * FROM mentors WHERE is_author = '0' AND is_co_author='0' AND author_id=$consultant[author_id] AND is_consultant='0'");
                        if ($mentors) {
                            while ($mentor = $mentors->fetch_assoc()) {

                                $checked = ($mentor['id'] == $consultant['mentor_id']) ? "checked" : "";
                                echo "<p>
                                        <label>
                                            <input $checked data-mentor=\"$mentor[id]\" data-consultant=\"$consultant[id]\" onchange=\"handleToggleConsultantMentor(this)\" type=\"radio\"  name=\"mentor\"/>
                                            <span>$mentor[name]</span>
                                            </label>
                                      </p>";
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
                <a class="btn red" href="?view=edit_mentor&delete=<?= $consultant['id'] ?>" name="save">Excluir <i class="material-icons">delete</i></a>
                <?php
                if ($master) {
                    if (!$consultant['is_author']) {
                        echo "<a class=\"btn blue\" href=\"?view=edit_mentor&mentor=$consultant[id]&toggleauthor\" name=\"save\">Definir como autor</a>";
                    } else {
                        echo "<a class=\"btn red\" href=\"?view=edit_mentor&mentor=$consultant[id]&toggleauthor\" name=\"save\">Remover como autor</a>";
                    }
                }
                if (!$consultant['is_co_author']) {
                    echo " <a class=\"btn blue\" href=\"?view=edit_mentor&mentor=$consultant[id]&togglecoauthor\" name=\"save\">Definir como co-autor</a>";
                } else {
                    echo " <a class=\"btn red\" href=\"?view=edit_mentor&mentor=$consultant[id]&togglecoauthor\" name=\"save\">Definir como mentor</a>";
                }
                if ($consultant['is_consultant']) {
                    echo " <a class=\"btn blue\" href=\"?view=edit_mentor&mentor=$consultant[id]&togglementhor\" name=\"save\">Definir como menthor</a>";
                }
                ?>
            </div>

        </div>


    </form>
</div>