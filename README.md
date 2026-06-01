# 📝 Blog Personnel Laravel

Un blog personnel moderne et professionnel avec système de rôles propriétaire/visiteur, support multi-média et interactions sociales.

## ✨ Fonctionnalités

### 👑 Pour le Propriétaire
- ✅ Publier des articles avec texte, images, vidéos ou documents
- ✅ Modifier et supprimer ses articles
- ✅ Répondre aux commentaires
- ✅ Modérer tous les commentaires
- ✅ Gérer les comptes visiteurs
- ✅ Personnaliser son profil (bio, avatar, réseaux sociaux)
- ✅ Accéder au tableau de bord de gestion

### 👥 Pour les Visiteurs
- ✅ Lire tous les articles
- ✅ Commenter les articles
- ✅ Répondre aux commentaires avec mentions @
- ✅ Liker les articles ❤️
- ✅ Supprimer ses propres commentaires
- ✅ S'inscrire automatiquement

### 🎨 Design
- Thème orange moderne avec dégradés (#ff6b35 → #ffc078)
- Interface responsive (mobile, tablette, desktop)
- Animations fluides et élégantes
- Design épuré et professionnel

## 🚀 Installation Rapide

### Prérequis
- PHP 8.2+
- MySQL
- Composer
- XAMPP (ou équivalent)

### Étapes d'Installation

1. **Installer les dépendances**
   ```bash
   cd blog-laravel
   composer install
   ```

2. **Configurer l'environnement**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Configurer la base de données**
   - Créez une base de données `blog_laravel` dans phpMyAdmin
   - Modifiez le fichier `.env` :
     ```env
     DB_DATABASE=blog_laravel
     DB_USERNAME=root
     DB_PASSWORD=
     ```

4. **Appliquer les migrations**
   
   **Méthode Automatique (Recommandée)** :
   ```bash
   # Double-cliquez sur :
   APPLIQUER_MISE_A_JOUR.bat
   ```
   
   **Méthode Manuelle** :
   ```bash
   php artisan migrate
   php artisan storage:link
   php artisan config:clear
   ```

5. **Créer les utilisateurs de test**
   ```bash
   php artisan db:seed --class=AdminSeeder
   ```

6. **Démarrer le serveur**
   ```bash
   php artisan serve
   ```

7. **Accéder au blog**
   - URL : http://127.0.0.1:8000
   - Propriétaire : `owner@blog.com` / `password`
   - Visiteur : `visitor1@blog.com` / `password`

## 📚 Documentation Complète

| Document | Description |
|----------|-------------|
| **[Guide Complet](GUIDE_COMPLET_BLOG_PERSONNEL.md)** | Documentation utilisateur complète avec toutes les fonctionnalités |
| **[Guide de Mise à Jour](MISE_A_JOUR_BLOG_PERSONNEL.md)** | Instructions de mise à jour et dépannage |
| **[Résumé des Changements](RESUME_CHANGEMENTS.md)** | Liste détaillée des modifications |
| **[Guide de Test](GUIDE_TEST_FONCTIONNALITES.md)** | Tests complets des fonctionnalités |
| **[Démarrage Rapide](DEMARRAGE_RAPIDE_BLOG_PERSONNEL.txt)** | Guide de démarrage en 3 étapes |
| **[Liste des Fichiers](LISTE_FICHIERS_MODIFIES.md)** | Tous les fichiers créés et modifiés |

## 🎯 Système de Rôles

| Rôle | Publier | Commenter | Liker | Gérer | Modérer |
|------|---------|-----------|-------|-------|---------|
| **👑 Propriétaire** | ✅ | ✅ | ✅ | ✅ | ✅ |
| **👥 Visiteur** | ❌ | ✅ | ✅ | ❌ | ❌ |

### Différences Clés
- **Un seul propriétaire** peut publier des articles
- **Les visiteurs** peuvent uniquement interagir (commenter, liker)
- **Navigation adaptée** selon le rôle
- **Inscription automatique** en tant que visiteur

## 📸 Support Multi-Média

| Type | Formats | Taille Max | Affichage |
|------|---------|------------|-----------|
| **Images** | JPG, PNG, GIF | 5 Mo | Pleine largeur en haut |
| **Vidéos** | MP4, AVI, MOV, WMV | 50 Mo | Lecteur intégré |
| **Documents** | PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX | 10 Mo | Bouton téléchargement |

## ❤️ Système de Likes

- Bouton "J'aime" sur chaque article
- Compteur de likes visible
- Un utilisateur = 1 like par article
- Indicateur visuel si déjà liké
- Persistant (sauvegardé en base de données)

## 👤 Profil Propriétaire

Le propriétaire peut personnaliser son profil avec :
- 📝 Biographie personnelle
- 👤 Avatar (photo de profil)
- 🔗 Liens réseaux sociaux :
  - Facebook
  - Twitter
  - Instagram
  - LinkedIn

Ces informations sont affichées sur la **page "À propos"**.

## 🛠️ Technologies

- **Framework** : Laravel 11.x
- **Base de données** : MySQL
- **Frontend** : Tailwind CSS (CDN)
- **Icônes** : Font Awesome 6
- **JavaScript** : Alpine.js
- **Authentification** : Laravel Breeze (personnalisé)

## 📂 Structure du Projet

```
blog-laravel/
├── app/
│   ├── Http/Controllers/
│   │   ├── PostController.php       # Gestion des articles
│   │   ├── CommentController.php    # Gestion des commentaires
│   │   ├── LikeController.php       # Système de likes
│   │   ├── AdminController.php      # Gestion du blog
│   │   └── UserController.php       # Gestion des visiteurs
│   └── Models/
│       ├── User.php                 # Modèle utilisateur (owner/visitor)
│       ├── Post.php                 # Modèle article (multi-média)
│       ├── Comment.php              # Modèle commentaire
│       └── Like.php                 # Modèle like
├── database/
│   ├── migrations/
│   │   ├── 2024_01_02_000001_update_users_roles.php
│   │   ├── 2024_01_02_000002_add_owner_info_to_users.php
│   │   ├── 2024_01_02_000003_create_likes_table.php
│   │   └── 2024_01_02_000004_add_media_to_posts.php
│   └── seeders/
│       └── AdminSeeder.php          # Crée owner + visiteurs
├── resources/views/
│   ├── posts/                       # Vues articles
│   ├── admin/                       # Vues gestion
│   ├── auth/                        # Vues authentification
│   └── layouts/                     # Layout principal
└── routes/
    └── web.php                      # Routes (+ route likes)
```

## 🔧 Commandes Utiles

```bash
# Démarrer le serveur
php artisan serve

# Appliquer les migrations
php artisan migrate

# Créer les utilisateurs de test
php artisan db:seed --class=AdminSeeder

# Nettoyer le cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Créer le lien de stockage (pour les médias)
php artisan storage:link

# Voir le statut des migrations
php artisan migrate:status

# Lister les routes
php artisan route:list
```

## 🐛 Dépannage

### Les images ne s'affichent pas
```bash
php artisan storage:link
```

### Erreur "Table not found"
```bash
php artisan migrate
```

### Erreur "Access denied for user"
Vérifiez le fichier `.env` :
```env
DB_USERNAME=root
DB_PASSWORD=
```

### Erreur 403 "Accès non autorisé"
Connectez-vous avec le compte propriétaire (`owner@blog.com`)

### Le bouton "J'aime" ne fonctionne pas
Vérifiez que la route existe :
```bash
php artisan route:list | grep like
```

### Erreur lors de l'upload de fichiers
Vérifiez `php.ini` :
```ini
upload_max_filesize = 50M
post_max_size = 50M
```

## 📝 Comptes de Test

Après avoir exécuté `php artisan db:seed --class=AdminSeeder` :

### Propriétaire
- **Email** : owner@blog.com
- **Mot de passe** : password
- **Rôle** : owner
- **Permissions** : Toutes

### Visiteurs
- **Email** : visitor1@blog.com / visitor2@blog.com
- **Mot de passe** : password
- **Rôle** : visitor
- **Permissions** : Commenter et liker uniquement

## 🎮 Utilisation

### Pour le Propriétaire

**Publier un article** :
1. Connectez-vous avec `owner@blog.com`
2. Cliquez sur "Publier"
3. Remplissez le titre et le contenu
4. Ajoutez UN média (image, vidéo OU document)
5. Cliquez sur "Publier l'article"

**Personnaliser votre profil** :
1. Allez dans "Gestion" → "Gérer les visiteurs"
2. Modifiez votre compte
3. Ajoutez bio, avatar et réseaux sociaux
4. Sauvegardez

**Modérer** :
1. Accédez à "Gestion"
2. Gérez articles, commentaires et visiteurs
3. Supprimez le contenu inapproprié

### Pour les Visiteurs

**S'inscrire** :
1. Cliquez sur "Inscription"
2. Remplissez le formulaire
3. Vous êtes automatiquement visiteur

**Interagir** :
1. Lisez les articles
2. Cliquez sur ❤️ pour liker
3. Commentez et répondez
4. Mentionnez avec @utilisateur

## 🎨 Personnalisation

### Modifier les Couleurs
Éditez `resources/views/layouts/app.blade.php` :

```css
.gradient-orange {
    background: linear-gradient(135deg, #ff6b35 0%, #ffc078 100%);
}
```

### Ajouter des Fonctionnalités
Le code est modulaire. Vous pouvez ajouter :
- Catégories d'articles
- Système de tags
- Notifications
- Recherche avancée
- Partage sur réseaux sociaux
- Newsletter

## 📊 Base de Données

### Tables Principales

**users** : Utilisateurs (owner/visitor)
- Champs : name, email, password, role, bio, avatar, réseaux sociaux

**posts** : Articles
- Champs : title, content, image, video, document, media_type

**comments** : Commentaires
- Champs : content, parent_id (pour les réponses)

**likes** : Likes
- Champs : user_id, post_id
- Contrainte : UNIQUE(user_id, post_id)

## 🔒 Sécurité

- ✅ Authentification Laravel
- ✅ Protection CSRF
- ✅ Validation des formulaires
- ✅ Contrôle d'accès par rôle
- ✅ Validation des uploads (type, taille)
- ✅ Hachage des mots de passe (bcrypt)
- ✅ Protection contre les injections SQL (Eloquent)

## 🤝 Contribution

Ce projet est un blog personnel éducatif créé pour un cours Laravel.

## 📄 Licence

Ce projet est open source et disponible sous licence MIT.

## 🎓 Crédits

Développé avec Laravel 11.x pour un projet académique.

---

**Version** : 2.0 - Blog Personnel avec Système de Rôles
**Date** : Janvier 2024
**Statut** : ✅ Production Ready

🎉 **Bon blogging !** ✍️🚀
