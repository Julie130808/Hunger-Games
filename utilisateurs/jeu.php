<?php
require_once __DIR__ . '/../config.php';

$id = (int)($_GET['id'] ?? 0);
if ($id === 0) { header('Location: ../index.php'); exit; }

$stmt = $pdo->prepare("
    SELECT g.*, COALESCE(c.name, 'Non classé') AS category
    FROM GAME g
    LEFT JOIN ASSO_GAME_CATEGORY agc ON g.id_game = agc.id_game
    LEFT JOIN CATEGORY c ON agc.id_category = c.id_category
    WHERE g.id_game = :id
");
$stmt->execute(['id' => $id]);
$jeu = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$jeu) { header('Location: ../index.php'); exit; }

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) { header('Location: connexion.php'); exit; }

    $stmt = $pdo->prepare("SELECT id_favorites FROM FAVORITES WHERE id_user = :id_user");
    $stmt->execute(['id_user' => $_SESSION['user_id']]);
    $favori = $stmt->fetch();

    if (!$favori) {
        $pdo->prepare("INSERT INTO FAVORITES (id_user) VALUES (:id_user)")->execute(['id_user' => $_SESSION['user_id']]);
        $id_favorites = $pdo->lastInsertId();
    } else {
        $id_favorites = $favori['id_favorites'];
    }

    $stmt = $pdo->prepare("SELECT * FROM Asso_FAVORITES_GAME WHERE id_game = :id_game AND id_favorites = :id_favorites");
    $stmt->execute(['id_game' => $id, 'id_favorites' => $id_favorites]);

    if ($stmt->fetch()) {
        $message = 'Ce jeu est déjà dans vos favoris !';
    } else {
        $pdo->prepare("INSERT INTO Asso_FAVORITES_GAME (id_game, id_favorites) VALUES (:id_game, :id_favorites)")
            ->execute(['id_game' => $id, 'id_favorites' => $id_favorites]);
        $message = '⭐ Jeu ajouté à vos favoris !';
    }
}

include __DIR__ . '/../includes/header.php';
?>

<section class="game-details-section">
    <div class="container">

        <div class="back-link">
            <a href="../index.php">← Retour à l'accueil</a>
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

<!-- Variable JS pour l'ID du jeu (obligatoire, doit être avant le script) -->
<script>
    const ID_JEU = <?= (int)$id ?>;
</script>
 
<section class="section-commentaires">
    <div class="container">
        <div class="game-details-description">
 
        <h2 class="titre-commentaires">💬 Avis de la communauté</h2>
 
        <!-- Résumé de la note moyenne -->
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
 
        <!-- Formulaire (visible uniquement si connecté, géré par JS) -->
        <div class="bloc-formulaire" id="formulaireCommentaire" style="display:none;">
            <h3 class="titre-formulaire">✍️ Laisser un avis</h3>
 
            <!-- Étoiles cliquables -->
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
 
        <!-- Message si non connecté (géré par JS) -->
        <div class="bloc-connexion" id="messageConnexion" style="display:none;">
            <p class="message-connexion">
                <a href="connexion.php">Connectez-vous</a> pour laisser un avis sur ce jeu.
            </p>
        </div>
 
        <!-- Retour succès / erreur après envoi -->
        <div id="retourCommentaire" style="display:none;"></div>
 
        <!-- Liste des commentaires -->
        <div id="listeCommentaires">
            <p class="commentaires-vide">Chargement des avis...</p>
        </div>
        </div>
    </div>
</section>
 
<!-- Script JS (chemin depuis utilisateurs/jeu.php vers assets/js/) -->
<script src="../assets/js/commentaires.js"></script>

<?php include __DIR__ . '/../includes/footer.php'; ?>