<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/OrderDao.php';

class OrderService extends BaseService{
public function __construct(){
    $dao = new OrderDao();
    parent::__construct($dao);
}
}


?>