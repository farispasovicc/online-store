<?php
require_once __DIR__ . '/BaseDao.php';


class OrderDao extends BaseDao {
   public function __construct() {
       parent::__construct("orders");
   }


   public function getByStatus($status) {
       $stmt = $this->connection->prepare("SELECT * FROM orders WHERE status = :status");
       $stmt->bindParam(':status', $status);
       $stmt->execute();
       return $stmt->fetchAll();
   }
}
?>
