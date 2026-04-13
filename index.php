<?php
require_once __DIR__ . '/models/config.php';
include __DIR__ . '/views/includes/header.php';

$categorie = $_GET['categorie'] ?? 'all';
$recherche = trim($_GET['recherche'] ?? '');

$params = [];
$sql = "
    SELECT g.id_game, g.name, g.image, g.rating, g.players, g.duration, g.description,
           COALESCE(MAX(c.name), 'Non classé') AS category
    FROM GAME g
    LEFT JOIN ASSO_GAME_CATEGORY agc ON g.id_game = agc.id_game
    LEFT JOIN CATEGORY c ON agc.id_category = c.id_category
    WHERE 1=1
";

if (!empty($recherche)) {
    $sql .= " AND g.name LIKE :recherche";
    $params['recherche'] = '%' . $recherche . '%';
}

if ($categorie !== 'all') {
    $sql .= " AND c.name = :categorie";
    $params['categorie'] = $categorie;
}

$sql .= " GROUP BY g.id_game";

$jeux = $pdo->prepare($sql);
$jeux->execute($params);
$jeux = $jeux->fetchAll(PDO::FETCH_ASSOC);
$categories = $pdo->query("SELECT DISTINCT name FROM CATEGORY ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="first-section">
    <div class="container">
        <h2 class="first-section-title">Puisse le sort vous être favorable !</h2>
        <p class="first-section-subtitle">Plongez dans l'univers sombre et captivant des jeux de société.</p>

        <form action="" method="GET" class="search-container">
            <div class="search-box">
                <input type="text" name="recherche" class="search-input"
                       placeholder="🔍 Rechercher un jeu..."
                       value="<?= htmlspecialchars($recherche) ?>">
                <input type="hidden" name="categorie" value="<?= htmlspecialchars($categorie) ?>">
                <button type="submit" class="search-button">Rechercher</button>
            </div>
        </form>
    </div>
</section>

<section class="filters-section">
    <div class="container">
        <div class="filters-container">
            <a href="?" class="filter-btn <?= $categorie === 'all' ? 'filter-btn-active' : '' ?>">Tous</a>
            <?php foreach ($categories as $cat): ?>
                <a href="?categorie=<?= urlencode($cat['name']) ?>&recherche=<?= urlencode($recherche) ?>"
                   class="filter-btn <?= $categorie === $cat['name'] ? 'filter-btn-active' : '' ?>">
                    <?= htmlspecialchars($cat['name']) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="games-section">
    <div class="container">
        <h3 class="section-title">Jeux populaires</h3>

        <?php if (empty($jeux)): ?>
            <p style="color:rgba(255,255,255,0.6); text-align:center;">Aucun jeu trouvé.</p>
        <?php else: ?>
            <div class="games-grid">
                <?php foreach ($jeux as $jeu): ?>
                <a href="controllers/users/jeu.php?id=<?= $jeu['id_game'] ?>" class="game-card-link">
                    <div class="game-card">
                        <div class="game-image-container">
                            <img src="<?= htmlspecialchars($jeu['image']) ?>" alt="<?= htmlspecialchars($jeu['name']) ?>" class="game-image">
                            <div class="game-rating">⭐ <span class="rating-value"><?= $jeu['rating'] ?></span></div>
                        </div>
                        <div class="game-content">
                            <h4 class="game-title"><?= htmlspecialchars($jeu['name']) ?></h4>
                            <p class="game-description"><?= htmlspecialchars($jeu['description']) ?></p>
                            <p class="game-info">
                                <span class="info-item">👥 <?= $jeu['players'] ?> joueurs</span>
                                <span class="info-item">⏱️ <?= $jeu['duration'] ?> min</span>
                            </p>
                            <span class="game-category"><?= htmlspecialchars($jeu['category']) ?></span>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php include __DIR__ . '/views/includes/footer.php'; ?>