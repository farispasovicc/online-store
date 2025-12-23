$(function () {
  $('main#spapp > section').css('min-height', $(window).height() - 120);

  var app = $.spapp({
    defaultView: 'home',
    templateDir: 'views/',
    pageNotFound: 'home'
  });
  app.run();

  function setActive() {
    var hash = location.hash || '#home';
    $('.navbar-nav .nav-link').removeClass('active');
    $('.navbar-nav .nav-link[href="' + hash + '"]').addClass('active');
  }

  function updateNavbar() {
    if (!Utils.isLoggedIn()) {
      $("#dashboard").addClass("d-none");
      $("#admin-menu").addClass("d-none");

      $("#nav-login").removeClass("d-none");
      $("#nav-register").removeClass("d-none");
      $("#nav-logout").addClass("d-none");
      return;
    }

    const user = Utils.getCurrentUser();

    $("#dashboard").removeClass("d-none");
    $("#dash-email").text(user.email);
    $("#dash-role").text(user.role);

    $("#nav-login").addClass("d-none");
    $("#nav-register").addClass("d-none");
    $("#nav-logout").removeClass("d-none");

    if (Utils.isAdmin()) {
      $("#admin-menu").removeClass("d-none");
    } else {
      $("#admin-menu").addClass("d-none");
    }
  }

  function renderProductsTable(products) {
    let html = "";

    products.forEach(p => {
      html += `
        <tr>
          <td>${p.id}</td>
          <td>${p.name}</td>
          <td>${p.brand}</td>
          <td>${p.price}</td>
          <td class="admin-actions">
            <button class="btn btn-danger btn-sm delete-product-btn" data-id="${p.id}">Delete</button>
          </td>
        </tr>
      `;
    });

    $("#products-body").html(html);

    if (!Utils.isAdmin()) {
      $(".admin-actions").hide();
    }
  }

  function loadProducts() {
    ProductService.getAll(
      function (res) {
        const products = Array.isArray(res) ? res : (res.data || []);
        renderProductsTable(products);
      },
      function () {
        alert("Failed to load products.");
      }
    );
  }

  function handleRoute() {
    const hash = location.hash || '#home';
    const protectedRoutes = ['#products', '#cart', '#admin-panel'];

    if (protectedRoutes.includes(hash) && !Utils.isLoggedIn()) {
      window.location.hash = '#login';
      return;
    }

    if (hash === '#admin-panel' && !Utils.isAdmin()) {
      window.location.hash = '#home';
      return;
    }

    if (hash === '#products') {
      loadProducts();
    }

    setActive();
    updateNavbar();
  }

  handleRoute();
  $(window).on('hashchange', handleRoute);

  $(document).on("click", "#logout-btn", function (e) {
    e.preventDefault();
    AuthService.logout();
    updateNavbar();
    window.location.hash = "#login";
  });

  $(document).on("click", "#login-btn", function () {
    const email = $("#login-email").val();
    const password = $("#login-password").val();

    if (!email || !password) {
      alert("Please enter email and password");
      return;
    }

    AuthService.login(
      email,
      password,
      function () {
        updateNavbar();
        window.location.hash = "#home";
      },
      function (xhr) {
        alert(xhr.responseText || "Login failed");
      }
    );
  });

  $(document).on("click", "#register-btn", function () {
    const email = $("#register-email").val();
    const password = $("#register-password").val();
    const repeat = $("#register-password-repeat").val();
    const phone = $("#register-phone").val();

    if (!email || !password || !repeat || !phone) {
      alert("All fields are required");
      return;
    }

    if (password !== repeat) {
      alert("Passwords do not match");
      return;
    }

    AuthService.register(
      { email: email, password: password, phone: phone },
      function () {
        window.location.hash = "#login";
      },
      function (xhr) {
        alert(xhr.responseText || "Registration failed");
      }
    );
  });

  $(document).on("click", ".delete-product-btn", function () {
    const id = $(this).data("id");

    ProductService.delete(
      id,
      function () {
        loadProducts();
      },
      function () {
        alert("Delete failed.");
      }
    );
  });
});
