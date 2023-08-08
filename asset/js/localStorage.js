

if (document.getElementsByClassName('article')) {
    const searchForm = document.getElementsByClassName('article');
    console.log(searchForm);

    for (let i = 0; i < searchForm.length; i++) {
        searchForm[i].addEventListener('click', (event) => {
            // Empêcher la soumission du formulaire pour pouvoir manipuler les données
            event.preventDefault();

            // Récupérer les valeurs des champs de formulaire
            const city = document.getElementById('cityM').value;
            const startDate = document.getElementById('start_dateM').value;
            const endDate = document.getElementById('end_dateM').value;
            const numberOfPerson = document.getElementById('number_of_personM').value;
            const idLogement = document.getElementsByClassName('idLogement')[i].innerHTML;
            const priceByNight = document.getElementsByClassName('priceByNight')[i].innerHTML;
            

            // Stocker les valeurs dans des cookies
            document.cookie = `city=${city}`;
            document.cookie = `start_date=${startDate}`;
            document.cookie = `end_date=${endDate}`;
            document.cookie = `number_of_person=${numberOfPerson}`;
            document.cookie = `priceByNight=${priceByNight}`;
            console.log(document.cookie);
            // // Rediriger vers la page oneLogement
            window.location.href = "http://localhost/Projet/homeaway1.0/one"+idLogement;
        });
    }

}



const startDate = document.getElementById('startDate');
const endDate = document.getElementById('endDate');
const numberOfPerson = document.getElementById('numberOfPerson');
const priceByNight = document.getElementById('priceByNight');

// Récupérer les valeurs des cookies
const cookies = document.cookie.split(';');
const cityCookie = cookies.find(cookie => cookie.includes('city='));
const startDateCookie = cookies.find(cookie => cookie.includes('start_date='));
const endDateCookie = cookies.find(cookie => cookie.includes('end_date='));
const numberOfPersonCookie = cookies.find(cookie => cookie.includes('number_of_person='));
const priceByNightCookie = cookies.find(cookie => cookie.includes('priceByNight='));

// Afficher les valeurs dans le formulaire
startDate.innerHTML = startDateCookie.split('=')[1];
endDate.innerHTML = endDateCookie.split('=')[1];
numberOfPerson.innerHTML = numberOfPersonCookie.split('=')[1];
priceByNight.innerHTML = priceByNightCookie.split('=')[1];

// Supprimer les cookies après utilisation
document.cookie = 'city=; expires=Thu, 01 Jan 2033 00:00:00 UTC;';
document.cookie = 'start_date=; expires=Thu, 01 Jan 2033 00:00:00 UTC;';
document.cookie = 'end_date=; expires=Thu, 01 Jan 2033 00:00:00 UTC;';
document.cookie = 'number_of_person=; expires=Thu, 01 Jan 2033 00:00:00 UTC;';
document.cookie = 'priceByNight=; expires=Thu, 01 Jan 2033 00:00:00 UTC;';