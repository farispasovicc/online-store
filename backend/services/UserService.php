<?php

require_once 'BaseService.php';
require_once __DIR__ . '/../dao/UserDao.php';

class UserService extends BaseService {

    public function __construct() {
        $dao = new UserDao();
        parent::__construct($dao);
    }

    public function createUser($data) {
        if (empty($data['first_name']) || empty($data['surname']) || empty($data['email'])) {
            throw new Exception("First name, surname, and email must be filled out.");
        }

        $existingUser = $this->dao->getByEmail($data['email']);
        if ($existingUser) {
            throw new Exception("User with this email already exists.");
        }

        return $this->insert($data);  
    }

    public function updateUser($id, $data) {
        if (empty($data['first_name']) || empty($data['surname']) || empty($data['email'])) {
            throw new Exception("First name, surname, and email must be filled out.");
        }
        return $this->update($id, $data);
    }

    public function deleteUser($id) {
        return $this->delete($id);
    }


}
?>