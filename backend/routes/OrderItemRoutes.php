<?php
/**
 * @OA\Get(
 *     path="/order-items",
 *     tags={"Order Items"},
 *     summary="Get all order items",
 *     @OA\Response(
 *         response=200,
 *         description="List of all order items"
 *     )
 * )
 */
Flight::route('GET /order-items', function() {
    Flight::json(Flight::orderItemService()->getAll());
});

/**
 * @OA\Get(
 *     path="/order-items/{id}",
 *     tags={"Order Items"},
 *     summary="Get order item by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order Item ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item data"
 *     )
 * )
 */
Flight::route('GET /order-items/@id', function($id) {
    Flight::json(Flight::orderItemService()->getById($id));
});

/**
 * @OA\Post(
 *     path="/order-items",
 *     tags={"Order Items"},
 *     summary="Create a new order item",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"order_id", "product_id", "quantity", "unit_price"},
 *             @OA\Property(property="order_id", type="integer", example=1),
 *             @OA\Property(property="product_id", type="integer", example=1),
 *             @OA\Property(property="quantity", type="integer", example=2),
 *             @OA\Property(property="unit_price", type="number", format="float", example=64.99)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item created successfully"
 *     )
 * )
 */
Flight::route('POST /order-items', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderItemService()->createOrderItem($data));
});

/**
 * @OA\Put(
 *     path="/order-items/{id}",
 *     tags={"Order Items"},
 *     summary="Update order item by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order Item ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"order_id", "product_id", "quantity", "unit_price"},
 *             @OA\Property(property="order_id", type="integer", example=1),
 *             @OA\Property(property="product_id", type="integer", example=1),
 *             @OA\Property(property="quantity", type="integer", example=3),
 *             @OA\Property(property="unit_price", type="number", format="float", example=59.99)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item updated successfully"
 *     )
 * )
 */
Flight::route('PUT /order-items/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderItemService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/order-items/{id}",
 *     tags={"Order Items"},
 *     summary="Delete order item by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order Item ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order item deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /order-items/@id', function($id) {
    Flight::json(Flight::orderItemService()->delete($id));
});
?>