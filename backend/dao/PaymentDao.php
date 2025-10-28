<?php
require_once __DIR__ . '/BaseDao.php';

class PaymentDao extends BaseDao {
   public function __construct() {
       parent::__construct('payments');
   }

   public function getByOrderId(int $orderId): ?array {
       $stmt = $this->connection->prepare("SELECT * FROM payments WHERE order_id = :orderId");
       $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
       $stmt->execute();
       $row = $stmt->fetch();
       return $row ?: null;
   }

   public function getByProvider(string $provider): array {
       $stmt = $this->connection->prepare("SELECT * FROM payments WHERE provider = :provider");
       $stmt->bindParam(':provider', $provider);
       $stmt->execute();
       return $stmt->fetchAll();
   }
}
?>
