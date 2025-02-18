<?php
class Task {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function getTasksByUser($userId) {
        $query = $this->pdo->prepare("SELECT * FROM tasks WHERE user_id = ?");
        $query->execute([$userId]);
        return $query->fetchAll();
    }
    public function addTask($title, $description, $status, $userId) {
        $query = $this->pdo->prepare("INSERT INTO tasks (title, description, status, user_id) VALUES (?, ?, ?, ?)");
        $query->execute([$title, $description, $status, $userId]);
    }
    public function updateTaskStatus($taskId, $status) {
        $query = $this->pdo->prepare("UPDATE tasks SET status = ? WHERE id = ?");
        $query->execute([$status, $taskId]);
    }
    public function deleteTask($taskId) {
        $query = $this->pdo->prepare("DELETE FROM tasks WHERE id = ?");
        $query->execute([$taskId]);
    }
}
?>