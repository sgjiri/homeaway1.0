// Sélectionner tous les éléments avec la classe 'heartIcon'
let heartIcons = document.getElementsByClassName('heartIcon');

// Sélectionner l'élément conteneur du message
let messageContainer = document.getElementById('messageContainer');

// Parcourir tous les icônes de cœur
for (let i = 0; i < heartIcons.length; i++) {
  let heartIcon = heartIcons[i];
  let heartImage = heartIcon.querySelector('img');

  // Ajouter un gestionnaire d'événement click à chaque icône de cœur
  heartIcon.addEventListener('click', function(e) {
    e.stopPropagation();
    
    // Récupérer l'identifiant du logement
    let idLogementHiddenElement = heartIcon.closest('.item').querySelector('.idLogementHidden');
    let idLogementHidden = idLogementHiddenElement.value;
    
    // Créer un objet FormData et y ajouter les valeurs du formulaire
    let formData = new FormData();
    formData.append('id_logement', idLogementHidden);
    
    // Vérifier l'état actuel de l'icône du cœur
    let isFavorite = heartImage.src.includes('iconHeartRed.png');
    
    if (isFavorite) {
      // Effectuer une requête fetch pour supprimer le logement des favoris
      fetch('/Projet/homeaway1.0/delfavorite', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (response.ok) {
          // Mettre à jour l'icône du cœur sur la page après avoir supprimé le logement des favoris
          heartImage.src = './asset/img/iconHeartBlack.png';
          // Afficher le message de succès
          messageContainer.innerHTML = 'Le logement a été supprimé des favoris.';
        } else {
          console.error('Une erreur s\'est produite lors de la suppression des favoris.');
        }
      })
      .catch(error => {
        console.error('Une erreur s\'est produite lors de la requête de suppression des favoris:', error);
      });
    } else {
      // Effectuer une requête fetch pour ajouter le logement aux favoris
      fetch('/Projet/homeaway1.0/favorite', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (response.ok) {
          // Mettre à jour l'icône du cœur sur la page après avoir ajouté le logement aux favoris
          heartImage.src = './asset/img/iconHeartRed.png';
          // Afficher le message de succès
          messageContainer.innerHTML = 'Le logement a été ajouté aux favoris.';
        } else {
          console.error('Une erreur s\'est produite lors de l\'ajout aux favoris.');
        }
      })
      .catch(error => {
        console.error('Une erreur s\'est produite lors de la requête d\'ajout aux favoris:', error);
      });
    }
  });
}