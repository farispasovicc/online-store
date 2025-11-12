<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/ProductDao.php';

class ProductService extends BaseService {
    public function __construct() {
        $dao = new ProductDao();
        parent::__construct($dao);
    }

    public function createProduct($data) {
        if ($data['price'] <= 0) {
            throw new Exception("Price must be a positive value.");
        }

        return $this->insert($data);
    }
}
?>