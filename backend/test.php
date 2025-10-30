<?php
require_once __DIR__ . '/dao/UserDao.php';
require_once __DIR__ . '/dao/ProductDao.php';
require_once __DIR__ . '/dao/OrderDao.php';
require_once __DIR__ . '/dao/OrderItemDao.php';
require_once __DIR__ . '/dao/PaymentDao.php';

$userDao = new UserDao();
$productDao = new ProductDao();
$orderDao = new OrderDao();
$orderItemDao = new OrderItemDao();
$paymentDao = new PaymentDao();

$userDao->insert([
   'first_name' => 'Pasovic',
   'surname'    => 'Faris',
   'email'      => 'pasovic.faris@gmail.com'
]);

$user   = $userDao->getByEmail('pasovic.faris@gmail.com');
$userId = $user ? (int)$user['id'] : null;

$productDao->insert([
   'name'  => 'Nike Tech Fleece Hoodie',
   'brand' => 'Nike',
   'price' => 129.90
]);

$product     = $productDao->getByName('Nike Tech Fleece Hoodie');
$productId   = $product ? (int)$product['id'] : null;
$productPrice= $product ? (float)$product['price'] : 0.0;

if ($userId !== null) {
   $orderDao->insert([
      'user_id' => $userId,
      'status'  => 'Pending',
      'total'   => $productPrice
   ]);
}

$allOrders = $orderDao->getAll();
$orderId   = $allOrders ? (int)$allOrders[array_key_last($allOrders)]['id'] : null;

if ($orderId !== null && $productId !== null) {
   $orderItemDao->insert([
      'order_id'   => $orderId,
      'product_id' => $productId,
      'quantity'   => 1,
      'unit_price' => $productPrice
   ]);

   $paymentDao->insert([
      'order_id' => $orderId,
      'provider' => 'Credit Card',
      'status'   => 'Successful',
      'amount'   => $productPrice
   ]);
}

$users        = $userDao->getAll();
$products     = $productDao->getAll();
$orders       = $orderDao->getAll();
$orderItems   = $orderItemDao->getAll();
$payments     = $paymentDao->getAll();
$qty1Items    = $orderItemDao->getByQuantity(1);
$cardPayments = $paymentDao->getByProvider('Credit Card');

echo "<pre>";
print_r($users);
print_r($products);
print_r($orders);
print_r($orderItems);
print_r($payments);
print_r($qty1Items);
print_r($cardPayments);
echo "</pre>";
