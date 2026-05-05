<?php include __DIR__ . '/../includes/header.php'; ?>

<section class="game-details-section">
    <div class="container">

        <div class="back-link">
            <a href="../../index.php">← Retour à l'accueil</a>
        </div>

        <?php if (!empty($message)): ?>
            <p class="succes"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <div class="game-details-container">

            <div class="game-details-image">
                <img src="<?= htmlspecialchars($jeu['image']) ?>" alt="<?= htmlspecialchars($jeu['name']) ?>">
            </div>

            <div class="game-details-info">
                <h2 class="game-details-title"><?= htmlspecialchars($jeu['name']) ?></h2>

                <div class="game-details-rating">
                    <span><?= str_repeat('⭐', floor($jeu['rating'])) ?></span>
                    <span class="rating-number"><?= $jeu['rating'] ?> / 5</span>
                </div>

                <p>👥 <?= $jeu['players'] ?> joueurs &nbsp;|&nbsp; ⏱️ <?= $jeu['duration'] ?> min &nbsp;|&nbsp; 🎯 <?= htmlspecialchars($jeu['category']) ?></p>

                <form action="" method="POST">
                    <button type="submit" class="submit-btn">⭐ AJOUTER AUX FAVORIS</button>
                </form>
            </div>

        </div>

        <div class="game-details-description">
            <h2>📖 À propos de ce jeu</h2>
            <p><?= htmlspecialchars($jeu['détails']) ?></p>
        </div>

    </div>
</section>

<script>
    const ID_JEU = <?= (int)$id ?>;
</script>

<section class="section-commentaires">
    <div class="container">
        <div class="game-details-description">

            <h2 class="titre-commentaires">💬 Avis de la communauté</h2>

            <div class="resume-note">
                <span class="note-grande" id="affichageNote"><?= number_format($jeu['rating'], 1) ?></span>
                <span class="resume-etoiles" id="affichageEtoiles">
                    <?php
                    $r = (int)round(floatval($jeu['rating']));
                    for ($i = 1; $i <= 5; $i++) {
                        echo $i <= $r ? '★' : '☆';
                    }
                    ?>
                </span>
                <span class="resume-total" id="affichageTotal">Chargement...</span>
            </div>

            <div class="bloc-formulaire" id="formulaireCommentaire" style="display:none;">
                <h3 class="titre-formulaire">✍️ Laisser un avis</h3>

                <div class="saisie-etoiles" role="group" aria-label="Note sur 5">
                    <input type="radio" id="e5" name="note" value="5"><label for="e5" title="5 étoiles">★</label>
                    <input type="radio" id="e4" name="note" value="4"><label for="e4" title="4 étoiles">★</label>
                    <input type="radio" id="e3" name="note" value="3"><label for="e3" title="3 étoiles">★</label>
                    <input type="radio" id="e2" name="note" value="2"><label for="e2" title="2 étoiles">★</label>
                    <input type="radio" id="e1" name="note" value="1"><label for="e1" title="1 étoile">★</label>
                </div>

                <textarea id="contenuCommentaire"
                          class="form-input"
                          placeholder="Partagez votre expérience... (10 à 1000 caractères)"
                          maxlength="1000"
                          rows="4"></textarea>

                <button type="button" id="boutonPublier" class="submit-btn" onclick="envoyerCommentaire()">
                    Publier mon avis
                </button>
            </div>

            <div class="bloc-connexion" id="messageConnexion" style="display:none;">
                <p class="message-connexion">
                    <a href="connexion.php">Connectez-vous</a> pour laisser un avis sur ce jeu.
                </p>
            </div>

            <div id="retourCommentaire" style="display:none;"></div>

            <div id="listeCommentaires">
                <p class="commentaires-vide">Chargement des avis...</p>
            </div>

        </div>
    </div>
</section>

<script src="<?= BASE_URL ?>/assets/js/commentaires.js"></script>

<?php include __DIR__ . '/../includes/footer.php'; ?>