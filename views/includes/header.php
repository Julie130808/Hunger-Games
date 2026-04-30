<?php
$page_actuelle = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Découvrez votre prochain jeu préféré sur HUNGER GAMES">
    <title>HUNGER GAMES - Découvrez votre prochain jeu préféré</title>
    <link rel="stylesheet" href="/HungerGames/assets/css/styles.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
                <h1 class="main-title">HUNGER GAMES</h1>
        </div>
    </header>
    
    <!-- Navigation -->
    <nav class="sub-nav">
        <div class="container">
            <div class="nav-links">
                <a href="/HungerGames/index.php" 
                class="sub-nav-link <?= $page_actuelle === 'index.php' ? 'active' : '' ?>">
                    🏠 Accueil
                </a>
                <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="/HungerGames/controllers/users/inscription.php"
                class="sub-nav-link <?= $page_actuelle === 'inscription.php' ? 'active' : '' ?>">
                    👤 Inscription
                </a>
                <?php endif; ?>
                <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/HungerGames/controllers/users/deconnexion.php"
                class="sub-nav-link <?= $page_actuelle === 'deconnexion.php' ? 'active' : '' ?>">
                🚪 Déconnexion</a>
                <?php else: ?>
                <a href="/HungerGames/controllers/users/connexion.php"
                class="sub-nav-link <?= $page_actuelle === 'connexion.php' ? 'active' : '' ?>">
                🔑 Connexion</a>
                <?php endif; ?>
                <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/HungerGames/controllers/users/favoris.php"
                class="sub-nav-link <?= $page_actuelle === 'favoris.php' ? 'active' : '' ?>">
                    ⭐ Mes Favoris
                </a>
                <?php endif; ?>
            </div>
        </div>                
    </nav>

    <main>