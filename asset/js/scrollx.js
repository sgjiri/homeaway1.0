// function up(){  document.getElementById("scrollbar").scrollTop=document.getElementById("scrollbar").scrollTop - 100;}

// function down(){document.getElementById("scrollbar").scrollTop=document.getElementById("scrollbar").scrollTop + 100;}

// function wheel(event){
    
// 	let delta = 0;
	
// 	if (event.wheelDelta) {
// 		delta = event.wheelDelta/120; 
// 		if (window.opera) delta = -delta;
// 	} else if (event.detail) {
// 		delta = -event.detail/3;
// 	}
// 	if (delta > 0)up();
// 	if (delta < 0)down();
// 	return false;
// }

// function keyListener(event){
   
//    if(event.keyCode==38)up(); //keyCode 38 is up arrow
//    if(event.keyCode==40)down(); //keyCode 40 is down arrow
// }

// /* Initialization code. */
// if (window.addEventListener)
// 	window.addEventListener('DOMMouseScroll', wheel, false);
// window.onmousewheel = document.onmousewheel = wheel;
// window.onkeydown = document.onkeydown = keyListener; 

//centrer image cliqué 
function centerImageInGallery(selectedImg) {
    let galleryContainer = document.getElementById('scrollbar');  
    let galleryWidth = galleryContainer.offsetWidth;
    let selectedImgOffsetLeft = selectedImg.offsetLeft;
    let selectedImgWidth = selectedImg.clientWidth;
    let selectedImgCenter = selectedImgOffsetLeft + (selectedImgWidth / 2);
    let scrollLeft = selectedImgCenter - (galleryWidth / 2);
    galleryContainer.scrollTo({
      left: scrollLeft,
      behavior: 'smooth'
    });
  }

// img take place

let imgTop = document.getElementsByClassName('imgTop')[0];
let imgGallery = document.getElementsByClassName('imgGallery');
for (let i = 0; i < imgGallery.length; i++) {
    imgGallery[i].addEventListener('click', function() {
        let srcImgGallery = imgGallery[i].getAttribute('src');
        imgTop.setAttribute('src', srcImgGallery);
        centerImageInGallery(imgGallery[i]);
    });
}
