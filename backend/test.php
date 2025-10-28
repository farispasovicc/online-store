<?php
require_once __DIR__ . '/dao/UserDao.php';
require_once __DIR__ . '/dao/OrderDao.php';

$userDao = new UserDao();
$orderDao = new OrderDao();


$userDao->insert([
   'first_name' => 'John',
   'surname'    => 'Doe',
   'email'      => 'john.doe@gmail.com'
]);


$user   = $userDao->getByEmail('john.doe@gmail.com');
$userId = $user ? (int)$user['id'] : null;


if ($userId !== null) {
   $orderDao->insert([
      'user_id' => $userId,
      'status'  => 'Pending',
      'total'   => 25.98
   ]);
}

// Fetch all users
$users = $userDao->getAll();
print_r($users);

// Fetch all orders
$orders = $orderDao->getAll();
print_r($orders);
?>



