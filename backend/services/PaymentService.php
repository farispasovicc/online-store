<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/PaymentDao.php';


class PaymentService extends BaseService{
public function __construct(){
    $dao = new PaymentDao();
    parent::__construct($dao);
}
}

?>