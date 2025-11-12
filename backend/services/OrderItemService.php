<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/OrderItemDao.php';

class OrderItemService extends BaseService {
    public function __construct() {
        $dao = new OrderItemDao();
        parent::__construct($dao);
    }

    public function createOrderItem($data) {
        if ($data['quantity'] <= 0) {
            throw new Exception("Quantity must be greater than 0.");
        }

        if ($data['unit_price'] <= 0) {
            throw new Exception("Unit price must be greater than 0.");
        }

        return $this->insert($data);
    }
}
?>