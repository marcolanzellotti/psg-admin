<?php
if (isset($_FILES['file'])) {
    $filename = $_FILES['file']['tmp_name'];
    if (!move_uploaded_file($filename, "/home1/eudesa99/fase2.planosecagordura.com.br/assets/img/calendario3.png")) {
        echo "err";
    } else {
        echo "Atualizado";
    }
}


?>
<div class="container section">
    <h5>Calendário</h5>

    <form id="upload-calendar-form" action="" method="POST" enctype="multipart/form-data">
        <div class="file-field input-field">
            <div class="btn">
                <span>Carregar imagem</span>
                <input type="file" name="file" id="file">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" style="visibility: hidden;" name="file" type="text">
            </div>
        </div>
    </form>
    <img src="https://fase2.planosecagordura.com.br/assets/img/calendario3.png" style="width: 400px;max-width:100%;" alt="">
</div>
<script>
    document.getElementById("file").addEventListener("change", e => {
        document.getElementById("upload-calendar-form").submit();
    })
</script>