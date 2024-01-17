<div class="container">
    <h5>Salvar nova gravação de live</h5>
    <?php if (isset($error)) echo "<blockquote>$error</blockquote>"; ?>
    <br />
    <form method="POST" action="">
        <input type="hidden" name="createLive">
        <div class="row">
            <div class="col m6 s12 ">
                <i class="material-icons">edit</i> Título
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" name="title" required>
            </div>
        </div>
        <div class="row">
            <div class="col m6 s12 ">
                Link
            </div>
            <div class="col m6 s12 ">
                <input type="text" class="text" name="url" required>
            </div>
        </div>

        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn" name="save">Salvar <i class="material-icons">send</i></button>
            </div>
        </div>
</div>