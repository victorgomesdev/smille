document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      locale: 'pt-br',

      buttonText:{
        today:    'Hoje',
        month:    'Mês',
        week:     'Semana',
        day:      'Dia',
        
      },
      

      //Pegando a data atual
      var: today = new Date(),

      // Configuramos a data inicial para o primeiro dia do mês atual
      var: initialDate = today.getFullYear() + '-' +  String(today.getMonth() + 1).padStart(2, '0') + '-01',

      //Configurando o calendário para começar a partir do dia 1 do mês atual
      initialDate: initialDate,
      
      navLinks: true, // can click day/week names to navigate views
      businessHours: true, // display business hours
      editable: true,
      selectable: true,

      dateClick: function(info){
        if(info.view.type == 'dayGridMonth'){
          calendar.changeView('timeGrid', info.dateStr);
        }
      },

      eventClick: function(info) {
        window.location.href = `edit.php?id=${info.event.id}`;
      },
      
      events: 'controllers/ControllerEvents.php',

        
    });

    calendar.render();
  });