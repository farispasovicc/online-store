<?php
require_once __DIR__ . '/BaseDao.php';

class ProductDao extends BaseDao {
    public function __construct(){
        parent::__construct('products');
    }

    public function createProduct($product){
        $data = [
            'name'  => $product['name'],
            'brand' => $product['brand'],
            'price' => $product['price']
        ];
        return $this->insert($data);
    }

    public function getAllProducts(){
        return $this->getAll();
    }

    public function getProductById($id){
        return $this->getById($id);
    }

    public function updateProduct($id, $product){
        $data = [
            'name'  => $product['name'],
            'brand' => $product['brand'],
            'price' => $product['price']
        ];
        return $this->update($id, $data);
    }

    public function deleteProduct($id){
        return $this->delete($id);
    }
}
?>