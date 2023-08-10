if (document.getElementsByClassName('article')) {
  const searchForm = document.getElementsByClassName('item');

  for (let i = 0; i < searchForm.length; i++) {
    searchForm[i].addEventListener('click', (event) => {
      event.preventDefault();

      const startDate = document.getElementById('start_dateM').value;
      const endDate = document.getElementById('end_dateM').value;
      const numberOfPerson = document.getElementById('number_of_personM').value;
      const idLogement = document.getElementsByClassName('idLogement')[i].innerHTML;
      const priceByNight = document.getElementsByClassName('priceByNight')[i].innerHTML;
      const totalPrices = document.getElementsByClassName('totalPrices')[i].innerHTML;

      // Stocker les valeurs dans des cookies avec une durée d'expiration plus longue
      document.cookie = `start_date=${startDate}; expires=Fri, 31 Dec 9999 23:59:59 UTC`;
      document.cookie = `end_date=${endDate}; expires=Fri, 31 Dec 9999 23:59:59 UTC`;
      document.cookie = `number_of_person=${numberOfPerson}; expires=Fri, 31 Dec 9999 23:59:59 UTC`;
      document.cookie = `priceByNight=${priceByNight}; expires=Fri, 31 Dec 9999 23:59:59 UTC`;
      document.cookie = `totalPrices=${totalPrices}; expires=Fri, 31 Dec 9999 23:59:59 UTC`;

      console.log(document.cookie);

      window.location.href = "http://localhost/Projet/homeaway1.0/one" + idLogement;
    });
  }
}

const startDate = document.getElementById('startDate');
const endDate = document.getElementById('endDate');
const numberOfPerson = document.getElementById('numberOfPerson');
const priceByNight = document.getElementById('priceByNight');
const totalPrices = document.getElementById('totalPrices');

const cookies = document.cookie.split(';');

const startDateCookie = cookies.find(cookie => cookie.includes('start_date='));
const endDateCookie = cookies.find(cookie => cookie.includes('end_date='));
const numberOfPersonCookie = cookies.find(cookie => cookie.includes('number_of_person='));
const priceByNightCookie = cookies.find(cookie => cookie.includes('priceByNight='));
const totalPricesCookie = cookies.find(cookie => cookie.includes('totalPrices='));

startDate.innerHTML = startDateCookie ? startDateCookie.split('=')[1].trim() : '';
endDate.innerHTML = endDateCookie ? endDateCookie.split('=')[1].trim() : '';
numberOfPerson.innerHTML = numberOfPersonCookie ? numberOfPersonCookie.split('=')[1].trim() : '';
priceByNight.innerHTML = priceByNightCookie ? priceByNightCookie.split('=')[1].trim() : '';
totalPrices.innerHTML = totalPricesCookie ? totalPricesCookie.split('=')[1].trim() : '';

