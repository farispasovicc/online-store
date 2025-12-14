<?php

require 'vendor/autoload.php';

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/database.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/ProductService.php';
require_once __DIR__ . '/services/OrderService.php';
require_once __DIR__ . '/services/OrderItemService.php';
require_once __DIR__ . '/services/PaymentService.php';
require_once __DIR__ . '/services/AuthService.php';

require_once __DIR__ . '/middleware/AuthMiddleware.php';
require_once __DIR__ . '/data/roles.php';

Flight::register('userService', 'UserService');
Flight::register('productService', 'ProductService');
Flight::register('orderService', 'OrderService');
Flight::register('orderItemService', 'OrderItemService');
Flight::register('paymentService', 'PaymentService');
Flight::register('auth_service', 'AuthService');
Flight::register('auth_middleware', 'AuthMiddleware');

Flight::route('/*', function () {

    $url = Flight::request()->url;

    if (
        strpos($url, '/auth/login') === 0 ||
        strpos($url, '/auth/register') === 0 ||
        strpos($url, '/docs') === 0
    ) {
        return TRUE;
    }


    try {
        $token = Flight::request()->getHeader("Authentication");


        Flight::auth_middleware()->verifyToken($token);

        return TRUE;

    } catch (Exception $e) {
        Flight::halt(401, $e->getMessage());
    }
});



require_once __DIR__ . '/routes/AuthRoutes.php';
require_once __DIR__ . '/routes/UserRoutes.php';
require_once __DIR__ . '/routes/ProductRoutes.php';
require_once __DIR__ . '/routes/OrderRoutes.php';
require_once __DIR__ . '/routes/OrderItemRoutes.php';
require_once __DIR__ . '/routes/PaymentRoutes.php';

Flight::start();
?>