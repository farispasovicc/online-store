<?php
/**
 * @OA\Get(
 *     path="/products",
 *     tags={"Products"},
 *     summary="Get all products",
 *     @OA\Response(
 *         response=200,
 *         description="List of all products"
 *     )
 * )
 */
Flight::route('GET /products', function() {
    Flight::json(Flight::productService()->getAll());
});

/**
 * @OA\Get(
 *     path="/products/{id}",
 *     tags={"Products"},
 *     summary="Get product by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Product ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product data"
 *     )
 * )
 */
Flight::route('GET /products/@id', function($id) {
    Flight::json(Flight::productService()->getById($id));
});

/**
 * @OA\Post(
 *     path="/products",
 *     tags={"Products"},
 *     summary="Create a new product",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "brand", "price"},
 *             @OA\Property(property="name", type="string", example="Nike Air Max"),
 *             @OA\Property(property="brand", type="string", example="Nike"),
 *             @OA\Property(property="price", type="number", format="float", example=129.99)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product created successfully"
 *     )
 * )
 */
Flight::route('POST /products', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->createProduct($data));
});

/**
 * @OA\Put(
 *     path="/products/{id}",
 *     tags={"Products"},
 *     summary="Update product by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Product ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "brand", "price"},
 *             @OA\Property(property="name", type="string", example="Nike Air Max Updated"),
 *             @OA\Property(property="brand", type="string", example="Nike"),
 *             @OA\Property(property="price", type="number", format="float", example=139.99)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product updated successfully"
 *     )
 * )
 */
Flight::route('PUT /products/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->update($id, $data));
});

/**
 * @OA\Delete(
 *     path="/products/{id}",
 *     tags={"Products"},
 *     summary="Delete product by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Product ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Product deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /products/@id', function($id) {
    Flight::json(Flight::productService()->delete($id));
});
?>