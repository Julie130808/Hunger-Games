<?php
$page_actuelle = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <a href="/HungerGames/utilisateurs/inscription.php" 
                class="sub-nav-link <?= $page_actuelle === 'inscription.php' ? 'active' : '' ?>">
                    👤 Inscription
                <?php endif; ?>
                </a>
                <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/HungerGames/utilisateurs/deconnexion.php" 
                class="sub-nav-link <?= $page_actuelle === 'deconnexion.php' ? 'active' : '' ?>">
                🚪 Déconnexion</a>
                <?php else: ?>
                <a href="/HungerGames/utilisateurs/connexion.php" 
                class="sub-nav-link <?= $page_actuelle === 'connexion.php' ? 'active' : '' ?>">
                🔑 Connexion</a>
                <?php endif; ?>
                </a>
                <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/HungerGames/utilisateurs/favoris.php" 
                class="sub-nav-link <?= $page_actuelle === 'favoris.php' ? 'active' : '' ?>">
                    ⭐ Mes Favoris
                <?php endif; ?>
                </a>
            </div>
        </div>                
    </nav>

    <main>