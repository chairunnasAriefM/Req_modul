
// onscroller navbar
window.addEventListener('scroll', function () {
    const navbar = document.querySelector('.header');
    if (window.scrollY > 0) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// burger 
document.addEventListener('DOMContentLoaded', () => {
    const navbarBurger = document.querySelector('.navbar-burger');
    const sidebar = document.querySelector('.sidebar');


    navbarBurger.addEventListener('click', () => {
        navbarBurger.classList.toggle('is-active');
        sidebar.classList.toggle('is-active');
        document.getElementById("nav").style.display = "none";
    });
});


document.addEventListener('DOMContentLoaded', function() {
    // JavaScript untuk mengubah gambar background

    const images = [
        'assets/images/perpus.jpg',
        'assets/images/perpus3.jpg',
        'assets/images/perpus2.jpg',
    ];

    let currentIndex = 0;
    const topImageElement = document.getElementById('top-image');

    function changeBackgroundImage() {
        console.log(`Changing to image: ${images[currentIndex]}`);
        topImageElement.style.backgroundImage = `url(${images[currentIndex]})`;
        currentIndex = (currentIndex + 1) % images.length;
    }

    setInterval(changeBackgroundImage, 4000);
    changeBackgroundImage(); // Initial call to set the first image
});

// dropdown navbar item 
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
  }
  
  // Close the dropdown if the user clicks outside of it
  window.onclick = function(e) {
    if (!e.target.matches('.dropbtn')) {
    var myDropdown = document.getElementById("myDropdown");
      if (myDropdown.classList.contains('show')) {
        myDropdown.classList.remove('show');
      }
    }
  }
