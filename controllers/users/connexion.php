<?php
require_once __DIR__ . '/../../models/config.php';
require_once __DIR__ . '/../../models/users/connexion.php';

if (isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
    exit;
}

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $mdp   = $_POST['mdp'] ?? '';

    $user = trouverUtilisateurParEmail($pdo, $email);

    if ($user && password_verify($mdp, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id']   = $user['id_user'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: ../../index.php');
        exit;
    } else {
        $erreur = "Email ou mot de passe incorrect.";
    }
}

require_once __DIR__ . '/../../views/users/connexion.php';
?>