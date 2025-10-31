<?php
require_once __DIR__ . '/BaseDao.php';

class PaymentDao extends BaseDao {
    public function __construct(){
        parent::__construct('payments');
    }

    public function createPayment($payment){
        $data = [
            'order_id' => $payment['order_id'],
            'provider' => $payment['provider'],
            'status'   => $payment['status'],
            'amount'   => $payment['amount'],
            'paid_at'  => $payment['paid_at']
        ];
        return $this->insert($data);
    }

    public function getAllPayments(){
        return $this->getAll();
    }

    public function getPaymentById($id){
        return $this->getById($id);
    }

    public function updatePayment($id, $payment){
        $data = [
            'order_id' => $payment['order_id'],
            'provider' => $payment['provider'],
            'status'   => $payment['status'],
            'amount'   => $payment['amount'],
            'paid_at'  => $payment['paid_at']
        ];
        return $this->update($id, $data);
    }

    public function deletePayment($id){
        return $this->delete($id);
    }
}
?>