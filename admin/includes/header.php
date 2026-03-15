<?php 
$page_actuelle = basename($_SERVER['PHP_SELF']); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HUNGER GAMES - Administration</title>
    <link rel="stylesheet" href="/HungerGames/assets/css/styles.css">
    <link rel="stylesheet" href="/HungerGames/assets/css/admin.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <h1 class="main-title">HUNGER GAMES</h1>
            </div>
        </div>
    </header>

    <!-- Navigation admin -->
    <nav class="sub-nav">
        <div class="container">
            <div class="nav-links">
               <a href="/HungerGames/admin/dashboard.php" 
                class="sub-nav-link <?= $page_actuelle === 'dashboard.php' ? 'active' : '' ?>">📊 Dashboard</a>

                <a href="/HungerGames/admin/jeux/liste.php" 
                class="sub-nav-link <?= $page_actuelle === 'liste.php' ? 'active' : '' ?>">🎲 Jeux</a>

                <a href="/HungerGames/admin/jeux/ajouter.php" 
                class="sub-nav-link <?= $page_actuelle === 'ajouter.php' ? 'active' : '' ?>">➕ Ajouter un jeu</a>

                <a href="/HungerGames/admin/categories.php" 
                class="sub-nav-link <?= $page_actuelle === 'categories.php' ? 'active' : '' ?>">🏷️ Catégories</a>

                <a href="/HungerGames/admin/utilisateurs/utilisateurs.php" 
                class="sub-nav-link <?= $page_actuelle === 'utilisateurs.php' ? 'active' : '' ?>">👥 Utilisateurs</a>

                <a href="/HungerGames/admin/logout.php" 
                class="sub-nav-link">🚪 Déconnexion</a>
            </div>
        </div>
    </nav>

    <main>