# ✅ Checklist d'Installation - Blog Laravel

## Avant de commencer

- [ ] PHP 8.2+ installé
- [ ] MySQL installé et démarré
- [ ] Composer installé
- [ ] Terminal/Invite de commandes ouvert

## Étape 1 : Base de données

- [ ] Ouvrir phpMyAdmin ou client MySQL
- [ ] Créer la base de données `blog_laravel`
- [ ] Vérifier que la base est créée

```sql
CREATE DATABASE blog_laravel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

## Étape 2 : Configuration

- [ ] Vérifier le fichier `.env`
- [ ] Confirmer les paramètres de base de données :
  - DB_DATABASE=blog_laravel
  - DB_USERNAME=root
  - DB_PASSWORD=(votre mot de passe)

## Étape 3 : Installation

### Windows
- [ ] Double-cliquer sur `setup.bat`
- [ ] Attendre la fin de l'installation
- [ ] Vérifier qu'il n'y a pas d'erreurs

### Linux/Mac
- [ ] Ouvrir le terminal
- [ ] Exécuter : `chmod +x setup.sh`
- [ ] Exécuter : `./setup.sh`
- [ ] Vérifier qu'il n'y a pas d'erreurs

## Étape 4 : Vérification

- [ ] Exécuter : `php artisan serve`
- [ ] Ouvrir le navigateur
- [ ] Aller sur : http://localhost:8000
- [ ] Vérifier que la page d'accueil s'affiche

## Étape 5 : Test des fonctionnalités

### Inscription
- [ ] Cliquer sur "S'inscrire"
- [ ] Remplir le formulaire
- [ ] Vérifier la redirection vers les articles

### Connexion
- [ ] Se déconnecter
- [ ] Se connecter avec : admin@blog.com / password
- [ ] Vérifier l'accès au menu Admin

### Articles
- [ ] Cliquer sur "Publier"
- [ ] Créer un article de test
- [ ] Ajouter une image (optionnel)
- [ ] Publier l'article
- [ ] Vérifier l'affichage de l'article

### Commentaires
- [ ] Ouvrir un article
- [ ] Ajouter un commentaire
- [ ] Cliquer sur "Répondre" à un commentaire
- [ ] Ajouter une réponse
- [ ] Vérifier l'affichage hiérarchique

### Administration
- [ ] Se connecter en tant qu'admin
- [ ] Accéder au tableau de bord admin
- [ ] Vérifier les statistiques
- [ ] Tester la suppression d'un article
- [ ] Tester la suppression d'un commentaire

## Problèmes courants

### Erreur "Base de données introuvable"
- [ ] Vérifier que la base `blog_laravel` existe
- [ ] Vérifier les paramètres dans `.env`

### Erreur "Access denied"
- [ ] Vérifier le nom d'utilisateur MySQL
- [ ] Vérifier le mot de passe MySQL
- [ ] Mettre à jour `.env` si nécessaire

### Erreur "Class not found"
- [ ] Exécuter : `composer dump-autoload`
- [ ] Réessayer

### Les images ne s'affichent pas
- [ ] Exécuter : `php artisan storage:link`
- [ ] Recharger la page

### Erreur de migration
- [ ] Exécuter : `php artisan migrate:fresh --seed`
- [ ] Attention : cela supprime toutes les données !

## Comptes de test

### Administrateur
- Email : admin@blog.com
- Mot de passe : password
- [ ] Connexion testée
- [ ] Accès admin vérifié

### Utilisateur
- Email : user@blog.com
- Mot de passe : password
- [ ] Connexion testée
- [ ] Création d'article testée

## Fonctionnalités à tester

### Authentification
- [ ] Inscription
- [ ] Connexion
- [ ] Déconnexion
- [ ] Mot de passe oublié (optionnel)

### Articles
- [ ] Créer un article
- [ ] Modifier un article
- [ ] Supprimer un article
- [ ] Ajouter une image
- [ ] Pagination

### Commentaires
- [ ] Ajouter un commentaire
- [ ] Répondre à un commentaire
- [ ] Supprimer un commentaire
- [ ] Affichage des réponses

### Administration
- [ ] Tableau de bord
- [ ] Statistiques
- [ ] Gestion des articles
- [ ] Gestion des commentaires
- [ ] Suppression de contenus

### Design
- [ ] Dégradé orange visible
- [ ] Responsive (tester sur mobile)
- [ ] Animations fluides
- [ ] Icônes affichées

## Résultat final

- [ ] Toutes les fonctionnalités testées
- [ ] Aucune erreur
- [ ] Design attrayant
- [ ] Projet prêt à être présenté

## 🎉 Félicitations !

Si toutes les cases sont cochées, votre blog Laravel est opérationnel !

---

**Besoin d'aide ?**
- Consultez `DEMARRAGE_RAPIDE.md`
- Consultez `INSTRUCTIONS.md`
- Consultez `RESUME_PROJET.md`
