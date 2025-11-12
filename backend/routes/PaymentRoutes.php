<?php
/**
 * @OA\Get(
 *     path="/payments",
 *     tags={"Payments"},
 *     summary="Get all payments",
 *     @OA\Response(
 *         response=200,
 *         description="List of all payments"
 *     )
 * )
 */
Flight::route('GET /payments', function() {
    Flight::json(Flight::paymentService()->getAll());
});

/**
 * @OA\Get(
 *     path="/payments/{id}",
 *     tags={"Payments"},
 *     summary="Get payment by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Payment ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Payment data"
 *     )
 * )
 */
Flight::route('GET /payments/@id', function($id) {
    Flight::json(Flight::paymentService()->getById($id));
});

/**
 * @OA\Post(
 *     path="/payments",
 *     tags={"Payments"},
 *     summary="Create a new payment",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"order_id", "provider", "status", "amount", "paid_at"},
 *             @OA\Property(property="order_id", type="integer", example=1),
 *             @OA\Property(property="provider", type="string", example="Credit Card"),
 *             @OA\Property(property="status", type="string", example="Successful"),
 *             @OA\Property(property="amount", type="number", format="float", example=129.99),
 *             @OA\Property(property="paid_at", type="string", example="2024-01-15 11:35:00")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Payment created successfully"
 *     )
 * )
 */
Flight::route('POST /payments', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::paymentService()->createPayment($data));
});

/**
 * @OA\Put(
 *     path="/payments/{id}",
 *     tags={"Payments"},
 *     summary="Update payment by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Payment ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"order_id", "provider", "status", "amount", "paid_at"},
 *             @OA\Property(property="order_id", type="integer", example=1),
 *             @OA\Property(property="provider", type="string", example="PayPal"),
 *             @OA\Property(property="status", type="string", example="Pending"),
 *             @OA\Property(property="amount", type="number", format="float", example=129.99),
 *             @OA\Property(property="paid_at", type="string", example="2024-01-15 11:35:00")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Payment updated successfully"
 *     )
 * )
 */
Flight::route('PUT /payments/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::paymentService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/payments/{id}",
 *     tags={"Payments"},
 *     summary="Delete payment by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Payment ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Payment deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /payments/@id', function($id) {
    Flight::json(Flight::paymentService()->delete($id));
});
?>