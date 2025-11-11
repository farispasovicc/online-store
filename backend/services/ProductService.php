<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/ProductDao.php';

class ProductService extends BaseService{
public function __construct(){
    $dao = new ProductDao();
    parent::__construct($dao);
}
}

?>