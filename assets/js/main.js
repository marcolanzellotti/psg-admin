handleMarcoJulie = (e) => {
  formData = new FormData();
  formData.append("id", e.dataset.id);
  formData.append("toggleAuthor", e.dataset.author);
  axios.post("/formularios/api.php", formData).then((res) => {
    console.log(res);
  });
};

handleDoneUpdates = (id) => {
  formData = new FormData();
  formData.append("toggleDoneUpdate", id);
  axios.post("/formularios/api.php", formData).then((res) => {
    console.log(res);
  });
};

handleSentUpdates = (id) => {
  formData = new FormData();
  formData.append("toggleSentUpdate", id);
  axios.post("/formularios/api.php", formData).then((res) => {
    console.log(res);
  });
};

handleDoneAnalysis = (id) => {
  formData = new FormData();

  formData.append("toggleDoneAnalysis", id);
  axios.post("/formularios/api.php", formData).then((res) => {
    console.log(res);
  });
};

handleDoneWeeklyUpdates = (id) => {
  formData = new FormData();
  formData.append("toggleDoneWeeklyUpdate", id);
  axios.post("/formularios/api.php", formData).then((res) => {
    console.log(res);
  });
};

handleSentWeeklyUpdates = (id) => {
  formData = new FormData();
  formData.append("toggleSentWeeklyUpdate", id);
  axios.post("/formularios/api.php", formData).then((res) => {
    console.log(res);
  });
};

handleDoneHabits = (id) => {
  formData = new FormData();
  formData.append("toggleDoneHabit", id);
  axios.post("/formularios/api.php", formData).then((res) => {
    console.log(res);
  });
};

handleDoneHabitSelectAuthor = (id) => {
  formData = new FormData();
  formData.append("toggleDoneHabitSelectAuthor", id);
  axios.post("/formularios/api.php", formData).then((res) => {
    console.log(res);
  });
};
handleDoneHabitSelectMentor = (id) => {
  formData = new FormData();
  formData.append("toggleDoneHabitSelectMentor", id);
  axios.post("/formularios/api.php", formData).then((res) => {
    console.log(res);
  });
};

handleChangeMentor = (e) => {
  formData = new FormData();
  formData.append("toggleMentor", e.value);
  formData.append("id", e.dataset.id);
  axios.post("/formularios/api.php", formData).then((res) => {
    console.log(res);
  });
};

handleChangeCoAuthor = (e) => {
  formData = new FormData();
  formData.append("toggleCoAuthor", e.dataset.id);
  formData.append("co_author", e.value);
  axios.post("/formularios/api.php", formData).then((res) => {
    console.log(res);
  });
};

handleTogglePermission = (e) => {
  axios
    .get(
      "/psg-admin/admin-ajax.php?mentor=" +
        e.dataset.mentor +
        "&togglepermission=" +
        e.dataset.permission
    )
    .then((res) => {
      console.log(res);
    });
};

handleToggleMentorAuthor = (e) => {
  axios
    .get(
      "/psg-admin/admin-ajax.php?toggleMentorAuthor&habit=" +
        e.dataset.mentor +
        "&author=" +
        e.dataset.author
    )
    .then((res) => {
      console.log(res);
    });
};

handleToggleHabitAuthor = (e) => {
  console.log(e.dataset);
  axios
    .get(
      "/psg-admin/admin-ajax.php?toggleHabitAuthor=" +
        e.dataset.habit +
        "&author=" +
        e.dataset.author
    )
    .then((res) => {
      console.log(res);
    });
};

handleToggleMentorCoAuthor = (e) => {
  console.log(e.dataset);
  axios
    .get(
      "/psg-admin/admin-ajax.php?toggleMentorCoAuthor&mentor=" +
        e.dataset.mentor +
        "&author=" +
        e.dataset.coAuthor
    )
    .then((res) => {
      console.log(res);
    });
};

handleToggleConsultantMentor = (e) => {
  console.log(e.dataset);
  axios
    .get(
      "/psg-admin/admin-ajax.php?toggleConsultantMentor&consultant=" +
        e.dataset.consultant +
        "&mentor=" +
        e.dataset.mentor
    )
    .then((res) => {
      console.log(res);
    });
};

