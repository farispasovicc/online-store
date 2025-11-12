<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/PaymentDao.php';

class PaymentService extends BaseService {
    public function __construct() {
        $dao = new PaymentDao();
        parent::__construct($dao);
    }

    public function createPayment($data) {
        if (empty($data['order_id']) || empty($data['amount']) || empty($data['provider'])) {
            throw new Exception("Order ID, amount, and provider must be provided.");
        }

        if ($data['amount'] <= 0) {
            throw new Exception("Amount must be greater than 0.");
        }

        return $this->insert($data);
    }
}
?>