<?php
/**
 * @OA\Get(
 *     path="/orders",
 *     tags={"Orders"},
 *     summary="Get all orders",
 *     @OA\Response(
 *         response=200,
 *         description="List of all orders"
 *     )
 * )
 */
Flight::route('GET /orders', function() {
    Flight::json(Flight::orderService()->getAll());
});

/**
 * @OA\Get(
 *     path="/orders/{id}",
 *     tags={"Orders"},
 *     summary="Get order by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order data"
 *     )
 * )
 */
Flight::route('GET /orders/@id', function($id) {
    Flight::json(Flight::orderService()->getById($id));
});

/**
 * @OA\Post(
 *     path="/orders",
 *     tags={"Orders"},
 *     summary="Create a new order",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "status", "total", "created_at"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="status", type="string", example="Pending"),
 *             @OA\Property(property="total", type="number", format="float", example=129.99),
 *             @OA\Property(property="created_at", type="string", example="2024-01-15 11:30:00")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order created successfully"
 *     )
 * )
 */
Flight::route('POST /orders', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderService()->createOrder($data));
});

/**
 * @OA\Put(
 *     path="/orders/{id}",
 *     tags={"Orders"},
 *     summary="Update order by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "status", "total", "created_at"},
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="status", type="string", example="Completed"),
 *             @OA\Property(property="total", type="number", format="float", example=139.99),
 *             @OA\Property(property="created_at", type="string", example="2024-01-15 11:30:00")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order updated successfully"
 *     )
 * )
 */
Flight::route('PUT /orders/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/orders/{id}",
 *     tags={"Orders"},
 *     summary="Delete order by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Order ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /orders/@id', function($id) {
    Flight::json(Flight::orderService()->delete($id));
});
?>