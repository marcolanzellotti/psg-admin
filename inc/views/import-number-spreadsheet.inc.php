<?php
session_start();
ob_start();
if ($_POST['save'] == 'btnImport') {
    $file = $_FILES['file'];

    $primeira_linha = true;

    if ($file['type'] == "text/csv") {
        $dados_file = fopen($file['tmp_name'], "r");

        while ($line = fgetcsv($dados_file, 1000, ";")) {

            if ($primeira_linha) {
                $primeira_linha = false;
                continue;
            }
            // Busca usuário pelo numero de telefone informado na planilha
            $customer = $con->query("SELECT * FROM customers WHERE phone = '" . $line[0] . "'");
            $custom = $customer->fetch_assoc();

            // Altera campo no banco que dirá que o usuário entrou no grupo do whatsapp
            $updateCustomer = $con->query("UPDATE customers SET participating_group = 1 WHERE id = " . $custom['id']);

            if($updateCustomer){
                $_SESSION['msg'] =  "<p style='color: green;'>Importação feita com sucesso. :)</p>";
            } else {
                $_SESSION['msg'] =  "<p style='color: red;'>Falha na importação. :(</p>";
            }
        }
    } else {
        $_SESSION['msg'] =  "<p style='color: red;'>Necessário enviar um arquivo .CSV</p>";
    }
}
?>

<div class="container">
    <div class="row">
        <h5>Importar Planilha de Números</h5>
        <a href="painel.php?view=members">Lista de Usuários Plataforma</a>
        <?php
        if ($_SESSION['msg']) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="row">
                <div class="col m6 s12 input-field">
                    <span style="font-style: italic">(Extensão de arquivo para importação .CSV)</span><br>
                    <input type="file" name="file" id="file" accept="text/csv">
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <button type="submit" class="btn" name="save" value="btnImport">Importar <i class="material-icons">send</i></button>
                </div>
            </div>
        </form>
    </div>
</div>