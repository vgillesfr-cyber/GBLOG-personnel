# Changelog - Blog Personnel Laravel

Toutes les modifications notables de ce projet sont documentées dans ce fichier.

## [2.0.0] - 2024-01-02 - Blog Personnel

### 🎉 Transformation Majeure
Transformation du blog communautaire en blog personnel avec système de rôles propriétaire/visiteur.

### ✨ Ajouté

#### Système de Rôles
- Nouveau rôle `owner` (propriétaire) - remplace `admin`
- Nouveau rôle `visitor` (visiteur) - remplace `user`
- Un seul propriétaire peut publier des articles
- Les visiteurs peuvent uniquement commenter et liker
- Navigation adaptée selon le rôle

#### Support Multi-Média
- Support des vidéos (MP4, AVI, MOV, WMV - max 50 Mo)
- Support des documents (PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX - max 10 Mo)
- Champ `media_type` pour identifier le type de média
- Lecteur vidéo intégré dans les articles
- Bouton de téléchargement pour les documents

#### Système de Likes
- Table `likes` avec relation many-to-many
- Bouton "J'aime" sur chaque article
- Compteur de likes visible
- Contrainte unique (user_id, post_id)
- Méthodes `isLikedBy()` et `likesCount()` dans le modèle Post
- Route POST `/posts/{post}/like`
- Contrôleur `LikeController` avec méthode `toggle()`

#### Profil Propriétaire
- Champ `bio` (biographie personnelle)
- Champ `avatar` (photo de profil)
- Champs réseaux sociaux : `facebook`, `twitter`, `instagram`, `linkedin`
- Méthode `isOwner()` dans le modèle User

#### Page "À propos" Personnalisée
- Affichage du profil complet du propriétaire
- Avatar avec fallback sur icône
- Biographie
- Liens vers les réseaux sociaux
- Design personnalisé avec le thème orange

#### Documentation
- `GUIDE_COMPLET_BLOG_PERSONNEL.md` - Guide utilisateur complet
- `MISE_A_JOUR_BLOG_PERSONNEL.md` - Instructions de mise à jour
- `RESUME_CHANGEMENTS.md` - Résumé des changements
- `GUIDE_TEST_FONCTIONNALITES.md` - Guide de test
- `DEMARRAGE_RAPIDE_BLOG_PERSONNEL.txt` - Démarrage rapide
- `LISTE_FICHIERS_MODIFIES.md` - Liste des fichiers
- `COMMENCER_ICI.txt` - Point de départ
- `APPLIQUER_MISE_A_JOUR.bat` - Script de mise à jour
- `README.md` - Documentation principale mise à jour
- `CHANGELOG_PROJET.md` - Ce fichier

### 🔄 Modifié

#### Modèles
- `User.php` : Ajout fillable (bio, avatar, réseaux), méthode `isOwner()`, relation `likes()`
- `Post.php` : Ajout fillable (video, document, media_type), relation `likes()`, méthodes `isLikedBy()` et `likesCount()`

#### Contrôleurs
- `PostController.php` : 
  - `create()` vérifie `isOwner()`
  - `store()` gère upload image/video/document
  - `edit()` utilise `isOwner()`
  - `update()` gère upload médias
  - `destroy()` utilise `isOwner()`, supprime tous médias
- `AdminController.php` : Middleware utilise `isOwner()`
- `CommentController.php` : `destroy()` utilise `isOwner()`
- `RegisteredUserController.php` : Rôle par défaut = `visitor`

#### Vues
- `posts/create.blade.php` : Formulaire avec 3 types de médias
- `posts/show.blade.php` : Affichage conditionnel médias, bouton like
- `about.blade.php` : Profil du propriétaire
- `layouts/app.blade.php` : Navigation adaptée aux rôles
- `admin/dashboard.blade.php` : Terminologie mise à jour

#### Routes
- Ajout route : `POST /posts/{post}/like`

#### Seeders
- `AdminSeeder.php` : Crée 1 owner + 2 visitors avec profils

### 🗄️ Base de Données

#### Migrations Ajoutées
1. `2024_01_02_000001_update_users_roles.php` - Change admin→owner, user→visitor
2. `2024_01_02_000002_add_owner_info_to_users.php` - Ajoute bio, avatar, réseaux
3. `2024_01_02_000003_create_likes_table.php` - Crée table likes
4. `2024_01_02_000004_add_media_to_posts.php` - Ajoute video, document, media_type

#### Tables Modifiées
- `users` : +6 colonnes (bio, avatar, facebook, twitter, instagram, linkedin)
- `posts` : +3 colonnes (video, document, media_type)

#### Tables Créées
- `likes` : id, user_id, post_id, timestamps, UNIQUE(user_id, post_id)

### 🔒 Sécurité
- Validation des uploads (type, taille)
- Contrôle d'accès par rôle (isOwner)
- Protection contre les uploads multiples

### 🎨 Interface
- Bouton "Publier" caché pour les visiteurs
- "Admin" renommé en "Gestion"
- Icône changée (shield → cog)
- Bouton "J'aime" avec indicateur visuel
- Affichage adapté selon media_type

### 📊 Statistiques
- 11 fichiers créés
- 13 fichiers modifiés
- 4 migrations ajoutées
- 1 table créée
- 9 colonnes ajoutées

---

## [1.0.0] - 2024-01-01 - Blog Communautaire Initial

### ✨ Ajouté

#### Authentification
- Système d'inscription avec validation
- Connexion sécurisée
- Mot de passe oublié
- Gestion de session

#### Articles
- Création d'articles avec titre et contenu
- Upload d'images (JPG, PNG, GIF - max 2 Mo)
- Modification des articles
- Suppression des articles
- Pagination automatique

#### Commentaires
- Système de commentaires
- Réponses aux commentaires (threading)
- Mention @utilisateur dans les réponses
- Suppression de ses propres commentaires
- Affichage hiérarchique

#### Administration
- Rôle `admin` pour la modération
- Rôle `user` pour les utilisateurs normaux
- Tableau de bord avec statistiques
- Gestion de tous les articles
- Gestion de tous les commentaires
- Suppression de contenus inappropriés

#### Design
- Thème orange avec dégradés
- Interface responsive
- Icônes Font Awesome
- Animations fluides
- Tailwind CSS via CDN

#### Documentation
- `README.md` - Documentation principale
- `DEMARRAGE_RAPIDE.md` - Guide de démarrage
- `BIENVENUE.md` - Message de bienvenue
- `CHECKLIST.md` - Checklist de développement
- Scripts batch pour Windows

### 🗄️ Base de Données

#### Migrations Initiales
- `create_users_table` - Table utilisateurs
- `create_posts_table` - Table articles
- `create_comments_table` - Table commentaires
- `add_role_to_users_table` - Ajout rôle admin/user

#### Seeders
- `AdminSeeder` - Crée admin et user de test

### 🛠️ Technologies
- Laravel 11.x
- MySQL
- Tailwind CSS (CDN)
- Font Awesome 6
- Alpine.js

---

## Légende

- ✨ Ajouté : Nouvelles fonctionnalités
- 🔄 Modifié : Changements dans les fonctionnalités existantes
- 🗑️ Supprimé : Fonctionnalités retirées
- 🐛 Corrigé : Corrections de bugs
- 🔒 Sécurité : Améliorations de sécurité
- 🎨 Interface : Changements visuels
- 🗄️ Base de données : Modifications de la structure
- 📚 Documentation : Ajouts/modifications de documentation
- ⚡ Performance : Améliorations de performance

---

**Format** : [Version] - Date - Titre
**Versioning** : Semantic Versioning (MAJOR.MINOR.PATCH)
