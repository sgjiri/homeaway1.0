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

        classCard[index].id = index + 1 + 'card';
        p = 0;
        y = -90
        classFigureModifier[index].addEventListener('click', function () {


            classImgModifier[index].classList.toggle('activeModifie');

            let activeBeforeCount = 0;
            for (let i = index + 1; i < classFigureModifier.length; i++) {
                if (classImgModifier[i].classList.contains('activeModifie')) {
                    activeBeforeCount++;
                }
            }
            let activeBehindCount = 0;
            for (let i = 0; i <= index; i++) {
                if (classImgModifier[i].classList.contains('activeModifie')) {
                    activeBehindCount++;
                    console.log(activeBehindCount);
                }
            }
            console.log(activeBehindCount);



            for (let i = index + 1; i < classCard.length; i++) {
                if (classImgModifier[index].classList.contains('activeModifie')) {


                    classCard[i].style.transform = "translateY(" + (p + 90) + "px)";
                    classInput[i].style.transform = "translateY(" + (y + 90) + "px)";

                } else {
                    if (classImgModifier[i].classList.contains('activeModifie')) { }
                    classCard[i].style.transform = "translateY(" + (p - 90) + "px)";
                    classInput[i].style.transform = "translateY(" + (y - 90) + "px)";
                }

            }
            if (classImgModifier[index].classList.contains('activeModifie')) {
                p = p + 90;
                y = y + 90;
                classInput[index].style.transform = "translateY(" + (y) +"px)";


            } else {
                p = p - 90;
                y = y - 90;
                classInput[index].style.transform = "translateY(" + y + "px)";

            }


        });
    })(i);
}

