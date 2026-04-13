<?php
require_once __DIR__ . '/../../models/config.php';

if (isset($_SESSION['admin'])) {
    header('Location: dashboard.php');
    exit;
}

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login    = trim($_POST['login']    ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($login === $adminLogin && password_verify($password, $adminPass)) {
        $_SESSION['admin'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $erreur = "Identifiant ou mot de passe incorrect.";
    }
}

require_once __DIR__ . '/../../views/admin/login.php';
?>