// script.js
const slider = document.querySelector('.slider');
const cards = document.querySelectorAll('.card');

let index = 0;

function autoPlaySlider() {
  index++;
  if (index >= cards.length) {
    index = 0; // Reset to the first card
  }
  slider.style.transform = `translateY(-${index * 300}px)`; // Adjust height based on card size
}

// AutoPlay every 3 seconds
setInterval(autoPlaySlider, 3000);
