<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="ajouter">

    <a href="liste.php" class="retour">← Retour à la liste</a>

    <h1>Ajouter un <span>jeu</span></h1>

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
        <input type="text" name="name" id="name" placeholder="Ex: Catan" required
               value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">

        <label for="image">Nom du fichier image :</label>
        <input type="text" name="image" id="image" placeholder="Ex: catan.jpg" required
               value="<?= htmlspecialchars($_POST['image'] ?? '') ?>">

        <label for="rating">Note (0 à 5) :</label>
        <input type="number" name="rating" id="rating" min="0" max="5" step="0.1" placeholder="Ex: 4.5" required
               value="<?= htmlspecialchars($_POST['rating'] ?? '') ?>">

        <label for="players">Nombre de joueurs :</label>
        <input type="number" name="players" id="players" min="1" placeholder="Ex: 4" required
               value="<?= htmlspecialchars($_POST['players'] ?? '') ?>">

        <label for="duration">Durée (en minutes) :</label>
        <input type="number" name="duration" id="duration" min="1" placeholder="Ex: 90" required
               value="<?= htmlspecialchars($_POST['duration'] ?? '') ?>">

        <label for="id_category">Catégorie :</label>
        <select name="id_category" id="id_category">
            <option value="">-- Choisir une catégorie --</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id_category'] ?>"
                    <?= (($_POST['id_category'] ?? '') == $cat['id_category']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="description">Description :</label>
        <textarea name="description" id="description"
                  placeholder="Description courte du jeu..." required><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>

        <label for="details">Détails :</label>
        <textarea name="details" id="details"
                  placeholder="Informations supplémentaires..."><?= htmlspecialchars($_POST['details'] ?? '') ?></textarea>

        <button type="submit">＋ Ajouter le jeu</button>

    </form>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>