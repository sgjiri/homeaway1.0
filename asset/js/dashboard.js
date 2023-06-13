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



let classFigureModifier = document.getElementsByClassName('figureModifier');
let classImgModifier = document.getElementsByClassName('imgModifier');
let classInput = document.getElementsByClassName('input');
let classCard = document.getElementsByClassName('card');

for (let i = 0; i < classFigureModifier.length; i++) {
    (function (index) {
        j=50;
        
        p=-20;
        classCard[index].id = index + 1 + 'card';
        classFigureModifier[index].addEventListener('click', function () {

            classImgModifier[index].classList.toggle('activeModifie');
            classInput[index].classList.toggle('activeInput');
            for (let i = index + 1; i < classCard.length; i++) {
                if(classImgModifier[index].classList.contains('activeModifie')){
                classCard[i].style.transform = "translateY(" + j + "px)";
                classInput[i].style.transform = "translateY(" + p + "px)";
            }else{
                classCard[i].style.transform = "translateY(-" + p + "px)";
                classInput[i].style.transform = "translateY(-" + p + "px)";
            }
        }
        j = j+50;
        p = p+50;
        console.log(j);
        });
    })(i);
}

