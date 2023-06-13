let like = document.getElementById('like');
let info = document.getElementById('info');
let resevations = document.getElementById('resevations');
let messagerie = document.getElementById('messagerie');
let nav = document.getElementById('navDash');
let iconLike = document.getElementById('iconLike');
like.addEventListener('click', function () {
    like.classList.add('likeActive');
    nav.classList.add('likeActive');
    iconLike.classList.add('likeActive');
    info.classList.add('likeActive')
})

info.addEventListener('click', function () {
    info.classList.add('infoActive');
    like.classList.remove('likeActive');
    iconInfo.classList.add('iconInfo')
})



// let figureModifier = document.getElementById('figureModifier');
// let imgModifier = document.getElementById('imgModifier');
// let setName = document.getElementById('setName');

// figureModifier.addEventListener('click', function(){
//     imgModifier.classList.toggle('activeModifie');
//     setName.classList.toggle('activeInput');
// })

let classFigureModifier = document.getElementsByClassName('figureModifier');
let classImgModifier = document.getElementsByClassName('imgModifier');
let classInput = document.getElementsByClassName('input');
let classCard = document.getElementsByClassName('card');

for (let i = 0; i < classFigureModifier.length; i++) {
    (function (index) {

        classCard[index].id = index + 1 + 'card';
        classFigureModifier[index].addEventListener('click', function () {

            classImgModifier[index].classList.toggle('activeModifie');
            classInput[index].classList.toggle('activeInput');

            const elements = document.querySelectorAll('.classCard');
            elements.forEach(function (element, index) {
                const id = element.id;
                const num = parseInt(id.match(/^\d+/)[0]); // extrait le numéro du début de l'id
                if (num > index) {
                    // Faites quelque chose avec l'élément classCard[index]
                    console.log(element);
                }
            });



            // if (classCard.id[0] > index) {
            //     classCard[i].classList.toggle('activeModifie');
            // }
        });
    })(i);
}