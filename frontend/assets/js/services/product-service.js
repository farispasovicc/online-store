var ProductService = {
  getAll: function (callback, error_callback) {
    RestClient.get("products", callback, error_callback);
  },

  getById: function (id, callback, error_callback) {
    RestClient.get("products/" + id, callback, error_callback);
  },

  create: function (product, callback, error_callback) {
    RestClient.post("products", product, callback, error_callback);
  },

  update: function (id, product, callback, error_callback) {
    RestClient.put("products/" + id, product, callback, error_callback);
  },

  delete: function (id, callback, error_callback) {
    RestClient.delete("products/" + id, null, callback, error_callback);
  }
};
