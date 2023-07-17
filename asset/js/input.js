let span = document.getElementById('spanPlus')
const addFlat = document.getElementById('add-flat')
const addImg = document.getElementById('addImg')

let clickCount = 1;


span.addEventListener("click", function () {
    
    const div = document.createElement('div')
    const btnInput = document.createElement('input');
    btnInput.type = 'file';
    btnInput.name = 'thumbnail' + '_' + clickCount;

    div.appendChild(btnInput);
    addImg.prepend(div);
    clickCount++
})

// ****AJAX*****//

addFlat.addEventListener('submit', function (e) {
    e.preventDefault();

    const data = new FormData(addFlat)

    fetch('./addLogement', {
        method: 'POST',
        body: data
    })
        .then((response) => response.json())
        .then((datas) => {
            const lastInsertId = datas;
            const idLogement = document.createElement('input');
            idLogement.type = 'hidden';
            idLogement.name = 'id_logement';
            idLogement.value = lastInsertId;
            addImg.append(idLogement)
        })

        .catch(error => {
            console.log(error);
        });
    form - add.classList.toggle('activeImage')
    addFlat.classList.toogle('activeFlat');
})