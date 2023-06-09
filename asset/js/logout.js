menuBurger = document.getElementById ('menuBurger')
navConnectPhone = document.getElementById('navConnectPhone')
navDisconnectPhone = document.getElementById ('navDisconnectPhone')

searchPhone = document.getElementById('searchPhone')
searchBoxPhone = document.getElementById('searchBoxPhone')


loginBox = document.getElementById('loginBox')
loginButton = document.getElementById('loginButton')
const registerButton = document.getElementById("registerButton");
const tab1 = document.getElementById("tab-1");
const tab2 = document.getElementById("tab-2");

const close =document.getElementById('close')



menuBurger.addEventListener('click', function(){    
    navDisconnectPhone.classList.toggle('logout')
    
})


loginButton.addEventListener('click', function(){

    loginBox.classList.toggle('formActive')
    tab1.checked=true
    tab2.checked=false
})

registerButton.addEventListener('click', function(){
    loginBox.classList.toggle('formActive')
    tab1.checked=false
    tab2.checked=true
    
})
close.addEventListener('click', function(){
    loginBox.classList.toggle('formActive') 
})