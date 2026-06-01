# Blog Laravel - Instructions d'installation

## 📋 Fonctionnalités

✅ **Système d'authentification complet**
- Inscription et connexion
- Mot de passe oublié
- Gestion de session

✅ **Gestion des articles**
- Créer, modifier et supprimer des articles
- Ajouter des images aux articles
- Voir tous les articles avec pagination

✅ **Système de commentaires**
- Commenter les articles
- Répondre aux commentaires (tagging)
- Supprimer ses propres commentaires

✅ **Rôles utilisateurs**
- **Utilisateur** : Peut publier des articles et commenter
- **Administrateur** : Peut supprimer n'importe quel article ou commentaire

✅ **Design attrayant**
- Interface moderne avec dégradé orange
- Responsive (mobile, tablette, desktop)
- Animations et effets visuels

## 🚀 Installation

### 1. Configuration de la base de données

Modifiez le fichier `.env` avec vos paramètres de base de données :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_laravel
DB_USERNAME=root
DB_PASSWORD=
```

### 2. Créer la base de données

Créez une base de données MySQL nommée `blog_laravel` :

```sql
CREATE DATABASE blog_laravel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 3. Installer les dépendances

```bash
composer install
npm install
```

### 4. Générer la clé d'application

```bash
php artisan key:generate
```

### 5. Exécuter les migrations

```bash
php artisan migrate
```

### 6. Créer les utilisateurs de test

```bash
php artisan db:seed --class=AdminSeeder
```

Cela créera deux utilisateurs :
- **Administrateur** : admin@blog.com / password
- **Utilisateur** : user@blog.com / password

### 7. Créer le lien symbolique pour les images

```bash
php artisan storage:link
```

### 8. Compiler les assets (optionnel)

```bash
npm run dev
```

### 9. Lancer le serveur

```bash
php artisan serve
```

Le blog sera accessible à l'adresse : http://localhost:8000

## 👤 Comptes de test

### Administrateur
- **Email** : admin@blog.com
- **Mot de passe** : password
- **Permissions** : Peut supprimer tous les articles et commentaires

### Utilisateur
- **Email** : user@blog.com
- **Mot de passe** : password
- **Permissions** : Peut créer des articles et commenter

## 📁 Structure du projet

```
blog-laravel/
├── app/
│   ├── Http/Controllers/
│   │   ├── Auth/                    # Contrôleurs d'authentification
│   │   ├── AdminController.php      # Gestion admin
│   │   ├── CommentController.php    # Gestion des commentaires
│   │   ├── HomeController.php       # Page d'accueil
│   │   └── PostController.php       # Gestion des articles
│   └── Models/
│       ├── Comment.php              # Modèle Commentaire
│       ├── Post.php                 # Modèle Article
│       └── User.php                 # Modèle Utilisateur
├── database/
│   ├── migrations/                  # Migrations de base de données
│   └── seeders/
│       └── AdminSeeder.php          # Création des utilisateurs de test
├── resources/
│   └── views/
│       ├── admin/                   # Vues administration
│       ├── auth/                    # Vues authentification
│       ├── layouts/                 # Layout principal
│       ├── posts/                   # Vues articles
│       ├── about.blade.php          # Page À propos
│       └── home.blade.php           # Page d'accueil
└── routes/
    ├── auth.php                     # Routes d'authentification
    └── web.php                      # Routes principales
```

## 🎨 Personnalisation

### Modifier les couleurs

Les couleurs orange sont définies dans `resources/views/layouts/app.blade.php` :

```css
.gradient-orange {
    background: linear-gradient(135deg, #ff6b35 0%, #ff8c42 25%, #ffa552 50%, #ffb366 75%, #ffc078 100%);
}
```

Vous pouvez modifier ces valeurs pour changer le dégradé.

### Ajouter des fonctionnalités

Le projet est structuré de manière modulaire. Vous pouvez facilement ajouter :
- Des catégories d'articles
- Un système de likes
- Des notifications
- Un système de recherche
- etc.

## 📝 Règles de la communauté

Les administrateurs peuvent supprimer :
- Les articles qui enfreignent les règles
- Les commentaires inappropriés
- Les contenus spam

## 🐛 Dépannage

### Erreur de migration
Si vous avez une erreur lors de la migration, supprimez la base de données et recréez-la :

```bash
php artisan migrate:fresh --seed
```

### Erreur de permissions sur storage
Sur Linux/Mac :

```bash
chmod -R 775 storage bootstrap/cache
```

### Les images ne s'affichent pas
Vérifiez que le lien symbolique est créé :

```bash
php artisan storage:link
```

## 📧 Support

Pour toute question ou problème, contactez : contact@monblog.com

## 🎉 Bon développement !

Profitez de votre nouveau blog Laravel avec un design orange attrayant !
