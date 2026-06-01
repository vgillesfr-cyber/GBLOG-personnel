# 📚 Guide Complet - Blog Personnel Laravel

## 🎯 Vue d'Ensemble

Ce blog personnel Laravel permet à **un seul propriétaire** de publier du contenu (articles avec images, vidéos ou documents) tandis que les **visiteurs** peuvent commenter et liker les publications.

---

## 👥 Système de Rôles

### 👑 Propriétaire (Owner)
**Il ne peut y avoir qu'UN SEUL propriétaire du blog.**

#### Permissions :
- ✅ Publier des articles (texte + image/vidéo/document)
- ✅ Modifier et supprimer ses articles
- ✅ Répondre aux commentaires
- ✅ Supprimer n'importe quel commentaire
- ✅ Gérer les visiteurs (créer, modifier, supprimer)
- ✅ Accéder au tableau de bord de gestion
- ✅ Personnaliser son profil (bio, avatar, réseaux sociaux)

#### Interface :
```
Navigation : Articles | Publier | À propos | Gestion | [Profil ▼]
```

### 👥 Visiteur (Visitor)
**Tous les utilisateurs qui s'inscrivent deviennent automatiquement visiteurs.**

#### Permissions :
- ✅ Lire tous les articles
- ✅ Commenter les articles
- ✅ Répondre aux commentaires (avec mention @utilisateur)
- ✅ Liker les articles
- ✅ Supprimer ses propres commentaires
- ❌ Ne peut PAS publier d'articles
- ❌ Ne peut PAS accéder à la gestion

#### Interface :
```
Navigation : Articles | À propos | [Profil ▼]
```

---

## 📝 Fonctionnalités Détaillées

### 1. Publication d'Articles (Propriétaire uniquement)

#### Types de Médias Supportés :

**📸 Images**
- Formats : JPG, JPEG, PNG, GIF
- Taille max : 5 Mo
- Affichage : Image pleine largeur en haut de l'article

**🎥 Vidéos**
- Formats : MP4, AVI, MOV, WMV
- Taille max : 50 Mo
- Affichage : Lecteur vidéo intégré avec contrôles

**📄 Documents**
- Formats : PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX
- Taille max : 10 Mo
- Affichage : Bouton de téléchargement avec icône

#### Comment Publier :

1. Cliquez sur **"Publier"** dans la navigation
2. Remplissez le **titre** de l'article
3. Écrivez le **contenu** (texte)
4. Choisissez **UN SEUL** type de média (optionnel) :
   - Soit une image
   - Soit une vidéo
   - Soit un document
5. Cliquez sur **"Publier l'article"**

⚠️ **Important** : Vous ne pouvez ajouter qu'un seul type de média par article.

### 2. Système de Commentaires

#### Commenter un Article :

1. Allez sur un article
2. Scrollez jusqu'à la section "Commentaires"
3. Écrivez votre commentaire dans le champ de texte
4. Cliquez sur **"Commenter"**

#### Répondre à un Commentaire :

