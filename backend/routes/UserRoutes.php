<?php

/**
 * @OA\Get(
 *     path="/users",
 *     tags={"Users"},
 *     summary="Get all users",
 *     security={{"ApiKey": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="List of all users"
 *     )
 * )
 */
Flight::route('GET /users', function () {


    Flight::auth_middleware()->verifyToken(
        Flight::request()->getHeader("Authentication")
    );


    Flight::auth_middleware()->authorizeRoles([
        Roles::ADMIN,
        Roles::USER
    ]);

    Flight::json(Flight::userService()->getAll());
});


/**
 * @OA\Get(
 *     path="/users/{id}",
 *     tags={"Users"},
 *     summary="Get user by ID",
 *     security={{"ApiKey": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User data"
 *     )
 * )
 */
Flight::route('GET /users/@id', function ($id) {


    Flight::auth_middleware()->verifyToken(
        Flight::request()->getHeader("Authentication")
    );


    Flight::auth_middleware()->authorizeRoles([
        Roles::ADMIN,
        Roles::USER
    ]);

    Flight::json(Flight::userService()->getById($id));
});


/**
 * @OA\Post(
 *     path="/users",
 *     tags={"Users"},
 *     summary="Create a new user",
 *     security={{"ApiKey": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"first_name", "surname", "email", "created_at"},
 *             @OA\Property(property="first_name", type="string", example="John"),
 *             @OA\Property(property="surname", type="string", example="Doe"),
 *             @OA\Property(property="email", type="string", example="john.doe@example.com"),
 *             @OA\Property(property="created_at", type="string", example="2024-01-15 10:00:00")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User created successfully"
 *     )
 * )
 */
Flight::route('POST /users', function () {


    Flight::auth_middleware()->verifyToken(
        Flight::request()->getHeader("Authentication")
    );


    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);

    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->createUser($data));
});


/**
 * @OA\Put(
 *     path="/users/{id}",
 *     tags={"Users"},
 *     summary="Update user by ID",
 *     security={{"ApiKey": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"first_name", "surname", "email", "created_at"},
 *             @OA\Property(property="first_name", type="string", example="John Updated"),
 *             @OA\Property(property="surname", type="string", example="Doe Updated"),
 *             @OA\Property(property="email", type="string", example="john.updated@example.com"),
 *             @OA\Property(property="created_at", type="string", example="2024-01-15 10:00:00")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User updated successfully"
 *     )
 * )
 */
Flight::route('PUT /users/@id', function ($id) {


    Flight::auth_middleware()->verifyToken(
        Flight::request()->getHeader("Authentication")
    );


    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);

    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->updateUser($id, $data));
});


/**
 * @OA\Delete(
 *     path="/users/{id}",
 *     tags={"Users"},
 *     summary="Delete user by ID",
 *     security={{"ApiKey": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /users/@id', function ($id) {


    Flight::auth_middleware()->verifyToken(
        Flight::request()->getHeader("Authentication")
    );


    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);

    Flight::json(Flight::userService()->deleteUser($id));
});
?>