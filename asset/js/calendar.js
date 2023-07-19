

document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');
    let calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'fr',
      droppable: true,
     
      selectable: true,
      events: 'BookCrontroller.php?action=getBookHold&id_logement=1',
      select: function(info) {
        // Ajouter un événement temporaire pour les dates sélectionnées
        calendar.addEvent({
            title: 'Nouvelle réservation',
            start_date: info.startStr,
            end_date: info.endStr,
            color: 'blue'
        });
    }

    });
   
    calendar.render();
  });