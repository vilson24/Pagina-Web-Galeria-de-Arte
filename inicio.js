const carrusel = document.querySelector('.carrusel-contenido');
const slides = document.querySelectorAll('.slide');
const btnPrev = document.querySelector('.btn-prev');
const btnNext = document.querySelector('.btn-next');

let index = 0;

btnNext.addEventListener('click', () => {
  if (index < slides.length - 1) {
    index++;
  } else {
    index = 0;
  }
  carrusel.style.transform = `translateX(-${index * 100}%)`;
});

btnPrev.addEventListener('click', () => {
  if (index > 0) {
    index--;
  } else {
    index = slides.length - 1;
  }
  carrusel.style.transform = `translateX(-${index * 100}%)`;
});
