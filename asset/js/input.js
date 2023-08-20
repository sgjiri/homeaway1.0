
  
function insertImage(idSpan, idForm, idDiv){
let span = document.getElementsByClassName(idSpan);
const addFlat = document.getElementsByClassName(idForm);
const addImg = document.getElementsByClassName(idDiv);

let clickCount = 1;



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


insertImage('spanPlus', 'add-flat', 'addImg');
insertImage('spanPlus2', 'formModifierImg', 'changeImage');

