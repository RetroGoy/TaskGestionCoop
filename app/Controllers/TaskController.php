<?php
require_once __DIR__ . '/../Models/Task.php';
require_once __DIR__ . '/../../config/database.php';

class TaskController {
    private $taskModel;

    public function __construct() {
        global $pdo;
        $this->taskModel = new Task($pdo);
    }

    public function getTasks() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit;
        }
        return $this->taskModel->getTasksByUser($_SESSION['user_id']);
    }

    public function addTask() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $this->taskModel->addTask($_POST['title'], $_POST['description'], $_POST['status'], $_SESSION['user_id']);
            header("Location: tasks.php");
            exit;
        }
    }

    public function updateTask() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $this->taskModel->updateTaskStatus($_POST['task_id'], $_POST['status']);
            header("Location: tasks.php");
            exit;
        }
    }

    public function deleteTask() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $this->taskModel->deleteTask($_POST['task_id']);
            header("Location: tasks.php");
            exit;
        }
    }
}
?>
