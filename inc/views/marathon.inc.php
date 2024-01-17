<div class="container">
    <?php
    if (isset($_FILES['image'])) {
        $image = $_FILES['image'];

        if (move_uploaded_file($image['tmp_name'], "../maratona_/assets/img/calendar.png")) {
        } else {
        }
    }
    ?>
    <h5>Maratona</h5>
    <div class="section z-depth-3 p1">
        <h5>Calendário</h5>
        <img src="/maratona_/assets/img/calendar.png" alt="" style="width: 300px;max-width:98%;" class="materialboxed z-depth-3">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="file-field input-field col m6 s12">
                    <div class="btn">
                        <span>Carregar calendário</span>
                        <input type="file" name="image" accept="image/*">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
                <div class="col m12 s12">
                    <button type="submit" class="btn blue">Salvar</button>
                </div>
            </div>
        </form>
    </div>


</div>