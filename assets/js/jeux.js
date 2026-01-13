/*--------------------------------------------- RÉCUPÉRATION DE L'ID DANS L'URL ---------------------------------------------*/

function getGameIdFromURL() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('id');
}

/*--------------------------------------------- CHARGEMENT DU JEU ---------------------------------------------*/

function loadGameDetails() {
    const gameId = getGameIdFromURL();
    
    console.log('🎮 ID du jeu récupéré:', gameId);
    
    if (!gameId) {
        console.error('❌ Aucun ID de jeu trouvé dans l\'URL');
        return;
    }
    
    // Charger les données depuis le JSON - essayer plusieurs chemins
    const possiblePaths = [
        'data/games.json',
        '../data/games.json',
        './data/games.json',
        'games.json'
    ];
    
    // Essayer de charger depuis le premier chemin
    fetch(possiblePaths[0])
        .then(response => {
            if (!response.ok) {
                throw new Error('Fichier non trouvé au chemin: ' + possiblePaths[0]);
            }
            return response.json();
        })
        .then(data => {
            console.log('📦 Données JSON chargées');
            console.log('Tous les jeux:', data.games);
            
            // Trouver le jeu correspondant à l'ID
            const game = data.games.find(g => g.id == gameId);
            
            if (!game) {
                console.error('❌ Jeu non trouvé pour l\'ID:', gameId);
                console.log('IDs disponibles:', data.games.map(g => g.id));
                return;
            }
            
            console.log('✅ Jeu trouvé:', game);
            displayGameDetails(game);
        })
        .catch(error => {
            console.error('❌ Erreur lors du chargement:', error);
            console.log('Essayez de vérifier :');
            console.log('1. Que le fichier data/games.json existe');
            console.log('2. Que vous avez bien un ID dans l\'URL (ex: Jeux.html?id=1)');
            console.log('3. Que le serveur est lancé correctement');
        });
}

/*--------------------------------------------- AFFICHAGE DES DÉTAILS ---------------------------------------------*/

function displayGameDetails(game) {
    // Afficher le contenu
    document.getElementById('gameDetailsContent').style.display = 'block';
    
    // Remplir les informations
    document.getElementById('gameImage').src = game.image;
    document.getElementById('gameImage').alt = game.name;
    document.getElementById('gameTitle').textContent = game.name;
    document.getElementById('gameRating').textContent = game.rating;
    document.getElementById('gamePlayers').textContent = game.players;
    document.getElementById('gameDuration').textContent = game.duration;
    document.getElementById('gameCategory').textContent = game.category;
    document.getElementById('gameDescription').textContent = game.details;
    
    // Afficher simplement les étoiles
    document.getElementById('gameStars').textContent = '⭐'.repeat(Math.floor(game.rating));
    
    // Changer le titre de la page
    document.title = `${game.name} - HUNGER GAMES`;
}

/*--------------------------------------------- AFFICHAGE ERREUR ---------------------------------------------*/

function showError() {
    document.getElementById('loadingMessage').style.display = 'none';
    document.getElementById('errorMessage').style.display = 'block';
}

/*--------------------------------------------- BOUTON FAVORIS ---------------------------------------------*/

function setupFavoritesButton() {
    const favBtn = document.getElementById('addToFavoritesBtn');
    
    favBtn.addEventListener('click', () => {
        alert('⭐ Fonctionnalité "Favoris" à venir !\n\nPour l\'instant, cette fonctionnalité n\'est pas encore disponible.');
    });
}

/*--------------------------------------------- INITIALISATION ---------------------------------------------*/

document.addEventListener('DOMContentLoaded', () => {
    console.log('🎲 Page détails du jeu chargée');
    console.log('📍 URL actuelle:', window.location.href);
    console.log('🆔 ID dans l\'URL:', getGameIdFromURL());
    
    loadGameDetails();
    setupFavoritesButton();
});