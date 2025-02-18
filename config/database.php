<?php
$serveur = 'localhost';
$base = 'taskgestion';
$utilisateur = 'root';
$motdepasse = '';

try {
    $pdo = new PDO("mysql:host=$serveur;dbname=$base;charset=utf8", $utilisateur, $motdepasse);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("connection echouée : " . $e->getMessage());
}
?>