const slides = document.querySelectorAll(".carousel-item");
let counter = 0;
let interValid = null;

document.addEventListener("DOMContentLoaded", () => {
  initializeSlider(); // Initialize the slider after DOM is loaded
});

if (slides.length > 0) {
  function initializeSlider() {
    slides[counter].classList.add("displaySlide");
    interValid = setInterval(nextSlide, 3000);
  }
}

function showSlide(index) {
  if (index >= slides.length) {
    counter = 0;
  } else if (index < 0) {
    counter = slides.length - 1;
  }
  slides.forEach((slide) => {
    slide.classList.remove("displaySlide");
  });
  slides[counter].classList.add("displaySlide");
}

function prevSlide() {
  clearInterval(interValid);
  counter--;
  showSlide(counter);
}

function nextSlide() {
  counter++;
  showSlide(counter);
}
