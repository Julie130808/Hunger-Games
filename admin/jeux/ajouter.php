<?php
require_once __DIR__ . '/../../config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit;
}

include __DIR__ . '/../includes/header.php';

$erreurs = [];
$succes  = '';

// Récupérer les catégories pour le select
$categories = $pdo->query("SELECT id_category, name FROM CATEGORY ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = trim($_POST['name']        ?? '');
    $description = trim($_POST['description'] ?? '');
    $details     = trim($_POST['details']     ?? '');
    $image       = trim($_POST['image']       ?? '');
    $rating      = trim($_POST['rating']      ?? '');
    $players     = trim($_POST['players']     ?? '');
    $duration    = trim($_POST['duration']    ?? '');
    $id_category = trim($_POST['id_category'] ?? '');

    // Validation
    if (empty($name))        $erreurs[] = "Le nom est obligatoire.";
    if (empty($description)) $erreurs[] = "La description est obligatoire.";
    if (empty($image))       $erreurs[] = "L'image est obligatoire.";
    if ($rating < 0 || $rating > 5) $erreurs[] = "La note doit être entre 0 et 5.";
    if ($players < 1)        $erreurs[] = "Le nombre de joueurs est obligatoire.";
    if ($duration < 1)       $erreurs[] = "La durée est obligatoire.";

    if (empty($erreurs)) {
        // Insérer le jeu
        $stmt = $pdo->prepare("
            INSERT INTO GAME (name, image, rating, players, duration, description, détails)
            VALUES (:name, :image, :rating, :players, :duration, :description, :details)
        ");
        $stmt->execute([
            'name'        => $name,
            'image'       => $image,
            'rating'      => $rating,
            'players'     => $players,
            'duration'    => $duration,
            'description' => $description,
            'details'     => $details,
        ]);

        $id_game = $pdo->lastInsertId();

        // Associer la catégorie si choisie
        if (!empty($id_category)) {
            $stmt = $pdo->prepare("INSERT INTO ASSO_GAME_CATEGORY (id_game, id_category) VALUES (:id_game, :id_category)");
            $stmt->execute(['id_game' => $id_game, 'id_category' => $id_category]);
        }

        $succes = "Le jeu a été ajouté avec succès !";
    }
}

?>

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
        <textarea name="description" id="description" placeholder="Description courte du jeu..." required><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>

        <label for="details">Détails :</label>
        <textarea name="details" id="details" placeholder="Informations supplémentaires..."><?= htmlspecialchars($_POST['details'] ?? '') ?></textarea>

        <button type="submit">＋ Ajouter le jeu</button>

    </form>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>