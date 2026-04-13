<?php include __DIR__ . '/includes/header.php'; ?>

<div class="dashboard">

    <h1>Tableau de <span>bord</span></h1>

    <!-- Statistiques -->
    <div class="stats">
        <div class="stat">
            <div class="stat-number"><?= $stats['nb_jeux'] ?></div>
            <div class="stat-label">🎲 Jeux</div>
        </div>
        <div class="stat">
            <div class="stat-number"><?= $stats['nb_utilisateurs'] ?></div>
            <div class="stat-label">👥 Utilisateurs</div>
        </div>
        <div class="stat">
            <div class="stat-number"><?= $stats['nb_favoris'] ?></div>
            <div class="stat-label">⭐ Favoris</div>
        </div>
        <div class="stat">
            <div class="stat-number"><?= $stats['nb_categories'] ?></div>
            <div class="stat-label">🏷️ Catégories</div>
        </div>
    </div>

    <div class="panels">

        <!-- Derniers jeux -->
        <div class="panel">
            <h2>🎲 Derniers jeux ajoutés</h2>
            <a href="jeux/ajouter.php" class="btn-add">＋ Ajouter un jeu</a>
            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Note</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($derniers_jeux as $jeu): ?>
                    <tr>
                        <td><?= htmlspecialchars($jeu['name']) ?></td>
                        <td><span class="badge"><?= htmlspecialchars($jeu['category']) ?></span></td>
                        <td class="note">⭐ <?= $jeu['rating'] ?></td>
                        <td>
                            <a href="jeux/modifier.php?id=<?= $jeu['id_game'] ?>" class="btn-edit">✏️ Modifier</a>
                            <a href="jeux/supprimer.php?id=<?= $jeu['id_game'] ?>" class="btn-delete"
                               onclick="return confirm('Supprimer ce jeu ?')">🗑️ Suppr.</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p style="margin-top:12px;">
                <a href="jeux/liste.php" style="color:#a855f7;">→ Voir tous les jeux</a>
            </p>
        </div>

        <!-- Derniers utilisateurs -->
        <div class="panel">
            <h2>👥 Derniers inscrits</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Inscrit le</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($derniers_users as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['name']) ?></td>
                        <td><?= htmlspecialchars($u['email']) ?></td>
                        <td><?= date('d/m/Y', strtotime($u['created_at'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p style="margin-top:12px;">
                <a href="utilisateurs/liste.php" style="color:#a855f7;">→ Voir tous les utilisateurs</a>
            </p>
        </div>

    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>