<?php
include 'include/header.php';
?>
        <!-- First Section -->
        <section class="first-section">
        <div class="container">
            <div class="first-section-text">
                <h2 class="first-section-title">Puisse le sort vous être favorable !</h2>
                <p class="first-section-subtitle">
                    Plongez dans l'univers sombre et captivant des jeux de société. Seuls les plus stratèges survivront.
                </p>
            </div>

            <!-- Barre de recherche -->
            <div class="search-container">
                <div class="search-box">
                    <input
                        type="text"
                        id="searchInput"
                        placeholder="🔍 Rechercher un jeu de société..."
                        class="search-input"
                    />
                    <button id="searchBtn" class="search-button">
                        Rechercher
                    </button>
                </div>
            </div>
        </div>
        </section>

        <!-- Filtres par catégorie -->
        <section class="filters-section">
            <div class="container">
                <div class="filters-container">
                    <button class="filter-btn filter-btn-active" data-category="all">Tous</button>
                    <button class="filter-btn" data-category="Stratégie">Stratégie</button>
                    <button class="filter-btn" data-category="Ambiance">Ambiance</button>
                    <button class="filter-btn" data-category="JDR">JDR</button>
                    <button class="filter-btn" data-category="Famille">Famille</button>
                    <button class="filter-btn" data-category="Initiés">Initiés</button>
                    <button class="filter-btn" data-category="Expert">Expert</button>
                </div>
            </div>
        </section>

        <!-- Jeux populaires -->
        <section class="games-section">
            <div class="container">
                <h3 class="section-title">Jeux populaires</h3>
                <div id="gamesGrid" class="games-grid">
                    <!-- Les jeux seront injectés par JavaScript -->
                </div>
            </div>
        </section>
    
<?php
include 'include/footer.php';
?>