<?php
require_once __DIR__ . '/../config.php';

if (isset($_SESSION['user_id'])) { header('Location: ../index.php'); exit; }

$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['username'] ?? '');
    $email    = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirmPassword'] ?? '';

    if (strlen($name) < 3)                         $erreurs[] = "Le nom doit contenir au moins 3 caractères.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $erreurs[] = "L'email n'est pas valide.";
    if (strlen($password) < 6)                     $erreurs[] = "Le mot de passe doit contenir au moins 6 caractères.";
    if ($password !== $confirm)                    $erreurs[] = "Les mots de passe ne correspondent pas.";
    if (!isset($_POST['terms']))                   $erreurs[] = "Vous devez accepter les conditions d'utilisation.";

    if (empty($erreurs)) {
        $stmt = $pdo->prepare("SELECT id_user FROM USER_ WHERE email = :email");
        $stmt->execute(['email' => $email]);

        if ($stmt->fetch()) {
            $erreurs[] = "Un compte existe déjà avec cet email.";
        } else {
            $pdo->prepare("INSERT INTO USER_ (name, email, password, conditions) VALUES (:name, :email, :password, 'accepted')")
                ->execute(['name' => $name, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)]);

            session_regenerate_id(true);
            $_SESSION['user_id']   = $pdo->lastInsertId();
            $_SESSION['user_name'] = $name;
            header('Location: ../index.php');
            exit;
        }
    }
}

include __DIR__ . '/../includes/header.php';
?>

<section class="inscription-section">
    <div class="container">

        <div class="inscription-header">
            <h2 class="inscription-title">REJOIGNEZ L'ARÈNE</h2>
            <p class="inscription-subtitle">Créez votre compte pour sauvegarder vos jeux favoris</p>
        </div>

        <?php if (!empty($erreurs)): ?>
            <ul class="erreur">
                <?php foreach ($erreurs as $e): ?>
                    <li>⚠️ <?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form action="" method="POST" class="form-container">

            <label class="input-label">👤 Nom d'utilisateur</label>
            <input type="text" name="username" class="form-input" placeholder="Choisissez votre pseudo"
                   required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">

            <label class="input-label">📧 Email</label>
            <input type="email" name="email" class="form-input" placeholder="votre@email.com"
                   required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

            <label class="input-label">🔒 Mot de passe</label>
            <input type="password" name="password" class="form-input" placeholder="••••••••" required>

            <label class="input-label">🔒 Confirmer le mot de passe</label>
            <input type="password" name="confirmPassword" class="form-input" placeholder="••••••••" required>

            <div class="checkbox-group">
                <input type="checkbox" name="terms" id="terms" class="custom-checkbox"
                       <?= isset($_POST['terms']) ? 'checked' : '' ?> required>
                <label for="terms" class="checkbox-label">J'accepte les conditions d'utilisation</label>
            </div>

            <button type="submit" class="submit-btn">➡️ ENTRER DANS L'ARÈNE</button>

            <p class="footer-text" style="text-align:center; margin-top:16px;">
                Déjà inscrit ? <a href="connexion.php" class="footer-link">Connectez-vous</a>
            </p>

        </form>

    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>