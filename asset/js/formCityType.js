// // Obtenez la date actuelle
// let today = new Date();

// // Ajoutez 5 jours à la date actuelle
// let fiveDaysLater = new Date();
// fiveDaysLater.setDate(today.getDate() + 5);

// // Formatez les dates pour les champs d'entrée de date
// let formattedToday = formatDate(today);
// let formattedFiveDaysLater = formatDate(fiveDaysLater);

// // Définissez les valeurs des champs d'entrée de date
// document.getElementById('start_date').value = formattedToday;
// document.getElementById('end_date').value = formattedFiveDaysLater;

// // Fonction pour formater une date au format "YYYY-MM-DD"
// function formatDate(date) {
//     let year = date.getFullYear();
//     let month = ('0' + (date.getMonth() + 1)).slice(-2);
//     let day = ('0' + date.getDate()).slice(-2);
//     return year + '-' + month + '-' + day;
// }