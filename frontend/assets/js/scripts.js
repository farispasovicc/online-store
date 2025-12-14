$(function () {

  $('main#spapp > section').css('min-height', $(window).height() - 120);

  var app = $.spapp({
    defaultView: 'home',
    templateDir: 'frontend/views/',
    pageNotFound: 'home'
  });

  app.run();

  function setActive() {
    var hash = (location.hash || '#home');
    $('.navbar-nav .nav-link').removeClass('active');
    $('.navbar-nav .nav-link[href="' + hash + '"]').addClass('active');
  }

  setActive();
  $(window).on('hashchange', setActive);

  $(window).on('hashchange', function () {
    const protectedRoutes = ['#products', '#cart', '#admin-panel'];

    if (protectedRoutes.includes(location.hash) && !Utils.isLoggedIn()) {
      window.location.hash = '#login';
    }

    if (location.hash === '#admin-panel' && !Utils.isAdmin()) {
      window.location.hash = '#home';
    }
  });
});

$(document).on("click", "#login-btn", function () {
  const email = $("#login-email").val();
  const password = $("#login-password").val();

  if (!email || !password) {
    alert("Please enter email and password");
    return;
  }

  AuthService.login(email, password);
});
