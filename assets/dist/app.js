document.addEventListener("DOMContentLoaded", function(event) {

    //jQuery(this).scrollTop(0);

  var screenWidth = document.documentElement.clientWidth;

  initResizeRefresh(screenWidth);


  mobileNavigation();

});

// ==================================================
// Set mobile navigation
// ==================================================
function mobileNavigation() {


  document.getElementById("nav-icon-open").addEventListener('click', function() {

    toggleMobileMenu();

  }, false);

  document.getElementById("nav-icon-close").addEventListener('click', function() {

    toggleMobileMenu();

  }, false);


  var selectClass = document.getElementById("nav-main").getElementsByClassName("a");

  for (var i = 0; i < selectClass.length; i++) {
    selectClass[i].addEventListener('click', function() {
      toggleMobileMenu();
    }, false);
  };

  /*
    jQuery('#nav-icon-open').on('click', function(){
          //var el = document.getElementById("hamburger_toggle");
          //var br = el.getBoundingClientRect();
          //  el.style.right = br.right + 'px';
          //el.style.top = br.top + 'px';

          jQuery('html').addClass('modal-open');
    });

    jQuery('#nav-icon-close').on('click', function(){
          jQuery('html').removeClass('modal-open');
    });


    jQuery('#nav-overlay a').on('click', function(){
          jQuery('html').removeClass('modal-open');
    });

    */
}

function toggleMobileMenu(mode) {
  if (mode == "off") {
    document.documentElement.classList.remove("modal-open");
  } else if (mode == "on") {
    document.documentElement.classList.add("modal-open");
  } else {
    document.documentElement.classList.toggle("modal-open");
  }
}




function initResizeRefresh(width) {

  window.addEventListener("resize", function() {
    newWidth = document.documentElement.clientWidth;

    if (newWidth != width) {
      width = newWidth;

      toggleMobileMenu("off");

    }

  }, true);
}
