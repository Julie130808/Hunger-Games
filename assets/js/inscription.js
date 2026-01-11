// Gestion de l'inscription
document.addEventListener('DOMContentLoaded', () => {
    const registerBtn = document.getElementById('registerBtn');
    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const termsCheckbox = document.getElementById('terms');

    // Fonction de validation
    function validateForm() {
        const username = usernameInput.value.trim();
        const email = emailInput.value.trim();
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        const termsAccepted = termsCheckbox.checked;

        // Validation du nom d'utilisateur
        if (username.length < 3) {
            alert('❌ Le nom d\'utilisateur doit contenir au moins 3 caractères');
            usernameInput.focus();
            return false;
        }

        // Validation de l'email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('❌ Veuillez entrer une adresse email valide');
            emailInput.focus();
            return false;
        }

        // Validation du mot de passe
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

        // Vérification des conditions
        if (!termsAccepted) {
            alert('❌ Vous devez accepter les conditions d\'utilisation');
            return false;
        }

        return true;
    }

    // Fonction d'inscription
    function handleRegistration() {
        if (!validateForm()) {
            return;
        }

        const username = usernameInput.value.trim();
        const email = emailInput.value.trim();
        const password = passwordInput.value;

        // Créer l'objet utilisateur
        const user = {
            username: username,
            email: email,
            password: password, // En production, JAMAIS stocker le mot de passe en clair !
            createdAt: new Date().toISOString(),
            favorites: []
        };

        // Sauvegarder dans le localStorage
        try {
            // Vérifier si l'utilisateur existe déjà
            const existingUsers = JSON.parse(localStorage.getItem('hungergames_users') || '[]');
            const userExists = existingUsers.some(u => u.email === email || u.username === username);

            if (userExists) {
                alert('❌ Un compte existe déjà avec cet email ou ce nom d\'utilisateur');
                return;
            }

            // Ajouter le nouvel utilisateur
            existingUsers.push(user);
            localStorage.setItem('hungergames_users', JSON.stringify(existingUsers));

            // Connecter automatiquement l'utilisateur
            localStorage.setItem('hungergames_current_user', JSON.stringify(user));

            // Message de succès
            alert(`✅ Bienvenue dans l'arène, ${username} !\n\nVotre compte a été créé avec succès.`);

            // Redirection vers la page d'accueil
            setTimeout(() => {
                window.location.href = 'accueil.html';
            }, 1000);

        } catch (error) {
            console.error('Erreur lors de l\'inscription:', error);
            alert('❌ Une erreur est survenue lors de l\'inscription. Veuillez réessayer.');
        }
    }

    // Event listener sur le bouton
    registerBtn.addEventListener('click', handleRegistration);

    // Event listener sur la touche Entrée
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

    console.log('🎮 Page d\'inscription HUNGER GAMES chargée');
});