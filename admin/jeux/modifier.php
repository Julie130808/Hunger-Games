<?php
require_once __DIR__ . '/../../config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit;
}

include __DIR__ . '/../includes/header.php';

$id = (int)($_GET['id'] ?? 0);

if ($id === 0) {
    header('Location: liste.php');
    exit;
}

$erreurs = [];
$succes  = '';

// Récupérer le jeu
$stmt = $pdo->prepare("SELECT * FROM GAME WHERE id_game = :id");
$stmt->execute(['id' => $id]);
$jeu = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$jeu) {
    header('Location: liste.php');
    exit;
}

// Récupérer toutes les catégories
$categories = $pdo->query("SELECT id_category, name FROM CATEGORY ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);

// Récupérer la catégorie actuelle du jeu
$stmt = $pdo->prepare("SELECT id_category FROM ASSO_GAME_CATEGORY WHERE id_game = :id");
$stmt->execute(['id' => $id]);
$categorie_actuelle = $stmt->fetchColumn();

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
        // Mettre à jour le jeu
        $stmt = $pdo->prepare("
            UPDATE GAME
            SET name = :name, image = :image, rating = :rating,
                players = :players, duration = :duration,
                description = :description, détails = :details
            WHERE id_game = :id
        ");
        $stmt->execute([
            'name'        => $name,
            'image'       => $image,
            'rating'      => $rating,
            'players'     => $players,
            'duration'    => $duration,
            'description' => $description,
            'details'     => $details,
            'id'          => $id,
        ]);

        // Mettre à jour la catégorie
        $stmt = $pdo->prepare("DELETE FROM ASSO_GAME_CATEGORY WHERE id_game = :id");
        $stmt->execute(['id' => $id]);

        if (!empty($id_category)) {
            $stmt = $pdo->prepare("INSERT INTO ASSO_GAME_CATEGORY (id_game, id_category) VALUES (:id_game, :id_category)");
            $stmt->execute(['id_game' => $id, 'id_category' => $id_category]);
        }

        $succes = "Le jeu a été modifié avec succès !";

        // Recharger le jeu pour afficher les nouvelles valeurs
        $stmt = $pdo->prepare("SELECT * FROM GAME WHERE id_game = :id");
        $stmt->execute(['id' => $id]);
        $jeu = $stmt->fetch(PDO::FETCH_ASSOC);
        $categorie_actuelle = $id_category;
    }
}

?>

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

<?php include __DIR__ . '/../includes/footer.php';?>