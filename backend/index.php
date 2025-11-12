<?php
require 'vendor/autoload.php';

require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/ProductService.php';
require_once __DIR__ . '/services/OrderService.php';
require_once __DIR__ . '/services/OrderItemService.php';
require_once __DIR__ . '/services/PaymentService.php';

Flight::register('userService', 'UserService');
Flight::register('productService', 'ProductService');
Flight::register('orderService', 'OrderService');
Flight::register('orderItemService', 'OrderItemService');
Flight::register('paymentService', 'PaymentService');

require_once __DIR__ . '/routes/UserRoutes.php';
require_once __DIR__ . '/routes/ProductRoutes.php';
require_once __DIR__ . '/routes/OrderRoutes.php';
require_once __DIR__ . '/routes/OrderItemRoutes.php';
require_once __DIR__ . '/routes/PaymentRoutes.php';

Flight::route('/', function(){
    echo "Welcome to OnlineClothes API";
});

Flight::start();
?>