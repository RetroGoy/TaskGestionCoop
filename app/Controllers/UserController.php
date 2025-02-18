<?php
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../../config/database.php';

class UserController {
    private $userModel;

    public function __construct() {
        global $pdo;
        $this->userModel = new User($pdo);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->register($_POST['name'], $_POST['email'], $_POST['password']);
            header("Location: /login");
            exit;
        }
    }    

    public function login() {
        var_dump($_POST);
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->userModel->login($_POST['email'], $_POST['password']);
            var_dump($user);
    
            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                var_dump($_SESSION);
                header("Location: /tasks");
                exit;
            } else {
                echo "Identifiants incorrects.";
            }
        }
    }
      

    public function logout() {
        session_start();
        session_destroy();
        header("Location: login.php");
        exit;
    }
}
?>
