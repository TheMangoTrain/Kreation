document.addEventListener("DOMContentLoaded", function(event) {

  var screenWidth = document.documentElement.clientWidth;

  initResizeRefresh(screenWidth);

  initMobileNav();

});


// ==================================================
// Setup mobile navigation
// ==================================================
function initMobileNav() {

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

// ==================================================
// Setup screen refresh
// ==================================================
function initResizeRefresh(width) {

  window.addEventListener("resize", function() {
    newWidth = document.documentElement.clientWidth;

    if (newWidth != width) {
      width = newWidth;

      toggleMobileMenu("off");

    }

  }, true);
}
