# Déploiement Railway — Guide rapide (5 minutes)

## 1. Préparer GitHub

```bash
git add .
git commit -m "Fix déploiement Railway"
git push origin main
```

## 2. Créer le projet Railway

1. Allez sur [railway.app](https://railway.app)
2. **New Project** → **Deploy from GitHub repo**
3. Sélectionnez `blog-laravel`

## 3. Ajouter MySQL

1. Dans le projet : **+ New** → **Database** → **MySQL**
2. Cliquez sur le service MySQL → **Settings** → vérifiez que le nom est **`MySQL`** (avec M majuscule)

## 4. Variables d'environnement

1. Cliquez sur le service **Laravel** (pas MySQL)
2. Onglet **Variables** → **Raw Editor**
3. Copiez le contenu de **`railway-variables.txt`**
4. Modifiez :
   - `APP_URL` → votre URL Railway (Settings → Networking → Generate Domain)
   - `APP_KEY` → générez avec `php artisan key:generate --show` en local
5. **Update Variables**

### Syntaxe obligatoire pour la base

```env
DB_CONNECTION=mysql
DB_URL=${{MySQL.MYSQL_URL}}
```

> Si votre service MySQL s'appelle autrement (ex: `mysql`), remplacez : `${{mysql.MYSQL_URL}}`

## 5. Déployer

Railway redéploie automatiquement. Le script `scripts/railway-start.sh` exécute :
- migrations
- création du compte propriétaire (`owner:ensure`)
- lien storage
- démarrage du serveur

## 6. Se connecter

- URL : votre domaine Railway
- Email : `ownerblog@gmail.com`
- Mot de passe : `password`

---

## Dépannage

| Erreur | Solution |
|--------|----------|
| Connection refused / 127.0.0.1 | Vérifiez `DB_URL=${{MySQL.MYSQL_URL}}` et le nom du service MySQL |
| No application encryption key | Ajoutez `APP_KEY` (base64:...) |
| Formulaires HTTP au lieu HTTPS | Redéployez (trust proxies + forceScheme déjà configurés) |
| Erreur 500 | Mettez `APP_DEBUG=true` temporairement, consultez les logs Railway |
| Build OK mais crash au start | Onglet Deployments → View Logs, cherchez l'erreur de migration |

## Logs

Railway → service Laravel → **Deployments** → **View Logs**

Ou avec Railway CLI :
```bash
railway login
railway link
railway logs
```
