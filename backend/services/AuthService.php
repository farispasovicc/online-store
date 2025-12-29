<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/AuthDao.php';
require_once __DIR__ . '/../config.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthService extends BaseService {
    private $auth_dao;

    public function __construct() {
        $this->auth_dao = new AuthDao();
        parent::__construct(new AuthDao);
    }

    public function get_user_by_email($email){
        return $this->auth_dao->get_user_by_email($email);
    }

    public function register($entity) {
        $email = isset($entity['email']) ? trim($entity['email']) : '';
        $password = isset($entity['password']) ? (string)$entity['password'] : '';

        if ($email === '' || $password === '') {
            return ['success' => false, 'error' => 'Email and password are required.', 'code' => 400];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'error' => 'Invalid email format.', 'code' => 400];
        }

        if (strlen($password) < 6 || strlen($password) > 64) {
            return ['success' => false, 'error' => 'Password must be between 6 and 64 characters.', 'code' => 400];
        }

        $email_exists = $this->auth_dao->get_user_by_email($email);
        if ($email_exists) {
            return ['success' => false, 'error' => 'Email already registered.', 'code' => 409];
        }

        $entity['email'] = $email;
        $entity['password'] = password_hash($password, PASSWORD_BCRYPT);

        if (!isset($entity['role']) || $entity['role'] === '') {
            $entity['role'] = 'user';
        }

        $insert_result = parent::insert($entity);

        if (is_array($insert_result)) {
            $user = $insert_result;
        } else {
            $user = $this->auth_dao->get_user_by_email($email);
        }

        if (!is_array($user)) {
            return ['success' => false, 'error' => 'User created but could not be fetched.', 'code' => 500];
        }

        if (isset($user['password'])) unset($user['password']);

        return ['success' => true, 'data' => $user];
    }

    public function login($entity) {
        $email = isset($entity['email']) ? trim($entity['email']) : '';
        $password = isset($entity['password']) ? (string)$entity['password'] : '';

        if ($email === '' || $password === '') {
            return ['success' => false, 'error' => 'Email and password are required.', 'code' => 400];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'error' => 'Invalid email format.', 'code' => 400];
        }

        $user = $this->auth_dao->get_user_by_email($email);
        if (!$user) {
            return ['success' => false, 'error' => 'Invalid username or password.', 'code' => 401];
        }

        if (!password_verify($password, $user['password'])) {
            return ['success' => false, 'error' => 'Invalid username or password.', 'code' => 401];
        }

        unset($user['password']);

        $jwt_payload = [
            'user' => $user,
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24)
        ];

        $token = JWT::encode(
            $jwt_payload,
            Config::JWT_SECRET(),
            'HS256'
        );

        return [
            'success' => true,
            'data' => array_merge($user, ['token' => $token])
        ];
    }
}
?>
