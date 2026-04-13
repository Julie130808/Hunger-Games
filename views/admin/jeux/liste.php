<?php include __DIR__ . '/../includes/header.php'; ?>

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