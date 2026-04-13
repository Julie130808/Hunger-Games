<?php include __DIR__ . '/../includes/header.php'; ?>

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
            <input type="text" name="username" class="form-input"
                   placeholder="Choisissez votre pseudo" required
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">

            <label class="input-label">📧 Email</label>
            <input type="email" name="email" class="form-input"
                   placeholder="votre@email.com" required
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

            <label class="input-label">🔒 Mot de passe</label>
            <input type="password" name="password" class="form-input"
                   placeholder="••••••••" required>

            <label class="input-label">🔒 Confirmer le mot de passe</label>
            <input type="password" name="confirmPassword" class="form-input"
                   placeholder="••••••••" required>

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