1. Cliquez sur **"Répondre"** sous un commentaire
2. Un formulaire apparaît
3. Écrivez votre réponse (l'utilisateur sera automatiquement mentionné avec @)
4. Cliquez sur **"Répondre"**

#### Supprimer un Commentaire :

- **Visiteurs** : Peuvent supprimer uniquement leurs propres commentaires (icône 🗑️)
- **Propriétaire** : Peut supprimer n'importe quel commentaire

### 3. Système de Likes ❤️

#### Liker un Article :

1. Allez sur un article
2. Cliquez sur le bouton **"J'aime"** sous le contenu
3. Le bouton devient orange et affiche **"Aimé"**
4. Le compteur de likes augmente

#### Retirer un Like :

1. Cliquez à nouveau sur le bouton **"Aimé"**
2. Le like est retiré
3. Le compteur diminue

**Règles** :
- Un utilisateur ne peut liker qu'une seule fois par article
- Les likes sont comptabilisés et affichés publiquement
- Seuls les utilisateurs connectés peuvent liker

### 4. Page "À propos"

La page "À propos" affiche automatiquement le profil du propriétaire du blog.

#### Informations Affichées :
- 👤 Avatar (ou icône par défaut)
- 📝 Nom du propriétaire
- 👑 Badge "Propriétaire du blog"
- 📄 Biographie personnelle
- 🔗 Liens vers les réseaux sociaux (Facebook, Twitter, Instagram, LinkedIn)

#### Personnaliser Votre Profil (Propriétaire) :

1. Allez dans **"Gestion"** → **"Gérer les visiteurs"**
2. Trouvez votre compte et cliquez sur **"Modifier"**
3. Ajoutez/modifiez :
   - Votre biographie
   - Votre avatar (image de profil)
   - Vos liens de réseaux sociaux
4. Cliquez sur **"Mettre à jour"**

---

## 🎨 Interface et Design

### Thème Orange
Le blog utilise un dégradé d'orange personnalisé :
- Couleur principale : `#ff6b35` (orange vif)
- Couleur secondaire : `#ffc078` (orange clair)
- Dégradé : Du orange vif au orange clair

### Éléments Visuels :
- 🎨 Fond avec dégradé orange léger
- 📦 Cartes blanches avec ombres pour le contenu
- 🔘 Boutons avec effet de survol (élévation)
- 📱 Design responsive (mobile, tablette, desktop)
- ✨ Animations douces sur les interactions

---

## 🔐 Sécurité et Permissions

### Contrôles d'Accès :

| Action | Visiteur | Propriétaire |
|--------|----------|--------------|
| Voir les articles | ✅ | ✅ |
| Publier un article | ❌ | ✅ |
| Modifier un article | ❌ | ✅ (ses articles) |
| Supprimer un article | ❌ | ✅ (ses articles) |
| Commenter | ✅ | ✅ |
| Liker | ✅ | ✅ |
| Supprimer son commentaire | ✅ | ✅ |
| Supprimer tout commentaire | ❌ | ✅ |
| Gérer les utilisateurs | ❌ | ✅ |
| Accéder à "Gestion" | ❌ | ✅ |

### Validations :

**Articles** :
- Titre : obligatoire, max 255 caractères
- Contenu : obligatoire
- Image : optionnelle, formats image, max 5 Mo
- Vidéo : optionnelle, formats vidéo, max 50 Mo
- Document : optionnel, formats bureautique, max 10 Mo

**Commentaires** :
- Contenu : obligatoire
- Parent_id : optionnel (pour les réponses)

**Utilisateurs** :
- Nom : obligatoire, max 255 caractères
- Email : obligatoire, unique, format email valide
- Mot de passe : obligatoire, min 8 caractères, confirmation requise

---

## 📂 Structure de la Base de Données

### Table `users`
```
- id
- name
- email
- password
- role (owner/visitor)
- bio (texte)
- avatar (chemin fichier)
- facebook (URL)
- twitter (URL)
- instagram (URL)
- linkedin (URL)
- created_at
- updated_at
```

### Table `posts`
```
- id
- user_id (FK → users)
- title
- content (texte long)
- image (chemin fichier)
- video (chemin fichier)
- document (chemin fichier)
- media_type (none/image/video/document)
- created_at
- updated_at
```

### Table `comments`
```
- id
- user_id (FK → users)
- post_id (FK → posts)
- parent_id (FK → comments, nullable)
- content (texte)
- created_at
- updated_at
```

### Table `likes`
```
- id
- user_id (FK → users)
- post_id (FK → posts)
- created_at
- updated_at
- UNIQUE(user_id, post_id) ← Un utilisateur = 1 like par article
```

---

## 🚀 Commandes Utiles

### Démarrer le Serveur
```bash
php artisan serve
```
Accès : http://127.0.0.1:8000

### Migrations
```bash
# Appliquer toutes les migrations
php artisan migrate

# Voir le statut des migrations
php artisan migrate:status

# Réinitialiser et réappliquer (⚠️ SUPPRIME LES DONNÉES)
php artisan migrate:fresh
```

### Seeders
```bash
# Créer les utilisateurs de test
php artisan db:seed --class=AdminSeeder

# Réinitialiser et seeder (⚠️ SUPPRIME LES DONNÉES)
php artisan migrate:fresh --seed
```

### Cache
```bash
# Nettoyer tous les caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Stockage
```bash
# Créer le lien symbolique pour les fichiers uploadés
php artisan storage:link
```

---

## 📁 Organisation des Fichiers Uploadés

Les fichiers sont stockés dans `storage/app/public/` :

```
storage/app/public/
├── posts/
│   ├── images/        ← Images des articles
│   ├── videos/        ← Vidéos des articles
│   └── documents/     ← Documents des articles
└── avatars/           ← Avatars des utilisateurs (à implémenter)
```

**Accès public** : Via le lien symbolique `public/storage/`

---

## 🐛 Dépannage

### Problème : "Class 'Like' not found"
**Solution** : Vérifiez que le fichier `app/Models/Like.php` existe et que le namespace est correct.

### Problème : Les images ne s'affichent pas
**Solution** :
```bash
php artisan storage:link
```

### Problème : "SQLSTATE[42S02]: Base table or view not found"
**Solution** : Appliquez les migrations :
```bash
php artisan migrate
```

### Problème : "Access denied for user"
**Solution** : Vérifiez le fichier `.env` :
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_laravel
DB_USERNAME=root
DB_PASSWORD=
```

### Problème : Erreur 403 "Accès non autorisé"
**Solution** : Vérifiez que vous êtes connecté avec le bon rôle (owner pour publier).

---

## 📊 Statistiques et Gestion

Le propriétaire a accès à un tableau de bord de gestion affichant :

### Statistiques Globales :
- 👥 Nombre total d'utilisateurs
- 📰 Nombre total d'articles
- 💬 Nombre total de commentaires

### Listes Récentes :
- 📝 10 derniers articles publiés
- 💬 10 derniers commentaires postés

### Actions Rapides :
- Supprimer un article
- Supprimer un commentaire
- Gérer les visiteurs

---

## 🎓 Bonnes Pratiques

### Pour le Propriétaire :

1. **Publiez régulièrement** pour garder votre audience engagée
2. **Répondez aux commentaires** pour créer une communauté
3. **Modérez avec bienveillance** les commentaires inappropriés
4. **Optimisez vos médias** avant de les uploader (compression)
5. **Sauvegardez régulièrement** votre base de données

### Pour les Visiteurs :

1. **Commentez de manière constructive**
2. **Respectez les autres utilisateurs**
3. **Utilisez les likes** pour montrer votre appréciation
4. **Signalez** (via commentaire) tout contenu inapproprié

---

## 📞 Support

Pour toute question ou problème :

1. Consultez ce guide complet
2. Vérifiez `MISE_A_JOUR_BLOG_PERSONNEL.md`
3. Consultez les logs Laravel : `storage/logs/laravel.log`

---

**Version** : 2.0 - Blog Personnel avec Système de Rôles
**Date** : Janvier 2024
**Framework** : Laravel 11.x

Bon blogging ! ✍️🚀
