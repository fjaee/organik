function openModal(card) {
  const additionalInfo = card.querySelector(".additional-info");
  
  if (additionalInfo) {
    const isVisible = additionalInfo.style.display === "block";
    additionalInfo.style.display = isVisible ? "none" : "block";
  }
}

function closeModal(event) {
  if (event.target === document.getElementById("modal") || event.target.id === "modal-close") {
    document.getElementById("modal").style.display = "none";
  }
}



