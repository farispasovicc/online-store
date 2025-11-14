<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/OrderDao.php';

class OrderService extends BaseService {
    public function __construct() {
        $dao = new OrderDao();
        parent::__construct($dao);
    }

    public function createOrder($data) {
        if (empty($data['user_id'])) {
            throw new Exception("User ID is required.");
        }

        if ($data['total'] <= 0) {
            throw new Exception("Total amount must be greater than 0.");
        }

        return $this->insert($data);
    }
}
?>