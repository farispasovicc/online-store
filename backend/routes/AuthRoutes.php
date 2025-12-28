<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::group('/auth', function() {

    /**
     * @OA\Post(
     *     path="/auth/register",
     *     summary="Register new user.",
     *     description="Add a new user to the database.",
     *     tags={"auth"},
     *     security={
     *         {"ApiKey": {}}
     *     },
     *     @OA\RequestBody(
     *         description="Add new user",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"password", "email"},
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     example="some_password",
     *                     description="User password"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     example="demo@gmail.com",
     *                     description="User email"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User has been added."
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error."
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="Email already exists."
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error."
     *     )
     * )
     */
    Flight::route("POST /register", function () {
        $data = Flight::request()->data->getData();

        if (!is_array($data)) {
            $raw = Flight::request()->getBody();
            $decoded = json_decode($raw, true);
            $data = is_array($decoded) ? $decoded : [];
        }

        $response = Flight::auth_service()->register($data);

        if (isset($response['success']) && $response['success']) {
            Flight::json([
                'message' => 'User registered successfully',
                'data' => $response['data']
            ]);
        } else {
            $code = isset($response['code']) ? (int)$response['code'] : 400;
            $error = isset($response['error']) ? $response['error'] : 'Registration failed';
            Flight::halt($code, $error);
        }
    });

    /**
     * @OA\Post(
     *      path="/auth/login",
     *      tags={"auth"},
     *      summary="Login to system using email and password",
     *      @OA\Response(
     *           response=200,
     *           description="User data and JWT"
     *      ),
     *      @OA\Response(
     *           response=400,
     *           description="Validation error."
     *      ),
     *      @OA\Response(
     *           response=401,
     *           description="Invalid credentials."
     *      ),
     *      @OA\RequestBody(
     *          description="Credentials",
     *          @OA\JsonContent(
     *              required={"email","password"},
     *              @OA\Property(property="email", type="string", example="demo@gmail.com"),
     *              @OA\Property(property="password", type="string", example="some_password")
     *          )
     *      )
     * )
     */
    Flight::route('POST /login', function() {
        $data = Flight::request()->data->getData();

        if (!is_array($data)) {
            $raw = Flight::request()->getBody();
            $decoded = json_decode($raw, true);
            $data = is_array($decoded) ? $decoded : [];
        }

        $response = Flight::auth_service()->login($data);

        if (isset($response['success']) && $response['success']) {
            Flight::json([
                'message' => 'User logged in successfully',
                'data' => $response['data']
            ]);
        } else {
            $code = isset($response['code']) ? (int)$response['code'] : 401;
            $error = isset($response['error']) ? $response['error'] : 'Login failed';
            Flight::halt($code, $error);
        }
    });
});
?>
