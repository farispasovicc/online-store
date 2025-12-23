var AuthService = {
  login: function (email, password, callback, error_callback) {
    RestClient.post(
      "auth/login",
      { email: email, password: password },
      function (response) {
        if (response && response.data && response.data.token) {
          localStorage.setItem(Constants.TOKEN_KEY, response.data.token);
        }
        if (callback) callback(response);
      },
      function (xhr) {
        if (error_callback) error_callback(xhr);
        else alert("Login failed");
      }
    );
  },

  register: function (payload, callback, error_callback) {
    RestClient.post(
      "auth/register",
      payload,
      function (response) {
        if (callback) callback(response);
      },
      function (xhr) {
        if (error_callback) error_callback(xhr);
        else alert(xhr.responseText || "Registration failed");
      }
    );
  },

  logout: function () {
    localStorage.removeItem(Constants.TOKEN_KEY);
  }
};
