let like = document.getElementById('like');
let info = document.getElementById('info');
let resevations = document.getElementById('resevations');
let messagerie = document.getElementById('messagerie');
let nav =document.getElementById('navDash');
let iconLike = document.getElementById('iconLike');
like.addEventListener('click', function(){
    like.classList.add('likeActive');
    nav.classList.add('likeActive');
    iconLike.classList.add('likeActive');
    info.classList.add('likeActive')
})

info.addEventListener('click', function(){
    info.classList.add('infoActive');
    like.classList.remove('likeActive');
    iconInfo.classList.add('iconInfo')
})



let figureModifier = document.getElementById('figureModifier');
let imgModifier = document.getElementById('imgModifier');

figureModifier.addEventListener('click', function(){
    imgModifier.classList.toggle('activeModifie');
})