<?php
$platform_site = $pCon->query("SELECT * FROM platform_site");
?>

<div class="container">
    <h5>Gerenciamento Maratona</h5>
    <a href="painel.php?view=platform_marathon_list">Lista de Plataformas</a>
    <?php if (isset($error)) echo "<blockquote>$error</blockquote>"; ?>

    <?php if ($ok) echo '<div class="alert card green lighten-4 green-text text-darken-4" id="alert_box">
                            <div class="card-content">
                                <p><i class="material-icons">check_circle</i>' . $msg . '</p>
                            </div>
                            <i class="material-icons" id="alert_close" aria-hidden="true">close</i>
                        </div>';
    ?>
    <br />
    <form method="POST" action="inc/views/processa.inc.php" enctype="multipart/form-data">
        <div class="row">
            <div class="col m6 s12 input-field">
                <i class="material-icons prefix">edit</i>
                <select name="platform_site" id="platform_site">
                    <option value="0">Selecione uma Plataforma</option>
                    <?php
                    while ($platform = $platform_site->fetch_assoc()) {
                    ?>
                        <option value="<?= $platform['id']; ?>"><?= $platform['title']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <h5>Videos Topo</h5>
            <div class="row" id="boxCamposVideoTopo">
                <div class="col m3 s12 input-field">
                    <i class="material-icons prefix">edit</i>
                    <input type="text" class="text" name="titleVideoTopo[]" id="titleVideoTopo" required>
                    <label for="titleVideoTopo">Título</label>
                </div>
                <div class="col m4 s12 input-field">
                    <i class="material-icons prefix">edit</i>
                    <input type="text" class="text" name="descriptionVideoTopo[]" id="descriptionVideoTopo" required>
                    <label for="descriptionVideoTopo">Descrição</label>
                </div>
                <div class="col m4 s12 input-field">

                    <i class="material-icons prefix">web</i>
                    <input type="text" class="text" name="urlVideoTopo[]" id="urlVideoTopo" required>
                    <label for="urlVideoTopo">Link</label>
                </div>
                <div class="col m1 s12 input-field">
                    <button type="button" class="btn" name="save" onclick="adicionarCamposVideoTopo();">+</button>
                </div>
            </div>
        </div>
        <div class="row">
            <h5>Videos Rodapé</h5>
            <div class="row" id="boxCamposVideoRodape">
                <div class="col m3 s12 input-field">
                    <i class="material-icons prefix">edit</i>
                    <input type="text" class="text" name="titleVideoRodape[]" id="titleVideoRodape" required>

                    <label for="titleVideoRodape">Título</label>
                </div>
                <div class="col m4 s12 input-field">
                    <i class="material-icons prefix">edit</i>
                    <input type="text" class="text" name="descriptionVideoRodape" id="descriptionVideoRodape" required>

                    <label for="descriptionVideoRodape">Descrição</label>
                </div>
                <div class="col m4 s12 input-field">

                    <i class="material-icons prefix">web</i>
                    <input type="text" class="text" name="urlVideoRodape" id="urlVideoRodape" required>
                    <label for="urlVideoRodape">Link</label>
                </div>
                <div class="col m1 s12 input-field">
                    <button type="button" class="btn" name="save" onclick="adicionarCamposVideoRodape();">+</button>
                </div>
            </div>
        </div>
        <div class="row">
            <h5>Calendário</h5>
            <div class="form-group">
                <div class="col m6 s12 input-field">
                    <i class="material-icons prefix">web</i>
                    <input type="text" class="text" name="titleCalendar" id="titleCalendar" required>
                    <label for="titleCalendar">Titulo</label>
                </div>
                <div class="file-field input-field col m5 s12">
                    <div class="btn">
                        <span>Carregar Calendário</span>
                        <input type="file" name="fileCalendar" id="fileCalendar">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h5>Ebook's</h5>
            <div class="row" id="boxCamposArquivosEbooks">
                <div class="form-group">
                    <div class="col m6 s12 input-field">
                        <i class="material-icons prefix">web</i>
                        <input type="text" class="text" name="titleEbooks[]" id="titleEbooks" required>
                        <label for="titleEbooks">Titulo</label>
                    </div>
                    <div class="file-field input-field col m5 s12">
                        <div class="btn">
                            <span>Carregar Arquivo</span>
                            <input type="file" name="fileEbooks[]" id="fileEbooks" accept="application/pdf,application/vnd.ms-excel">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                    <div class="col m1 s12 input-field">
                        <button type="button" class="btn" name="save" onclick="adicionarCamposEbooks();">+</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h5>Bônus</h5>
            <div class="row" id="boxCamposArquivosBonus">
                <div class="form-group">
                    <div class="col m6 s12 input-field">
                        <i class="material-icons prefix">web</i>
                        <input type="text" class="text" name="titleBonus[]" id="titleBonus" required>
                        <label for="titleBonus">Titulo</label>
                    </div>
                    <div class="file-field input-field col m5 s12">
                        <div class="btn">
                            <span>Carregar Arquivo</span>
                            <input type="file" name="fileBonus[]" id="fileBonus" accept="application/pdf,application/vnd.ms-excel">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                    <div class="col m1 s12 input-field">
                        <button type="button" class="btn" name="save" onclick="adicionarCamposBonus();">+</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h5>Material VIP</h5>
            <div class="row" id="boxCamposArquivosMaterialVip">
                <div class="form-group">
                    <div class="col m6 s12 input-field">
                        <i class="material-icons prefix">web</i>
                        <input type="text" class="text" name="titleMaterialVip[]" id="titleMaterialVip" required>
                        <label for="titleMaterialVip">Titulo</label>
                    </div>
                    <div class="file-field input-field col m5 s12">
                        <div class="btn">
                            <span>Carregar Arquivo</span>
                            <input type="file" name="fileMaterialVip[]" id="fileMaterialVip" accept="application/pdf,application/vnd.ms-excel">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                    <div class="col m1 s12 input-field">
                        <button type="button" class="btn" name="save" onclick="adicionarCamposMaterialVip();">+</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn" name="save">Salvar <i class="material-icons">send</i></button>
            </div>
        </div>
</div>
<script src="././assets/js/custom.js"></script>
<script>
    $('#alert_close').click(function() {
        $("#alert_box").fadeOut("slow", function() {});
    });
</script>