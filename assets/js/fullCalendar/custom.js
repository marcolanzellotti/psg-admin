document.addEventListener("DOMContentLoaded", function () {
  var calendarEl = document.getElementById("calendar");

  var calendar = new FullCalendar.Calendar(calendarEl, {
    themeSystem: 'bootstrap5',
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay",
    },
    locale: "pt-br",
    initialDate: "2023-10-01",
    //initialDate: '2023-10-12',
    navLinks: true, // can click day/week names to navigate views
    selectable: true,
    selectMirror: true,
    editable: true,
    dayMaxEvents: true, // allow "more" link when too many events
    events: "listar_evento.php",

    eventClick: function (info) {

        console.log(info);
        const visualizarModal = new bootstrap.Modal(document.getElementById('visualizarModal'));

        document.getElementById('visualizar_id').innerText = info.event.id;
        document.getElementById('visualizar_title').innerText = info.event.title;
        document.getElementById('visualizar_start').innerText = info.event.start.toLocaleString();
        document.getElementById('visualizar_end').innerText = info.event.end.toLocaleString();

        visualizarModal.show();
    }
  });

  calendar.render();
});
