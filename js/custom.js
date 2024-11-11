const carouselWrapper = document.querySelector('.carousel-wrapper');
const carouselItems = document.querySelectorAll('.carousel-item');
const prevBtn = document.querySelector('.left-btn');
const nextBtn = document.querySelector('.right-btn');

let currentIndex = 0; 
const visibleItems = 4; // Number of items visible at a time

// Calculate the maximum index for the slides
const maxIndex = carouselItems.length - visibleItems;

function updateCarousel() {
  // Calculate the offset for the carousel
  const offset = currentIndex * -100 / visibleItems;
  carouselWrapper.style.transform = `translateX(${offset}%)`;
}

// Event listeners for buttons
nextBtn.addEventListener('click', () => {
  if (currentIndex < maxIndex) {
    currentIndex++;
  } else {
    currentIndex = 0; // Wrap around to the beginning
  }
  updateCarousel();
});

prevBtn.addEventListener('click', () => {
  if (currentIndex > 0) {
    currentIndex--;
  } else {
    currentIndex = maxIndex; // Wrap around to the last set of items
  }
  updateCarousel();
});
