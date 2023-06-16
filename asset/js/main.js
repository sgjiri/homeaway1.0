
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






//swipe

// let listSlide = document.getElementById('list-slide')
// let slide = document.getElementsByClassName('slide');
// let nbSlide = slide.length;
// let currentSlide = 0;


// function nextSlide() {
//    slide[currentSlide].style.display = "none";
//    currentSlide = (currentSlide + 1) % nbSlide;
//    slide[currentSlide].style.display = "block";
// }

// function prevSlide() {
//    slide[currentSlide].style.display = "none";
//    currentSlide = (currentSlide - 1 + nbSlide) % nbSlide;
//    slide[currentSlide].style.display = "block";
// }



// listSlide.addEventListener("touchstart", handleTouchStart, false);
// listSlide.addEventListener("touchmove", handleTouchMove, false);


// let xDown = null;
// let yDown = null;

// function handleTouchStart(evt) {
//    xDown = evt.touches[0].clientX;
//    yDown = evt.touches[0].clientY;
// }

// function handleTouchMove(evt) {
//    if (!xDown || !yDown) {
//       return;
//    }

//    let xUp = evt.touches[0].clientX;
//    let yUp = evt.touches[0].clientY;

//    let xDiff = xDown - xUp;
//    let yDiff = yDown - yUp;


//    if (Math.abs(xDiff) > Math.abs(yDiff)) {
//       if (xDiff > 0) {

//          nextSlide();
//       } else {

//          prevSlide();
//       }
//    }

//    xDown = null;
//    yDown = null;
// }
