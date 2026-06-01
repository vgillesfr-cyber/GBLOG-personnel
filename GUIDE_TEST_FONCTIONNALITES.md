# 🧪 Guide de Test des Fonctionnalités

Ce guide vous permet de tester toutes les nouvelles fonctionnalités du blog personnel.

---

## 🚀 Préparation

### 1. Appliquer les Migrations
```bash
php artisan migrate
php artisan storage:link
```

### 2. Créer les Utilisateurs de Test
```bash
php artisan db:seed --class=AdminSeeder
```

### 3. Démarrer le Serveur
```bash
php artisan serve
```

Accès : http://127.0.0.1:8000

---

## ✅ Tests à Effectuer

### TEST 1 : Système de Rôles 👑👥

#### A. Tester le Propriétaire

1. **Connexion**
   - [ ] Allez sur http://127.0.0.1:8000
   - [ ] Cliquez sur "Connexion"
   - [ ] Email : `owner@blog.com`
   - [ ] Mot de passe : `password`
   - [ ] Cliquez sur "Se connecter"

2. **Vérifier la Navigation**
   - [ ] Vous devez voir : Articles | **Publier** | À propos | **Gestion** | Profil
   - [ ] Le bouton "Publier" est visible ✅
   - [ ] Le bouton "Gestion" est visible ✅

3. **Accéder à la Gestion**
   - [ ] Cliquez sur "Gestion"
   - [ ] Vous devez voir le tableau de bord avec statistiques
   - [ ] Vous devez voir 3 cartes : Gérer les articles, commentaires, visiteurs

#### B. Tester un Visiteur

1. **Déconnexion**
   - [ ] Cliquez sur votre nom (en haut à droite)
   - [ ] Cliquez sur "Déconnexion"

2. **Connexion Visiteur**
   - [ ] Cliquez sur "Connexion"
   - [ ] Email : `visitor1@blog.com`
   - [ ] Mot de passe : `password`
   - [ ] Cliquez sur "Se connecter"

3. **Vérifier la Navigation**
   - [ ] Vous devez voir : Articles | À propos | Profil
   - [ ] Le bouton "Publier" est **CACHÉ** ❌
   - [ ] Le bouton "Gestion" est **CACHÉ** ❌

4. **Tenter d'Accéder à la Publication**
   - [ ] Allez sur http://127.0.0.1:8000/posts/create
   - [ ] Vous devez voir une erreur 403 "Accès non autorisé"

**✅ TEST 1 RÉUSSI** si :
- Le propriétaire voit "Publier" et "Gestion"
- Le visiteur ne voit ni "Publier" ni "Gestion"
- Le visiteur ne peut pas accéder à /posts/create

---

### TEST 2 : Publication avec Images 📸

1. **Connexion Propriétaire**
   - [ ] Connectez-vous avec `owner@blog.com` / `password`

2. **Créer un Article avec Image**
   - [ ] Cliquez sur "Publier"
   - [ ] Titre : `Mon premier article avec image`
   - [ ] Contenu : `Ceci est un test d'article avec une image.`
   - [ ] Cliquez sur "Choisir un fichier" dans la section **Image**
   - [ ] Sélectionnez une image JPG/PNG (max 5 Mo)
   - [ ] Cliquez sur "Publier l'article"

3. **Vérifier l'Affichage**
   - [ ] Vous êtes redirigé vers la liste des articles
   - [ ] Cliquez sur votre article
   - [ ] L'image s'affiche en haut de l'article (pleine largeur)

**✅ TEST 2 RÉUSSI** si :
- L'article est créé avec succès
- L'image s'affiche correctement
- Message de succès "Article publié avec succès !"

---

### TEST 3 : Publication avec Vidéo 🎥

1. **Créer un Article avec Vidéo**
   - [ ] Cliquez sur "Publier"
   - [ ] Titre : `Article avec vidéo`
   - [ ] Contenu : `Test de publication de vidéo.`
   - [ ] Cliquez sur "Choisir un fichier" dans la section **Vidéo**
   - [ ] Sélectionnez une vidéo MP4 (max 50 Mo)
   - [ ] Cliquez sur "Publier l'article"

