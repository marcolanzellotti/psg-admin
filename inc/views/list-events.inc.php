<?php
$events = $con->query("SELECT e.*, ps.title AS plataforma FROM events e
                       INNER JOIN platform_site ps
                       ON e.id_platform = ps.id");

// if (issetPostFields(["platform_site", "titleEvent", "dateStart", "dateEnd"])) {
//     $platform_site = E($_POST['platform_site']);
//     $titleEvent = E($_POST['titleEvent']);
//     $color = E($_POST['color']);
//     $dateStart = E($_POST['dateStart']);
//     $dateEnd = E($_POST['dateEnd']);

//     $qAddEvent = $con->query(
//         "  INSERT INTO events (id_platform, title, color, start, end) 
//                                 VALUES ('$platform_site', '$titleEvent', '$color','$dateStart', '$dateEnd')"
//     );
//     if ($qAddEvent) {

//         //var_dump($con->insert_id);
//         echo "<script>document.location.href=\"painel.php?view=list_events&event=$con->insert_id\"</script>";
//     } else {
//         var_dump($con);
//     }
// }
?>

<style>
    .alert-success {
        color: #0f5132;
        background-color: #d1e7dd;
        border-color: #badbcc;
    }

    .alert {
        position: relative;
        padding: 1rem 1rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 0.25rem;
    }

    .alert-danger {
        color: #842029;
        background-color: #f8d7da;
        border-color: #f5c2c7;
    }

    .alert {
        position: relative;
        padding: 1rem 1rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 0.25rem;
    }
</style>

<div class="container">
    <div class="row">
        <h5>Lista de Eventos</h5>
        <?php
        if ($_SESSION['msg']) {
            echo "<p class='" . $_SESSION['style'] . "'>" . $_SESSION['msg'] . "</p>";
            unset($_SESSION['msg']);
            unset($_SESSION['style']);
        }
        ?>
        <a href="painel.php?view=create_events">Cadastro de Eventos</a>
        <table class="highlight">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Plataforma</th>
                    <th>Titulo do Evento</th>
                    <th>Descrição</th>
                    <th>Cor</th>
                    <th>Data Inicio</th>
                    <th>Data Fim</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($event = $events->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?= $event['id'] ?></td>
                        <td><?= $event['plataforma'] ?></td>
                        <td><?= utf8_encode($event['title']) ?></td>
                        <td><?= utf8_encode($event['description']) ?></td>
                        <td>
                            <div style="width: 20px; height: 20px; background-color: <?= $event['color'] ?>;"></div>
                        </td>
                        <td><?= formateDatePtBr($event['start']); ?></td>
                        <td><?= formateDatePtBr($event['end']); ?></td>
                        <td>
                            <a href="painel.php?view=create_events&id=<?= $event['id'] ?>">Editar</a>
                            <a href="#" onclick="deleteEvent(<?= $event['id'] ?>);">Excluir</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>