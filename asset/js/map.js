// Récupérer l'élément de la carte dans le DOM
let mappy = document.getElementById('map');

// Classe LeafletMap pour gérer la carte Leaflet
class LeafletMap {
  constructor() {
    this.map = null; // Référence à l'objet de la carte Leaflet
    this.bounds = []; // Tableau des points des marqueurs pour ajuster le zoom de la carte
    this.activeMarker = null; // Référence au marqueur actif
  }

  // Méthode pour charger la carte Leaflet
  async load(element) {
    return new Promise((resolve, reject) => {
      // Charger la bibliothèque Leaflet depuis le CDN Content Delivery Network (Réseau de diffusion de contenu). $scrit est une fonction d'une bibliothèque tierce appelée "script.js" qui facilite le chargement asynchrone de scripts externes.
      $script("https://unpkg.com/leaflet@1.9.4/dist/leaflet.js", () => {
        // Créer la carte Leaflet dans l'élément spécifié
        this.map = L.map(element, { scrollWheelZoom: false });
        
        // Ajouter la couche de tuiles de la carte à partir de Stadia Maps
        L.tileLayer('https://tiles.stadiamaps.com/tiles/osm_bright/{z}/{x}/{y}{r}.png', {
          attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
        }).addTo(this.map);
        
        resolve(); // Résoudre la promesse une fois que la carte est chargée
      });
    });
  }

  // Méthode pour ajouter un marqueur à la carte
  addMarker(lat, lng, text) {
    let point = [lat, lng];
    this.bounds.push(point); // Ajouter le point du marqueur aux limites de la carte
    return new LeafletMarker(point, text, this.map, this);
  }

  // Méthode pour centrer la carte sur tous les marqueurs
  center() {
    this.map.fitBounds(this.bounds);
  }

  // Méthode pour définir le marqueur actif
  setActiveMarker(marker) {
    if (this.activeMarker !== null && this.activeMarker !== marker) {
      this.activeMarker.resetContent();
    }
    this.activeMarker = marker;
  }

  // Méthode pour réinitialiser le marqueur actif
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

  // Méthode pour définir le marqueur comme actif
  setActive() {
    this.popup.getElement().classList.add('is-active');
  }

  // Méthode pour définir le marqueur comme inactif
  unsetActive() {
    this.popup.getElement().classList.remove('is-active');
  }

  // Méthode pour ajouter un écouteur d'événement au marqueur
  addEventListener(event, callback) {
    this.popup.addEventListener('add', () => {
      this.popup.getElement().addEventListener(event, callback);
    });
  }

  // Méthode pour définir le contenu du marqueur
  setContent(text) {
    this.popup.setContent('<div class="popup-content">' + text + '</div>');
    this.popup.getElement().classList.add('is-expanded');
    this.popup.update();

    // Ajouter un écouteur d'événement au bouton de fermeture du marqueur
    const closeButton = this.popup.getElement().querySelector('.close-button');
    closeButton.addEventListener('click', (event) => {
      event.stopPropagation();
      this.resetContent();
      this.leafletMap.resetActiveMarker();
    });
  }

  // Méthode pour réinitialiser le contenu du marqueur
  resetContent() {
    this.popup.setContent('<div class="popup-content">' + this.text + '</div>');
    this.popup.getElement().classList.remove('is-expanded');
    this.popup.update();
  }
}

// Fonction d'initialisation de la carte et des marqueurs
const initMap = async function () {
  try {
    const leafletMap = new LeafletMap(); // Créer une instance de LeafletMap

    await leafletMap.load(mappy); // Charger la carte Leaflet

    // Récupérer tous les marqueurs à partir des éléments avec la classe "js-marker"
    const markers = document.querySelectorAll('.js-marker');

    markers.forEach((marker) => {
      const lat = marker.getAttribute('data-lat');
      const lng = marker.getAttribute('data-lng');
      const text = marker.innerHTML;

      // Ajouter un marqueur à la carte
      leafletMap.addMarker(lat, lng, text);
    });

    leafletMap.center(); // Centrer la carte sur tous les marqueurs
  } catch (error) {
    console.error(error);
  }
};

// Vérifier si l'élément de la carte existe dans le DOM et l'initialiser
if (mappy !== null) {
  initMap();
}