2. **Vérifier l'Affichage**
   - [ ] Cliquez sur l'article
   - [ ] Un lecteur vidéo s'affiche en haut
   - [ ] Vous pouvez lire la vidéo avec les contrôles (play, pause, volume)

**✅ TEST 3 RÉUSSI** si :
- La vidéo est uploadée avec succès
- Le lecteur vidéo fonctionne
- Les contrôles sont visibles

---

### TEST 4 : Publication avec Document 📄

1. **Créer un Article avec Document**
   - [ ] Cliquez sur "Publier"
   - [ ] Titre : `Article avec document PDF`
   - [ ] Contenu : `Téléchargez le document ci-joint.`
   - [ ] Cliquez sur "Choisir un fichier" dans la section **Document**
   - [ ] Sélectionnez un fichier PDF/DOC (max 10 Mo)
   - [ ] Cliquez sur "Publier l'article"

2. **Vérifier l'Affichage**
   - [ ] Cliquez sur l'article
   - [ ] Une zone orange s'affiche avec une icône de document
   - [ ] Un bouton "Télécharger le document" est visible
   - [ ] Cliquez sur le bouton
   - [ ] Le document se télécharge ou s'ouvre dans un nouvel onglet

**✅ TEST 4 RÉUSSI** si :
- Le document est uploadé avec succès
- Le bouton de téléchargement fonctionne
- Le fichier se télécharge correctement

---

### TEST 5 : Système de Likes ❤️

#### A. Liker un Article

1. **Connexion Visiteur**
   - [ ] Déconnectez-vous
   - [ ] Connectez-vous avec `visitor1@blog.com` / `password`

2. **Liker un Article**
   - [ ] Allez sur "Articles"
   - [ ] Cliquez sur un article
   - [ ] Scrollez jusqu'au bouton "J'aime" (sous le contenu)
   - [ ] Vérifiez que le bouton est gris avec "J'aime"
   - [ ] Vérifiez que le compteur affiche "0"
   - [ ] Cliquez sur le bouton "J'aime"

3. **Vérifier le Like**
   - [ ] Le bouton devient orange
   - [ ] Le texte change en "Aimé"
   - [ ] Le compteur affiche "1"
   - [ ] Rafraîchissez la page (F5)
   - [ ] Le like est toujours là (persistant)

#### B. Retirer un Like

1. **Unliker**
   - [ ] Cliquez à nouveau sur le bouton "Aimé"
   - [ ] Le bouton redevient gris
   - [ ] Le texte change en "J'aime"
   - [ ] Le compteur affiche "0"

#### C. Plusieurs Utilisateurs

1. **Deuxième Visiteur**
   - [ ] Déconnectez-vous
   - [ ] Connectez-vous avec `visitor2@blog.com` / `password`
   - [ ] Allez sur le même article
   - [ ] Cliquez sur "J'aime"
   - [ ] Le compteur affiche "1" (votre like)

2. **Propriétaire Like**
   - [ ] Déconnectez-vous
   - [ ] Connectez-vous avec `owner@blog.com` / `password`
   - [ ] Allez sur le même article
   - [ ] Cliquez sur "J'aime"
   - [ ] Le compteur affiche "2" (visitor2 + owner)

**✅ TEST 5 RÉUSSI** si :
- Le like/unlike fonctionne
- Le compteur est correct
- Les likes sont persistants
- Plusieurs utilisateurs peuvent liker

---

### TEST 6 : Commentaires et Réponses 💬

#### A. Commenter

1. **Connexion Visiteur**
   - [ ] Connectez-vous avec `visitor1@blog.com` / `password`

2. **Ajouter un Commentaire**
   - [ ] Allez sur un article
   - [ ] Scrollez jusqu'à la section "Commentaires"
   - [ ] Écrivez : `Super article ! Merci pour le partage.`
   - [ ] Cliquez sur "Commenter"
   - [ ] Le commentaire s'affiche immédiatement

#### B. Répondre à un Commentaire

