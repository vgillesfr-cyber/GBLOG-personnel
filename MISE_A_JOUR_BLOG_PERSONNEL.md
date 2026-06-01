# 🎉 Mise à jour : Blog Personnel avec Système de Rôles

## 📋 Changements Majeurs

Votre blog a été transformé en **blog personnel** avec un nouveau système de rôles :

### 🎭 Nouveaux Rôles

1. **👑 Propriétaire (Owner)** - 1 seul utilisateur
   - Peut publier des articles (texte, images, vidéos, documents)
   - Peut répondre aux commentaires
   - Peut gérer tous les contenus et utilisateurs
   - Ses informations sont affichées dans la page "À propos"

2. **👥 Visiteur (Visitor)** - Tous les autres utilisateurs
   - Peut commenter les articles
   - Peut liker les publications
   - Ne peut PAS publier d'articles

### ✨ Nouvelles Fonctionnalités

#### 📸 Support Multi-Média
- **Images** : JPG, PNG, GIF (max 5 Mo)
- **Vidéos** : MP4, AVI, MOV, WMV (max 50 Mo)
- **Documents** : PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX (max 10 Mo)

#### ❤️ Système de Likes
- Les visiteurs peuvent liker les articles
- Compteur de likes visible sur chaque article
- Un utilisateur ne peut liker qu'une seule fois par article

#### 👤 Page "À propos" Personnalisée
- Affiche le profil du propriétaire
- Avatar personnalisable
- Biographie
- Liens vers les réseaux sociaux (Facebook, Twitter, Instagram, LinkedIn)

#### 🔒 Permissions Mises à Jour
- Seul le propriétaire peut publier des articles
- Le bouton "Publier" est caché pour les visiteurs
- Section "Gestion" remplace "Admin" (accessible uniquement au propriétaire)

---

## 🚀 Instructions de Mise à Jour

### Étape 1 : Sauvegarder la Base de Données (IMPORTANT !)

Avant toute chose, sauvegardez votre base de données actuelle :

