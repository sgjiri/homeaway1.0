// let span = document.getElementById('spanPlus');
// const addFlat = document.getElementById('add-flat');
// const addImg = document.getElementById('addImg');

// let clickCount = 1;

// // Cette fonction gère le téléchargement d'une image au serveur
// function uploadImage(imageInput, id_logement) {
//     // Crée un objet FormData pour stocker les données du formulaire à envoyer
//     const data = new FormData();
  
//     // Ajoute l'ID du logement au FormData pour l'associer à l'image téléchargée
//     data.append('id_logement', id_logement);
  
//     // Ajoute l'image sélectionnée par l'utilisateur au FormData
//     data.append('thumbnail', imageInput.files[0]);
  
//     // Effectue une requête Fetch pour envoyer l'image au serveur
//     fetch('./addLogement', {
//       method: 'POST',
//       body: data // Utilise l'objet FormData comme corps de la requête
//     })
//       .then((response) => response.json()) // Transforme la réponse en JSON
//       .then((datas) => {
//         // Une fois la réponse (JSON) reçue, exécute cette fonction de rappel
//         // qui traite la réponse du serveur
//         const lastInsertId = datas; // Récupère l'ID de la dernière insertion du serveur
  
//         // Crée un nouvel élément input de type 'hidden' pour stocker l'ID de l'image insérée
//         const idLogement = document.createElement('input');
//         idLogement.type = 'hidden';
//         idLogement.name = 'id_logement';
//         idLogement.value = lastInsertId;
  
//         // Ajoute l'élément input 'id_logement' au formulaire avec les données envoyées
//         addImg.append(idLogement);
  
//         // Une fois l'image téléchargée avec succès, passe à l'image suivante (récursivement)
//         const nextImageInput = document.querySelector(`input[name="thumbnail_${clickCount}"]`);
//         if (nextImageInput) {
//           clickCount++;
//           uploadImage(nextImageInput, logementId);
//         } else {
//           // Toutes les images ont été téléchargées, soumettre le formulaire
//           addFlat.submit();
//         }
//       })
//       .catch(error => {
//         console.log(error); // Affiche les erreurs dans la console en cas d'échec de la requête
//       });
//   }
  
//   // Écouteur d'événement pour le bouton '+' (id="spanPlus")
//   span.addEventListener("click", function () {
//     // Crée un nouvel élément div pour contenir l'input de type 'file' pour l'image
//     const div = document.createElement('div');
//     const btnInput = document.createElement('input');
//     btnInput.type = 'file';
//     btnInput.name = 'thumbnail_' + clickCount;
  
//     // Ajoute l'input 'file' au div nouvellement créé
//     div.appendChild(btnInput);
  
//     // Ajoute le div contenant l'input 'file' au formulaire (id="addImg")
//     addImg.prepend(div);
  
//     // Incrémente le compteur pour créer des noms uniques pour chaque input de fichier
//     clickCount++;
//   });
  
//   // Écouteur d'événement pour le formulaire (id="add-flat") lors de la soumission
//   addFlat.addEventListener('submit', function (e) {
//     e.preventDefault(); // Empêche la soumission normale du formulaire
  
//     // Récupère l'élément input 'id_logement' du formulaire
//     const logementIdInput = document.querySelector('input[name="id_logement"]');
  
//     if (logementIdInput) {
//       const id_logement = logementIdInput.value; // Récupère la valeur de l'ID du logement
  
//       // Récupère le premier input de type 'file' qui commence par le nom 'thumbnail_'
//       const firstImageInput = document.querySelector('input[name^="thumbnail_"]');
  
//       if (firstImageInput) {
//         // Si un input 'file' est trouvé, appelle la fonction 'uploadImage'
//         // pour télécharger l'image au serveur
//         uploadImage(firstImageInput, id_logement);
//       }
//     } else {
//       // Si le formulaire ne contient aucune image, soumet simplement le formulaire
//       addFlat.submit();
//     }
//   });
  
function insertImage(idSpan, idForm, idDiv){
let span = document.getElementsByClassName(idSpan);
const addFlat = document.getElementsByClassName(idForm);
const addImg = document.getElementsByClassName(idDiv);

let clickCount = 1;
console.log(addImg);



for (let i = 0; i < span.length; i++) {
    (function (index) {


        span[index].addEventListener('click', function () {
            const div = document.createElement('div');
            const btnInput = document.createElement('input');
            btnInput.type = 'file';
            btnInput.name = 'thumbnail_' + clickCount;
            btnInput.accept = 'image/*';
        
            div.appendChild(btnInput);
            addImg[index].prepend(div);
            clickCount++;
        });
    })(i);
}

}


// insertImage('spanPlus', 'add-flat', 'addImg');
insertImage('spanPlus2', 'formModifierImg', 'changeImage');

// ****AJAX*****//

// addFlat.addEventListener('submit', function (e) {
//     e.preventDefault();

//     const data = new FormData(addFlat)
//     console.log(data);

//     fetch('./add2', {
//         method: 'POST',
//         body: data
//     })
//         .then((response) => response.json())
//         .then((datas) => {
//             const lastInsertId = datas;
//             const idLogement = document.createElement('input');
//             idLogement.type = 'hidden';
//             idLogement.name = 'id_logement';
//             idLogement.value = lastInsertId;
//             addImg.append(idLogement);
//             console.log(datas);
//         })

//         .catch(error => {
//             console.log(error);
//         });
    // form - add.classList.toggle('activeImage')
    // addFlat.classList.toogle('activeFlat');
// })