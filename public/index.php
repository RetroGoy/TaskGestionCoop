<?php
require '../app/Controllers/UserController.php';
require '../app/Controllers/TaskController.php';

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/':
        require '../app/Views/login.php';
        break;
    case '/register':
        require '../app/Views/register.php';
        break;
    case '/tasks':
        require '../app/Views/tasks.php';
        break;
    case '/login':
        require '../app/Views/login.php';
        break;        
    case '/register-action': 
        $controller = new UserController();
        $controller->register();
        break;        
    case '/logout':
        $controller = new UserController();
        $controller->logout();
        break;
    case '/add-task':
        $controller = new TaskController();
        $controller->addTask();
        break;
    case '/update-task':
        $controller = new TaskController();
        $controller->updateTask();
        break;
    case '/delete-task':
        $controller = new TaskController();
        $controller->deleteTask();
        break;
    default:
        http_response_code(404);
        break;
}
?>
