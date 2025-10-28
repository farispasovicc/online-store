<?php
require_once __DIR__ . '/BaseDao.php';

class ProductDao extends BaseDao {
   public function __construct() {
       parent::__construct('products');
   }

   public function getByName(string $name): ?array {
       $stmt = $this->connection->prepare("SELECT * FROM products WHERE name = :name");
       $stmt->bindParam(':name', $name);
       $stmt->execute();
       $row = $stmt->fetch();
       return $row ?: null;
   }
}
?>
