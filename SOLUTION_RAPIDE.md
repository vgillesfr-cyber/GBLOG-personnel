# ⚡ Solution Rapide - Lancer le Blog

## Problème Actuel
L'installation de Composer est en cours mais très lente car l'extension ZIP de PHP n'est pas activée.

## Solution 1 : Activer ZIP (RECOMMANDÉ - 2 minutes)

### Étapes :
1. Ouvrez `C:\xampp\php\php.ini` avec Notepad++
2. Cherchez `;extension=zip` (Ctrl+F)
3. Enlevez le `;` pour avoir : `extension=zip`
4. Sauvegardez
5. Redémarrez Apache dans XAMPP
6. Fermez et rouvrez votre terminal
7. Dans le dossier blog-laravel, exécutez :
   ```bash
   composer install
   ```

L'installation sera 10x plus rapide !

## Solution 2 : Attendre (15-20 minutes)

Laissez simplement Composer terminer l'installation via Git.
C'est plus lent mais ça fonctionne.

## Solution 3 : Télécharger un projet Laravel pré-installé

Si vous êtes pressé, je peux vous guider pour :
1. Télécharger Laravel avec toutes les dépendances
2. Copier nos fichiers personnalisés
3. Lancer immédiatement

## Vérifier si l'installation est terminée

Exécutez cette commande :
```bash
php artisan --version
```

Si vous voyez "Laravel Framework X.X.X", l'installation est terminée !

## Une fois l'installation terminée

1. Créez la base de données :
   ```sql
   CREATE DATABASE blog_laravel;
   ```

2. Exécutez le script de configuration :
   ```bash
   setup.bat
   ```

3. Lancez le serveur :
   ```bash
   php artisan serve
   ```

4. Ouvrez votre navigateur sur : **http://localhost:8000**

## Comptes de Test

- **Admin** : admin@blog.com / password
- **User** : user@blog.com / password

---

**Quelle solution préférez-vous ?**
