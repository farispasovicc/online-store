<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/dao/UserDao.php';
require_once __DIR__ . '/dao/ProductDao.php';
require_once __DIR__ . '/dao/OrderDao.php';
require_once __DIR__ . '/dao/OrderItemDao.php';
require_once __DIR__ . '/dao/PaymentDao.php';

$db          = Database::connect();
$userDao     = new UserDao();
$productDao  = new ProductDao();
$orderDao    = new OrderDao();
$orderItemDao= new OrderItemDao();
$paymentDao  = new PaymentDao();


$userDao->insert([
   'first_name' => 'Faris',
   'surname'    => 'Faris',
   'email'      => 'pasovic.faris@gmail.com'
]);


$stmt = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
$stmt->execute([':email' => 'pasovic.faris@gmail.com']);
$user   = $stmt->fetch();
$userId = $user ? (int)$user['id'] : null;


$productDao->insert([
   'name'  => 'Najjaci najk',
   'brand' => 'Nike',
   'price' => 129.90
]);


$stmt = $db->prepare("SELECT * FROM products WHERE name = :name LIMIT 1");
$stmt->execute([':name' => 'Nike Tech Fleece Hoodie']);
$product       = $stmt->fetch();
$productId     = $product ? (int)$product['id'] : null;
$productPrice  = $product ? (float)$product['price'] : 0.0;


if ($userId !== null) {
   $orderDao->insert([
      'user_id' => $userId,
      'status'  => 'Pending',
      'total'   => $productPrice

   ]);
   $orderId = (int)$db->lastInsertId();
} else {
   $orderId = null;
}


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


$users      = $userDao->getAll();
$products   = $productDao->getAll();
$orders     = $orderDao->getAll();
$orderItems = $orderItemDao->getAll();
$payments   = $paymentDao->getAll();


$stmt = $db->prepare("SELECT * FROM orderitems WHERE quantity = :q");
$stmt->execute([':q' => 1]);
$qty1Items = $stmt->fetchAll();

$stmt = $db->prepare("SELECT * FROM payments WHERE provider = :p");
$stmt->execute([':p' => 'Credit Card']);
$cardPayments = $stmt->fetchAll();


echo "<pre>";
print_r($users);
print_r($products);
print_r($orders);
print_r($orderItems);
print_r($payments);
print_r($qty1Items);
print_r($cardPayments);
echo "</pre>";
?>