1. Ouvrez **phpMyAdmin** (http://localhost/phpmyadmin)
2. Sélectionnez la base `blog_laravel`
3. Cliquez sur l'onglet **"Exporter"**
4. Cliquez sur **"Exécuter"** pour télécharger la sauvegarde

### Étape 2 : Appliquer les Nouvelles Migrations

Ouvrez un terminal dans le dossier `blog-laravel` et exécutez :

```bash
php artisan migrate
```

Cette commande va :
- ✅ Transformer les rôles `admin` → `owner` et `user` → `visitor`
- ✅ Ajouter les champs de profil (bio, avatar, réseaux sociaux)
- ✅ Créer la table des likes
- ✅ Ajouter les champs média aux articles (video, document, media_type)

### Étape 3 : Créer le Lien de Stockage

Pour que les images, vidéos et documents soient accessibles :

```bash
php artisan storage:link
```

### Étape 4 : Mettre à Jour les Données de Test (Optionnel)

Si vous voulez recréer les utilisateurs de test avec les nouveaux rôles :

```bash
php artisan db:seed --class=AdminSeeder
```

⚠️ **Attention** : Cela créera de nouveaux utilisateurs. Si vous avez déjà des utilisateurs, passez cette étape.

---

## 👤 Comptes de Test

Après avoir exécuté le seeder, vous aurez :

### Propriétaire
- **Email** : owner@blog.com
- **Mot de passe** : password
- **Rôle** : owner (propriétaire)

### Visiteurs
- **Email** : visitor1@blog.com / visitor2@blog.com
- **Mot de passe** : password
- **Rôle** : visitor

---

## 📝 Utilisation du Nouveau Système

### Pour le Propriétaire

1. **Publier un article avec média** :
   - Allez sur "Publier"
   - Remplissez le titre et le contenu
   - Choisissez UN type de média (image, vidéo OU document)
   - Cliquez sur "Publier l'article"

2. **Gérer votre profil** :
   - Allez dans "Gestion" → "Gérer les visiteurs"
   - Modifiez votre profil pour ajouter :
     - Une biographie
     - Un avatar
     - Vos liens de réseaux sociaux

3. **Modérer les contenus** :
   - Section "Gestion" pour voir tous les articles et commentaires
   - Possibilité de supprimer les commentaires inappropriés

### Pour les Visiteurs

1. **S'inscrire** :
   - Cliquez sur "Inscription" dans la navigation
   - Remplissez le formulaire
   - Vous serez automatiquement un visiteur

2. **Interagir avec les articles** :
   - Liker les articles (bouton ❤️)
   - Commenter les articles
   - Répondre aux commentaires

---

## 🎨 Interface Mise à Jour

### Navigation
- **Visiteurs** : Articles | À propos | Profil
- **Propriétaire** : Articles | Publier | À propos | Gestion | Profil

### Page "À propos"
- Affiche maintenant le profil complet du propriétaire
- Avatar, biographie et réseaux sociaux
- Design personnalisé avec le thème orange

### Articles
- Affichage des vidéos avec lecteur intégré
- Téléchargement des documents PDF/Office
- Bouton "J'aime" avec compteur
- Indicateur visuel si vous avez déjà liké

---

## 🔧 Dépannage

### Erreur "Table already exists"
Si vous obtenez cette erreur lors de la migration :
```bash
php artisan migrate:status
```
Vérifiez quelles migrations ont déjà été exécutées.

### Les images ne s'affichent pas
Assurez-vous d'avoir créé le lien symbolique :
```bash
php artisan storage:link
```

### Erreur de permissions
Sur Windows avec XAMPP, assurez-vous que le dossier `storage` est accessible en écriture.

---

## 📂 Fichiers Modifiés

### Nouveaux Fichiers
- `database/migrations/2024_01_02_000001_update_users_roles.php`
- `database/migrations/2024_01_02_000002_add_owner_info_to_users.php`
- `database/migrations/2024_01_02_000003_create_likes_table.php`
- `database/migrations/2024_01_02_000004_add_media_to_posts.php`
- `app/Models/Like.php`
- `app/Http/Controllers/LikeController.php`

### Fichiers Mis à Jour
- `app/Models/User.php` - Ajout méthode `isOwner()` et nouveaux champs
- `app/Models/Post.php` - Support multi-média et likes
- `app/Http/Controllers/PostController.php` - Gestion des médias
- `app/Http/Controllers/AdminController.php` - Utilise `isOwner()`
- `app/Http/Controllers/CommentController.php` - Utilise `isOwner()`
- `app/Http/Controllers/Auth/RegisteredUserController.php` - Rôle par défaut = visitor
- `resources/views/posts/create.blade.php` - Formulaire multi-média
- `resources/views/posts/show.blade.php` - Affichage médias et likes
- `resources/views/about.blade.php` - Profil du propriétaire
- `resources/views/layouts/app.blade.php` - Navigation adaptée aux rôles
- `resources/views/admin/dashboard.blade.php` - Terminologie mise à jour
- `database/seeders/AdminSeeder.php` - Nouveaux rôles
- `routes/web.php` - Route pour les likes

---

## 🎯 Prochaines Étapes

1. ✅ Appliquer les migrations
2. ✅ Créer le lien de stockage
3. ✅ Tester la publication avec différents types de médias
4. ✅ Personnaliser le profil du propriétaire
5. ✅ Tester les likes et commentaires avec un compte visiteur

---

## 💡 Conseils

- **Sauvegardez régulièrement** votre base de données
- **Testez avec plusieurs navigateurs** pour vérifier la compatibilité
- **Optimisez vos images** avant de les uploader (max 5 Mo)
- **Compressez vos vidéos** si elles dépassent 50 Mo

---

Bon développement ! 🚀
