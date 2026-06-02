# 🚀 Guide de Déploiement sur Railway

## 📋 Pré-requis

- Compte GitHub
- Compte Railway (gratuit)
- Votre projet poussé sur GitHub

---

## 🎯 Étapes de Déploiement

### 1. Préparer le Projet

#### A. Générer une Clé d'Application

En local, exécutez :

```bash
php artisan key:generate --show
```

Copiez la clé générée (commence par `base64:...`)

#### B. Pousser sur GitHub

```bash
git add .
git commit -m "Préparation pour déploiement Railway"
git push origin main
```

---

### 2. Créer le Projet sur Railway

1. Allez sur [railway.app](https://railway.app)
2. Cliquez sur **"Start a New Project"**
3. Sélectionnez **"Deploy from GitHub repo"**
4. Choisissez votre dépôt `blog-laravel`
5. Railway va détecter automatiquement Laravel

---

### 3. Ajouter une Base de Données MySQL

1. Dans votre projet Railway
2. Cliquez sur **"+ New"**
3. Sélectionnez **"Database"** → **"MySQL"**
4. Railway créera automatiquement les variables :
   - `MYSQLHOST`
   - `MYSQLPORT`
   - `MYSQLDATABASE`
   - `MYSQLUSER`
   - `MYSQLPASSWORD`

---

### 4. Configurer les Variables d'Environnement

#### A. Ouvrir le Raw Editor

1. Cliquez sur votre service Laravel (pas la base de données)
2. Allez dans l'onglet **"Variables"**
3. Cliquez sur **"Raw Editor"** en haut à droite

#### B. Copier les Variables

Ouvrez le fichier **`railway-variables.txt`** et copiez tout son contenu.

Collez-le dans le Raw Editor de Railway.

#### C. Modifier les Variables

Remplacez les valeurs suivantes :

```env
APP_URL=https://VOTRE-DOMAINE.railway.app
APP_KEY=base64:VOTRE_CLE_GENEREE_A_L_ETAPE_1
```

Pour obtenir votre URL Railway :
- Allez dans l'onglet **"Settings"** de votre service
- Section **"Domains"**
- Copiez l'URL générée (ou créez-en une)

#### D. Sauvegarder

Cliquez sur **"Update Variables"**

---

### 5. Déployer

Railway va automatiquement :
1. Détecter les changements
2. Builder l'application
3. Exécuter les migrations (via `nixpacks.toml`)
4. Démarrer le serveur

**Attendez que le build soit terminé** (voyez les logs en temps réel)

---

### 6. Créer le Compte Propriétaire

#### Option A : Via Railway CLI

Si vous avez installé Railway CLI :

```bash
railway login
railway link
railway run php artisan db:seed --class=AdminSeeder
```

#### Option B : Manuellement via l'Application

1. Allez sur votre site : `https://votre-domaine.railway.app`
2. Cliquez sur **"Inscription"**
3. Créez un compte
4. Connectez-vous à votre base de données MySQL Railway
5. Trouvez l'utilisateur dans la table `users`
6. Changez manuellement `role` de `visitor` à `owner`

#### Option C : Via Adminer (Recommandé)

1. Ajoutez un service Adminer sur Railway :
   - Cliquez **"+ New"**
   - **"Template"** → **"Adminer"**
2. Ouvrez Adminer
3. Connectez-vous avec les credentials MySQL Railway
4. Ouvrez la table `users`
5. Modifiez le rôle du premier utilisateur en `owner`

---

### 7. Vérifier le Déploiement

✅ **Checklist :**

- [ ] Le site est accessible
- [ ] La page d'accueil s'affiche
- [ ] L'inscription fonctionne
- [ ] La connexion fonctionne
- [ ] Les articles s'affichent
- [ ] Le compte propriétaire peut accéder à "Gestion"
- [ ] Les images s'uploadent correctement
- [ ] Les commentaires fonctionnent
- [ ] Les likes fonctionnent

---

## 🔧 Commandes Utiles

### Voir les Logs

Dans Railway, cliquez sur l'onglet **"Deployments"** puis **"View Logs"**

### Exécuter des Commandes

Avec Railway CLI :

```bash
# Se connecter
railway login

# Lier le projet
railway link

# Exécuter une migration
railway run php artisan migrate

# Créer le lien de stockage
railway run php artisan storage:link

# Créer le compte propriétaire
railway run php artisan db:seed --class=AdminSeeder

# Nettoyer le cache
railway run php artisan cache:clear
```

---

## 🐛 Dépannage

### Erreur : "No application encryption key"

**Cause :** APP_KEY manquante ou invalide

**Solution :**
1. Générez une clé : `php artisan key:generate --show`
2. Ajoutez-la dans les variables Railway
3. Redéployez

---

### Erreur : "SQLSTATE[HY000] [2002] Connection refused"

**Cause :** Base de données MySQL non connectée

**Solution :**
1. Vérifiez que le service MySQL est actif
2. Vérifiez les variables `${MYSQL*}`
3. Dans Railway, allez dans **"Settings"** → **"Service"** → **"Connect"**

---

### Les Images Ne S'affichent Pas

**Cause :** Lien symbolique storage non créé

**Solution :**

```bash
railway run php artisan storage:link
```

Ou ajoutez dans `nixpacks.toml` (déjà fait) :

```toml
[start]
cmd = "php artisan storage:link && ..."
```

---

### Erreur 500

**Cause :** Erreur application (vérifier les logs)

**Solutions :**
1. Vérifiez les logs : Railway → Deployments → View Logs
2. Activez temporairement le debug :
   ```env
   APP_DEBUG=true
   LOG_LEVEL=debug
   ```
3. Corrigez l'erreur
4. Remettez `APP_DEBUG=false`

---

### Les Migrations Ne S'exécutent Pas

**Solution :**

```bash
railway run php artisan migrate --force
```

---

## 📊 Performance

### Optimiser pour la Production

Ces commandes sont déjà dans `nixpacks.toml` :

```bash
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Activer le Mode Maintenance

```bash
railway run php artisan down
# Faire les modifications
railway run php artisan up
```

---

## 🔒 Sécurité

### Checklist de Sécurité

- [ ] `APP_DEBUG=false` en production
- [ ] `APP_ENV=production`
- [ ] APP_KEY unique et sécurisée
- [ ] `.env` non commité sur GitHub
- [ ] HTTPS activé (automatique sur Railway)
- [ ] Mots de passe forts pour le compte propriétaire

---

## 💰 Coûts Railway

### Plan Gratuit

- **5$ de crédit gratuit par mois**
- Suffisant pour un blog personnel
- Pas de carte de crédit requise

### Si vous Dépassez

- Railway vous alertera
- Vous pouvez upgrade vers le plan Hobby ($5/mois)

---

## 🎉 Félicitations !

Votre blog personnel est maintenant en ligne ! 🚀

**URL :** `https://votre-domaine.railway.app`

**Identifiants :**
- Propriétaire : `owner@blog.com` / `password`
- Visiteurs : Peuvent s'inscrire librement

---

## 📞 Support

- **Documentation Railway :** [docs.railway.app](https://docs.railway.app)
- **Discord Railway :** [discord.gg/railway](https://discord.gg/railway)
- **Documentation Laravel :** [laravel.com/docs](https://laravel.com/docs)

---

**Version :** 2.0 - Blog Personnel
**Date :** Janvier 2024
