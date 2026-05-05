<?php include __DIR__ . '/includes/header.php'; ?>

<div class="categories">

    <a href="<?= BASE_URL ?>/controllers/admin/dashboard.php" class="retour">← Retour au dashboard</a>

    <h1>Gestion des <span>catégories</span></h1>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($categories as $cat): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= htmlspecialchars($cat['name']) ?></td>
                <td><?= htmlspecialchars($cat['description']) ?></td>
                <td>
                    <a href="categories.php?supprimer=<?= $cat['id_category'] ?>" class="btn-delete"
                       onclick="return confirm('Supprimer cette catégorie ?')">🗑️ Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>➕ Ajouter une catégorie</h2>

    <form action="" method="POST">

        <?php if (!empty($erreurs)): ?>
            <ul class="erreur">
                <?php foreach ($erreurs as $e): ?>
                    <li>⚠️ <?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if (!empty($succes)): ?>
            <p class="succes">✅ <?= htmlspecialchars($succes) ?></p>
        <?php endif; ?>

        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" placeholder="Ex: Stratégie" required
               value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">

        <label for="description">Description :</label>
        <textarea name="description" id="description"
                  placeholder="Description de la catégorie..."><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>

        <button type="submit" name="ajouter">➕ Ajouter</button>

    </form>

</div>

<?php include __DIR__ . '/includes/footer.php'; ?>