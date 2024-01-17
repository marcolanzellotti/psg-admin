<?php
$id = intval($_GET['habit']);

$qHabit = $con->query("SELECT * FROM habits WHERE id=$id");
$habit = $qHabit->fetch_assoc();
$author_ = "";

if (isset($_GET['toggleauthor'])) {
    $con->query("UPDATE mentors SET is_author = NOT is_author, view_habits_mentor_selection = NOT view_habits_mentor_selection WHERE id=$habit[id]");
    echo "<script>document.location.href=\"painel.php?view=edit_mentor&mentor=$habit[id]\"</script>";
    $habit = getMentor(intval($_GET['mentor']));
}
if (isset($_GET['togglecoauthor'])) {
    $con->query("UPDATE habits SET is_co_author = NOT is_co_author WHERE id=$habit[id]");
    echo "<script>document.location.href=\"painel.php?view=edit_mentor&mentor=$habit[id]\"</script>";
    $habit = getMentor(intval($_GET['mentor']));
}


if (issetPostFields(["name", "email", "phone"])) {
    $name = mysqli_escape_string($con, $_POST['name']);
    $email = mysqli_escape_string($con, $_POST['email']);
    $phone = mysqli_escape_string($con, $_POST['phone']);
    $qUpdateHabit = $con->query("UPDATE habits SET name='$name', mail='$email', phone='$phone' WHERE id=$id");
    if ($qUpdateHabit) {
        echo "<script>document.location.href=\"painel.php?view=edit_habits&habit=$habit[id]\"</script>";
    }
} else if (isset($_GET['delete'])) {
    deleteMentor(intval($_GET['delete']));
    echo "<script>document.location.href=\"/psg-admin/painel.php?view=master_area\"</script>";
}
?>
<div class="container">
    <h5>Editar aluna</h5>
    <?php if (isset($error)) echo "<blockquote>$error</blockquote>"; ?>
    <br />
    <form method="POST" action="">
        <div class="row">
            <div class="col m6 s12 ">
                <i class="material-icons">person</i> Nome
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" name="name" value="<?= $habit['name'] ?>">
            </div>
        </div>

        <div class="row">
            <div class="col m6 s12 ">
                Email
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" name="email" value="<?= $habit['mail'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 ">
                Whatsapp
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" id="whatsapp" name="phone" value="<?= $habit['phone'] ?>">
            </div>
        </div>



        <div class="row">

            <div class="col s12">
                <h5>Autor</h5>



                <?php
                $authors = $con->query("SELECT * FROM mentors WHERE is_author=1");
                while ($author = $authors->fetch_assoc()) {
                    $checked = [];
                    $checked[$habit['author']] = "checked";
                    $name = $author['name'];
                    if ($checked[$name]) {
                        $author_ = $name;
                    }

                    echo "
               <p>
                <label>
                   <input name=\"group-$habit[id]\" $checked[$name] data-id=\"$habit[id]\" data-author=\"$name\" onchange=\"handleMarcoJulie(this)\" type=\"radio\"  />
                   <span>$name</span>
                 </label>
             </p>
               ";
                }
                ?>


            </div>

        </div>

        <div class="row">

            <div class="col s12">
                <h5>Co-Autor</h5>

                <?php

                $co_authors = $con->query("SELECT * FROM mentors WHERE is_co_author=1 AND author_id=(SELECT id FROM mentors WHERE name='$habit[author]')");

                if ($co_authors) {
                    while ($co_author = $co_authors->fetch_assoc()) {

                        $checked = ($co_author['id'] == $habit['co_author']) ? "checked" : "";
                        echo "
   <p>
    <label>
       <input $checked data-co-author=\"$co_author[id]\" data-habit=\"$habit[id]\" onchange=\"handleToggleHabitCoAuthor(this)\" type=\"radio\"  name=\"coAAuthor\"/>
       <span>$co_author[name]</span>
     </label>
 </p>
   ";
                    }
                } else {
                    echo "ERR";
                }
                ?>

            </div>

            <div class="col s12">
                <h5>Mentor</h5>

                <?php
                $qMentors = $con->query("SELECT * FROM mentors WHERE co_author_id=$habit[co_author]");

                echo "
            <td>
               <select name=\"mentors\" onchange=\"handleChangeMentor(this)\" data-id=\"$habit[id]\">
               <option value=\"\">Selecionar</option>\n
               ";
                while ($mentor = $qMentors->fetch_assoc()) {

                    $selected = ($habit['mentor'] == $mentor['username']) ? " selected" : "";
                    echo "<option value=\"$mentor[username]\"$selected>$mentor[name]</option>\n";
                }

                if (!$habit['mentor']) $habit['mentor'] = "<b style=\"color:red;\">Não selecionado</b>";

                echo "
               </select>
            </td>
          
            ";
                ?>

            </div>

        </div>

        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn" name="save">Salvar <i class="material-icons">send</i></button>

            </div>

        </div>


    </form>
</div>