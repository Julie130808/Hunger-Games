/*--------------------------------------------- DONNÉES ET CONFIGURATION ---------------------------------------------*/

let allGames = []; // Stocke tous les jeux chargés depuis le JSON
let currentGames = []; // Jeux actuellement affichés
let selectedCategory = 'all';

/*--------------------------------------------- CHARGEMENT DES DONNÉES JSON ---------------------------------------------*/

function loadGamesFromJSON() {
    console.log('📦 Chargement des jeux depuis le fichier JSON...');
    
    fetch('data/games.json')
        .then(function(response) {
            console.log('✅ Fichier JSON récupéré');
            return response.json(); // Convertit en objet JavaScript
        })
        .then(function(data) {
            console.log('📊 Données JSON chargées:', data);
            
            allGames = data.games; // Stocke tous les jeux
            currentGames = allGames; // Affiche tous les jeux par défaut
            
            console.log(`✅ ${allGames.length} jeux chargés depuis le JSON`);
            
            // Afficher les jeux
            displayGames('all');
        })
        .catch(function(error) {
            console.error('❌ Erreur lors du chargement du JSON:', error);
            alert('⚠️ Impossible de charger les jeux. Vérifiez que le fichier data/games.json existe.');
        });
}

/*--------------------------------------------- RECHERCHE ---------------------------------------------*/

function searchGames(query) {
    console.log(`🔍 Recherche de: "${query}"`);
    
    // Filtrer les jeux selon la recherche
    const results = allGames.filter(function(game) {
        return game.name.toLowerCase().includes(query.toLowerCase());
    });
    
    if (results.length === 0) {
        alert(`❌ Aucun jeu trouvé pour "${query}"`);
        // Réafficher tous les jeux
        currentGames = allGames;
        displayGames('all');
        return;
    }
    
    // Mettre à jour les jeux affichés
    currentGames = results;
    console.log(`✅ ${results.length} jeux trouvés`);
    
    // Afficher les résultats
    displayGames('all');
    
    // Message de confirmation
    alert(`🎮 ${results.length} jeu(x) trouvé(s) pour "${query}"`);
}

/*--------------------------------------------- AFFICHAGE DES JEUX ---------------------------------------------*/

function createGameCard(game) {
    return `
        <a href="Jeux.html?id=${game.id}" class="game-card-link">
            <div class="game-card">
                <div class="game-image-container">
                    <img src="${game.image}" alt="${game.name}" class="game-image">
                    <div class="game-rating">
                        <span class="star-icon">⭐</span>
                        <span class="rating-value">${game.rating}</span>
                    </div>
                </div>
                <div class="game-content">
                    <h4 class="game-title">${game.name}</h4>
                    <p class="game-description">${game.description}</p>
                    <div class="game-info">
                        <div class="info-item">
                            <span class="info-icon">👥</span>
                            <span>${game.players}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-icon">⏱️</span>
                            <span>${game.duration}</span>
                        </div>
                    </div>
                    <div>
                        <span class="game-category">${game.category}</span>
                    </div>
                </div>
            </div>
        </a>
    `;
}

function displayGames(category = 'all') {
    const gamesGrid = document.getElementById('gamesGrid');
    
    // Filtrer par catégorie
    const filtered = category === 'all' 
        ? currentGames 
        : currentGames.filter(game => game.category === category);
    
    // Afficher les jeux
    if (filtered.length === 0) {
        gamesGrid.innerHTML = '<p style="color: white; text-align: center; grid-column: 1/-1;">Aucun jeu dans cette catégorie.</p>';
    } else {
        gamesGrid.innerHTML = filtered.map(game => createGameCard(game)).join('');
    }
}

/*--------------------------------------------- FILTRES PAR CATEGORIE ---------------------------------------------*/

function setupFilters() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Retirer la classe active
            filterButtons.forEach(btn => btn.classList.remove('filter-btn-active'));
            
            // Ajouter au bouton cliqué
            button.classList.add('filter-btn-active');
            
            // Afficher les jeux filtrés
            const category = button.getAttribute('data-category');
            selectedCategory = category;
            displayGames(category);
        });
    });
}

/*--------------------------------------------- BARRE DE RECHERCHE ---------------------------------------------*/

function setupSearch() {
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.getElementById('searchBtn');
    
    const handleSearch = function() {
        const query = searchInput.value.trim();
        
        // Vérifier si les jeux sont chargés
        if (allGames.length === 0) {
            alert('⚠️ Les jeux ne sont pas encore chargés. Attendez quelques secondes.');
            return;
        }
        
        if (query && query.length >= 3) {
            searchGames(query);
        } else if (query.length > 0 && query.length < 3) {
            alert('⚠️ Entrez au moins 3 caractères pour la recherche');
        } else {
            // Si le champ est vide, réafficher tous les jeux
            currentGames = allGames;
            displayGames('all');
            alert('✅ Tous les jeux sont affichés');
        }
    };
    
    searchBtn.addEventListener('click', handleSearch);
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') handleSearch();
    });
}

/*--------------------------------------------- INITIALISATION ---------------------------------------------*/

document.addEventListener('DOMContentLoaded', function() {
    console.log('🎲 HUNGER GAMES chargé !');
    
    // Charger les jeux depuis le fichier JSON
    loadGamesFromJSON();
    
    // Initialiser les filtres et la recherche
    setupFilters();
    setupSearch();
});