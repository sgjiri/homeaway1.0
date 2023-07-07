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



let classFigureModifier = document.getElementsByClassName('figureModifier');
let classCardInfoPerso = document.getElementsByClassName('cardInfoPerso');
let classImgModifier = document.getElementsByClassName('imgModifier');
let classInput = document.getElementsByClassName('input');
let classCard = document.getElementsByClassName('card');

for (let i = 0; i < classFigureModifier.length; i++) {
    (function (index) {

        classCard[index].id = index + 1 + 'card';
        
        classFigureModifier[index].addEventListener('click', function () {


            classImgModifier[index].classList.toggle('activeModifie');
            classInput[index].classList.toggle('activeInput');
            classCardInfoPerso[index].classList.toggle('active');

            


        });
    })(i);
}

