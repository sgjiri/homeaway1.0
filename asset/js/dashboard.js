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

})




//activation of contentInfoPerso if #perso is selected
let liInfo = document.getElementsByClassName('liInfo');
let contentPage = document.getElementsByClassName('contentPage');

for (let i = 0; i < liInfo.length; i++) {
    (function (index) {
        liInfo[index].addEventListener('click', function () {
            for (let j = 0; j < contentPage.length; j++) {
                contentPage[j].classList.remove('contentPageActive');
            }
            contentPage[index - 1].classList.add('contentPageActive');
            console.log(contentPage);
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







