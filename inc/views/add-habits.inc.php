<?php
//////////////// CREATE MENTOR /////////////////////////////////////////////////

if (issetPostFields(["name", "email", "phone", "createHabit"])) {
    $name = E($_POST['name']);
    $email = E($_POST['email']);
    $phone = E($_POST['phone']);
    $date = E($_POST['date']);
    $qAddHabit = $con->query("INSERT INTO habits (name, mail, phone, create_date, created_at) VALUES ('$name', '$email', '$phone', '$date', NOW())");
    if ($qAddHabit) {
        echo "<script>document.location.href=\"painel.php?view=edit_habits&habit=$con->insert_id\"</script>";
    } else {
        var_dump($con);
    }
}
?>
<div class="container z-depth-1" id="new-mentor">
    <h5>Adicionar aluna</h5>
    <?php if (isset($error)) echo "<blockquote>$error</blockquote>"; ?>
    <br />
    <form method="POST" action="">
        <input type="hidden" name="createHabit">
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
                <i class="material-icons">text_fields</i> Email
            </div>
            <div class="col m6 s12 ">
                <input type="email" class="text" name="email" required>
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

            <div class="col m6 s12 ">
                <i class="material-icons">date_range</i> Data
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" name="date" id="date" required>
            </div>
        </div>
        <div class="row">

            <div class="col s12">
                <button type="submit" class="btn" name="save">Salvar <i class="material-icons">send</i></button>
            </div>
        </div>



    </form>
</div>