<?php
require_once __DIR__ . '/../config.php';

if (isset($_SESSION['user_id'])) { header('Location: ../index.php'); exit; }

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $mdp   = $_POST['mdp'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM USER_ WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($mdp, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id']   = $user['id_user'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: ../index.php');
        exit;
    } else {
        $erreur = "Email ou mot de passe incorrect.";
    }
}

include __DIR__ . '/../includes/header.php';
?>

<section class="inscription-section">
    <div class="container">

        <div class="inscription-header">
            <h1 class="inscription-title">CONNEXION</h1>
            <p class="inscription-subtitle">Accédez à votre espace personnel</p>
        </div>

        <?php if (!empty($erreur)): ?>
            <ul class="erreur">
                <li>⚠️ <?= htmlspecialchars($erreur) ?></li>
            </ul>
        <?php endif; ?>

        <form action="" method="POST" class="form-container">

            <label class="input-label">📧 Email</label>
            <input type="email" name="email" class="form-input" placeholder="Votre email"
                   required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

            <label class="input-label">🔒 Mot de passe</label>
            <input type="password" name="mdp" class="form-input" placeholder="Votre mot de passe" required>

            <button type="submit" class="submit-btn">🎮 SE CONNECTER</button>

            <p class="footer-text" style="text-align:center; margin-top:16px;">
                Pas encore de compte ? <a href="inscription.php" class="footer-link">S'inscrire</a>
            </p>

        </form>

    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>