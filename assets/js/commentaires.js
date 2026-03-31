// Générer des étoiles ★ en fonction d'une note
function genererEtoiles(note) {
    let etoiles = '';
    for (let i = 1; i <= 5; i++) {
        etoiles += (i <= note) ? '★' : '☆';
    }
    return etoiles;
}

// Mettre à jour l'affichage de la note moyenne en haut
function mettreAJourNote(nouvelleNote, total) {
    const affichageNote   = document.getElementById('affichageNote');
    const affichageEtoiles = document.getElementById('affichageEtoiles');
    const affichageTotal  = document.getElementById('affichageTotal');

    if (affichageNote)    affichageNote.textContent   = parseFloat(nouvelleNote).toFixed(1);
    if (affichageEtoiles) affichageEtoiles.textContent = genererEtoiles(Math.round(nouvelleNote));
    if (affichageTotal)   affichageTotal.textContent   = total + (total > 1 ? ' avis' : ' avis');
}

// Créer le HTML d'une carte commentaire
function creerCarteCommentaire(c) {
    return `
        <div class="carte-commentaire">
            <div class="commentaire-entete">
                <span class="commentaire-auteur">👤 ${c.auteur}</span>
                <div class="commentaire-meta">
                    <span class="commentaire-etoiles">${genererEtoiles(c.note)}</span>
                    <span class="commentaire-date">${c.date}</span>
                </div>
            </div>
            <p class="commentaire-texte">${c.contenu}</p>
        </div>`;
}

// Charger les commentaires depuis le serveur
function chargerCommentaires() {
    fetch(`obtenir_commentaires.php?id_jeu=${ID_JEU}`)
        .then(reponse => reponse.json())
        .then(data => {
            if (!data.succes) return;

            const liste = document.getElementById('listeCommentaires');

            // Mettre à jour le compteur
            mettreAJourNote(
                document.getElementById('affichageNote').textContent,
                data.total
            );

            // Afficher les commentaires ou un message vide
            if (data.commentaires.length === 0) {
                liste.innerHTML = '<p class="commentaires-vide">Aucun avis pour l\'instant. Soyez le premier ! 🎲</p>';
            } else {
                liste.innerHTML = data.commentaires.map(creerCarteCommentaire).join('');
            }

            // Afficher ou masquer le formulaire selon connexion
            const formulaire = document.getElementById('formulaireCommentaire');
            const messageConnexion = document.getElementById('messageConnexion');
            if (formulaire && messageConnexion) {
                if (data.connecte) {
                    formulaire.style.display = 'block';
                    messageConnexion.style.display = 'none';
                } else {
                    formulaire.style.display = 'none';
                    messageConnexion.style.display = 'block';
                }
            }
        })
        .catch(() => {
            document.getElementById('listeCommentaires').innerHTML =
                '<p class="commentaires-vide">Impossible de charger les avis.</p>';
        });
}

// Envoyer un nouveau commentaire
function envoyerCommentaire() {
    const bouton  = document.getElementById('boutonPublier');
    const contenu = document.getElementById('contenuCommentaire').value.trim();
    const noteEl  = document.querySelector('input[name="note"]:checked');
    const retour  = document.getElementById('retourCommentaire');

    // Masquer le retour précédent
    retour.style.display = 'none';

    // Vérifications côté client
    if (!noteEl) {
        afficherRetour('⭐ Veuillez sélectionner une note.', 'erreur');
        return;
    }

    if (contenu.length < 10) {
        afficherRetour('✏️ Le commentaire doit faire au moins 10 caractères.', 'erreur');
        return;
    }

    // Bloquer le bouton pendant l'envoi
    bouton.disabled = true;
    bouton.textContent = 'Publication en cours...';

    // Préparer les données
    const donnees = new FormData();
    donnees.append('id_jeu',   ID_JEU);
    donnees.append('note',     noteEl.value);
    donnees.append('contenu',  contenu);

    fetch('soumettre_commentaire.php', { method: 'POST', body: donnees })
        .then(reponse => reponse.json())
        .then(data => {
            if (data.succes) {
                // Ajouter le commentaire en haut de la liste sans recharger la page
                const liste = document.getElementById('listeCommentaires');
                const messageVide = liste.querySelector('.commentaires-vide');
                if (messageVide) messageVide.remove();
                liste.insertAdjacentHTML('afterbegin', creerCarteCommentaire(data.commentaire));

                // Mettre à jour la note moyenne
                const totalActuel = parseInt(document.getElementById('affichageTotal').textContent) || 0;
                mettreAJourNote(data.nouvelle_note, totalActuel + 1);

                // Réinitialiser le formulaire
                document.getElementById('contenuCommentaire').value = '';
                document.querySelectorAll('input[name="note"]').forEach(r => r.checked = false);

                afficherRetour('🎉 Votre avis a bien été publié !', 'succes');
            } else {
                afficherRetour('❌ ' + data.erreur, 'erreur');
            }

            // Réactiver le bouton
            bouton.disabled = false;
            bouton.textContent = 'Publier mon avis';
        })
        .catch(() => {
            afficherRetour('❌ Erreur réseau, veuillez réessayer.', 'erreur');
            bouton.disabled = false;
            bouton.textContent = 'Publier mon avis';
        });
}

// Afficher un message de succès ou d'erreur
function afficherRetour(message, type) {
    const el = document.getElementById('retourCommentaire');
    el.className = type === 'succes' ? 'succes' : 'erreur-commentaire';
    el.textContent = message;
    el.style.display = 'block';
}

// Lancer le chargement des commentaires au chargement de la page
document.addEventListener('DOMContentLoaded', chargerCommentaires);