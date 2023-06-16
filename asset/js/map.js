/*map*/

let mappy = document.getElementById('map')

class LeafletMap {
    constructor(){
        this.map = null
        this.bounds=[]
    }
   async load(element) {
    return new Promise((resolve, reject) => {
         $script("https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" , () => {
              this.map = L.map(element, {scrollWheelZoom: false})
        L.tileLayer('https://tiles.stadiamaps.com/tiles/osm_bright/{z}/{x}/{y}{r}.png', {
           
            attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
        }).addTo(this.map)
        resolve()
        })
    })
       
      
    }
    addMarker(lat,lng,text){
        let point=[lat,lng]
        this.bounds.push(point)
        return new LeafletMarker(point,text, this.map)

    }

    center() {
        this.map.fitBounds(this.bounds)
    }

}
class LeafletMarker {
    constructor(point, text, map) {
        this.popup= L.popup({
            autoClose:false, 
            closeOnEscapeKey :false,
            closeOnClick : false,
            closeButton : false,
            className :'marker',
            maxWidth: 400 
         })
         .setLatLng(point)
         .setContent(text)
         .openOn(map)
    }
    setActive() {
        this.popup.getElement().classList.add('is-active')
    }
    unsetActive() {
        this.popup.getElement().classList.remove('is-active')
    }
    addEventListener(event, callback) {
        this.popup.addEventListener('add',  () => {
          this.popup.getElement().addEventListener(event,callback)  
        })        
    }
    setContent (text) {
        this.popup.setContent(this.text)
        this.popup.getElement().classList.add('is-expended')
        this.popup.update()

    }
    resetContent () {
        this.popup.setContent(this.text)
        this.popup.getElement().classList.remove('is-expended')
        this.popup.update()

    }
}

const initMap = async function () {
    let map = new LeafletMap()
    let hoverMarker = null
    let activeMarker= null
     await map.load(mappy)
    Array.from(document.querySelectorAll('.js-marker')).forEach((item)=>{
       let marker= map.addMarker(item.dataset.lat, item.dataset.lng, item.dataset.price+'€')
        item.addEventListener('mouseover', function() {
            if(hoverMarker !== null) {
                hoverMarker.unsetActive()
            }
            marker.setActive()
            hoverMarker = marker
        })
        item.addEventListener('mouseleave', function () {
            if(hoverMarker !== null){
                hoverMarker.unsetActive()
            }
        })
        marker.addEventListener('click', function () {
            if(activeMarker !== null){
                activeMarker.resetContent()
            }
            marker.setContent(item.innerHTML)
            activeMarker = marker
        })
        
    })
    map.center() 
}

if (mappy !== null) {
    initMap()
}

