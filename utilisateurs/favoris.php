<?php
require_once __DIR__ . '/../config.php';

if (!isset($_SESSION['user_id'])) { header('Location: connexion.php'); exit; }

$stmt = $pdo->prepare("
    SELECT g.id_game, g.name, g.image, g.rating, g.players, g.duration, g.description,
           COALESCE(c.name, 'Non classé') AS category
    FROM GAME g
    JOIN Asso_FAVORITES_GAME afg ON g.id_game = afg.id_game
    JOIN FAVORITES f ON afg.id_favorites = f.id_favorites
    LEFT JOIN ASSO_GAME_CATEGORY agc ON g.id_game = agc.id_game
    LEFT JOIN CATEGORY c ON agc.id_category = c.id_category
    WHERE f.id_user = :id_user
");
$stmt->execute(['id_user' => $_SESSION['user_id']]);
$favoris = $stmt->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../includes/header.php';
?>

<section class="favorites-section">
    <div class="container">

        <div class="favorites-header">
            <h2 class="section-title">⭐ MES JEUX FAVORIS</h2>
            <p class="favorites-subtitle">Retrouvez tous vos jeux préférés en un seul endroit</p>
        </div>

        <?php if (empty($favoris)): ?>
            <p style="text-align:center; color:rgba(255,255,255,0.6);">
                Vous n'avez pas encore de favoris.
                <a href="/HungerGames/index.php" class="footer-link">Découvrir les jeux</a>
            </p>
        <?php else: ?>
            <div class="games-grid">
                <?php foreach ($favoris as $jeu): ?>
                    <div class="game-card">
                        <a href="jeu.php?id=<?= $jeu['id_game'] ?>" class="game-card-link">
                            <div class="game-image-container">
                                <img src="<?= htmlspecialchars($jeu['image']) ?>"
                                    alt="<?= htmlspecialchars($jeu['name']) ?>" class="game-image">
                                <div class="game-rating">⭐ <span class="rating-value"><?= $jeu['rating'] ?></span></div>
                            </div>
                            <div class="game-content">
                                <h3 class="game-title"><?= htmlspecialchars($jeu['name']) ?></h3>
                                <p class="game-description"><?= htmlspecialchars($jeu['description']) ?></p>
                                <p class="game-info">
                                    <span class="info-item">👥 <?= $jeu['players'] ?> joueurs</span>
                                    <span class="info-item">⏱️ <?= $jeu['duration'] ?> min</span>
                                </p>
                                <span class="game-category"><?= htmlspecialchars($jeu['category']) ?></span>
                            </div>
                        </a>
                        <form action="supprimer_favoris.php" method="POST" style="padding: 0 20px 16px;">
                            <input type="hidden" name="id_game" value="<?= $jeu['id_game'] ?>">
                            <button type="submit" class="submit-btn" style="font-size:14px; padding:8px; margin-top:0;">
                                🗑️ Retirer des favoris
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>