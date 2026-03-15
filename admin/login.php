<?php
require_once __DIR__ . '/../config.php';

if (isset($_SESSION['admin'])) {
    header('Location: dashboard.php');
    exit;
}

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login    = trim($_POST['login'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Identifiants admin (change-les selon tes préférences)
    if ($login === 'root' && $password === 'root') {
        $_SESSION['admin'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $erreur = "Identifiant ou mot de passe incorrect.";
    }
}

include __DIR__ . '/includes/header.php';
?>

<div class="login-form">
    <h1>Connexion Admin</h1>

    <?php if (!empty($erreur)): ?>
        <p class="erreur">⚠️ <?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="login">Identifiant :</label>
        <input type="text" name="login" id="login" placeholder="Votre identifiant" required>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" placeholder="Votre mot de passe" required>

        <button type="submit">Se connecter</button>
    </form>

    <p><a href="/index.php">← Retour au site</a></p>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>