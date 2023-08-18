let resevations = document.getElementById('resevations');
let messagerie = document.getElementById('messagerie');
let nav = document.getElementById('navDash');
let iconLike = document.getElementById('iconLike');

if(document.getElementById('like')){
    let like = document.getElementById('like');
    like.addEventListener('click', function () {
        like.classList.add('likeActive');
        nav.classList.add('likeActive');
        iconLike.classList.add('likeActive');
        info.classList.add('likeActive')
    })
}
if(document.getElementById('info')) {
    let info = document.getElementById('info');
    info.addEventListener('click', function () {
        info.classList.add('infoActive');
        like.classList.remove('likeActive');
    
    })
}




//activation of contentInfoPerso if #perso is selected
let clickInfo = document.getElementsByClassName('clickInfo');
let contentPage = document.getElementsByClassName('contentPage');

for (let i = 0; i < clickInfo.length; i++) {
    (function (index) {
        clickInfo[index].addEventListener('click', function () {
            for (let j = 0; j < contentPage.length; j++) {
                contentPage[j].classList.remove('contentPageActive');
            }
            contentPage[index - 1].classList.add('contentPageActive');
        })
    })(i);
}




function animationInput(idFigure, idCard, idImg, idInput) {
    let classFigureModifier = document.getElementsByClassName(idFigure);
    let classCard = document.getElementsByClassName(idCard);
    let classImgModifier = document.getElementsByClassName(idImg);
    let classInput = document.getElementsByClassName(idInput);

    for (let i = 0; i < classFigureModifier.length; i++) {
        (function (index) {
    
    
            classFigureModifier[index].addEventListener('click', function () {
    
    
                classImgModifier[index].classList.toggle('activeModifie');
                classInput[index].classList.toggle('activeInput');
                classCard[index].classList.toggle('active');
            });
        })(i);
    }
}

animationInput('figureModifierInfo', 'cardInfoPersoM', 'imgModifierInfo', 'inputInfo');
animationInput('figureModifierGestion', 'cardH', 'imgModifierGestion','inputGA');



window.addEventListener('load', function() {
    // Obtenez la valeur du paramètre de requête 'activeElement' depuis l'URL
    const urlParams = new URLSearchParams(window.location.search);
    const activeElement = urlParams.get('activeElement');

    if (activeElement) {
        // Ajoutez la classe 'contentPageActive' à l'élément correspondant à l'ID
        const elementToActivate = document.getElementById(activeElement);
        if (elementToActivate) {
            elementToActivate.classList.add('contentPageActive');
        }
    }
});


// Sélectionnez tous les éléments avec la classe 'labelSelectImage'
let classLabelSelectImage = document.getElementsByClassName('labelSelectImage');
// Sélectionnez tous les éléments avec la classe 'InputSelectImage'
let classInputSelectImage = document.getElementsByClassName('InputSelectImage');

// Parcourez chaque élément 'labelSelectImage'
for (let i = 0; i < classLabelSelectImage.length; i++) {
    // Utilisez une fonction anonyme pour capturer la valeur de 'i'
    (function (index) {
        // Ajoutez un écouteur d'événement 'click' à chaque élément 'labelSelectImage'
        classLabelSelectImage[index].addEventListener('click', function () {
            // Inversez l'état de la propriété 'checked' de l'élément 'InputSelectImage' correspondant
            classInputSelectImage[index].checked = !classInputSelectImage[index].checked;
        });
    })(i);
}




let deleteUser=document.getElementById('spanSuprimerUser');
let popop = document.getElementById('popop');
let popopValider = document.getElementById('popopvalider');

deleteUser.addEventListener('click', function() {
    popop.classList.add('popopActive')
    popopValider.setAttribute("name", "suprimerUser");
});





let addImage = document.getElementsByClassName('spanPlus2');

for (let i = 0; i < addImage.length; i++) {
    addImage[i].addEventListener('click', function(e) {
        e.preventDefault()
    });
}


let cross = document.getElementById('cross');
cross.addEventListener('click', function(){

    popop.classList.remove('popopActive');
})



let classInputSuprimerLogement = document.getElementsByClassName('suprimerLogement');
let inputHidden = document.getElementById('inputHiddenPopop');
let getMessagePopop = document.getElementById('messagePopop');

for (let i = 0; i < classInputSuprimerLogement.length; i++) {

    classInputSuprimerLogement[i].addEventListener('click', function () {
        let idLogement = this.getAttribute("data-idLogement");
        let nameLogement = this.getAttribute("data-nameLogement");
        getMessagePopop.innerHTML = "Voulez vous vraiment supprimer le logement " + nameLogement + "?";
        popop.classList.add('popopActive');
        popopValider.setAttribute("name", "suprimerLogement");
        inputHidden.setAttribute("value", idLogement)
    });
}


let classInputSuprimerLike = document.getElementsByClassName('suprimerLike');

for (let i = 0; i < classInputSuprimerLike.length; i++) {

    classInputSuprimerLike[i].addEventListener('click', function () {
        let idLogement = this.getAttribute("data-idLogement");
        getMessagePopop.innerHTML = "Voulez vous vraiment supprimer ce logement de vos favorit?";
        popop.classList.add('popopActive');
        popopValider.setAttribute("name", "suprimerLike");
        inputHidden.setAttribute("value", idLogement)
    });
}



//Funtion pour surprimer les images



    for (let i = 0; i < classInputSuprimerLogement.length; i++) {
        
        classInputSuprimerLogement[i].addEventListener('click', function() {
            let idLogement = this.getAttribute("data-idLogement");
            let nameLogement = this.getAttribute("data-nameLogement");
            getMessagePopop.innerHTML = "Voulez vous vraiment supprimer le logement " + nameLogement + "?";
            popop.classList.add('popopActive');
            popopValider.setAttribute("name", "suprimerLogement");
            inputHidden.setAttribute("value", idLogement)
        });
    }


//     let classInputSuprimerImg = document.getElementsByClassName('suprimerImg');
//     for (let i = 0; i < classInputSuprimerImg.length; i++) {


//         classInputSuprimerLogement[i].addEventListener('click', function() {    
//     for (let i = 0; i < classInputSelectImage.length; i++) {

//         if(classInputSelectImage[i].checked===true){
//             console.log(classInputSelectImage[i]);
//         }

//     }
// }
//     }




