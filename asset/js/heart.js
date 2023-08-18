
// let heartIcons = document.getElementsByClassName('heartIcon');

// for (let i = 0; i < heartIcons.length; i++) {
//   let heartIcon = heartIcons[i];
//   let heartImage = heartIcon.querySelector('img');

//   heartIcon.addEventListener('click', function(e) {
//    e.stopPropagation();
//     if (heartImage.src.includes('iconHeartBlack.png')) {
//       heartImage.src = './asset/img/iconHeartRed.png';
//     } else {
//       heartImage.src = './asset/img/iconHeartBlack.png';
//     }
//   });
// }
let heartIcons = document.getElementsByClassName('heartIcon');

for (let i = 0; i < heartIcons.length; i++) {
  let heartIcon = heartIcons[i];
  let heartImage = heartIcon.querySelector('img');

  heartIcon.addEventListener('click', function(e) {
    e.stopPropagation();
    
    // Récupérer l'identifiant du logement
    let idLogementHiddenElement = heartIcon.closest('.item').querySelector('.idLogementHidden');
    let idLogementHidden = idLogementHiddenElement.value;
    console.log(idLogementHidden);
    // Créer un objet FormData et y ajouter les valeurs du formulaire
    let formData = new FormData();
    formData.append('id_logement', idLogementHidden);
    
    // Effectuer une requête fetch pour ajouter le logement aux favoris
    fetch('/Projet/homeaway1.0/favorite', {
      method: 'POST',
      body: formData
    })
    .then(response => {
      if (response.ok) {
        // Mettre à jour l'icône du cœur sur la page après avoir ajouté le logement aux favoris
        if (heartImage.src.includes('iconHeartBlack.png')) {
          heartImage.src = './asset/img/iconHeartRed.png';
        } else {
          heartImage.src = './asset/img/iconHeartBlack.png';
        }
      } else {
        console.error('Une erreur s\'est produite lors de l\'ajout aux favoris.');
      }
    })
    .catch(error => {
      console.error('Une erreur s\'est produite lors de la requête d\'ajout aux favoris:', error);
    });
  });
}