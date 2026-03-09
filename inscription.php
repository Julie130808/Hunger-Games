<?php
include 'include/header.php';
?>
            <!-- Section Inscription -->
        <section class="inscription-section">
            <div class="container">
                <div class="inscription-container">
                    <div class="inscription-header">
                        <h2 class="inscription-title">REJOIGNEZ L'ARÈNE</h2>
                        <p class="inscription-subtitle">Créez votre compte pour sauvegarder vos jeux favoris</p>
                    </div>

                    <div class="form-container">
                        <div class="form-card">
                            <div class="avatar-section">
                                <div class="avatar-circle">
                                    <span style="font-size: 3rem;">👤</span>
                                </div>
                                <p class="avatar-text">Votre Profil</p>
                            </div>

                            <div class="form-wrapper">
                                <div class="input-group">
                                    <label for="username" class="input-label">
                                        <span class="label-icon">👤</span>
                                        Nom d'utilisateur
                                    </label>
                                    <input 
                                        type="text" 
                                        id="username" 
                                        class="form-input" 
                                        placeholder="Choisissez votre pseudo"
                                        required
                                    >
                                </div>

                                <div class="input-group">
                                    <label for="email" class="input-label">
                                        <span class="label-icon">📧</span>
                                        Email
                                    </label>
                                    <input 
                                        type="email" 
                                        id="email" 
                                        class="form-input" 
                                        placeholder="votre@email.com"
                                        required
                                    >
                                </div>

                                <div class="input-group">
                                    <label for="password" class="input-label">
                                        <span class="label-icon">🔒</span>
                                        Mot de passe
                                    </label>
                                    <input 
                                        type="password" 
                                        id="password" 
                                        class="form-input" 
                                        placeholder="••••••••"
                                        required
                                    >
                                </div>

                                <div class="input-group">
                                    <label for="confirmPassword" class="input-label">
                                        <span class="label-icon">🔒</span>
                                        Confirmer le mot de passe
                                    </label>
                                    <input 
                                        type="password" 
                                        id="confirmPassword" 
                                        class="form-input" 
                                        placeholder="••••••••"
                                        required
                                    >
                                </div>

                                <div class="checkbox-group">
                                    <input type="checkbox" id="terms" class="custom-checkbox" required>
                                    <label for="terms" class="checkbox-label">
                                        J'accepte les règles de l'arène et les conditions d'utilisation
                                    </label>
                                </div>

                                <button type="button" id="registerBtn" class="submit-btn">
                                    <span class="btn-icon">➡️</span>
                                    ENTRER DANS L'ARÈNE
                                </button>

                                <div class="form-footer">
                                    <p class="footer-text">
                                        Déjà inscrit ? 
                                        <a href="connexion.html" class="footer-link">Connectez-vous</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
<?php
include 'include/footer.php';
?>