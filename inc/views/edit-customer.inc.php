<?php
$id = intval($_GET['customer']);

$qCustomer = $con->query("SELECT * FROM customers WHERE id=$id");
$customer = $qCustomer->fetch_assoc();


if (issetPostFields(["name", "email", "phone"])) {
    $name = mysqli_escape_string($con, $_POST['name']);
    $email = mysqli_escape_string($con, $_POST['email']);
    $phone = mysqli_escape_string($con, $_POST['phone']);
    $qUpdateCustomer = $con->query("UPDATE customers SET name='$name', email='$email', phone='$phone' WHERE id=$id");

    if ($qUpdateCustomer) {
        $qCustomer = $con->query("SELECT * FROM customers WHERE id=$id");
        $customer = $qCustomer->fetch_assoc();
        echo "<script>document.location.href=\"painel.php?view=members\"</script>";
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
                <input type="text" class="text" name="name" value="<?= $customer['name'] ?>">
            </div>
        </div>

        <div class="row">
            <div class="col m6 s12 ">
                Email
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" name="email" value="<?= $customer['email'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 ">
                Whatsapp
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" name="phone" value="<?= $customer['phone'] ?>">
            </div>
        </div>







        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn" name="save">Salvar <i class="material-icons">send</i></button>

            </div>

        </div>


    </form>
</div>