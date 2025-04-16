jQuery(document).ready(function ($) {
  // Smooth scroll to section on anchor link click
  $('a[href^="#"]').on("click", function (e) {
    var target = $(this.getAttribute("href"));

    if (target.length) {
      e.preventDefault();

      $("html, body").animate(
        {
          scrollTop: target.offset().top,
        },
        800
      ); // 800ms trajanje animacije
    }
  });
  // Mobile navigation

  $(".menu-toggle").click(function () {
    $("#primary-menu").fadeToggle();
    $(this).toggleClass("menu-open");
  });

  // Sub Menu Trigger

  $(".sub-menu-trigger").click(function () {
    $(this).parent().toggleClass("sub-menu-open");
    $(this).siblings(".sub-menu").slideToggle();
  });

  window.addEventListener("scroll", function () {
    const header = document.getElementById("masthead");

    if (window.scrollY > 100) {
      header.setAttribute("is-pinned", "");
    } else {
      header.removeAttribute("is-pinned");
    }
  });
});
