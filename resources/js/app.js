import './bootstrap';
const cursorDot = document.querySelector('.cursor-dot');
const cursorOutline = document.querySelector('.cursor-outline');

window.addEventListener('mousemove', function (e) {
    const posX = e.clientX;
    const posY = e.clientY;

    // El punto sigue al instante
    cursorDot.style.left = `${posX}px`;
    cursorDot.style.top = `${posY}px`;

    // El borde sigue con el retraso del CSS
    cursorOutline.style.left = `${posX}px`;
    cursorOutline.style.top = `${posY}px`;
});
// Seleccionamos todos los enlaces y botones
const links = document.querySelectorAll('a, button');

links.forEach(link => {
    // Al entrar al botón, le damos la clase para que crezca
    link.addEventListener('mouseenter', () => {
        cursorOutline.classList.add('hover-effect');
    });
    // Al salir, se la quitamos para que vuelva a la normalidad
    link.addEventListener('mouseleave', () => {
        cursorOutline.classList.remove('hover-effect');
    });
});
// === SLIDER DINÁMICO (SOLO AUTOMÁTICO) ===
const heroSlider = document.querySelector('.hero-slider');
const dots = document.querySelectorAll('.dot');

// Tus imágenes de fondo
const images = [
    "url('https://wallpaperbat.com/img/9736419-double-exposure-generative-ai-22453397.jpg')",
    "url('https://images.unsplash.com/photo-1503387762-592deb58ef4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')",
    "url('https://inforcivil.com/wp-content/uploads/2025/12/Construcciones-en-seco.png')"
];

let currentIndex = 0;

// Función para actualizar la imagen y el puntito
function changeSlide(index) {
    currentIndex = index;
    
    // Cambiamos el fondo
    heroSlider.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), ${images[currentIndex]}`;
    
    // Actualizamos el puntito activo visualmente
    dots.forEach(dot => dot.classList.remove('active'));
    dots[currentIndex].classList.add('active');
}

// Pasa a la siguiente imagen cíclicamente
function nextSlide() {
    let nextIndex = (currentIndex + 1) % images.length;
    changeSlide(nextIndex);
}

// Inicia el ciclo automático cada 4 segundos (4000ms)
setInterval(nextSlide, 4000);