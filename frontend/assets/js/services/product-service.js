var ProductService = {
  loadProducts: function () {
    RestClient.get("products", function (data) {

      let html = "";

      data.forEach(p => {
        html += `
          <tr>
            <td>${p.id}</td>
            <td>${p.name}</td>
            <td>${p.brand}</td>
            <td>${p.price}</td>
            <td class="admin-actions">
              <button class="btn btn-danger btn-sm"
                onclick="ProductService.deleteProduct(${p.id})">
                Delete
              </button>
            </td>
          </tr>
        `;
      });

      $("#products-body").html(html);

      if (!Utils.isAdmin()) {
        $(".admin-actions").hide();
      }

    }, function () {
      window.location.hash = "#login";
    });
  },

  deleteProduct: function (id) {
    RestClient.delete("products/" + id, function () {
      ProductService.loadProducts();
    });
  }
};
