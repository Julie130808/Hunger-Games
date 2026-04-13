<?php include __DIR__ . '/../includes/header.php'; ?>

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
            <input type="email" name="email" class="form-input"
                   placeholder="Votre email" required
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

            <label class="input-label">🔒 Mot de passe</label>
            <input type="password" name="mdp" class="form-input"
                   placeholder="Votre mot de passe" required>

            <button type="submit" class="submit-btn">🎮 SE CONNECTER</button>

            <p class="footer-text" style="text-align:center; margin-top:16px;">
                Pas encore de compte ? <a href="inscription.php" class="footer-link">S'inscrire</a>
            </p>

        </form>

    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>