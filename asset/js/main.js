
searchPhone = document.getElementById('searchPhone')
searchBoxPhone = document.getElementById('searchBoxPhone')
if (document.getElementById('filter')){
    filter = document.getElementById('filter')
    filter.addEventListener('click', function(){
        
        formFilter = document.getElementById('formFilter')
        formFilter.classList.toggle('formFilterActive') 
    })
}


searchPhone.addEventListener('click', function(){
    
    searchBoxPhone.classList.toggle('formSearchActive') 
})









