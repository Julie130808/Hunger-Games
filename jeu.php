<?php
include 'include/header.php';
require 'config.php';
?>
        <!-- Section Détails du Jeu -->
        <section class="game-details-section">
            <div class="container">
                <!-- Lien de retour -->
                <div class="back-link">
                    <a href="index.html">← Retour à l'accueil</a>
                </div>

                <!-- Contenu du jeu -->
                <div id="gameDetailsContent">
                    <div class="game-details-container">
                        <!-- Image du jeu -->
                        <div class="game-details-image">
                            <img id="gameImage" src="#" alt="">
                        </div>

                        <!-- Informations du jeu -->
                        <div class="game-details-info">
                            <h2 id="gameTitle" class="game-details-title"></h2>

                            <div class="game-details-rating">
                                <div class="rating-stars" id="gameStars"></div>
                                <span id="gameRating" class="rating-number"></span>
                            </div>

                            <div class="game-details-meta">
                                <div class="meta-item">
                                    <span class="meta-label">👥 Joueurs :</span>
                                    <span id="gamePlayers" class="meta-value"></span>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">⏱️ Durée :</span>
                                    <span id="gameDuration" class="meta-value"></span>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">🎯 Catégorie :</span>
                                    <span id="gameCategory" class="meta-value"></span>
                                </div>
                            </div>

                            <button id="addToFavoritesBtn" class="submit-btn" style="width: 100%; margin-top: 2rem;">
                                <span class="btn-icon">⭐</span>
                                AJOUTER AUX FAVORIS
                            </button>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="game-details-description">
                        <h2>📖 À propos de ce jeu</h2>
                        <p id="gameDescription"></p>
                    </div>
                </div>
            </div>
        </section>

<?php
include 'include/footer.php';
?>