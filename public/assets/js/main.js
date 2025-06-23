(function($) {
  
  "use strict";  

  $(window).on('load', function() {

  /*Page Loader active
    ========================================================*/
    $('#preloader').fadeOut();

  // Sticky Nav
    $(window).on('scroll', function() { 
        if ($(window).scrollTop() > 200) {
            $('.scrolling-navbar').addClass('top-nav-collapse');
        } else {
            $('.scrolling-navbar').removeClass('top-nav-collapse');
        }
    });

    /* ==========================================================================
       countdown timer
       ========================================================================== */
       var startDate = $('#clock').data('start');
      if (startDate) {
          $('#clock').countdown(startDate, function(event) {
              $(this).html(event.strftime(
                  '<div class="time-entry days"><span>%-D</span> <b>:</b> Days</div> ' +
                  '<div class="time-entry hours"><span>%H</span> <b>:</b> Hours</div> ' +
                  '<div class="time-entry minutes"><span>%M</span> <b>:</b> Minutes</div> ' +
                  '<div class="time-entry seconds"><span>%S</span> Seconds</div>'
              ));
          });
}

       

    /* Auto Close Responsive Navbar on Click
    ========================================================*/
    function close_toggle() {
        if ($(window).width() <= 768) {
            $('.navbar-collapse a').on('click', function () {
                $('.navbar-collapse').collapse('hide');
            });
        }
        else {
            $('.navbar .navbar-inverse a').off('click');
        }
    }
    close_toggle();
    $(window).resize(close_toggle);

      /* WOW Scroll Spy
    ========================================================*/
     var wow = new WOW({
      //disabled for mobile
        mobile: false
    });
    wow.init();

    /* Nivo Lightbox 
    ========================================================*/
    $('.lightbox').nivoLightbox({
        effect: 'fadeScale',
        keyboardNav: true,
      });

    // one page navigation 
    $('.navbar-nav').onePageNav({
            currentClass: 'active'
    }); 

    /* Counter
    ========================================================*/
    $('.counterUp').counterUp({
     delay: 10,
     time: 1500
    });

    /* Back Top Link active
    ========================================================*/
      var offset = 200;
      var duration = 500;
      $(window).scroll(function() {
        if ($(this).scrollTop() > offset) {
          $('.back-to-top').fadeIn(400);
        } else {
          $('.back-to-top').fadeOut(400);
        }
      });

      $('.back-to-top').on('click',function(event) {
        event.preventDefault();
        $('html, body').animate({
          scrollTop: 0
        }, 600);
        return false;
      });

  });      

}(jQuery));

document.addEventListener('DOMContentLoaded', () => {
  const payBtn = document.getElementById('payNowBtn');
  const confirmBtn = document.getElementById('confirmPinBtn');
  const modal = document.getElementById('mpesaPrompt');

  payBtn.addEventListener('click', () => {
    modal.style.display = 'flex';
  });

  confirmBtn.addEventListener('click', () => {
    const pin = document.getElementById('fakePin').value;
    if (pin.length < 4) {
      alert("Please enter a valid PIN");
      return;
    }

    modal.innerHTML = `
      <div style="color:white; font-size:18px;">
        Processing Payment...<br><br>
        <div class="loader"></div>
      </div>
    `;

    setTimeout(() => {
      document.getElementById('checkoutForm').submit();
    }, 3000);
  });
});
