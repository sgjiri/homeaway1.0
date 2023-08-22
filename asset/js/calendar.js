const startDateCalendar = document.getElementById('startDate').value;
const endDateCalendar = document.getElementById('endDate').value;

// Attend que le contenu de la page soit chargé avant d'exécuter le code à l'intérieur de la fonction
document.addEventListener('DOMContentLoaded', function () {
  let calendarEl = document.getElementById('calendar');
  // Crée une nouvelle instance de FullCalendar avec l'élément calendarEl
  let calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale: 'fr',
    // Permet de faire glisser les événements sur le calendrier
    droppable: true,
    // Permet de sélectionner des plages de dates sur le calendrier
    selectable: true,
    // Liste des événements du calendrier
    events: [
      {
        // Ajouter un événement temporaire pour les dates sélectionnées
        title: 'Nouvelle réservation',
         start: startDateCalendar,        
        end: endDateCalendar,
        // Indique que l'événement dure toute la journée
        allDay: true,
        // Affiche l'événement en arrière-plan
        display: 'background',
        // Couleur de fond de l'événement
        color: 'blue'
      },
       // Ajouter un événement pour chaque reservation dans la liste books.La méthode map est appelée sur la liste books, ce qui permet d'itérer sur chaque élément de la liste.
      ... books.map(book => ({
        start: book.start_date,
        end: book.end_date,
        allDay: true,
        display: 'background',
        color: 'red'
      }))
    ]
  });
  // Affiche le calendrier à l'écran
  calendar.render();
});