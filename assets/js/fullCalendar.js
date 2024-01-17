document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar");
  
    // const cadastrarModal = new bootstrap.Modal(
    //   document.getElementById("cadastrarModal")
    // );

    const cadastrarModal = $("#cadastrarModal").modal();
  
    // const visualizarModal = new bootstrap.Modal(
    //   document.getElementById("visualizarModal")
    // );

    const visualizarModal = $("#visualizarModal").modal();
  
    var calendar = new FullCalendar.Calendar(calendarEl, {
      themeSystem: "bootstrap5",
      headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,timeGridDay",
      },
      locale: "pt-br",
      initialDate: "2023-01-01",
      //initialDate: '2023-10-12',
      navLinks: true, // can click day/week names to navigate views
      selectable: true,
      selectMirror: true,
      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
    //   events: "listar_evento.php",
      events: [{
        title: 'All Day Event',
        start: '2023-01-01'
      },
      {
        title: 'Long Event',
        start: '2023-01-07',
        end: '2023-01-10'
      }],
  
      eventClick: function (info) {
  
        // document.getElementById("visualizarEvento").style.display = "block";
        // document.getElementById("visualizarModalLabel").style.display = "block";
  
        // document.getElementById("editarEvento").style.display = "none";
        // document.getElementById("editarModalLabel").style.display = "none";
  
        // document.getElementById("visualizar_id").innerText = info.event.id;
        // document.getElementById("visualizar_title").innerText = info.event.title;
        // document.getElementById("visualizar_start").innerText = info.event.start.toLocaleString();
        // document.getElementById("visualizar_end").innerText = info.event.end !== null ? info.event.end.toLocaleString() : info.event.start.toLocaleString();
  
        // document.getElementById("editId").value = info.event.id;
        // document.getElementById("editTitle").value = info.event.title;
        // document.getElementById("editColor").value = info.event.backgroundColor;
        // document.getElementById("editStart").value = converterData(info.event.start);
        // document.getElementById("editEnd").value = info.event.end !== null ? converterData(info.event.end) : converterData(info.event.start);
  
        visualizarModal.show();
      },
      select: function (info) {
        // document.getElementById("cadStart").value = converterData(info.start);
        // document.getElementById("cadEnd").value = converterData(info.start);
  
        cadastrarModal.show();
      },
    });
  
    calendar.render();
  
    function converterData(data) {
      const dataObj = new Date(data);
  
      const ano = dataObj.getFullYear();
  
      const mes = String(dataObj.getMonth() + 1).padStart(2, "0");
  
      const dia = String(dataObj.getDate()).padStart(2, "0");
  
      const hora = String(dataObj.getHours()).padStart(2, "0");
  
      const minuto = String(dataObj.getMinutes()).padStart(2, "0");
  
      return `${ano}-${mes}-${dia} ${hora}:${minuto}`;
    }
  
    const formCadEvento = document.getElementById("formCadEvento");
  
    const msg = document.getElementById("msg");
  
    const msgCadEvento = document.getElementById("msgCadEvento");
  
    const btnCadEvento = document.getElementById("btnCadEvento");
  
    if (formCadEvento) {
      formCadEvento.addEventListener("submit", async (e) => {
        e.preventDefault();
  
        btnCadEvento.value = "Salvando...";
  
        const dadosForm = new FormData(formCadEvento);
  
        const dados = await fetch("cadastrar_evento.php", {
          method: "POST",
          body: dadosForm,
        });
  
        const resposta = await dados.json();
  
        if (!resposta["status"]) {
          msgCadEvento.innerHTML = `<div class="alert alert-danger" role="alert">${resposta["msg"]}</div>`;
        } else {
          msg.innerHTML = `<div class="alert alert-success" role="alert">${resposta["msg"]}</div>`;
  
          msgCadEvento.innerHTML = "";
  
          formCadEvento.reset();
  
          const novoEvento = {
            id: resposta["id"],
            title: resposta["title"],
            color: resposta["color"],
            start: resposta["start"],
            end: resposta["end"],
          };
  
          calendar.addEvent(novoEvento);
  
          removeMsg();
  
          cadastrarModal.hide();
        }
  
        btnCadEvento.value = "Cadastrar";
  
        console.log(resposta);
      });
    }
  
    function removeMsg() {
      setTimeout(() => {
        document.getElementById("msg").innerHTML = "";
      }, 3000);
    }
  
    const btnViewEditEvent = document.getElementById("btnViewEditEvent");
  
    if (btnViewEditEvent) {
      btnViewEditEvent.addEventListener("click", () => {
        document.getElementById("visualizarEvento").style.display = "none";
        document.getElementById("visualizarModalLabel").style.display = "none";
  
        document.getElementById("editarEvento").style.display = "block";
        document.getElementById("editarModalLabel").style.display = "block";
      });
    }
  
    const btnViewEvento = document.getElementById("btnViewEvento");
  
    if (btnViewEvento) {
      btnViewEvento.addEventListener("click", () => {
        document.getElementById("visualizarEvento").style.display = "block";
        document.getElementById("visualizarModalLabel").style.display = "block";
  
        document.getElementById("editarEvento").style.display = "none";
        document.getElementById("editarModalLabel").style.display = "none";
      });
    }
  
    const formEditEvento = document.getElementById("formEditEvento");
    const msgEditEvento = document.getElementById("msgEditEvento");
    const btnEditEvento = document.getElementById("btnEditEvento");
  
    if (formEditEvento) {
      formEditEvento.addEventListener("submit", async (e) => {
        e.preventDefault();
  
        btnEditEvento.value = "Salvando...";
  
        const dadosForm = new FormData(formEditEvento);
  
        const dados = await fetch("editar_evento.php", {
          method: "POST",
          body: dadosForm,
        });
  
        const resposta = await dados.json();
  
        if (!resposta["status"]) {
          msgEditEvento.innerHTML = `<div class="alert alert-danger" role="alert">${resposta["msg"]}</div>`;
        } else {
          msg.innerHTML = `<div class="alert alert-success" role="alert">${resposta["msg"]}</div>`;
          msgEditEvento.innerHTML = "";
  
          formEditEvento.reset();
  
          const eventoExist = calendar.getEventById(resposta["id"]);
  
          if (eventoExist) {
            eventoExist.setProp("title", resposta["title"]);
            eventoExist.setProp("color", resposta["color"]);
            eventoExist.setStart(resposta["start"]);
            eventoExist.setEnd(resposta["end"]);
          }
  
          removeMsg();
  
          visualizarModal.hide();
        }
  
        btnEditEvento.value = "Salvar";
      });
    }
  });
  