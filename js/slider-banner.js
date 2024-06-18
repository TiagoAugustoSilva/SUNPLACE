let currentSlide = 0;
const slides = document.querySelectorAll('.banner img');
const totalSlides = slides.length;

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.style.display = (i === index) ? 'block' : 'none';
    });
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % totalSlides;
    showSlide(currentSlide);
}

// Mostrar o primeiro slide ao carregar a página
document.addEventListener('DOMContentLoaded', () => {
    showSlide(currentSlide);

    // Alterne os slides a cada 3 segundos (3000ms)
    setInterval(nextSlide, 3000);
});
