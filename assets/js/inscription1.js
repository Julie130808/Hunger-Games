/*--------------------------------------------- GESTION DE L'INSCRIPTION ---------------------------------------------*/

document.addEventListener('DOMContentLoaded', () => {

    /*--------------------------------------------- RÉCUPÉRATION DES ÉLÉMENTS DU DOM ---------------------------------------------*/

    const registerBtn = document.getElementById('registerBtn');
    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const termsCheckbox = document.getElementById('terms');

    /*--------------------------------------------- VALIDATION DU FORMULAIRE ---------------------------------------------*/

    function validateForm() {
        const username = usernameInput.value.trim();
        const email = emailInput.value.trim();
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        const termsAccepted = termsCheckbox.checked;

        // Vérification du nom d'utilisateur
        if (username.length < 3) {
            alert('❌ Le nom d\'utilisateur doit contenir au moins 3 caractères');
            usernameInput.focus();
            return false;
        }

        // Vérification du format de l'email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('❌ Veuillez entrer une adresse email valide');
            emailInput.focus();
            return false;
        }

        // Vérification de la longueur du mot de passe
        if (password.length < 6) {
            alert('❌ Le mot de passe doit contenir au moins 6 caractères');
            passwordInput.focus();
            return false;
        }

        // Vérification de la confirmation du mot de passe
        if (password !== confirmPassword) {
            alert('❌ Les mots de passe ne correspondent pas');
            confirmPasswordInput.focus();
            return false;
        }

        // Vérification de l'acceptation des conditions
        if (!termsAccepted) {
            alert('❌ Vous devez accepter les conditions d\'utilisation');
            return false;
        }

        // Si toutes les validations sont correctes
        return true;
    }

    /*--------------------------------------------- TRAITEMENT DE L'INSCRIPTION ---------------------------------------------*/

    function handleRegistration() {
        // Arrêt si le formulaire n'est pas valide
        if (!validateForm()) {
            return;
        }

        const username = usernameInput.value.trim();
        const email = emailInput.value.trim();
        const password = passwordInput.value;

        // Création de l'objet utilisateur
        const user = {
            username: username,
            email: email,
            password: password, // ⚠️ En production, ne jamais stocker un mot de passe en clair
            createdAt: new Date().toISOString(),
            favorites: []
        };

        try {
            // Récupération des utilisateurs existants
            const existingUsers = JSON.parse(
                localStorage.getItem('hungergames_users') || '[]'
            );

            // Vérifier si l'utilisateur existe déjà
            const userExists = existingUsers.some(
                u => u.email === email || u.username === username
            );

            if (userExists) {
                alert('❌ Un compte existe déjà avec cet email ou ce nom d\'utilisateur');
                return;
            }

            // Ajout du nouvel utilisateur
            existingUsers.push(user);
            localStorage.setItem('hungergames_users', JSON.stringify(existingUsers));

            // Connexion automatique de l'utilisateur
            localStorage.setItem(
                'hungergames_current_user',
                JSON.stringify(user)
            );

            // Message de succès
            alert(`✅ Bienvenue dans l'arène, ${username} !\n\nVotre compte a été créé avec succès.`);

            // Redirection vers la page d'accueil
            setTimeout(() => {
                window.location.href = 'accueil.html';
            }, 1000);

        } catch (error) {
            console.error('❌ Erreur lors de l\'inscription :', error);
            alert('❌ Une erreur est survenue lors de l\'inscription. Veuillez réessayer.');
        }
    }

    /*--------------------------------------------- ÉVÉNEMENTS UTILISATEUR ---------------------------------------------*/

    // Clic sur le bouton d'inscription
    registerBtn.addEventListener('click', handleRegistration);

    // Validation avec la touche Entrée
    document.querySelectorAll('.form-input').forEach(input => {
        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                handleRegistration();
            }
        });
    });

    // Animation du bouton au survol
    registerBtn.addEventListener('mouseenter', () => {
        registerBtn.style.transform = 'translateY(-3px)';
    });

    registerBtn.addEventListener('mouseleave', () => {
        registerBtn.style.transform = 'translateY(0)';
    });

    /*--------------------------------------------- INITIALISATION ---------------------------------------------*/

    console.log('🎮 Page d\'inscription HUNGER GAMES chargée');
});
