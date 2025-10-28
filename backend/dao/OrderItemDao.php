    <?php
    require_once __DIR__ . '/BaseDao.php';

    class OrderItemDao extends BaseDao {
    public function __construct() {
        parent::__construct('orderItems');
    }

    public function getByOrderId(int $orderId): array {
        $stmt = $this->connection->prepare("SELECT * FROM `orderItems` WHERE order_id = :orderId");
        $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    }
    ?>