1. **Connexion Propriétaire**
   - [ ] Déconnectez-vous
   - [ ] Connectez-vous avec `owner@blog.com` / `password`
   - [ ] Allez sur le même article

2. **Répondre**
   - [ ] Cliquez sur "Répondre" sous le commentaire du visiteur
   - [ ] Un formulaire apparaît
   - [ ] Écrivez : `Merci pour ton commentaire !`
   - [ ] Cliquez sur "Répondre"
   - [ ] La réponse s'affiche en dessous avec un fond orange clair
   - [ ] La mention `@Visiteur Test 1` est visible

#### C. Supprimer un Commentaire

1. **Supprimer son Propre Commentaire (Visiteur)**
   - [ ] Connectez-vous avec `visitor1@blog.com` / `password`
   - [ ] Allez sur l'article
   - [ ] Cliquez sur l'icône 🗑️ à côté de votre commentaire
   - [ ] Confirmez la suppression
   - [ ] Le commentaire disparaît

2. **Supprimer N'importe Quel Commentaire (Propriétaire)**
   - [ ] Connectez-vous avec `owner@blog.com` / `password`
   - [ ] Ajoutez un commentaire en tant que visiteur2
   - [ ] Connectez-vous avec `owner@blog.com` / `password`
   - [ ] Vous devez voir l'icône 🗑️ sur TOUS les commentaires
   - [ ] Supprimez un commentaire d'un visiteur
   - [ ] Ça fonctionne ✅

**✅ TEST 6 RÉUSSI** si :
- Les commentaires s'ajoutent correctement
- Les réponses fonctionnent avec mention @
- Les visiteurs peuvent supprimer leurs commentaires
- Le propriétaire peut supprimer tous les commentaires

---

### TEST 7 : Page "À propos" 📄

1. **Personnaliser le Profil Propriétaire**
   - [ ] Connectez-vous avec `owner@blog.com` / `password`
   - [ ] Allez dans "Gestion" → "Gérer les visiteurs"
   - [ ] Trouvez votre compte (owner@blog.com)
   - [ ] Cliquez sur "Modifier"
   - [ ] Modifiez la bio : `Développeur passionné par Laravel et le web.`
   - [ ] Ajoutez des liens réseaux sociaux :
     - Facebook : `https://facebook.com/monprofil`
     - Twitter : `https://twitter.com/monprofil`
   - [ ] Cliquez sur "Mettre à jour"

2. **Vérifier la Page "À propos"**
   - [ ] Cliquez sur "À propos" dans la navigation
   - [ ] Vous devez voir :
     - [ ] Votre nom
     - [ ] Badge "Propriétaire du blog"
     - [ ] Votre biographie
     - [ ] Icônes Facebook et Twitter (cliquables)
   - [ ] Cliquez sur une icône de réseau social
   - [ ] Le lien s'ouvre dans un nouvel onglet

**✅ TEST 7 RÉUSSI** si :
- Le profil se met à jour
- La page "À propos" affiche les informations
- Les liens de réseaux sociaux fonctionnent

---

### TEST 8 : Inscription Automatique en Visiteur 👥

1. **Déconnexion**
   - [ ] Déconnectez-vous

2. **Créer un Nouveau Compte**
   - [ ] Cliquez sur "Inscription"
   - [ ] Nom : `Nouveau Visiteur`
   - [ ] Email : `nouveau@test.com`
   - [ ] Mot de passe : `password`
   - [ ] Confirmation : `password`
   - [ ] Cliquez sur "S'inscrire"

3. **Vérifier le Rôle**
   - [ ] Vous êtes automatiquement connecté
   - [ ] Vous devez voir : Articles | À propos | Profil
   - [ ] Le bouton "Publier" est **CACHÉ** ❌
   - [ ] Le bouton "Gestion" est **CACHÉ** ❌

4. **Tenter de Publier**
   - [ ] Allez sur http://127.0.0.1:8000/posts/create
   - [ ] Vous devez voir une erreur 403

**✅ TEST 8 RÉUSSI** si :
- Le nouveau compte est créé
- Le rôle est automatiquement "visitor"
- Le visiteur ne peut pas publier

