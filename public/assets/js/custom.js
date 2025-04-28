window.addEventListener('scroll', function () {
    const cards = document.querySelectorAll('.product-card');
    const cta = document.getElementById('cta-button');
    
    const revealPoint = window.innerHeight * 0.7;
    const ctaTop = cta.getBoundingClientRect().top;
    
    // Apply blur effect when the button comes into view
    if (ctaTop < revealPoint) {
      cards.forEach((card) => {
        card.classList.add('blur');
      });
      cta.classList.add('visible');
    } else {
      cards.forEach((card) => {
        card.classList.remove('blur');
      });
      cta.classList.remove('visible');
    }
  });
  