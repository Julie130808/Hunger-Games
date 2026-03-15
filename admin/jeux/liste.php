<?php
require_once __DIR__ . '/../../config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit;
}

include __DIR__ . '/../includes/header.php';

$jeux = $pdo->query("
    SELECT g.id_game, g.name, g.rating, g.players, g.duration,
           COALESCE(c.name, 'Non classé') AS category
    FROM GAME g
    LEFT JOIN ASSO_GAME_CATEGORY agc ON g.id_game = agc.id_game
    LEFT JOIN CATEGORY c ON agc.id_category = c.id_category
    ORDER BY g.id_game DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="liste">

    <a href="../dashboard.php" class="retour">← Retour au dashboard</a>

    <h1>Gestion des <span>jeux</span></h1>

    <a href="ajouter.php" class="btn-add">＋ Ajouter un jeu</a>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Note</th>
                <th>Joueurs</th>
                <th>Durée</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jeux as $jeu): ?>
            <tr>
                <td><?= $jeu['id_game'] ?></td>
                <td><?= htmlspecialchars($jeu['name']) ?></td>
                <td><span class="badge"><?= htmlspecialchars($jeu['category']) ?></span></td>
                <td class="note">⭐ <?= $jeu['rating'] ?></td>
                <td><?= $jeu['players'] ?> joueurs</td>
                <td><?= $jeu['duration'] ?> min</td>
                <td>
                    <a href="modifier.php?id=<?= $jeu['id_game'] ?>" class="btn-edit">✏️ Modifier</a>
                    <a href="supprimer.php?id=<?= $jeu['id_game'] ?>" class="btn-delete"
                       onclick="return confirm('Supprimer ce jeu ?')">🗑️ Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>