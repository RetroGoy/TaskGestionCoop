<?php
class User {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function register($name, $email, $password) {
        $query = $this->pdo->prepare("SELECT id FROM users WHERE email = ?");
        $query->execute([$email]);
        if ($query->fetch()) {
            die("email déja utilise");
        }
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $query->execute([$name, $email, $hashedPassword]);
    }
    
    public function login($email, $password) {
        $query = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $query->execute([$email]);
        $user = $query->fetch();
    
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }    
}
?>