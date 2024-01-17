<?php

$platform_site = $con->query("SELECT * FROM platform_site");

$colors = [
    [
        'valor' => '#FFD700',
        'descricao' => 'Amarelo'
    ],
    [
        'valor' => '#0071c5',
        'descricao' => 'Azul Turquesa'
    ],
    [
        'valor' => '#FF4500',
        'descricao' => 'Laranja'
    ],
    [
        'valor' => '#8B4513',
        'descricao' => 'Marron'
    ],
    [
        'valor' => '#1C1C1C',
        'descricao' => 'Preto'
    ],
    [
        'valor' => '#436EEE',
        'descricao' => 'Royal Blue'
    ],
    [
        'valor' => '#A020F0',
        'descricao' => 'Roxo'
    ],
    [
        'valor' => '#40E0D0',
        'descricao' => 'Turquesa'
    ],
    [
        'valor' => '#228B22',
        'descricao' => 'Verde'
    ],
    [
        'valor' => '#8B0000',
        'descricao' => 'Vermelho'
    ]
];

$titleForm = "Cadastro de ";
$btn = "btnSave";

if ($_GET['id']) {
    $query_event = $con->query("SELECT * FROM events WHERE id = {$_GET['id']}");
    $event = $query_event->fetch_array();
    $titleForm = "Editar ";
    $btn = "btnEdit";

    if ($_POST['save'] == 'btnEdit') {
        $platform_site = E($_POST['platform_site']);
        $titleEvent = E(utf8_decode($_POST['titleEvent']));
        $descriptionEvent = E(utf8_decode($_POST['descriptionEvent']));
        $color = E($_POST['color']);
        $dateStart = E($_POST['dateStart']);
        $dateEnd = E($_POST['dateEnd']);

        $result = $con->query("UPDATE events SET id_platform='$platform_site', title='$titleEvent', description='$descriptionEvent', color='$color', start='$dateStart', end='$dateEnd' WHERE id={$_GET['id']}");
        if($result){
            echo "<script>document.location.href=\"painel.php?view=list_events\"</script>";
            $_SESSION['msg'] = "Evento editado com sucesso!";
            $_SESSION['style'] = "alert alert-success";
        }
    }
} else {
    if (issetPostFields(["platform_site", "titleEvent", "descriptionEvent", "dateStart", "dateEnd"])) {
        $platform_site = E($_POST['platform_site']);
        $titleEvent = E(utf8_decode($_POST['titleEvent']));
        $descriptionEvent = E(utf8_decode($_POST['descriptionEvent']));
        $color = E($_POST['color']);
        $dateStart = E($_POST['dateStart']);
        $dateEnd = E($_POST['dateEnd']);

        $qAddEvent = $con->query("INSERT INTO events (id_platform, title, description, color, start, end) 
                              VALUES ('$platform_site', '$titleEvent', '$descriptionEvent', '$color','$dateStart', '$dateEnd')");
        if ($qAddEvent) {
            echo "<script>document.location.href=\"painel.php?view=list_events\"</script>";
            $_SESSION['msg'] = "Evento cadastrado com sucesso!";
            $_SESSION['style'] = "alert alert-success";
        } else {
            var_dump($con);
        }
    }
}
?>

<div class="container">
    <div class="row">
        <h5><?= $titleForm ?> Evento</h5>
        <a href="painel.php?view=list_events">Lista de Eventos</a>
        <form method="POST" action="">
            <div class="row">
                <div class="col m6 s12 input-field">
                    <i class="material-icons prefix">edit</i>
                    <select name="platform_site" id="platform_site">
                        <option value="0">Selecione uma Plataforma</option>
                        <?php
                        while ($platform = $platform_site->fetch_assoc()) {
                            if ($platform['id'] == $event['id_platform']) {
                                echo '<option value="' . $platform['id'] . '" selected>' . $platform['title'] . '</option>';
                            } else {
                                echo '<option value="' . $platform['id'] . '">' . $platform['title'] . '</option>';
                            }
                        ?>

                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col m6 s12 input-field">
                    <i class="material-icons prefix">edit</i>
                    <select name="color" id="color">
                        <option value="0">Selecione uma cor</option>
                        <?php
                        foreach ($colors as $color) {
                            if ($color['valor'] == $event['color']) {
                                echo '<option style="color: ' . $color['valor'] . '" value="' . $color['valor'] . '" selected>' . $color['descricao'] . '</option>';
                            } else {
                                echo '<option style="color: ' . $color['valor'] . '" value="' . $color['valor'] . '">' . $color['descricao'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col m6 s12 input-field">
                    <i class="material-icons prefix">list_alt</i>
                    <input type="text" name="titleEvent" id="titleEvent" placeholder="Titulo do Evento" value="<?= utf8_encode($event['title']); ?>">
                </div>
                <div class="col m6 s12 input-field">
                    <i class="material-icons prefix">list_alt</i>
                    <input type="text" name="descriptionEvent" id="descriptionEvent" placeholder="Descrição do Evento" value="<?= utf8_encode($event['description']); ?>">
                </div>
            </div>
            <div class="row">

                <div class="col m6 s12">
                    <i class="material-icons prefix">calendar_month</i>
                    <label for="dateStart">Data Inicio</label>
                    <input type="datetime-local" name="dateStart" id="dateStart" placeholder="Titulo do Evento" value="<?= $event['start']; ?>">
                </div>
                <div class="col m6 s12">
                    <i class="material-icons prefix">calendar_month</i>
                    <label for="dateEnd">Data Fim</label>
                    <input type="datetime-local" name="dateEnd" id="dateEnd" placeholder="Titulo do Evento" value="<?= $event['end']; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <button type="submit" class="btn" name="save" value="<?= $btn ?>">Salvar <i class="material-icons">send</i></button>
                </div>
            </div>
        </form>
    </div>
</div>