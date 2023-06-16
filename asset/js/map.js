/*map*/

let blop = document.getElementById('map')

class LeafletMap {
    constructor(){
        this.map = null
    }
    load(element) {
        this.map = L.map(element)
        L.tileLayer('https://tiles.stadiamaps.com/tiles/osm_bright/{z}/{x}/{y}{r}.png', {
            maxZoom: 20,
            attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
        }).addTo(this.map)
    }
    addMarker(lat,lng,text){
        L.popup({
           autoClose:false, 
           closeOnEscapeKey :false,
           closeOnClick : false,
           closeButton : false,
           className :'marker',
           maxWidth: 400 
        })
        .setLatLng([lat, lng])
        .setContent(text)
        .openOn(this.map)

    }

}

const initMap = function () {
    let map = new LeafletMap()
    map.load(blop)
    Array.from(document.querySelectorAll('.js-marker')).forEach((item)=>{
        map.addMarker(item.dataset.lat, item.dataset.lng, item.dataset.price+'€')
    })
}

if (blop !== null) {
    initMap()
}

// let map = L.map('map').setView([51.505, -0.09], 13);
// L.tileLayer('https://tiles.stadiamaps.com/tiles/osm_bright/{z}/{x}/{y}{r}.png', {
//     maxZoom: 20,
//     attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
// }).addTo(map)

// L.popup()
//     .setLatLng([51.505, -0.09])
//     .setContent('<p>Hello world!<br />This is a nice popup.</p>')
//     .openOn(map);