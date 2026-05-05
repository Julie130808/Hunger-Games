</main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h5 class="footer-title">HUNGER GAMES</h5>
                    <p class="footer-text">Panneau d'administration. Accès réservé.</p>
                </div>
                <div>
                    <h5 class="footer-title">Administration</h5>
                    <ul class="footer-links">
                        <li><a href="<?= BASE_URL ?>/controllers/admin/dashboard.php">Dashboard</a></li>
                        <li><a href="<?= BASE_URL ?>/controllers/admin/jeux/liste.php">Jeux</a></li>
                        <li><a href="<?= BASE_URL ?>/controllers/admin/categories.php">Catégories</a></li>
                        <li><a href="<?= BASE_URL ?>/controllers/admin/users/utilisateurs.php">Utilisateurs</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="footer-title">Site</h5>
                    <ul class="footer-links">
                        <li><a href="<?= BASE_URL ?>/index.php">Retour au site</a></li>
                        <li><a href="<?= BASE_URL ?>/controllers/admin/logout.php">Déconnexion</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2026 HUNGER GAMES 🃏 — Administration</p>
            </div>
        </div>
    </footer>

</body>
</html>