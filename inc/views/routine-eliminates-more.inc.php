<div class="container">
    <h5>Gerar Rotina Elimina +</h5>
    <form method="POST" action="inc/views/processa-export.inc.php" enctype="">
        <div class="row">
            <h5>Rotina</h5>
            <div class="col m6 s12 input-field">
                <i class="material-icons prefix">edit</i>
                <select name="rotina" id="rotina">
                    <option value="0">Selecione uma Rotina</option>
                    <option value="1">Elimina +</option>
                    <option value="2">Maratona</option>
                    <option value="3">Alimentar</option>
                </select>
            </div>
        </div>
        <div class="row">
            <h5>Dados</h5>
            <div class="row">
                <div class="col m6 s12 input-field">
                    <i class="material-icons prefix">edit</i>
                    <input type="text" class="text" name="aluna" id="aluna" required>
                    <label for="aluna">Aluno(a)</label>
                </div>
                <div class="col m6 s12 input-field">
                    <i class="material-icons prefix">edit</i>
                    <input type="number" class="text" name="periodo" id="periodo" required placeholder="Em dia(s)">
                    <label for="periodo">Período (dias)</label>
                </div>
            </div>
        </div>
        <div class="row">
            <h5>Shot Matinal</h5>
            <div class="row">
                <div class="col m2 s12 input-field">
                    <i class="material-icons prefix">edit</i>
                    <input type="text" class="text" name="horarioCampo1" id="horarioCampo1">

                    <label for="horarioCampo1">Horário</label>
                </div>
            </div>
            <div class="row">
                <div class="col m11 s12 input-field">
                    <i class="material-icons prefix">edit</i>
                    <input type="text" class="text" name="titleCampo1[]" id="titleCampo1">

                    <label for="titleCampo1">Descrição</label>
                </div>
                <div class="col m1 s12 input-field">
                    <button type="button" class="btn" name="save" onclick="adicionar1();">+</button>
                </div>
            </div>
            <div class="row" id="boxCampo1"></div>
        </div>
        <div class="row">
            <h5>Café da manhã</h5>
            <div class="row">
                <div class="col m2 s12 input-field">
                    <i class="material-icons prefix">edit</i>
                    <input type="text" class="text" name="horarioCampo2" id="horarioCampo2" require>

                    <label for="horarioCampo2">Horário</label>
                </div>
            </div>
            <div class="row">
                <div class="col m11 s12 input-field">
                    <i class="material-icons prefix">web</i>
                    <input type="text" class="text" name="titleCampo2[]" id="titleCampo2" require>
                    <label for="titleCampo2">Descrição</label>
                </div>
                <div class="col m1 s12 input-field">
                    <button type="button" class="btn" name="save" onclick="adicionar2();">+</button>
                </div>
            </div>
            <div class="row" id="boxCampo2"></div>
        </div>
        <div class="row">
            <h5>Lanche da manhã</h5>
            <div class="row">
                <div class="col m2 s12 input-field">
                    <i class="material-icons prefix">edit</i>
                    <input type="text" class="text" name="horarioCampo3" id="horarioCampo3">

                    <label for="horarioCampo3">Horário</label>
                </div>
            </div>
            <div class="row">
                <div class="col m11 s12 input-field">
                    <i class="material-icons prefix">web</i>
                    <input type="text" class="text" name="titleCampo3[]" id="titleCampo3">
                    <label for="titleCampo3">Descrição</label>
                </div>
                <div class="col m1 s12 input-field">
                    <button type="button" class="btn" name="save" onclick="adicionar3();">+</button>
                </div>
            </div>
            <div class="row" id="boxCampo3"></div>
        </div>
        <div class="row">
            <h5>Almoço</h5>
            <div class="row">
                <div class="col m2 s12 input-field">
                    <i class="material-icons prefix">edit</i>
                    <input type="text" class="text" name="horarioCampo4" id="horarioCampo4" required>

                    <label for="horarioCampo4">Horário</label>
                </div>
            </div>
            <div class="row">
                <div class="col m11 s12 input-field">
                    <i class="material-icons prefix">web</i>
                    <input type="text" class="text" name="titleCampo4[]" id="titleCampo4" required>
                    <label for="titleCampo4">Descrição</label>
                </div>
                <div class="col m1 s12 input-field">
                    <button type="button" class="btn" name="save" onclick="adicionar4();">+</button>
                </div>
            </div>
            <div class="row" id="boxCampo4"></div>
        </div>
        <div class="row">
            <h5>Lanche da tarde</h5>
            <div class="row">
                <div class="col m2 s12 input-field">
                    <i class="material-icons prefix">edit</i>
                    <input type="text" class="text" name="horarioCampo5" id="horarioCampo5" required>

                    <label for="horarioCampo5">Horário</label>
                </div>
            </div>
            <div class="row">
                <div class="col m11 s12 input-field">
                    <i class="material-icons prefix">web</i>
                    <input type="text" class="text" name="titleCampo5[]" id="titleCampo5" required>
                    <label for="titleCampo5">Descrição</label>
                </div>
                <div class="col m1 s12 input-field">
                    <button type="button" class="btn" name="save" onclick="adicionar5();">+</button>
                </div>
            </div>
            <div class="row" id="boxCampo5"></div>
        </div>
        <div class="row">
            <h5>Jantar</h5>
            <div class="row">
                <div class="col m2 s12 input-field">
                    <i class="material-icons prefix">edit</i>
                    <input type="text" class="text" name="horarioCampo6" id="horarioCampo6" required>

                    <label for="horarioCampo6">Horário</label>
                </div>
            </div>
            <div class="row">
                <div class="col m11 s12 input-field">
                    <i class="material-icons prefix">web</i>
                    <input type="text" class="text" name="titleCampo6[]" id="titleCampo6" required>
                    <label for="titleCampo6">Descrição</label>
                </div>
                <div class="col m1 s12 input-field">
                    <button type="button" class="btn" name="save" onclick="adicionar6();">+</button>
                </div>
            </div>
            <div class="row" id="boxCampo6"></div>
        </div>
        <div class="row">
            <h5>Ceia</h5>
            <div class="row">
                <div class="col m2 s12 input-field">
                    <i class="material-icons prefix">edit</i>
                    <input type="text" class="text" name="horarioCampo7" id="horarioCampo7" required>

                    <label for="horarioCampo7">Horário</label>
                </div>
            </div>
            <div class="row">
                <div class="col m11 s12 input-field">
                    <i class="material-icons prefix">web</i>
                    <input type="text" class="text" name="titleCampo7[]" id="titleCampo7" required>
                    <label for="titleCampo7">Descrição</label>
                </div>
                <div class="col m1 s12 input-field">
                    <button type="button" class="btn" name="save" onclick="adicionar7();">+</button>
                </div>
            </div>
            <div class="row" id="boxCampo7"></div>
        </div>
        <div class="row">
            <h5>Considerações</h5>
            <div class="row">
                <div class="col m11 s12 input-field">
                    <i class="material-icons prefix">web</i>
                    <input type="text" class="text" name="titleCampo8[]" id="titleCampo8" required>
                    <label for="titleCampo8">Descrição</label>
                </div>
                <div class="col m1 s12 input-field">
                    <button type="button" class="btn" name="save" onclick="adicionar8();">+</button>
                </div>
            </div>
            <div class="row" id="boxCampo8"></div>
        </div>
        <div class="row">
            <h5>Hidratação Diária</h5>
            <div class="row">
                <div class="col m11 s12 input-field">
                    <i class="material-icons prefix">web</i>
                    <input type="text" class="text" name="titleCampo9[]" id="titleCampo9" required>
                    <label for="titleCampo9">Descrição</label>
                </div>
                <div class="col m1 s12 input-field">
                    <button type="button" class="btn" name="save" onclick="adicionar9();">+</button>
                </div>
            </div>
            <div class="row" id="boxCampo9"></div>
        </div>
        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn" name="save">Gerar e Baixar <i class="material-icons">send</i></button>
            </div>
        </div>
</div>
<script src="././assets/js/customRoutine.js"></script>
<script>
    $('#alert_close').click(function() {
        $("#alert_box").fadeOut("slow", function() {});
    });
</script>
