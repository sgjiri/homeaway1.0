const startDateCalendar = document.getElementById('startDate').textContent;
const endDateCalendar = document.getElementById('endDate').textContent;




document.addEventListener('DOMContentLoaded', function () {
  let calendarEl = document.getElementById('calendar');
  let calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'fr',
    droppable: true,
    selectable: true,
    events: [
      {
        // Ajouter un événement temporaire pour les dates sélectionnées

        title: 'Nouvelle réservation',
        start: startDateCalendar,
        end: endDateCalendar,
        allDay: true,
        display: 'background',
        color: 'blue'
      },
   ... books.map(book => ({

      start: book.start_date,
      end: book.end_date,
      allDay: true,
      display: 'background',
      color: 'red'
    }))
 ]
  });

  calendar.render();
});