var controleCampoEbooks = 1;

var controleCampoBonus = 1;

var controleCampoMaterialVip = 1;

var controleVideoTopo = 1;

var controleVideoRodape = 1;

function montaComboPlataforma() {}

function adicionarCamposEbooks() {
  controleCampoEbooks++;

  var camposArquivosEbooks = `      
                        <div class="form-group" id="campoEbooks${controleCampoEbooks}">    
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
                                <button type="button" class="btn" id="${controleCampoEbooks}" name="save" onclick="removerCamposEbooks(${controleCampoEbooks});">-</button>
                            </div>
                        </div>`;

  //document.getElementById('boxCamposArquivos').insertAdjacentHTML('beforeend', camposArquivos);

  $("#boxCamposArquivosEbooks").append(camposArquivosEbooks);
}

function adicionarCamposBonus() {
  controleCampoBonus++;

  var camposArquivosBonus = `      
                          <div class="form-group" id="campoBonus${controleCampoBonus}">    
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
                                  <button type="button" class="btn" id="${controleCampoBonus}" name="save" onclick="removerCamposBonus(${controleCampoBonus});">-</button>
                              </div>
                          </div>`;

  //document.getElementById('boxCamposArquivos').insertAdjacentHTML('beforeend', camposArquivos);

  $("#boxCamposArquivosBonus").append(camposArquivosBonus);
}

function adicionarCamposMaterialVip() {
  controleCampoMaterialVip++;

  var camposArquivosMaterialVip = `      
                          <div class="form-group" id="campoMaterialVip${controleCampoMaterialVip}">    
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
                                  <button type="button" class="btn" id="${controleCampoMaterialVip}" name="save" onclick="removerCamposMaterialVip(${controleCampoMaterialVip});">-</button>
                              </div>
                          </div>`;

  //document.getElementById('boxCamposArquivos').insertAdjacentHTML('beforeend', camposArquivos);

  $("#boxCamposArquivosMaterialVip").append(camposArquivosMaterialVip);
}

function adicionarCamposVideoTopo() {
  controleVideoTopo++;
  var camposVideoTopo = `
                        <div  id="campoVideoTopo${controleVideoTopo}">
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
                                <button type="button" class="btn" id="${controleVideoTopo}" name="save" onclick="removerCamposVideoTopo(${controleVideoTopo});">-</button>
                            </div>
                        </div>
                            `;
  $("#boxCamposVideoTopo").append(camposVideoTopo);
}

function adicionarCamposVideoRodape() {
  controleVideoRodape++;
  var camposVideoRodape = `
                          <div  id="campoVideoRodape${controleVideoRodape}">
                              <div class="col m3 s12 input-field">
                                  <i class="material-icons prefix">edit</i>
                                  <input type="text" class="text" name="titleVideoRodape[]" id="titleVideoRodape" required>
                                  <label for="titleVideoRodape">Título</label>
                              </div>
                              <div class="col m4 s12 input-field">
                                  <i class="material-icons prefix">edit</i>
                                  <input type="text" class="text" name="descriptionVideoRodape[]" id="descriptionVideoRodape" required>
                                  <label for="descriptionVideoRodape">Descrição</label>
                              </div>
                              <div class="col m4 s12 input-field">
                                  <i class="material-icons prefix">web</i>
                                  <input type="text" class="text" name="urlVideoRodape[]" id="urlVideoRodape" required>
                                  <label for="urlVideoRodape">Link</label>
                              </div>
                              <div class="col m1 s12 input-field">
                                  <button type="button" class="btn" id="${controleVideoRodape}" name="save" onclick="removerCamposVideoRodape(${controleVideoRodape});">-</button>
                              </div>
                          </div>
                              `;
  $("#boxCamposVideoRodape").append(camposVideoRodape);
}

function removerCamposEbooks(idCampo) {
  //console.log(idCampo);
  document.getElementById("campoEbooks" + idCampo).remove();
}

function removerCamposBonus(idCampo) {
  //console.log(idCampo);
  document.getElementById("campoBonus" + idCampo).remove();
}

function removerCamposMaterialVip(idCampo) {
  //console.log(idCampo);
  document.getElementById("campoMaterialVip" + idCampo).remove();
}

function removerCamposVideoTopo(idCampo) {
  //console.log(idCampo);
  document.getElementById("campoVideoTopo" + idCampo).remove();
}

function removerCamposVideoRodape(idCampo) {
  //console.log(idCampo);
  document.getElementById("campoVideoRodape" + idCampo).remove();
}

function deleteEvent(value){
    if(confirm("Deseja excluir este evento?")){
        $.ajax({
            type: 'POST',
            url: '../../inc/dados.inc.php',   
            data: {value},
            success: (resp) =>{
                location.reload(true);
            },
            error: (resp) =>{
                console.log(resp);
            },

        });
    }
}
