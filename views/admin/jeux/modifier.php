<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="modifier">

    <a href="liste.php" class="retour">← Retour à la liste</a>

    <h1>Modifier <span><?= htmlspecialchars($jeu['name']) ?></span></h1>

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

        <label for="name">Nom du jeu :</label>
        <input type="text" name="name" id="name" required
               value="<?= htmlspecialchars($jeu['name']) ?>">

        <label for="image">Nom du fichier image :</label>
        <input type="text" name="image" id="image" required
               value="<?= htmlspecialchars($jeu['image']) ?>">

        <label for="rating">Note (0 à 5) :</label>
        <input type="number" name="rating" id="rating" min="0" max="5" step="0.1" required
               value="<?= htmlspecialchars($jeu['rating']) ?>">

        <label for="players">Nombre de joueurs :</label>
        <input type="number" name="players" id="players" min="1" required
               value="<?= htmlspecialchars($jeu['players']) ?>">

        <label for="duration">Durée (en minutes) :</label>
        <input type="number" name="duration" id="duration" min="1" required
               value="<?= htmlspecialchars($jeu['duration']) ?>">

        <label for="id_category">Catégorie :</label>
        <select name="id_category" id="id_category">
            <option value="">-- Choisir une catégorie --</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id_category'] ?>"
                    <?= ($categorie_actuelle == $cat['id_category']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="description">Description :</label>
        <textarea name="description" id="description" required><?= htmlspecialchars($jeu['description']) ?></textarea>

        <label for="details">Détails :</label>
        <textarea name="details" id="details"><?= htmlspecialchars($jeu['détails']) ?></textarea>

        <button type="submit">✏️ Enregistrer les modifications</button>

    </form>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>