handleToggleHabitCoAuthor = (e) => {
  console.log("toggleHabitCoAuthor");
  console.log(e.dataset);
  axios
    .get(
      "/psg-admin/admin-ajax.php?toggleHabitCoAuthor&habit=" +
        e.dataset.habit +
        "&co_author=" +
        e.dataset.coAuthor
    )
    .then((res) => {
      console.log(res);
    });
};

handleDoneContacted = (id) => {
  axios
    .get("/psg-admin/admin-ajax.php?toggleDoneContacted=" + id)
    .then((res) => {
      console.log(res);
    });
};

deleteHabits = (id) => {
  var confirmacao = confirm("Deseja mesmo excluir esse lead?");

  // Verificar se o usuário clicou em "OK"
  if (confirmacao) {
    axios.get("/psg-admin/uteis-ajax.php?deleteHabits=" + id).then((res) => {
      $("#row-" + id).remove();
    });
  }
};

generateRenewalSpreadsheet = (e) => {
  axios
    .get("/psg-admin/admin-ajax.php?generateRenewalSpreadsheet")
    .then((res) => {
      console.log(res);
    });
};

handleDoneRenewed = (id) => {
  axios.get("/psg-admin/admin-ajax.php?toggleDoneRenewed=" + id).then((res) => {
    console.log(res);
  });
};

handleSentAnalysis = (id) => {
  axios
    .get("/psg-admin/admin-ajax.php?toggleSentAnalysis=" + id.toString())
    .then((res) => {
      console.log(res);
    });
};

handleChangeRenewTime = (e) => {
  time = e.value;
  id = e.dataset.id;
  axios
    .get(
      "/psg-admin/admin-ajax.php?changeRenewTime=" +
        id.toString() +
        "&newTime=" +
        time.toString()
    )
    .then((res) => {
      console.log(res);
      document.location.reload();
    });
};

saveAnnotarion = (e) => {
  var conteudo = "";
  document.getElementById("btnSaveAnnotation").innerHTML = "Salvando...";
  document.getElementById("btnSaveAnnotation").disabled = true;

  var formulario = new FormData(document.getElementById("formSaveAnnotation"));
  formulario.append(
    "imagem",
    document.getElementById("fileAnnotation").files[0]
  );

  var idTableAnnotationUser = formulario.get("idUser");
  var nameUser = formulario.get("nameUser");

  var display = '';

  axios
    .post("/psg-admin/api/save-annotation.php", formulario, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    })
    .then(function (resposta) {
      M.toast({ html: resposta.data.msg, classes: "rounded" });
      console.log(resposta);
      if (!resposta.data.error) {
        if(resposta.data.dados.url == '') {
          display = 'display: none';
        }
        conteudo = `
                <li id="row-${resposta.data.dados.idAnnotation}">
                  <div class="collapsible-header" style="display: flex; justify-content: space-between;">
                    <div style="display: flex; justify-content: space-between;">
                      <div>
                          <a onclick="deleteAnnotation(${resposta.data.dados.idAnnotation})" title="Excluir Anotação de: ${nameUser}" style="color: #F00">
                              <i class="material-icons">clear</i>
                          </a>
                      </div>
                      <div>
                        <i class="material-icons">library_books</i>${resposta.data.dados.annotation}
                      </div>
                    </div>
                    <div>
                      <div>
                        ${resposta.data.dados.createdAt}
                      </div>
                    </div>
                  </div>
                  <div class="collapsible-body">
                    <div style="display: flex; justify-content: space-between;">
                      <div>${resposta.data.dados.annotation}</div>
                      <div><a href="${resposta.data.dados.url}" download style="${display}"><i class="material-icons">cloud_download</i></a></div>
                    </div>
                  </div>
                </li>
                  `;
        $("#myAnnotations_" + idTableAnnotationUser).append(conteudo);
      }

      document.getElementById("btnSaveAnnotation").innerHTML = "Salvar";
      document.getElementById("btnSaveAnnotation").disabled = false;
      $("#formSaveAnnotation").trigger("reset");
    })
    .catch(function (erro) {
      console.error("Erro ao enviar o formulário", erro);
      document.getElementById("resposta").innerHTML =
        "Erro ao enviar o formulário.";
    });
};
SaveDateCreate = (e) => {
  var conteudo = "";
  document.getElementById("btnSaveDateCreate").innerHTML = "Salvando...";
  document.getElementById("btnSaveDateCreate").disabled = true;

  var formulario = new FormData(document.getElementById("formSaveDateCreate"));
  
  var idHabits = formulario.get("idUser");

  axios
    .post("/psg-admin/api/save-date-create.php", formulario, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    })
    .then(function (resposta) {
      M.toast({ html: resposta.data.msg, classes: "rounded" });
      console.log(resposta);
      if (!resposta.data.error) {
        $("#date_create_" + idHabits).html('');
        conteudo = `<b>${resposta.data.dados.create_date}</b>`;
        $("#date_create_" + idHabits).append(conteudo);
        $('.modal').modal();
      }

      document.getElementById("btnSaveDateCreate").innerHTML = "Salvar";
      document.getElementById("btnSaveDateCreate").disabled = false;
      $("#formSaveDateCreate").trigger("reset");
    })
    .catch(function (erro) {
      console.error("Erro ao enviar o formulário", erro);
      document.getElementById("resposta").innerHTML =
        "Erro ao enviar o formulário.";
    });
};

