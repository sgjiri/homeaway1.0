

if (document.getElementsByClassName('article')) {
    const searchForm = document.getElementsByClassName('article');
    console.log(searchForm);

    for (let i = 0; i < searchForm.length; i++) {
      searchForm[i].addEventListener('click', (event) => {
        event.preventDefault();
        const city = document.getElementById('cityM').value
        const startDate = document.getElementById('start_dateM').value;
        const endDate = document.getElementById('end_dateM').value;
        const numberOfPerson = document.getElementById('number_of_personM').value;
        const idLogement = document.getElementsByClassName('idLogement')[i].innerHTML;
        const priceByNight = document.getElementsByClassName('priceByNight')[i].innerHTML;
        const totalPrices = document.getElementsByClassName('totalPrices')[i].innerHTML;
  
        // Stocker les valeurs dans des cookies avec une durée d'expiration plus longue
        document.cookie = `city=${city}; expires=Fri, 31 Dec 9999 23:59:59 UTC`;
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
  const cityHidden = document.getElementById('cityHidden');
  const startDateHidden = document.getElementById('startDateHidden');
  const endDateHidden = document.getElementById('endDateHidden');
  const numberOfPersonHidden = document.getElementById('numberOfPersonHidden');
  
  const cookies = document.cookie.split(';');

  const cityCookie = cookies.find(cookie => cookie.includes('city='));
  const startDateCookie = cookies.find(cookie => cookie.includes('start_date='));
  const endDateCookie = cookies.find(cookie => cookie.includes('end_date='));
  const numberOfPersonCookie = cookies.find(cookie => cookie.includes('number_of_person='));
  const priceByNightCookie = cookies.find(cookie => cookie.includes('priceByNight='));
  const totalPricesCookie = cookies.find(cookie => cookie.includes('totalPrices='));
  
  cityHidden.innerHTML = cityCookie ? cityCookie.split('=')[1].trim() : '';
  startDate.innerHTML = startDateCookie ? startDateCookie.split('=')[1].trim() : '';
  startDateHidden.innerHTML = startDateCookie ? startDateCookie.split('=')[1].trim() : '';
  endDate.innerHTML = endDateCookie ? endDateCookie.split('=')[1].trim() : '';
  endDateHidden.innerHTML = endDateCookie ? endDateCookie.split('=')[1].trim() : '';
  numberOfPerson.innerHTML = numberOfPersonCookie ? numberOfPersonCookie.split('=')[1].trim() : '';
  numberOfPersonHidden.innerHTML = numberOfPersonCookie ? numberOfPersonCookie.split('=')[1].trim() : '';
  priceByNight.innerHTML = priceByNightCookie ? priceByNightCookie.split('=')[1].trim() : '';
  totalPrices.innerHTML = totalPricesCookie ? totalPricesCookie.split('=')[1].trim() : '';
  
