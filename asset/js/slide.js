// Récupérer la largeur de la fenêtre de défilement
let windowSlider = document.getElementById('window-slider').offsetWidth;
// Récupérer l'élément de la liste des diapositives
let listSlide = document.getElementById('list-slide');
// Récupérer toutes les diapositives
let slide = document.getElementsByClassName('slide');
// Nombre total de diapositives
let nbSlide = slide.length;
// Décalage horizontal initial
let mLeft = 0;

// Indice de la diapositive actuelle
let currentSlide = 0;

// Fonction pour passer à la diapositive suivante
function nextSlide() {
   // Masquer la diapositive actuelle
   slide[currentSlide].style.display = "none";
   // Calculer l'indice de la diapositive suivante en bouclant
   currentSlide = (currentSlide + 1) % nbSlide;
   // Afficher la diapositive suivante
   slide[currentSlide].style.display = "block";
}

// Fonction pour passer à la diapositive précédente
function prevSlide() {
   // Masquer la diapositive actuelle
   slide[currentSlide].style.display = "none";
   // Calculer l'indice de la diapositive précédente en bouclant
   currentSlide = (currentSlide - 1 + nbSlide) % nbSlide;
   // Afficher la diapositive précédente
   slide[currentSlide].style.display = "block";
}

// Gestionnaire d'événement pour le toucher de début
function handleTouchStart(evt) {
   // Récupérer la position initiale du toucher
   xDown = evt.touches[0].clientX;
   yDown = evt.touches[0].clientY;
}

// Gestionnaire d'événement pour le mouvement du toucher
function handleTouchMove(evt) {
   if (!xDown || !yDown) {
      return;
   }

   // Récupérer la position actuelle du toucher
   let xUp = evt.touches[0].clientX;
   let yUp = evt.touches[0].clientY;

   // Calculer la différence horizontale et verticale
   let xDiff = xDown - xUp;
   let yDiff = yDown - yUp;

   // Vérifier si le déplacement horizontal est plus important que le déplacement vertical
   if (Math.abs(xDiff) > Math.abs(yDiff)) {
      if (xDiff > 0) {
         // Déplacement horizontal vers la gauche, passer à la diapositive suivante
         nextSlide();
      } else {
         // Déplacement horizontal vers la droite, passer à la diapositive précédente
         prevSlide();
      }
   }

   // Réinitialiser les positions du toucher
   xDown = null;
   yDown = null;
}

// Ajouter des écouteurs d'événement pour le toucher de début et le mouvement du toucher
listSlide.addEventListener("touchstart", handleTouchStart, false);
listSlide.addEventListener("touchmove", handleTouchMove, false);