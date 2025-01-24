// Function to open the modal
function openModal(card) {
  const modal = document.getElementById("modal");
  const modalBody = document.getElementById("modal-body");

  // Clone the clicked card's content into the modal body
  modalBody.innerHTML = card.innerHTML;
  modal.style.display = "block";
}

// Function to close the modal
function closeModal(event) {
  if (event.target === document.getElementById("modal") || event.target.id === "modal-close") {
    document.getElementById("modal").style.display = "none";
  }
}
