<?php
require_once("../inc/functions.inc.php");
// Page config
define("TITLE", "Painel master");


if (isset($_POST['whatsapp_subscriptions'])) {
    setWhatsappSubscriptionUrl($_POST['whatsapp_subscriptions']);
}


$whatsappSubscriptions = getWhatsappSubscriptionUrl();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ficha de inscrição</title>
    <?php require_once("./inc/views/head.inc.php"); ?>
</head>

<body>
    <header>
        <?php require_once("./inc/views/header.inc.php"); ?>
    </header>
    <main>
        <div class="container section">

            <h4>Redirecionamentos</h4>
            <!-- <h5>Link do Whatsapp</h5>
            <form action="" method="POST">
                <div class="row">
                    <input type="text" name="whatsapp_subscriptions" class="col m6 s12" value="<?= $whatsappSubscriptions ?>" id="">
                    <button class="btn waves-effect waves-light col" type="submit" value="submit" name="whatsapp_save">Salvar
                        <i class="material-icons right">send</i>
                    </button>

                </div>
            </form> -->
        </div>
        <div class="container section">
            <?php
            if (issetPostFields(['redirect', 'redirect_save_group'])) {
                $url = E($_POST['redirect']);
                $qUpdateRedirect = $con->query("UPDATE redirects SET dest='$url' WHERE id=1");
            }

            $qRedirect = $con->query("SELECT * FROM redirects WHERE id=1");

            $redirect = $qRedirect->fetch_assoc();
            $redirectUrl = $redirect['dest'];


            ?>
            <h5>Grupo</h5> (<a href="https://planosecagordura.com.br/whatsapp.php?i=<?= $redirect['id'] ?>">https://planosecagordura.com.br/whatsapp.php?i=<?= $redirect['id'] ?></a>)
            <form action="" method="POST">
                <div class="row">
                    <input type="hidden" value="<?= $redirect['id'] ?>" name="id">
                    <input type="text" name="redirect" class="col m6 s12" value="<?= $redirectUrl ?>" id="">
                    <button class="btn waves-effect waves-light col" type="submit" value="submit" name="redirect_save_group">Salvar
                        <i class="material-icons right">send</i>
                    </button>

                </div>
            </form>
        </div>



        <div class="container section">
            <?php
            if (issetPostFields(['redirect', 'redirect_save_live'])) {
                $url = E($_POST['redirect']);
                $qUpdateRedirect = $con->query("UPDATE redirects SET dest='$url' WHERE id=2");
            }

            $qRedirect = $con->query("SELECT * FROM redirects WHERE id=2");

            $redirect = $qRedirect->fetch_assoc();
            $redirectUrl = $redirect['dest'];


            ?>
            <h5>Mentoria</h5> (<a target="_blank" href="https://planosecagordura.com.br/mentoria/">https://planosecagordura.com.br/mentoria/</a>)
            <form action="" method="POST">
                <div class="row">
                    <input type="hidden" value="<?= $redirect['id'] ?>" name="id">
                    <input type="text" name="redirect" class="col m6 s12" value="<?= $redirectUrl ?>" id="">
                    <button class="btn waves-effect waves-light col" type="submit" value="submit" name="redirect_save_live">Salvar
                        <i class="material-icons right">send</i>
                    </button>

                </div>
            </form>
        </div>
    </main>
</body>

<?php require_once("./inc/views/footer.inc.php"); ?>

</html>