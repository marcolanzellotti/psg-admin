<?php
$id = intval($_GET['subscription']);

$qSubscription = $con->query("SELECT * FROM subscriptions WHERE id=$id");
$subscription = $qSubscription->fetch_assoc();


if (issetPostFields(["name", "email", "phone"])) {
    $name = mysqli_escape_string($con, $_POST['name']);
    $email = mysqli_escape_string($con, $_POST['email']);
    $phone = mysqli_escape_string($con, $_POST['phone']);
    $qUpdateSubscription = $con->query("UPDATE subscriptions SET name='$name', mail='$email', phone='$phone' WHERE id=$id");

    if ($qUpdateSubscription) {
        $qSubscription = $con->query("SELECT * FROM subscriptions WHERE id=$id");
        $subscription = $qSubscription->fetch_assoc();
        echo "<script>document.location.href=\"painel.php?view=subscriptions\"</script>";
    }
}
?>
<div class="container">
    <h5>Editar inscrição</h5>
    <?php if (isset($error)) echo "<blockquote>$error</blockquote>"; ?>
    <br />
    <form method="POST" action="">
        <div class="row">
            <div class="col m6 s12 ">
                <i class="material-icons">person</i> Nome
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" name="name" value="<?= $subscription['name'] ?>">
            </div>
        </div>

        <div class="row">
            <div class="col m6 s12 ">
                Email
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" name="email" value="<?= $subscription['mail'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 ">
                Whatsapp
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" id="whatsapp" name="phone" value="<?= $subscription['phone'] ?>">
            </div>
        </div>







        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn" name="save">Salvar <i class="material-icons">send</i></button>

            </div>

        </div>


    </form>
</div>