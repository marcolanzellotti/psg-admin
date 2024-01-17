<?php

if (issetPostFields(['createCategories', 'category'])) {

    $idUser = $_SESSION['idUser'];
    $category = E($_POST['category']);

    $qAddCategory = $con->query(
        "INSERT INTO categories_trainning_mentor (
                                    title, 
                                    createdAt, 
                                    createdBy
                            ) VALUES (
                                    '$category', 
                                    NOW(), 
                                    $idUser)"
    );

    if ($qAddCategory) {
        $ok = 1;
        $msg = "Registro inserido com sucesso!";
    } else {
        $ok = 0;
    }
}
?>
<div class="container">
    <h5>Cadastrar Categorias de Treinamento</h5>
    <?php if (isset($error)) echo "<blockquote>$error</blockquote>"; ?>

    <?php if ($ok) echo '<div class="alert card green lighten-4 green-text text-darken-4" id="alert_box">
                            <div class="card-content">
                                <p><i class="material-icons">check_circle</i>' . $msg . '</p>
                            </div>
                            <i class="material-icons" id="alert_close" aria-hidden="true">close</i>
                        </div>';
    ?>
    <br />
    <form method="POST" action="">
        <input type="hidden" name="createCategories">
        <div class="row">
            <div class="col m6 s12 input-field">
                <i class="material-icons prefix">edit</i>
                <input type="text" class="text" name="category" id="category" required>

                <label for="category">Nome da Categoria</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn" name="save">Salvar <i class="material-icons">send</i></button>
            </div>
        </div>
</div>
<div class="container">
    <div class="row">
        <div class="col l6 m6 s12">
            <h5>Lista de Categorias</h5>
            <?php
            $qCategories = $con->query("SELECT * FROM categories_trainning_mentor WHERE deletedAt IS NULL");

            if($qCategories->num_rows > 0){

                while ($category = $qCategories->fetch_assoc()) { ?>
                <div class="collection">
                    <div class="section" style="display: grid;">
                        <div class='collection-item'>
                            <a onclick="removeCategory('<?= $category['id']; ?>')" title="Excluir Equipe" style='cursor: pointer; color: #f00'><i class='material-icons prefix'>close</i></a>
                            <a href="?view=edit_category&category=<?= $category['id']; ?>" title="Editar Equipe" style='cursor: pointer; color: #000'><i class='material-icons prefix'>edit</i> <?= $category['title']; ?></a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>Nenhuma registro encontrado.</p>";
        }

            ?>
        </div>
    </div>
</div>
<script>
    $('#alert_close').click(function() {
        $("#alert_box").fadeOut("slow", function() {});
    });

    function removeCategory(value) {

        let text;
        if (confirm("Deseja mesmo excluir esse registro?") == true) {
            window.location.href = "?view=delete_category&delete=" + value;
        }
    }
</script>