

// menuBurger = document.getElementById ('menuBurger')
// navConnectPhone = document.getElementById('navConnectPhone')
// navDisconnectPhone = document.getElementById ('navDisconnectPhone')

searchPhone = document.getElementById('searchPhone')
searchBoxPhone = document.getElementById('searchBoxPhone')


// loginBox = document.getElementById('loginBox')
// loginButton = document.getElementById('loginButton')
// const registerButton = document.getElementById("registerButton");
// const tab1 = document.getElementById("tab-1");
// const tab2 = document.getElementById("tab-2");

// const close =document.getElementById('close')




searchPhone.addEventListener('click', function(){
    
    searchBoxPhone.classList.toggle('formSearchActive') 
})


let map = L.map('map').setView([51.505, -0.09], 13);
let Stadia_OSMBright = L.tileLayer('https://tiles.stadiamaps.com/tiles/osm_bright/{z}/{x}/{y}{r}.png', {
	maxZoom: 20,
	attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
});

Stadia_OSMBright.addTo(map)

