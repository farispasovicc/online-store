$(function () {
  $("main#spapp > section").css("min-height", $(window).height() - 120);

  var app = $.spapp({
    defaultView: "home",
    templateDir: "views/",
    pageNotFound: "home"
  });
  app.run();

  function setActive() {
    var hash = location.hash || "#home";
    $(".navbar-nav .nav-link").removeClass("active");
    $('.navbar-nav .nav-link[href="' + hash + '"]').addClass("active");
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

    if (Utils.isAdmin()) $("#admin-menu").removeClass("d-none");
    else $("#admin-menu").addClass("d-none");
  }

  function renderProductsTable(products) {
    let html = "";
    products.forEach(function (p) {
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

    if (!Utils.isAdmin()) $(".admin-actions").hide();
    else $(".admin-actions").show();
  }

  function loadProducts() {
    ProductService.getAll(
      function (res) {
        const products = Array.isArray(res) ? res : (res.data || []);
        renderProductsTable(products);
      },
      function (xhr) {
        alert((xhr && xhr.responseText) ? xhr.responseText : "Failed to load products.");
      }
    );
  }

  function initValidation() {
    if ($("#login-form").length && !$("#login-form").data("validator")) {
      $("#login-form").validate({
        rules: {
          email: { required: true, email: true },
          password: { required: true, minlength: 6, maxlength: 64 }
        },
        messages: {
          email: {
            required: "Please enter your email",
            email: "Please enter a valid email address"
          },
          password: {
            required: "Please enter your password",
            minlength: "Password must be at least 6 characters",
            maxlength: "Password cannot be longer than 64 characters"
          }
        },
        submitHandler: function () {
          $.blockUI({ message: "<h3>Please wait, processing your request...</h3>" });

          const email = $("#login-email").val();
          const password = $("#login-password").val();

          AuthService.login(
            email,
            password,
            function (response) {
              if (response && response.data) localStorage.setItem("user", JSON.stringify(response.data));
              updateNavbar();
              window.location.hash = "#home";
              $.unblockUI();
            },
            function (xhr) {
              $.unblockUI();
              alert((xhr && xhr.responseText) ? xhr.responseText : "Login failed");
            }
          );
        }
      });
    }

    if ($("#register-form").length && !$("#register-form").data("validator")) {
      $("#register-form").validate({
        rules: {
          email: { required: true, email: true },
          password: { required: true, minlength: 6, maxlength: 64 },
          password_repeat: { required: true, equalTo: "#register-password" }
        },
        messages: {
          email: {
            required: "Please enter your email",
            email: "Please enter a valid email address"
          },
          password: {
            required: "Please enter a password",
            minlength: "Password must be at least 6 characters",
            maxlength: "Password cannot be longer than 64 characters"
          },
          password_repeat: {
            required: "Please repeat your password",
            equalTo: "Passwords do not match"
          }
        },
        submitHandler: function () {
          $.blockUI({ message: "<h3>Please wait, processing your request...</h3>" });

          const payload = {
            email: $("#register-email").val(),
            password: $("#register-password").val()
          };

          AuthService.register(
            payload,
            function () {
              $.unblockUI();
              alert("Registration successful. Please log in.");
              window.location.hash = "#login";
              $("#register-form")[0].reset();
            },
            function (xhr) {
              $.unblockUI();
              alert((xhr && xhr.responseText) ? xhr.responseText : "Registration failed");
            }
          );
        }
      });
    }
  }

  function handleRoute() {
    const hash = location.hash || "#home";
    const protectedRoutes = ["#products", "#cart", "#admin-panel"];

    if (protectedRoutes.includes(hash) && !Utils.isLoggedIn()) {
      window.location.hash = "#login";
      return;
    }

    if (hash === "#admin-panel" && !Utils.isAdmin()) {
      window.location.hash = "#home";
      return;
    }

    if (hash === "#products") loadProducts();

    setActive();
    updateNavbar();

    initValidation();
  }

  handleRoute();
  $(window).on("hashchange", handleRoute);

  $(document).on("click", "#logout-btn", function (e) {
    e.preventDefault();
    AuthService.logout();
    localStorage.removeItem("user");
    updateNavbar();
    window.location.hash = "#login";
  });

  $(document).on("click", ".delete-product-btn", function () {
    if (!Utils.isAdmin()) return;

    const id = $(this).data("id");
    if (!confirm("Are you sure you want to delete this product?")) return;

    $.blockUI({ message: "<h3>Processing...</h3>" });

    ProductService.delete(
      id,
      function () {
        $.unblockUI();
        loadProducts();
      },
      function (xhr) {
        $.unblockUI();
        alert((xhr && xhr.responseText) ? xhr.responseText : "Delete failed.");
      }
    );
  });

  $(document).on("submit", "#login-form, #register-form", function (e) {
    e.preventDefault();
    return false;
  });
});
