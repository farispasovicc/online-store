<?php
Flight::route('GET /order-items', function() {
    Flight::json(Flight::orderItemService()->getAll());
});

Flight::route('GET /order-items/@id', function($id) {
    Flight::json(Flight::orderItemService()->getById($id));
});

Flight::route('POST /order-items', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderItemService()->createOrderItem($data));
});

Flight::route('PUT /order-items/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderItemService()->update($id, $data));
});

Flight::route('DELETE /order-items/@id', function($id) {
    Flight::json(Flight::orderItemService()->delete($id));
});
?>