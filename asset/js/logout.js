const menuBurger = document.getElementById ('menuBurger')
const navDisconnectPhone = document.getElementById ('navDisconnectPhone')

const imgDisconnectDesktop = document.getElementById ('imgDisconnectDesktop')
const navDisconnect = document.getElementById ('navDisconnect')

const searchPhone = document.getElementById('searchPhone')
const searchBoxPhone = document.getElementById('searchBoxPhone')


const loginBox = document.getElementById('loginBox')
const loginButton = document.getElementById('loginButton')
const registerButton = document.getElementById("registerButton");
const loginButtonDestop = document.getElementById('loginButtonDestop')
const registerButtonDesktop = document.getElementById("registerButtonDesktop");
const tab1 = document.getElementById("tab-1");
const tab2 = document.getElementById("tab-2");

const close =document.getElementById('close')



menuBurger.addEventListener('click', function(){ 
       
    navDisconnectPhone.classList.toggle('logout')
    
})

imgDisconnectDesktop.addEventListener('click', function(){   
   
    navDisconnect.classList.toggle('logoutDesktop')
    
})


loginButton.addEventListener('click', function(){

    loginBox.classList.toggle('formActive')
    tab1.checked=true
    tab2.checked=false
})
loginButtonDestop.addEventListener('click', function(){

    loginBox.classList.toggle('formActive')
    tab1.checked=true
    tab2.checked=false
})

registerButton.addEventListener('click', function(){
    loginBox.classList.toggle('formActive')
    tab1.checked=false
    tab2.checked=true
    
})
registerButtonDesktop.addEventListener('click', function(){
    loginBox.classList.toggle('formActive')
    tab1.checked=false
    tab2.checked=true
    
})
close.addEventListener('click', function(){
    loginBox.classList.toggle('formActive') 
})