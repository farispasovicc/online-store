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
       $phone = isset($entity['phone']) ? trim((string)$entity['phone']) : '';

       if ($email === '' || $password === '') {
           return ['success' => false, 'error' => 'Email and password are required.', 'code' => 400];
       }

       if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
           return ['success' => false, 'error' => 'Invalid email format.', 'code' => 400];
       }

       if (strlen($password) < 6 || strlen($password) > 64) {
           return ['success' => false, 'error' => 'Password must be between 6 and 64 characters.', 'code' => 400];
       }

       if ($phone !== '' && !preg_match('/^[0-9 +()\-\_]{6,30}$/', $phone)) {
           return ['success' => false, 'error' => 'Invalid phone number.', 'code' => 400];
       }

       $email_exists = $this->auth_dao->get_user_by_email($email);
       if($email_exists){
           return ['success' => false, 'error' => 'Email already registered.', 'code' => 409];
       }

       $entity['email'] = $email;
       $entity['password'] = password_hash($password, PASSWORD_BCRYPT);

       if (!isset($entity['role']) || $entity['role'] === '') {
           $entity['role'] = 'user';
       }

       $entity = parent::insert($entity);

       unset($entity['password']);

       return ['success' => true, 'data' => $entity];
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
       if(!$user){
           return ['success' => false, 'error' => 'Invalid username or password.', 'code' => 401];
       }

       if(!password_verify($password, $user['password'])) {
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
