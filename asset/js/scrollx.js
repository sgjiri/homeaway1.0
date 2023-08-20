

//centrer image cliqué 
function centerImageInGallery(selectedImg) {
    let galleryContainer = document.getElementById('scrollbar');  
    let galleryWidth = galleryContainer.offsetWidth;
    //position horizontale de l'image sélectionnée
    let selectedImgOffsetLeft = selectedImg.offsetLeft;
    //La largeur de l'image sélectionnée 
    let selectedImgWidth = selectedImg.clientWidth;
    let selectedImgCenter = selectedImgOffsetLeft + (selectedImgWidth / 2);
    let scrollLeft = selectedImgCenter - (galleryWidth / 2);

    // Faire défiler horizontalement le conteneur de la galerie pour centrer l'image
    galleryContainer.scrollTo({
      left: scrollLeft,
      behavior: 'smooth'
    });
  }

// img take place
// Récupérer la première image en haut de la galerie
let imgTop = document.getElementsByClassName('imgTop')[0];
// Récupérer toutes les images de la galerie
let imgGallery = document.getElementsByClassName('imgGallery');

// Ajouter un écouteur d'événement 'click' à chaque image de la galerie
for (let i = 0; i < imgGallery.length; i++) {
    imgGallery[i].addEventListener('click', function() {
        let srcImgGallery = imgGallery[i].getAttribute('src');
        // Ajouter un écouteur d'événement 'click' à chaque image de la galerie
        imgTop.setAttribute('src', srcImgGallery);
          // Centrer l'image sélectionnée dans la galerie
        centerImageInGallery(imgGallery[i]);
    });
}
