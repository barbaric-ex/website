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
      );

      // Ako smo na mobilnoj verziji i kliknemo na link, zatvori meni
      if ($(window).width() < 1199.5) {
        $("#primary-menu").fadeOut();
        $(".menu-toggle").removeClass("menu-open").prop("checked", false);
      }
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

  // Sticky header
  window.addEventListener("scroll", function () {
    const header = document.getElementById("masthead");

    if (window.scrollY > 100) {
      header.setAttribute("is-pinned", "");
    } else {
      header.removeAttribute("is-pinned");
    }
  });
});
