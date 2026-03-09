<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'header.php';
?>

<body>
    <div class="dashboard">
        <h1>Tableau de bord</h1>
        <p>Bienvenue, <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong></p>
        <p>Rôle : <strong><?= htmlspecialchars($_SESSION['user_role']) ?></strong></p>
        <p>ID utilisateur : <?= htmlspecialchars($_SESSION['user_id']) ?></p>
        <p><a href="logout.php">Se déconnecter</a></p>
    </div>
</body>

<?php
include 'footer.php';
?>