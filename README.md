# GBLOG — Blog personnel de VIGAN Gilles Patrick

Blog personnel développé avec **Laravel 12** et **PHP 8.2**, dans le cadre de mes études à l'**Université d'Abomey-Calavi (EPAC)**.

---

## Fonctionnalités

### Authentification

- Inscription et connexion
- Mot de passe oublié et réinitialisation
- Déconnexion sécurisée
- Sessions persistantes (option « Se souvenir de moi »)

### Système de rôles

| Rôle | Permissions |
|------|-------------|
| **Propriétaire** (`owner`) | Publier, modifier et supprimer des articles, gérer les commentaires et les utilisateurs, accéder à l'administration |
| **Visiteur** (`visitor`) | Lire les articles, commenter, répondre aux commentaires, liker les publications |

### Articles

- Publication réservée au propriétaire
- Titre et contenu texte
- Support **multi-média** :
  - Images (JPG, PNG, GIF — max 5 Mo)
  - Vidéos (MP4, AVI, MOV, WMV — max 50 Mo)
  - Documents (PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX — max 10 Mo)
- Liste paginée des articles
- Page de détail par article
- Modification et suppression (propriétaire ou auteur)

### Commentaires

- Commentaires sur chaque article (utilisateurs connectés)
- Réponses imbriquées avec mention du nom de l'utilisateur ciblé
- Suppression par l'auteur du commentaire ou le propriétaire

### Likes

- Like / unlike sur les articles
- Compteur de likes visible
- Un like maximum par utilisateur et par article

### Page À propos

- Profil du propriétaire (nom, bio, avatar)
- Liens vers les réseaux sociaux (Facebook, Twitter, Instagram, LinkedIn)
- Présentation du blog et de sa mission

### Administration (propriétaire uniquement)

- Tableau de bord avec statistiques (articles, commentaires, utilisateurs)
- Gestion des articles publiés
- Modération des commentaires
- Gestion des utilisateurs (création, modification, suppression)
- Édition du profil propriétaire (bio, avatar, réseaux sociaux)

### Interface

- Design orange moderne avec dégradés
- Interface responsive (mobile, tablette, desktop)
- Icônes Font Awesome 6
- Menus interactifs avec Alpine.js
- Messages de confirmation et d'erreur

---

## Installation locale

### Prérequis

- PHP 8.2+
- Composer
- MySQL (ou SQLite pour les tests)
- Extension PHP ZIP activée

### Étapes

```bash
# Cloner le projet
git clone <url-du-repo>
cd blog-laravel

# Installer les dépendances
composer install

# Configurer l'environnement
cp .env.example .env
php artisan key:generate

# Créer la base de données MySQL
# CREATE DATABASE blog_laravel;

# Configurer DB_* dans .env, puis :
php artisan migrate
php artisan db:seed --class=AdminSeeder
php artisan storage:link

# Lancer le serveur
php artisan serve
```

Ouvrir [http://127.0.0.1:8000](http://127.0.0.1:8000)

### Comptes de test

| Rôle | Email | Mot de passe |
|------|-------|--------------|
| Propriétaire | `ownerblog@gmail.com` | `password` |
| Visiteur 1 | `visitor1@blog.com` | `password` |
| Visiteur 2 | `visitor2@blog.com` | `password` |

---

## Déploiement Railway

1. Pousser le code sur GitHub
2. Créer un projet Railway → **Deploy from GitHub**
3. Ajouter un service **MySQL** (nom du service : `MySQL`)
4. Configurer les variables d'environnement sur le service web :

```env
APP_NAME=GBLOG
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.up.railway.app
APP_KEY=base64:VOTRE_CLE_GENEREE

DB_CONNECTION=mysql
DB_URL=${{MySQL.MYSQL_URL}}

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

ADMIN_EMAIL=ownerblog@gmail.com
ADMIN_PASSWORD=password
ADMIN_NAME=VIGAN Gilles Patrick
```

5. Générer `APP_KEY` en local : `php artisan key:generate --show`

Le compte propriétaire est créé automatiquement au démarrage via `php artisan owner:ensure`.

---

## Commandes Artisan utiles

```bash
php artisan owner:ensure          # Créer/mettre à jour le compte propriétaire
php artisan owner:change-email    # Changer l'email du propriétaire
php artisan migrate               # Appliquer les migrations
php artisan storage:link          # Lien symbolique pour les médias
```

---

## Structure technique

- **Backend** : Laravel 12, PHP 8.2
- **Frontend** : Blade, Tailwind CSS (CDN), Alpine.js
- **Base de données** : MySQL (production) / SQLite (développement)
- **Stockage médias** : `storage/app/public/posts/`
- **Déploiement** : Railway (Dockerfile)

### Modèles principaux

- `User` — utilisateurs (rôles, profil, réseaux sociaux)
- `Post` — articles (texte + médias)
- `Comment` — commentaires (réponses imbriquées)
- `Like` — likes sur les articles

---

## Auteur

**VIGAN Gilles Patrick**  
Étudiant à l'Université d'Abomey-Calavi — EPAC

---

## Licence

Projet académique — MIT
