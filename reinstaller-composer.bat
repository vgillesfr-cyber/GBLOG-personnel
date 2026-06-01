@echo off
cls
echo ========================================
echo   Reinstallation de Composer
echo ========================================
echo.

echo [IMPORTANT] Avant de continuer :
echo.
echo 1. Ouvrez XAMPP Control Panel
echo 2. Arretez Apache
echo 3. Ouvrez C:\xampp\php\php.ini avec Notepad++
echo 4. Cherchez ";extension=zip" (Ctrl+F)
echo 5. Enlevez le ";" pour avoir "extension=zip"
echo 6. Sauvegardez le fichier
echo 7. Redemarrez Apache
echo.
set /p ready="Avez-vous fait ces etapes ? (O/N) : "

if /i not "%ready%"=="O" (
    echo.
    echo Veuillez suivre ces etapes et relancer ce script.
    echo.
    pause
    exit /b 1
)

echo.
echo ========================================
echo   Nettoyage...
echo ========================================
echo.

REM Arrêter les processus Composer en cours
taskkill /F /IM composer.phar /T >nul 2>&1
taskkill /F /IM git.exe /T >nul 2>&1

echo Suppression de vendor...
if exist "vendor" (
    rmdir /s /q "vendor" 2>nul
    echo [OK] Dossier vendor supprime
) else (
    echo [OK] Dossier vendor n'existe pas
)

echo.
echo Suppression de composer.lock...
if exist "composer.lock" (
    del /f /q "composer.lock" 2>nul
    echo [OK] Fichier composer.lock supprime
) else (
    echo [OK] Fichier composer.lock n'existe pas
)

echo.
echo ========================================
echo   Installation de Composer
echo ========================================
echo.
echo Cela peut prendre 2-3 minutes...
echo Veuillez patienter...
echo.

REM Installer les dépendances
composer install --no-interaction --prefer-dist

if errorlevel 1 (
    echo.
    echo ========================================
    echo   ERREUR lors de l'installation
    echo ========================================
    echo.
    echo Verifiez que :
    echo 1. L'extension ZIP est bien activee dans php.ini
    echo 2. Apache a ete redémarre
    echo 3. Vous avez une connexion Internet
    echo.
    pause
    exit /b 1
)

echo.
echo ========================================
echo   Installation terminee !
echo ========================================
echo.

REM Vérifier que vendor/autoload.php existe
if exist "vendor\autoload.php" (
    echo [OK] Installation reussie !
    echo.
    echo Prochaines etapes :
    echo.
    echo 1. Creer la base de donnees :
    echo    CREATE DATABASE blog_laravel;
    echo.
    echo 2. Configurer le projet :
    echo    setup.bat
    echo.
    echo 3. Lancer le serveur :
    echo    php artisan serve
    echo.
    echo 4. Ouvrir dans le navigateur :
    echo    http://localhost:8000
    echo.
) else (
    echo [ERREUR] L'installation semble incomplete
    echo Le fichier vendor\autoload.php n'existe pas
    echo.
    echo Essayez de relancer ce script ou consultez SOLUTION_RAPIDE.md
    echo.
)

pause