deleteAnnotation = (e) => {
  var dados = {
    idAnnotation: e
  };

  var confirmacao = confirm("Deseja mesmo excluir essa anotação?");
  if (confirmacao) {
    axios
      .post("/psg-admin/api/delete-annotation.php", dados, {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      })
      .then(function (resposta) {
        M.toast({ html: resposta.data.msg, classes: "rounded" });
        $('#row-' + resposta.data.idAnnotation).remove();
      })
      .catch(function (erro) {
        console.error("Erro ao enviar o formulário", erro);
        document.getElementById("resposta").innerHTML =
          "Erro ao enviar o formulário.";
      });
  }
};

handleChangePlan = (e) => {
  plan = e.value;
  id = e.dataset.id;
  axios.get("/psg-admin/admin-ajax.php?changePlan=" + id.toString() + "&newPlan=" + plan.toString())
    .then((res) => {
      console.log(res);
      document.location.reload();
    });
};

const handleConfirm = (e) => {
  e.preventDefault();
  const target = e.target.localName == "i" ? e.target.parentElement : e.target;

  if (target.localName != "a") return;
  Swal.fire({
    title: "Deseja realmente excluir?",
    icon: "warning",
    showDenyButton: true,
    showConfirmButton: true,
    confirmButtonText: "Excluir",
    denyButtonText: "Não excluir",
  }).then((res) => {
    if (res.isConfirmed) {
      document.location.href = target.attributes.href.value;
    }
  });
};

const handleIsActive = (userId, text) => {
  var textBox = '';
  var textBtn1 = '';
  var textBtn2 = '';
  if(text == 'inactive') {
    textBox = 'desativar';
    textBtn1 = 'Desativar';
    textBtn2 = 'Não Desativar';
  } else {
    textBox = 'ativar';
    textBtn1 = 'Ativar';
    textBtn2 = 'Não Ativar';
  }

  var dados = {
    is_active: text,
    user: userId
  }

  Swal.fire({
    title: "Deseja realmente "+textBox+" esse usuário?",
    icon: "warning",
    showDenyButton: true,
    showConfirmButton: true,
    confirmButtonText: textBtn1,
    denyButtonText: textBtn2,
  }).then((res) => {
    if (res.isConfirmed) {

      axios
      .post("/psg-admin/api/users.php", dados, {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      })
      .then(function (resposta) {
        Swal.fire({
          icon: "success",
          text: resposta.data.msg,
        }).then((res) => {
          document.location.reload();
        });
      })
      .catch(function (erro) {
        console.error("Erro ao enviar o formulário", erro);
        document.getElementById("resposta").innerHTML =
          "Erro ao enviar o formulário.";
      });
    }
  });
  //e.preventDefault();
  //const target = e.target.localName == "i" ? e.target.parentElement : e.target;

  //if (target.localName != "a") return;
};

document.querySelectorAll(".confirm").forEach((e) => {
  e.addEventListener("click", handleConfirm);
});

