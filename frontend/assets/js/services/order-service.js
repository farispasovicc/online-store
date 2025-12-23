var OrderService = {
  getAll: function (callback, error_callback) {
    RestClient.get("orders", callback, error_callback);
  },

  getMyOrders: function (callback, error_callback) {
    RestClient.get("orders/my", callback, error_callback);
  },

  getById: function (id, callback, error_callback) {
    RestClient.get("orders/" + id, callback, error_callback);
  },

  create: function (order, callback, error_callback) {
    RestClient.post("orders", order, callback, error_callback);
  },

  update: function (id, order, callback, error_callback) {
    RestClient.put("orders/" + id, order, callback, error_callback);
  },

  delete: function (id, callback, error_callback) {
    RestClient.delete("orders/" + id, null, callback, error_callback);
  }
};
