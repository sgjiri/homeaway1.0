if (document.getElementsByClassName('article')) {
  const item = document.getElementsByClassName('item');

  for (let i = 0; i < item.length; i++) {
    item[i].addEventListener('click', (event) => {
      event.preventDefault();

      const startDate = document.getElementById('start_dateM').value;
    
      const endDate = document.getElementById('end_dateM').value;
      const numberOfPerson = document.getElementById('number_of_personM').value;
      const idLogement = document.getElementsByClassName('idLogement')[i].innerHTML;
      const priceByNight = document.getElementsByClassName('priceByNight')[i].innerHTML;
      const totalPrices = document.getElementsByClassName('totalPrices')[i].innerHTML;

      // Stocker les valeurs dans des cookies avec une durée d'expiration plus longue
      //ancienne méthode :document.cookie = 'start_date=' + startDate + '; expires=Fri, 31 Dec 9999 23:59:59 UTC';
      document.cookie = `start_date=${startDate}; expires=Fri, 31 Dec 9999 23:59:59 UTC`;
      document.cookie = `end_date=${endDate}; expires=Fri, 31 Dec 9999 23:59:59 UTC`;
      document.cookie = `number_of_person=${numberOfPerson}; expires=Fri, 31 Dec 9999 23:59:59 UTC`;
      document.cookie = `id_logement=${idLogement}; expires=Fri, 31 Dec 9999 23:59:59 UTC`;

      document.cookie = `priceByNight=${priceByNight}; expires=Fri, 31 Dec 9999 23:59:59 UTC`;
      document.cookie = `totalPrices=${totalPrices}; expires=Fri, 31 Dec 9999 23:59:59 UTC`;

      

      window.location.href = "http://localhost/Projet/homeaway1.0/one" + idLogement;
    });
  }
}

const startDate = document.getElementById('startDate');
const endDate = document.getElementById('endDate');
const numberOfPerson = document.getElementById('numberOfPerson');
const id_logement = document.getElementById('id_logement');
const priceByNight = document.getElementById('priceByNight');
const totalPrices = document.getElementById('totalPrices');
// Diviser les cookies en un tableau de chaînes de caractères
const cookies = document.cookie.split(';');
// Rechercher les cookies correspondants et extraire leurs valeurs
const startDateCookie = cookies.find(cookie => cookie.includes('start_date='));
const endDateCookie = cookies.find(cookie => cookie.includes('end_date='));
const numberOfPersonCookie = cookies.find(cookie => cookie.includes('number_of_person='));
const idLogementCookie = cookies.find(cookie => cookie.includes('id_logement='));
const priceByNightCookie = cookies.find(cookie => cookie.includes('priceByNight='));
const totalPricesCookie = cookies.find(cookie => cookie.includes('totalPrices='));
// Définir les valeurs des éléments du formulaire en utilisant les valeurs des cookies
startDate.value = startDateCookie ? startDateCookie.split('=')[1].trim() : '';
endDate.value = endDateCookie ? endDateCookie.split('=')[1].trim() : '';
numberOfPerson.innerHTML = numberOfPersonCookie ? numberOfPersonCookie.split('=')[1].trim() : '';
id_logement.value = idLogementCookie ? idLogementCookie.split('=')[1].trim() : '';
priceByNight.innerHTML = priceByNightCookie ? priceByNightCookie.split('=')[1].trim() : '';
totalPrices.innerHTML = totalPricesCookie ? totalPricesCookie.split('=')[1].trim() : '';

console.log(startDate.value )