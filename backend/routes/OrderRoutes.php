<?php
Flight::route('GET /orders', function() {
    Flight::json(Flight::orderService()->getAll());
});

Flight::route('GET /orders/@id', function($id) {
    Flight::json(Flight::orderService()->getById($id));
});

Flight::route('POST /orders', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderService()->createOrder($data));
});

Flight::route('PUT /orders/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderService()->update($id, $data));
});

Flight::route('DELETE /orders/@id', function($id) {
    Flight::json(Flight::orderService()->delete($id));
});
?>