---

### TEST 9 : Gestion des Visiteurs (Propriétaire) 👨‍💼

1. **Connexion Propriétaire**
   - [ ] Connectez-vous avec `owner@blog.com` / `password`

2. **Accéder à la Gestion**
   - [ ] Cliquez sur "Gestion"
   - [ ] Cliquez sur "Gérer les visiteurs"

3. **Voir la Liste**
   - [ ] Vous devez voir tous les utilisateurs
   - [ ] Colonnes : Nom, Email, Rôle, Actions

4. **Créer un Visiteur**
   - [ ] Cliquez sur "Créer un utilisateur"
   - [ ] Nom : `Test Visiteur`
   - [ ] Email : `test@visiteur.com`
   - [ ] Mot de passe : `password`
   - [ ] Rôle : Sélectionnez "visitor"
   - [ ] Cliquez sur "Créer"
   - [ ] Le visiteur apparaît dans la liste

5. **Modifier un Visiteur**
   - [ ] Cliquez sur "Modifier" à côté d'un visiteur
   - [ ] Changez le nom
   - [ ] Cliquez sur "Mettre à jour"
   - [ ] Le nom est mis à jour

6. **Supprimer un Visiteur**
   - [ ] Cliquez sur "Supprimer" à côté d'un visiteur
   - [ ] Confirmez la suppression
   - [ ] Le visiteur disparaît de la liste

**✅ TEST 9 RÉUSSI** si :
- La liste des utilisateurs s'affiche
- Création, modification et suppression fonctionnent
- Seul le propriétaire peut accéder à cette section

---

### TEST 10 : Responsive Design 📱

1. **Mode Desktop**
   - [ ] Ouvrez le blog en plein écran
   - [ ] Vérifiez que tout s'affiche correctement

2. **Mode Tablette**
   - [ ] Appuyez sur F12 (outils développeur)
   - [ ] Cliquez sur l'icône de responsive design
   - [ ] Sélectionnez "iPad"
   - [ ] Vérifiez que la navigation s'adapte
   - [ ] Vérifiez que les articles s'affichent bien

3. **Mode Mobile**
   - [ ] Sélectionnez "iPhone"
   - [ ] Vérifiez que le menu est accessible
   - [ ] Vérifiez que les boutons sont cliquables
   - [ ] Vérifiez que les images s'adaptent

**✅ TEST 10 RÉUSSI** si :
- Le design s'adapte à toutes les tailles d'écran
- Tous les éléments sont accessibles sur mobile

---

## 📊 Récapitulatif des Tests

| Test | Fonctionnalité | Statut |
|------|----------------|--------|
| 1 | Système de rôles | ⬜ |
| 2 | Publication avec image | ⬜ |
| 3 | Publication avec vidéo | ⬜ |
| 4 | Publication avec document | ⬜ |
| 5 | Système de likes | ⬜ |
| 6 | Commentaires et réponses | ⬜ |
| 7 | Page "À propos" | ⬜ |
| 8 | Inscription automatique | ⬜ |
| 9 | Gestion des visiteurs | ⬜ |
| 10 | Responsive design | ⬜ |

---

## 🐛 Problèmes Courants

### Erreur "SQLSTATE[42S02]: Base table or view not found"
**Solution** : Exécutez `php artisan migrate`

### Les images ne s'affichent pas
**Solution** : Exécutez `php artisan storage:link`

### Erreur 403 "Accès non autorisé"
**Solution** : Vérifiez que vous êtes connecté avec le bon rôle

### Le bouton "J'aime" ne fonctionne pas
**Solution** : Vérifiez que la route `/posts/{post}/like` existe avec `php artisan route:list`

---

## ✅ Validation Finale

Si tous les tests sont réussis (✅), votre blog personnel est **100% fonctionnel** ! 🎉

Vous pouvez maintenant :
- Publier vos premiers articles
- Inviter des visiteurs à s'inscrire
- Personnaliser votre profil
- Modérer les commentaires

**Bon blogging ! ✍️🚀**
