var controleCampo1 = 1;

var controleCampo2 = 1;

var controleCampo3 = 1;

var controleCampo4 = 1;

var controleCampo5 = 1;

var controleCampo6 = 1;

var controleCampo7 = 1;

var controleCampo8 = 1;

var controleCampo9 = 1;

function adicionar1() {
  controleCampo1++;

  var campos1 = `      
                        <div class="form-group" id="campo1${controleCampo1}">    
                            <div class="col m11 s12 input-field">
                                <i class="material-icons prefix">web</i>
                                <input type="text" class="text" name="titleCampo1[]" id="titleCampo1" required>
                                <label for="titleCampo1">Descrição</label>
                            </div>
                            <div class="col m1 s12 input-field">
                                <button type="button" class="btn" id="${controleCampo1}" name="save" onclick="removerCampo1(${controleCampo1});">-</button>
                            </div>
                        </div>`;

  $("#boxCampo1").append(campos1);
}

function adicionar2() {
  controleCampo2++;

  var campos2 = `      
                          <div class="form-group" id="campo2${controleCampo2}">    
                              <div class="col m11 s12 input-field">
                                  <i class="material-icons prefix">web</i>
                                  <input type="text" class="text" name="titleCampo2[]" id="titleCampo2" required>
                                  <label for="titleCampo2">Descrição</label>
                              </div>
                              <div class="col m1 s12 input-field">
                                  <button type="button" class="btn" id="${controleCampo2}" name="save" onclick="removerCampo2(${controleCampo2});">-</button>
                              </div>
                          </div>`;

  $("#boxCampo2").append(campos2);
}

function adicionar3() {
  controleCampo3++;

  var campos3 = `      
                            <div class="form-group" id="campo3${controleCampo3}">    
                                <div class="col m11 s12 input-field">
                                    <i class="material-icons prefix">web</i>
                                    <input type="text" class="text" name="titleCampo3[]" id="titleCampo3" required>
                                    <label for="titleCampo3">Descrição</label>
                                </div>
                                <div class="col m1 s12 input-field">
                                    <button type="button" class="btn" id="${controleCampo3}" name="save" onclick="removerCampo3(${controleCampo3});">-</button>
                                </div>
                            </div>`;

  $("#boxCampo3").append(campos3);
}

function adicionar4() {
  controleCampo4++;

  var campos4 = `      
                            <div class="form-group" id="campo4${controleCampo2}">    
                                <div class="col m11 s12 input-field">
                                    <i class="material-icons prefix">web</i>
                                    <input type="text" class="text" name="titleCampo4[]" id="titleCampo4" required>
                                    <label for="titleCampo4">Descrição</label>
                                </div>
                                <div class="col m1 s12 input-field">
                                    <button type="button" class="btn" id="${controleCampo4}" name="save" onclick="removerCampo4(${controleCampo4});">-</button>
                                </div>
                            </div>`;

  $("#boxCampo4").append(campos4);
}

function adicionar5() {
  controleCampo5++;

  var campos5 = `      
                            <div class="form-group" id="campo5${controleCampo5}">    
                                <div class="col m11 s12 input-field">
                                    <i class="material-icons prefix">web</i>
                                    <input type="text" class="text" name="titleCampo5[]" id="titleCampo5" required>
                                    <label for="titleCampo5">Descrição</label>
                                </div>
                                <div class="col m1 s12 input-field">
                                    <button type="button" class="btn" id="${controleCampo5}" name="save" onclick="removerCampo5(${controleCampo5});">-</button>
                                </div>
                            </div>`;

  $("#boxCampo5").append(campos5);
}

function adicionar6() {
  controleCampo6++;

  var campos6 = `      
                            <div class="form-group" id="campo6${controleCampo6}">    
                                <div class="col m11 s12 input-field">
                                    <i class="material-icons prefix">web</i>
                                    <input type="text" class="text" name="titleCampo6[]" id="titleCampo6" required>
                                    <label for="titleCampo6">Descrição</label>
                                </div>
                                <div class="col m1 s12 input-field">
                                    <button type="button" class="btn" id="${controleCampo6}" name="save" onclick="removerCampo6(${controleCampo6});">-</button>
                                </div>
                            </div>`;

  $("#boxCampo6").append(campos6);
}

function adicionar7() {
  controleCampo7++;

  var campos7 = `      
                              <div class="form-group" id="campo7${controleCampo7}">    
                                  <div class="col m11 s12 input-field">
                                      <i class="material-icons prefix">web</i>
                                      <input type="text" class="text" name="titleCampo7[]" id="titleCampo7" required>
                                      <label for="titleCampo7">Descrição</label>
                                  </div>
                                  <div class="col m1 s12 input-field">
                                      <button type="button" class="btn" id="${controleCampo7}" name="save" onclick="removerCampo7(${controleCampo7});">-</button>
                                  </div>
                              </div>`;

  $("#boxCampo7").append(campos7);
}

function adicionar8() {
  controleCampo8++;

  var campos8 = `      
                              <div class="form-group" id="campo8${controleCampo8}">    
                                  <div class="col m11 s12 input-field">
                                      <i class="material-icons prefix">web</i>
                                      <input type="text" class="text" name="titleCampo8[]" id="titleCampo8" required>
                                      <label for="titleCampo8">Descrição</label>
                                  </div>
                                  <div class="col m1 s12 input-field">
                                      <button type="button" class="btn" id="${controleCampo8}" name="save" onclick="removerCampo8(${controleCampo8});">-</button>
                                  </div>
                              </div>`;

  $("#boxCampo8").append(campos8);
}

function adicionar9() {
  controleCampo9++;

  var campos9 = `      
                              <div class="form-group" id="campo9${controleCampo9}">    
                                  <div class="col m11 s12 input-field">
                                      <i class="material-icons prefix">web</i>
                                      <input type="text" class="text" name="titleCampo9[]" id="titleCampo9" required>
                                      <label for="titleCampo9">Descrição</label>
                                  </div>
                                  <div class="col m1 s12 input-field">
                                      <button type="button" class="btn" id="${controleCampo9}" name="save" onclick="removerCampo9(${controleCampo9});">-</button>
                                  </div>
                              </div>`;

  $("#boxCampo8").append(campos8);
}

function removerCampo1(idCampo) {
  document.getElementById("campo1" + idCampo).remove();
}

function removerCampo2(idCampo) {
  document.getElementById("campo2" + idCampo).remove();
}

function removerCampo3(idCampo) {
  document.getElementById("campo3" + idCampo).remove();
}

function removerCampo4(idCampo) {
  document.getElementById("campo4" + idCampo).remove();
}

function removerCampo5(idCampo) {
  document.getElementById("campo5" + idCampo).remove();
}

function removerCampo6(idCampo) {
  document.getElementById("campo6" + idCampo).remove();
}

function removerCampo7(idCampo) {
  document.getElementById("campo7" + idCampo).remove();
}

function removerCampo8(idCampo) {
  document.getElementById("campo8" + idCampo).remove();
}

function removerCampo9(idCampo) {
  document.getElementById("campo9" + idCampo).remove();
}
