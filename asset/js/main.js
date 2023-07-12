
searchPhone = document.getElementById('searchPhone')
searchBoxPhone = document.getElementById('searchBoxPhone')
filter = document.getElementById('filter')
formFilter = document.getElementById('formFilter')

searchPhone.addEventListener('click', function(){
    
    searchBoxPhone.classList.toggle('formSearchActive') 
})
filter.addEventListener('click', function(){
    
    formFilter.classList.toggle('formFilterActive') 
})









