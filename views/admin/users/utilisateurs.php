<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="utilisateurs">

    <a href="/HungerGames/admin/dashboard.php" class="retour">← Retour au dashboard</a>

    <h1>Gestion des <span>utilisateurs</span></h1>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Inscrit le</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilisateurs as $u): ?>
            <tr>
                <td><?= $u['id_user'] ?></td>
                <td><?= htmlspecialchars($u['name']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= date('d/m/Y', strtotime($u['created_at'])) ?></td>
                <td>
                    <a href="supprimer_utilisateur.php?id=<?= $u['id_user'] ?>" class="btn-delete"
                       onclick="return confirm('Supprimer cet utilisateur ?')">🗑️ Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>