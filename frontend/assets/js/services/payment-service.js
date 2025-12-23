var PaymentService = {
  getAll: function (callback, error_callback) {
    RestClient.get("payments", callback, error_callback);
  },

  getById: function (id, callback, error_callback) {
    RestClient.get("payments/" + id, callback, error_callback);
  },

  getByOrderId: function (orderId, callback, error_callback) {
    RestClient.get("orders/" + orderId + "/payments", callback, error_callback);
  },

  create: function (payment, callback, error_callback) {
    RestClient.post("payments", payment, callback, error_callback);
  },

  update: function (id, payment, callback, error_callback) {
    RestClient.put("payments/" + id, payment, callback, error_callback);
  },

  delete: function (id, callback, error_callback) {
    RestClient.delete("payments/" + id, null, callback, error_callback);
  }
};
