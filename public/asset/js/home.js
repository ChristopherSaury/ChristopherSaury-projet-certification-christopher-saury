// PARTIE REVEAL ON SCROLL
let navHome = document.getElementById('site-header');
let navItem = document.querySelectorAll('.navigation-link');

window.addEventListener('scroll', ()=>{
  const scrollPosition = window.scrollY;
  if(scrollPosition < 80){
    navHome.style.backgroundColor = 'transparent';
    navHome.style.boxShadow = 'none';
    for (let i = 0; i < navItem.length; i++){
      navItem[i].style.color = '#ffffff';
      navItem[i].style.hover.color = '#ffffff';
    }
  }else if(scrollPosition >= 80){
    navHome.style.backgroundColor = '#ffffff';
    navHome.style.boxShadow = '0 0.5rem 1.5rem rgba(0, 0, 0, 0.1)';
    for (let i = 0; i < navItem.length; i++){
      navItem[i].style.color = '#684f40';
    }
  }
 });



window.addEventListener("scroll", reveal);

function reveal() {
  let reveals = document.querySelectorAll(".reveal");
  for (let i = 0; i < reveals.length; i++) {
    let windowHeight = window.innerHeight;
    let revealTop = reveals[i].getBoundingClientRect().top;
    let revealPoint = 150;

    if (revealTop < windowHeight - revealPoint) {
      reveals[i].classList.add("active");
    } else {
      reveals[i].classList.remove("active");
    }
  }
}


let currentYear = new Date().getUTCFullYear();
document.getElementById("currentYear").innerHTML = currentYear;
