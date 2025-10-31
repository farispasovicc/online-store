<?php
require_once __DIR__ . '/BaseDao.php';

class OrderDao extends BaseDao {
    public function __construct(){
        parent::__construct('orders');
    }

    public function createOrder($order){
        $data = [
            'user_id'    => $order['user_id'],
            'status'     => $order['status'],
            'total'      => $order['total'],
            'created_at' => $order['created_at']
        ];
        return $this->insert($data);
    }

    public function getAllOrders(){
        return $this->getAll();
    }

    public function getOrderById($id){
        return $this->getById($id);
    }

    public function updateOrder($id, $order){
        $data = [
            'user_id'    => $order['user_id'],
            'status'     => $order['status'],
            'total'      => $order['total'],
            'created_at' => $order['created_at']
        ];
        return $this->update($id, $data);
    }

    public function deleteOrder($id){
        return $this->delete($id);
    }
}
?>
