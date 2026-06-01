# 🔧 Guide : Activer l'extension ZIP dans PHP

## Pourquoi activer ZIP ?

Sans l'extension ZIP, Composer doit télécharger les packages via Git, ce qui est **10x plus lent**.
Avec ZIP activé, l'installation prend **2-3 minutes** au lieu de 15-20 minutes.

---

## 📋 Étapes Détaillées

### Étape 1 : Ouvrir XAMPP Control Panel

1. Ouvrez **XAMPP Control Panel**
2. **Arrêtez Apache** (cliquez sur "Stop")

![XAMPP Control Panel](https://via.placeholder.com/600x200/ff6b35/ffffff?text=XAMPP+Control+Panel)

---

### Étape 2 : Ouvrir le fichier php.ini

**Option A : Via XAMPP Control Panel**
1. Dans XAMPP Control Panel
2. Cliquez sur le bouton **"Config"** à côté d'Apache
3. Sélectionnez **"PHP (php.ini)"**

**Option B : Manuellement**
1. Ouvrez l'explorateur de fichiers
2. Allez dans : `C:\xampp\php\`
3. Ouvrez le fichier `php.ini` avec **Notepad++** ou **Bloc-notes**

---

### Étape 3 : Chercher l'extension ZIP

1. Dans le fichier ouvert, appuyez sur **Ctrl+F** (Rechercher)
2. Tapez : `extension=zip`
3. Vous devriez trouver une ligne comme :
   ```ini
   ;extension=zip
   ```

**Note :** Le point-virgule `;` au début signifie que la ligne est commentée (désactivée)

---

### Étape 4 : Activer l'extension

1. Trouvez la ligne : `;extension=zip`
2. **Enlevez le point-virgule** au début
3. La ligne doit devenir : `extension=zip`

**Avant :**
```ini
;extension=zip
```

**Après :**
```ini
extension=zip
```

---

### Étape 5 : Sauvegarder

1. Appuyez sur **Ctrl+S** pour sauvegarder
2. Fermez le fichier

---

### Étape 6 : Redémarrer Apache

1. Retournez dans **XAMPP Control Panel**
2. Cliquez sur **"Start"** pour redémarrer Apache
3. Attendez que le statut devienne vert

---

### Étape 7 : Vérifier l'activation

1. Ouvrez un **nouveau terminal** (important : nouveau terminal !)
2. Tapez :
   ```bash
   php -m | findstr zip
   ```
3. Vous devriez voir `zip` dans la liste

**Si vous voyez "zip", c'est bon ! ✅**

---

### Étape 8 : Réinstaller Composer

Maintenant que ZIP est activé, réinstallez Composer :

1. Allez dans le dossier `blog-laravel`
2. Double-cliquez sur **`reinstaller-composer.bat`**
3. Suivez les instructions

**OU** en ligne de commande :
```bash
cd blog-laravel
reinstaller-composer.bat
```

---

## ✅ Vérification Finale

Après l'installation, vérifiez que tout fonctionne :

```bash
php artisan --version
```

Vous devriez voir :
```
Laravel Framework 12.x.x
```

---

## 🎉 Prochaines Étapes

Une fois Composer installé :

1. **Créer la base de données :**
   ```sql
   CREATE DATABASE blog_laravel;
   ```

2. **Configurer le projet :**
   ```bash
   setup.bat
   ```

3. **Lancer le serveur :**
   ```bash
   php artisan serve
   ```

4. **Ouvrir le navigateur :**
   ```
   http://localhost:8000
   ```

---

## 🐛 Problèmes Courants

### "Access denied" lors de la modification de php.ini

**Solution :** Ouvrez Notepad++ en tant qu'administrateur
1. Clic droit sur Notepad++
2. "Exécuter en tant qu'administrateur"
3. Ouvrez le fichier php.ini
4. Modifiez et sauvegardez

### L'extension ZIP n'apparaît pas après activation

**Solution :**
1. Vérifiez que vous avez bien enlevé le `;`
2. Vérifiez que vous avez sauvegardé le fichier
3. Redémarrez Apache
4. **Fermez et rouvrez votre terminal** (important !)

### Composer est toujours lent

**Solution :**
1. Vérifiez avec `php -m | findstr zip`
2. Si "zip" n'apparaît pas, recommencez les étapes
3. Assurez-vous d'avoir redémarré Apache
4. Ouvrez un **nouveau terminal**

---

## 📞 Besoin d'Aide ?

Si vous rencontrez des problèmes :
1. Consultez **SOLUTION_RAPIDE.md**
2. Vérifiez **CHECKLIST.md**
3. Relisez ce guide étape par étape

---

**Bon courage ! 🚀**
