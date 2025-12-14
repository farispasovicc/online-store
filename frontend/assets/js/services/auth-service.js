var AuthService = {
  login: function (email, password) {
    RestClient.post(
      "auth/login",
      { email: email, password: password },
      function (response) {
        localStorage.setItem(Constants.TOKEN_KEY, response.data.token);
        localStorage.setItem("user", JSON.stringify(response.data));
        window.location.hash = "#home";
      },
      function () {
        alert("Login failed");
      }
    );
  },

  logout: function () {
    localStorage.removeItem(Constants.TOKEN_KEY);
    localStorage.removeItem("user");
    window.location.hash = "#login";
  }
};
