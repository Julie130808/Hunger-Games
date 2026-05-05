<?php
require_once __DIR__ . '/../../models/config.php';

// 1) Vider toutes les variables de session pour la requête courante
$_SESSION = [];

// 2) Supprimer le cookie de session côté navigateur
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3) Détruire les données de session côté serveur
session_destroy();

header('Location: ' . BASE_URL . '/index.php');
exit;
?>