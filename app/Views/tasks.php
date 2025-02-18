<?php
session_start();
var_dump($_SESSION);
if (!isset($_SESSION['user_id'])) {
    header("Location: /");
    exit;
}

require_once __DIR__ . '/../app/Controllers/TaskController.php';
$controller = new TaskController();
$tasks = $controller->getTasks();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Tâches</title>
</head>
<body>
    <h2>Gestion des Tâches</h2>
    <a href="/logout">Déconnexion</a>

    <h3>Ajouter une Tâche</h3>
    <form action="/add-task" method="POST">
        <label>Titre :</label>
        <input type="text" name="title" required>
        <label>Description :</label>
        <textarea name="description"></textarea>
        <label>Statut :</label>
        <select name="status">
            <option value="À faire">À faire</option>
            <option value="En cours">En cours</option>
            <option value="Terminé">Terminé</option>
        </select>
        <button type="submit">Ajouter</button>
    </form>

    <h3>Liste des Tâches</h3>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <strong><?= htmlspecialchars($task['title']) ?></strong> - <?= htmlspecialchars($task['status']) ?>
                <form action="/delete-task" method="POST" style="display:inline;">
                    <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                    <button type="submit">Supprimer</button>
                </form>
                <form action="/update-task" method="POST" style="display:inline;">
                    <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                    <select name="status">
                        <option value="À faire">À faire</option>
                        <option value="En cours">En cours</option>
                        <option value="Terminé">Terminé</option>
                    </select>
                    <button type="submit">Modifier</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
