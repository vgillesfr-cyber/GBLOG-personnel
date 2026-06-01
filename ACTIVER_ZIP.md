# 🔧 Activer l'extension ZIP dans PHP

## Problème
L'installation de Composer est très lente car l'extension ZIP n'est pas activée dans PHP.

## Solution Rapide

### 1. Ouvrir le fichier php.ini
- Chemin : `C:\xampp\php\php.ini`
- Ouvrir avec un éditeur de texte (Notepad++)

### 2. Chercher la ligne
Cherchez cette ligne (Ctrl+F) :
```
;extension=zip
```

### 3. Activer l'extension
Enlevez le point-virgule au début :
```
extension=zip
```

### 4. Sauvegarder et redémarrer
- Sauvegardez le fichier
- Redémarrez Apache depuis XAMPP Control Panel
- Fermez et rouvrez votre terminal

### 5. Vérifier
```bash
php -m | findstr zip
```

Vous devriez voir "zip" dans la liste.

## Alternative : Continuer sans ZIP

L'installation continue via Git (plus lent mais fonctionne).
Attendez simplement que Composer termine l'installation.

Cela peut prendre 10-15 minutes.
