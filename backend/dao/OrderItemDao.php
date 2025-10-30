    <?php
    require_once __DIR__ . '/BaseDao.php';

    class OrderItemDao extends BaseDao {
    public function __construct() {
        parent::__construct('orderItems');
    }

  public function getByQuantity(int $quantity): array {
    $stmt = $this->connection->prepare("
      SELECT * FROM orderItems
      WHERE quantity = :quantity
    ");
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  }
    }
    ?>
