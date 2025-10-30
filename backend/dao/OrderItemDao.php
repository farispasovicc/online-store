<?php
require_once __DIR__ . '/BaseDao.php';

class OrderItemDao extends BaseDao {
    public function __construct(){
        parent::__construct('orderitems');
    }

    public function createOrderItem($orderItem){
        $data = [
            'order_id'   => $orderItem['order_id'],
            'product_id' => $orderItem['product_id'],
            'quantity'   => $orderItem['quantity'],
            'unit_price' => $orderItem['unit_price']
        ];
        return $this->insert($data);
    }

    public function getAllOrderItems(){
        return $this->getAll();
    }

    public function getOrderItemById($id){
        return $this->getById($id);
    }

    public function updateOrderItem($id, $orderItem){
        $data = [
            'order_id'   => $orderItem['order_id'],
            'product_id' => $orderItem['product_id'],
            'quantity'   => $orderItem['quantity'],
            'unit_price' => $orderItem['unit_price']
        ];
        return $this->update($id, $data);
    }

    public function deleteOrderItem($id){
        return $this->delete($id);
    }
}
?>
