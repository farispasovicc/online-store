var OrderItemService = {
  getAll: function (callback, error_callback) {
    RestClient.get("orderitems", callback, error_callback);
  },

  getById: function (id, callback, error_callback) {
    RestClient.get("orderitems/" + id, callback, error_callback);
  },

  getByOrderId: function (orderId, callback, error_callback) {
    RestClient.get("orders/" + orderId + "/items", callback, error_callback);
  },

  create: function (item, callback, error_callback) {
    RestClient.post("orderitems", item, callback, error_callback);
  },

  update: function (id, item, callback, error_callback) {
    RestClient.put("orderitems/" + id, item, callback, error_callback);
  },

  delete: function (id, callback, error_callback) {
    RestClient.delete("orderitems/" + id, null, callback, error_callback);
  }
};
