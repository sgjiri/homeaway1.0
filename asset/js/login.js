menuBurger = document.getElementById ('menuBurger')
navConnectPhone = document.getElementById('navConnectPhone')


imgConnectDesktop = document.getElementById('imgConnectDesktop')
navConnect = document.getElementById('navConnect')



menuBurger.addEventListener('click', function(){   
    navConnectPhone.classList.toggle('loginActive')
})

imgConnectDesktop.addEventListener('click', function(){   
    navConnect.classList.toggle('loginDesktopActive')
})