var clicked = 0;
$(".toggle-password").click(function (e) {
  e.preventDefault();
  $(this).toggleClass("toggle-password");
  if (clicked == 0) {
    $(this).html('<span class="material-icons">visibility_off</span >');
    clicked = 1;
  } else {
    $(this).html('<span class="material-icons">visibility</span >');
    clicked = 0;
  }

  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

$("#save").submit((e) => {
  e.preventDefault();
  console.log(e.target.dataset);
  let formData = new FormData(e.target);
  axios
    .post(
      `/psg-admin/api/${e.target.dataset.formtype}?id=${e.target.dataset.id}`,
      formData
    )
    .then((res) => {
      if (res.data.success) {
        Swal.fire({
          icon: "success",
          text: "Salvo com sucesso",
        }).then((res) => {
          document.location.reload();
        });
      }
    });
});

$(".data-edit").click((e) => {
  console.log("Trigged");
  document.getElementById("modal1-content").innerHTML = ``;
  console.log(e.target.dataset);
  const formtype = e.target.dataset.formtype;
  const id = e.target.dataset.id;
  dict = {
    habits: {
      name: "Nome",
      phone: "Telefone",
      mail: "Email",
      // "difficult": "Dificuldades",
      // "try": "O que já tentou",
      // "height": "Altura",
      // "weight": "Peso",
      // "abdomen": "Abdomen",
      // "hip": "Cintura",
      // "wanted_weight": "Peso desejado"
    },
  };
  axios.get(`/psg-admin/api/${formtype}?id=${id}`).then((res) => {
    document.getElementById("save").dataset.formtype = formtype;
    document.getElementById("save").dataset.id = id;
    console.log(res.data);
    data = res.data[formtype][0];
    Object.entries(dict[formtype]).map((e) => {
      elemName = e[0];
      elemTitle = e[1];
      elemValue = data[elemName];
      console.log(e);
      document.getElementById("modal1-content").innerHTML += `
            <div class="col s12 m12 input-field">
                <input id="edit-${data.id}" name="${elemName}" value="${elemValue}" type="text"></input>
                <label for="edit-${data.id}">${elemTitle}</label>
            </div>
            `;
    });
  });
});

$(document).ready(function () {
  $(".modal").modal();
});

const symptomsCtx = document.getElementById("symptomsChart");
if (symptomsCtx) {
  axios
    .get("/psg-admin/admin-ajax.php?getSubscriptions&limit=300")
    .then((res) => {
      let count = {};
      res.data["subscriptions"].forEach((sub) => {
        sub["symptoms"].forEach((symptom) => {
          count[symptom] = count[symptom] ? count[symptom] + 1 : 1;
        });
      });

      const myChart = new Chart(symptomsCtx, {
        data: {
          labels: Object.keys(count),

          datasets: [
            {
              type: "bar",
              label: "Sintomas",
              data: Object.values(count),
              backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(54, 162, 235, 0.2)",
                "rgba(255, 206, 86, 0.2)",
                "rgba(75, 192, 192, 0.2)",
                "rgba(153, 102, 255, 0.2)",
                "rgba(255, 159, 64, 0.2)",
              ],
              borderColor: [
                "rgba(255, 99, 132, 1)",
                "rgba(54, 162, 235, 1)",
                "rgba(255, 206, 86, 1)",
                "rgba(75, 192, 192, 1)",
                "rgba(153, 102, 255, 1)",
                "rgba(255, 159, 64, 1)",
              ],
              borderWidth: 1,
            },
          ],
        },
      });
    });
}

const handleScroll = (d) => {
  let e = document.getElementById("select_mentor");
  if (d == 1) {
    e.scroll({
      left: e.scrollLeft + 500,
      behavior: "smooth",
    });
  } else if (d == 0) {
    e.scroll({
      left: e.scrollLeft - 500,
      behavior: "smooth",
    });
  }
};

const handleScrollWeeklyUpdates = (d) => {
  let e = document.getElementById("weekly_updates");
  console.log(e);
  if (d == 1) {
    e.scroll({
      left: e.scrollLeft + 500,
      behavior: "smooth",
    });
  } else if (d == 0) {
    e.scroll({
      left: e.scrollLeft - 500,
      behavior: "smooth",
    });
  } else {
    console.log("Invalid direction");
  }
};

const handleScrollSelectMentor = (d) => {
  let e = document.getElementById("select_mentor");
  console.log(e);
  if (d == 1) {
    e.scroll({
      left: e.scrollLeft + 500,
      behavior: "smooth",
    });
    console.log("To left");
  } else if (d == 0) {
    e.scroll({
      left: e.scrollLeft - 500,
      behavior: "smooth",
    });
    console.log("To right");
  } else {
    console.log("Invalid direction");
  }
};

const handleScrollSelectAuthor = (d) => {
  let e = document.getElementById("select_author");
  console.log(e);
  if (d == 1) {
    e.scroll({
      left: e.scrollLeft + 500,
      behavior: "smooth",
    });
    console.log("To left");
  } else if (d == 0) {
    e.scroll({
      left: e.scrollLeft - 500,
      behavior: "smooth",
    });
    console.log("To right");
  } else {
    console.log("Invalid direction");
  }
};

const handleScrollAnalysis = (d) => {
  let e = document.getElementById("common");
  console.log(e);
  if (d == 1) {
    e.scroll({
      left: e.scrollLeft + 500,
      behavior: "smooth",
    });
    console.log("To left");
  } else if (d == 0) {
    e.scroll({
      left: e.scrollLeft - 500,
      behavior: "smooth",
    });
    console.log("To right");
  } else {
    console.log("Invalid direction");
  }
};

const handleScrollUpdates = (d) => {
  let e = document.getElementById("updates");
  console.log(e);
  if (d == 1) {
    e.scroll({
      left: e.scrollLeft + 500,
      behavior: "smooth",
    });
    console.log("To left");
  } else if (d == 0) {
    e.scroll({
      left: e.scrollLeft - 500,
      behavior: "smooth",
    });
    console.log("To right");
  } else {
    console.log("Invalid direction");
  }
};

const lifeChangesCtx = document.getElementById("lifeChangesChart");
if (lifeChangesCtx) {
  axios.get("/psg-admin/admin-ajax.php?getUpdates&limit=300").then((res) => {
    let count = {};
    res.data["updates"].forEach((sub) => {
      sub["life_change"].forEach((symptom) => {
        count[symptom] = count[symptom] ? count[symptom] + 1 : 1;
      });
    });
    console.log(count);
    const myChart = new Chart(lifeChangesCtx, {
      data: {
        labels: Object.keys(count),

        datasets: [
          {
            type: "bar",
            label: "O que mudaria na sua vida com o corpo dos sonhos?",
            data: Object.values(count),
            backgroundColor: [
              "rgba(255, 99, 132, 0.2)",
              "rgba(54, 162, 235, 0.2)",
              "rgba(255, 206, 86, 0.2)",
              "rgba(75, 192, 192, 0.2)",
              "rgba(153, 102, 255, 0.2)",
              "rgba(255, 159, 64, 0.2)",
            ],
            borderColor: [
              "rgba(255, 99, 132, 1)",
              "rgba(54, 162, 235, 1)",
              "rgba(255, 206, 86, 1)",
              "rgba(75, 192, 192, 1)",
              "rgba(153, 102, 255, 1)",
              "rgba(255, 159, 64, 1)",
            ],
            borderWidth: 1,
          },
        ],
      },
    });
  });
}

const planningFollowedChartCtx = document.getElementById(
  "planningFollowedChart"
);
if (planningFollowedChartCtx) {
  axios.get("/psg-admin/admin-ajax.php?getUpdates&limit=300").then((res) => {
    let count = {};
    res.data["updates"].forEach((sub) => {
      count[sub["planning_followed"]] = count[sub["planning_followed"]]
        ? count[sub["planning_followed"]] + 1
        : 1;
    });
    const myChart = new Chart(planningFollowedChartCtx, {
      type: "bar",
      data: {
        labels: Object.keys(count),

        datasets: [
          {
            label: "Seguiu o planejamento?",
            data: Object.values(count),
            backgroundColor: [
              "rgba(255, 99, 132, 0.2)",
              "rgba(54, 162, 235, 0.2)",
            ],
            borderColor: ["rgba(255, 99, 132, 1)", "rgba(54, 162, 235, 1)"],
            borderWidth: 1,
          },
        ],
      },
    });
  });
}
