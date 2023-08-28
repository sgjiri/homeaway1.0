document.getElementById("reservationButton").addEventListener("click", showConfirmation);

function showConfirmation(event) {
	event.preventDefault(); // Pour empêcher l'envoi du formulaire par défaut

	const start_date = document.getElementById("startDate").value;
	const end_date = document.getElementById("endDate").value;
	const id_person = document.getElementById("id_person").value;
	const id_logement = document.getElementById("id_logement").value;

	document.getElementById("start_date").value = start_date;
	document.getElementById("end_date").value = end_date;
	document.getElementById("id_person").value = id_person;
	document.getElementById("id_logement").value = id_logement;

	const confirmation = confirm("Êtes-vous sûr de vouloir effectuer cette réservation ?");
	if (confirmation) {
		const message = "Votre réservation a bien été prise en compte.";
		alert(message);
		// Vous pouvez également rediriger l'utilisateur vers une autre page ici si nécessaire
		document.getElementById("secondPartOne").submit();
	}
}