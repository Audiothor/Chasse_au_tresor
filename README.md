💍 Chasse au Trésor - 25 Ans de Mariage (v1.1.4)

Une application web interactive, responsive et moderne conçue pour animer une chasse au trésor d'anniversaire de mariage (Noces d'Argent). Elle permet aux invités de participer via leur smartphone en scannant des QR codes physiquement cachés sur le lieu de l'événement et en résolvant des énigmes.

✨ Fonctionnalités Principales

📱 Interface Mobile First & Dynamic Glassmorphism : Optimisée pour smartphones et tablettes avec effets visuels modernes (Tailwind CSS, animations, confetti).

🎫 Pass Joueur à 4 chiffres : Génération unique d'un code joueur sans obligation de créer un compte.

⚡ Synchronisation serveur temps réel (Anti-Cache) : API backend PHP (api.php) avec persistance des données JSON (players_data.json & guestbook_data.json) et contournement strict du cache navigateur (cache: 'no-store').

🔓 Progression sécurisée : Accès direct à l'Étape 1 dès la création du pass. Les étapes 2+ nécessitent la saisie du Code Joueur à 4 chiffres.

🎵 Support des Médias : Énigmes basées sur du texte, des images/photos ou des extraits audio MP3.

👑 Backoffice Administrateur complet (Code PIN par défaut : 2525) :

Suivi en temps réel de la progression des invités.

Suppression de joueurs en 1 clic.

Éditeur d'étapes dynamique (ajout, modification, suppression).

Générateur & outil d'impression grand format des QR codes physiques.

Livre d'or en ligne avec déverrouillage du code du cadenas final.

📂 Structure du Projet

Chasse_au_tresor/
├── index.html                 # Interface principale client & administration (v1.1.4)
├── api.php                    # API Backend (Synchronisation & sauvegarde JSON)
├── players_data.json          # Stockage des joueurs et progressions (généré automatiquement)
├── guestbook_data.json        # Stockage des messages du livre d'or (généré automatiquement)
└── README.md                  # Documentation de l'application


🚀 Guide d'Installation & Déploiement

Prérequis

Un hébergement web supportant PHP 7.4 ou supérieur (ex: DreamHost, OVH, Hostinger, cPanel, etc.).

Connexion HTTPS recommandée pour des raisons d'ergonomie sur mobile.

Étapes d'installation sur le serveur web

Téléversement des fichiers :

Téléversez les fichiers index.html (ou chasse_au_tresor_25_ans.html) et api.php dans le même dossier racine ou sous-dossier de votre serveur web (ex: http://votre-domaine.com/chasse/).

Permissions d'écriture (CHMOD) :

Vérifiez que le dossier contenant les fichiers possède les permissions d'écriture suffisantes (755 ou 777) pour permettre au script api.php de créer et mettre à jour automatiquement les fichiers players_data.json et guestbook_data.json.

Vérification :

Ouvrez votre navigateur à l'adresse du site et cliquez sur le bouton Administration (icône d'engrenage/curseurs en haut à droite). Entrez le PIN 2525. Dans l'onglet Joueurs & Suivi, vérifiez que le badge vert "Serveur Synchro OK" est affiché.

📖 Manuel d'Utilisation

👥 Guide Joueur (Parcours des Invités)

Création du Pass Joueur :

L'invité se rend sur la page d'accueil du site sur son smartphone.

Il entre son prénom (si un prénom identique existe déjà, l'application lui propose d'ajouter son initiale ou nom de famille).

L'application lui génère un Code Joueur unique à 4 chiffres affiché en grand sur fond rouge.

Déroulement du Jeu :

Étape 1 : Accessible automatiquement dès la création du Pass. L'invité répond à la première question. Une fois la bonne réponse trouvée, l'application lui révèle l'indice textuel indiquant l'emplacement physique du QR Code suivant.

Étapes suivantes (Étapes 2+) : L'invité part chercher le QR code dans la salle/le jardin. Lors du scan avec son téléphone, la page s'ouvre sur un portail d'accès lui demandant de saisir son Code Joueur à 4 chiffres. Une fois validé, l'énigme correspondante se déverrouille.

Étape Finale & Trésor :

Arrivé à la dernière étape, l'invité est invité à rédiger un message souvenir dans le Livre d'Or.

Après la validation du mot doux, le code secret du cadenas physique du coffre aux trésors lui est révélé !

⚙️ Guide Administrateur (Backoffice)

Pour accéder au panneau d'administration :

Cliquez sur l'icône de réglages en haut à droite de l'en-tête.

Entrez le code secret PIN (par défaut : 2525).

Onglets du Backoffice :

Joueurs & Suivi : Visualisez en temps réel tous les invités inscrits, leur code à 4 chiffres et leur niveau de progression. Un bouton corbeille permet de supprimer un profil au besoin.

Éditeur d'Étapes : Modifiez le titre, les énigmes, les réponses exactes attendues, les indices d'emplacement et les médias associés (aucune, image ou MP3).

Coffre Final : Configurez le titre de l'étape du trésor et le code du cadenas (ex: 4 - 8 - 2).

Sécurité Admin : Personnalisez le mot de passe PIN du Backoffice.

Tous les QR Codes : Prévisualisez, agrandissez et imprimez directement les fiches QR Codes associées à chaque étape pour les cacher sur le lieu de la fête.

Livre d'Or : Consultez tous les messages laissés par les invités.

🛠️ Dépannage & Conseils pour le Jour J

Impression des QR Codes : Utilisez l'onglet Tous les QR Codes dans le Backoffice. Cliquez sur "Imprimer" sur chaque étape pour générer un document à découper et afficher.

Problème de réseau / Wi-Fi : L'application utilise une stratégie d'anti-cache pour garantir que les données circulent même avec une connexion vacillante. Assurez-vous d'avoir une bonne couverture Wi-Fi ou 4G/5G sur le lieu.

Support Audio : Si vous utilisez un extrait audio MP3 pour l'étape musicale, veillez à ce que le lien du fichier soit en http:// ou https:// direct et accessible publiquement.
