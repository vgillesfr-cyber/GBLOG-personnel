# 🚀 Configuration Railway - Étape par Étape

## 1️⃣ Variables d'Environnement

Dans Railway → Variables → Raw Editor, copiez TOUT ceci :

```env
APP_NAME=Mon Blog Personnel
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.railway.app
APP_KEY=VOTRE_CLE_GENEREE

DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}

SESSION_DRIVER=database
CACHE_DRIVER=database
QUEUE_CONNECTION=database
LOG_CHANNEL=stack
LOG_LEVEL=error
FILESYSTEM_DISK=public

ADMIN_EMAIL=ownerblog@gmail.com
ADMIN_PASSWORD=password
ADMIN_NAME=Gilles
```

**Remplacez** :
- `APP_URL` par votre vraie URL Railway
- `APP_KEY` par votre clé générée (voir ci-dessous)

---

## 2️⃣ Générer APP_KEY

En local, exécutez :

```bash
php artisan key:generate --show
```

Copiez le résultat et mettez-le dans `APP_KEY`.

---

## 3️⃣ Pousser sur GitHub

```bash
git add .
git commit -m "Configuration Railway complète"
git push origin main
```

Railway va redéployer automatiquement.

---

## 4️⃣ Créer le Compte Propriétaire

**Une fois le déploiement terminé**, exécutez UNE SEULE FOIS :

### Option A : Avec Railway CLI (Recommandé)

```bash
railway login
railway link
railway run php artisan db:seed --class=AdminSeeder --force
```

### Option B : Sans Railway CLI

1. Ajoutez Adminer sur Railway :
   - Railway → + New → Template → Adminer

2. Ouvrez Adminer et connectez-vous avec MySQL Railway

3. Supprimez l'utilisateur owner existant (si il y en a un)

4. Via Railway, exécutez dans les logs ou redéployez avec `migrate:fresh --seed`

---

## 5️⃣ Vérifier

1. Allez sur votre URL Railway
2. Connexion avec :
   - Email : `ownerblog@gmail.com`
   - Password : `password`
3. ✅ Ça devrait fonctionner !

---

## 🔧 Si l'Email N'existe Pas Encore

Exécutez cette commande UNE SEULE FOIS :

```bash
railway run php artisan tinker
```

Dans tinker :
```php
\App\Models\User::create([
    'name' => 'Gilles',
    'email' => 'ownerblog@gmail.com',
    'password' => bcrypt('password'),
    'role' => 'owner',
    'bio' => 'Bienvenue sur mon blog personnel !'
]);
exit
```

---

## ⚠️ IMPORTANT

Après avoir créé le compte la première fois, **changez le mot de passe** :

```bash
railway run php artisan tinker
```

```php
$owner = \App\Models\User::where('email', 'ownerblog@gmail.com')->first();
$owner->password = bcrypt('VotreNouveauMotDePasseSecurise123!');
$owner->save();
exit
```
