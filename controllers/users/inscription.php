<?php
require_once __DIR__ . '/../../models/config.php';
require_once __DIR__ . '/../../models/users/inscription.php';

if (isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
    exit;
}

$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['username'] ?? '');
    $email    = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirmPassword'] ?? '';

    if (strlen($name) < 3)                          $erreurs[] = "Le nom doit contenir au moins 3 caractères.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))  $erreurs[] = "L'email n'est pas valide.";
    if (strlen($password) < 6)                      $erreurs[] = "Le mot de passe doit contenir au moins 6 caractères.";
    if ($password !== $confirm)                     $erreurs[] = "Les mots de passe ne correspondent pas.";
    if (!isset($_POST['terms']))                    $erreurs[] = "Vous devez accepter les conditions d'utilisation.";

    if (empty($erreurs)) {
        if (emailDejaUtilise($pdo, $email)) {
            $erreurs[] = "Un compte existe déjà avec cet email.";
        } else {
            $id = creerUtilisateur($pdo, $name, $email, $password);
            session_regenerate_id(true);
            $_SESSION['user_id']   = $id;
            $_SESSION['user_name'] = $name;
            header('Location: ../../index.php');
            exit;
        }
    }
}

require_once __DIR__ . '/../../views/users/inscription.php';
?>