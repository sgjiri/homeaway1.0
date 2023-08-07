

document.querySelector("form").addEventListener("submit", function(e) {
    e.preventDefault();
    // Récupérer les valeurs du formulaire
    let cityValue = document.getElementById("city").value;
    let startDateValue = document.getElementById("start_date").value;
    let endDateValue = document.getElementById("end_date").value;
    let numberOfPersonValue = document.getElementById("number_of_person").value;
   

    // Créer un objet JSON avec les données du formulaire
    let formData = {
        city: cityValue,
        start_date: startDateValue,
        end_date: endDateValue,
        number_of_person: numberOfPersonValue
      
    };

    // Convertir l'objet JSON en chaîne JSON et le stocker dans le local storage
    localStorage.setItem('formData', JSON.stringify(formData));

    window.location.href = "./view/oneLogement.html.twig";
})

let formDataString = localStorage.getItem('formData');
console.log(formDataString);
if (formDataString) {
    // Convertir la chaîne JSON en objet JavaScript
    let formData = JSON.parse(formDataString);

    // Utiliser les données pour remplir les champs du deuxième formulaire
    document.getElementById("startDate").textContent = formData.start_date;
    document.getElementById("endDate").textContent = formData.end_date;
    document.getElementById("numberOfPerson").textContent = formData.number_of_person;
}