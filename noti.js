let currentSlide = 0;
const slides = document.querySelectorAll('.carousel-item');

function moveSlide(step) {
    currentSlide = (currentSlide + step + slides.length) % slides.length; // Ciclo continuo
    updateCarousel();
}

function updateCarousel() {
    const offset = -currentSlide * 100;
    document.querySelector('.carousel').style.transform = `translateX(${offset}%)`;
}

// Auto-play del carrusel
setInterval(() => moveSlide(1), 5000); // Cambia cada 5 segundos
