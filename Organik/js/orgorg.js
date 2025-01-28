function toggleInfo(item) {
    const info = item.querySelector('.community-info');
    const isVisible = info.classList.contains('open');
  
    // Close all other open info boxes
    document.querySelectorAll('.community-info').forEach((box) => box.classList.remove('open'));
  
    // Toggle the clicked one
    if (!isVisible) {
      info.classList.add('open');
    }
  }
  