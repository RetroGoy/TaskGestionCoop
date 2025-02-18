<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: tasks.php");
    exit; }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <h2>Inscription</h2>
    <form action="/register-action" method="POST">
        <input type="hidden" name="action" value="register">
        <label>Nom :</label>
        <input type="text" name="name" required>
        <label>Email :</label>
        <input type="email" name="email" required>
        <label>Mot de passe :</label>
        <input type="password" name="password" required>
        <button type="submit">S'inscrire</button>
    </form>
    <p>Déjà un compte ? <a href="login">Se connecter</a></p>
</body>
</html>
