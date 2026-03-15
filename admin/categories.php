<?php
require_once __DIR__ . '/../config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: /HungerGames/admin/login.php');
    exit;
}

include __DIR__ . '/includes/header.php';

$erreurs = [];
$succes  = '';

// Ajouter une catégorie
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
    $name        = trim($_POST['name']        ?? '');
    $description = trim($_POST['description'] ?? '');

    if (empty($name))        $erreurs[] = "Le nom est obligatoire.";
    if (empty($description)) $erreurs[] = "La description est obligatoire.";

    if (empty($erreurs)) {
        $stmt = $pdo->prepare("INSERT INTO CATEGORY (name, description) VALUES (:name, :description)");
        $stmt->execute(['name' => $name, 'description' => $description]);
        $succes = "Catégorie ajoutée avec succès !";
    }
}

// Supprimer une catégorie
if (isset($_GET['supprimer'])) {
    $id = (int)$_GET['supprimer'];

    // Supprimer les associations avant
    $stmt = $pdo->prepare("DELETE FROM ASSO_GAME_CATEGORY WHERE id_category = :id");
    $stmt->execute(['id' => $id]);

    $stmt = $pdo->prepare("DELETE FROM CATEGORY WHERE id_category = :id");
    $stmt->execute(['id' => $id]);

    header('Location: categories.php');
    exit;
}

$categories = $pdo->query("SELECT * FROM CATEGORY ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="categories">

    <a href="/HungerGames/admin/dashboard.php" class="retour">← Retour au dashboard</a>

    <h1>Gestion des <span>catégories</span></h1>

    <!-- Liste des catégories -->
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
            <?php foreach ($categories as $cat): ?>
            <tr>
                <td><?= $cat['id_category'] ?></td>
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

    <!-- Formulaire ajout -->
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
        <textarea name="description" id="description" placeholder="Description de la catégorie..."><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>

        <button type="submit" name="ajouter">➕ Ajouter</button>

    </form>

</div>

<?php include __DIR__ . '/includes/footer.php';?>