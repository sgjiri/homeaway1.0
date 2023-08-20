// Récupérer l'élément de la carte
let mappy = document.getElementById('map');

// Classe LeafletMap pour gérer la carte Leaflet
class LeafletMap {
  constructor() {
    this.map = null;
    this.bounds = [];
    this.activeMarker = null;
  }

  async load(element) {
    return new Promise((resolve, reject) => {
      // Charger la bibliothèque Leaflet
      $script("https://unpkg.com/leaflet@1.9.4/dist/leaflet.js", () => {
        // Créer la carte Leaflet
        this.map = L.map(element, { scrollWheelZoom: false });
        // Ajouter la couche de tuiles de la carte
        L.tileLayer('https://tiles.stadiamaps.com/tiles/osm_bright/{z}/{x}/{y}{r}.png', {
          attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
        }).addTo(this.map);
        resolve();
      });
    });
  }

  addMarker(lat, lng, text) {
    let point = [lat, lng];
    this.bounds.push(point);
    return new LeafletMarker(point, text, this.map, this);
  }

  center() {
    this.map.fitBounds(this.bounds);
  }

  setActiveMarker(marker) {
    if (this.activeMarker !== null && this.activeMarker !== marker) {
      this.activeMarker.resetContent();
    }
    this.activeMarker = marker;
  }

  resetActiveMarker() {
    if (this.activeMarker !== null) {
      this.activeMarker.resetContent();
      this.activeMarker.unsetActive();
      this.activeMarker = null;
    }
  }
}

// Classe LeafletMarker pour gérer les marqueurs Leaflet
class LeafletMarker {
  constructor(point, text, map, leafletMap) {
    this.text = text;
    this.popup = L.popup({
      autoClose: false,
      closeOnEscapeKey: false,
      closeOnClick: false,
      closeButton: false,
      className: 'marker',
      maxWidth: 400
    })
      .setLatLng(point)
      .setContent('<div class="popup-content">' + text + '</div>')
      .openOn(map);
    this.leafletMap = leafletMap;
  }

  setActive() {
    this.popup.getElement().classList.add('is-active');
  }

  unsetActive() {
    this.popup.getElement().classList.remove('is-active');
  }

  addEventListener(event, callback) {
    this.popup.addEventListener('add', () => {
      this.popup.getElement().addEventListener(event, callback);
    });
  }

  setContent(text) {
    this.popup.setContent('<div class="popup-content">' + text + '</div>');
    this.popup.getElement().classList.add('is-expanded');
    this.popup.update();

    const closeButton = this.popup.getElement().querySelector('.close-button');
    closeButton.addEventListener('click', (event) => {
      event.stopPropagation();
      this.resetContent();
      this.leafletMap.resetActiveMarker();
    });
  }

  resetContent() {
    this.popup.setContent('<div class="popup-content">' + this.text + '</div>');
    this.popup.getElement().classList.remove('is-expanded');
    this.popup.update();
  }
}

// Fonction d'initialisation de la carte
const initMap = async function () {
  let map = new LeafletMap();
  let hoverMarker = null;
  await map.load(mappy);
  // Récupérer tous les éléments de marqueur
  Array.from(document.querySelectorAll('.js-marker')).forEach((item) => {
    let marker = map.addMarker(item.dataset.lat, item.dataset.lng, item.dataset.price + '€');
    item.addEventListener('mouseover', function () {
      if (hoverMarker !== null) {
        hoverMarker.unsetActive();
      }
      marker.setActive();
      hoverMarker = marker;
    });
    item.addEventListener('mouseleave', function () {
      if (hoverMarker !== null) {
        hoverMarker.unsetActive();
      }
    });
    marker.addEventListener('click', function () {
      if (map.activeMarker === marker && marker.popup.getElement().classList.contains('is-expanded')) {
        marker.resetContent();
        marker.unsetActive();
        map.resetActiveMarker();
      } else {
        marker.setContent(item.innerHTML);
        map.setActiveMarker(marker);
      }
    });
  });
  map.center();
};

// Vérifier si l'élément de la carte existe
if (mappy !== null) {
  // Initialiser la carte
  initMap();
}