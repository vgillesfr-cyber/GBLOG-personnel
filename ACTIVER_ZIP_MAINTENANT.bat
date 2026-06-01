@echo off
cls
echo ========================================
echo   ACTIVATION DE L'EXTENSION ZIP
echo ========================================
echo.
echo IMPORTANT : Suivez ces etapes EXACTEMENT :
echo.
echo 1. Ouvrez XAMPP Control Panel
echo 2. Cliquez sur "Stop" pour arreter Apache
echo 3. Cliquez sur "Config" a cote d'Apache
echo 4. Selectionnez "PHP (php.ini)"
echo 5. Dans le fichier qui s'ouvre :
echo    - Appuyez sur Ctrl+F
echo    - Cherchez : ;extension=zip
echo    - ENLEVEZ le point-virgule (;) au debut
echo    - La ligne doit devenir : extension=zip
echo 6. Sauvegardez (Ctrl+S)
echo 7. Fermez le fichier
echo 8. Dans XAMPP, cliquez sur "Start" pour redemarrer Apache
echo.
echo ========================================
echo.
set /p done="Avez-vous fait TOUTES ces etapes ? (O/N) : "

if /i not "%done%"=="O" (
    echo.
    echo Veuillez suivre toutes les etapes ci-dessus.
    echo.
    pause
    exit /b 1
)

echo.
echo Verification de l'activation de ZIP...
echo.

php -m | findstr /i "zip" >nul 2>&1

if errorlevel 1 (
    echo [ERREUR] L'extension ZIP n'est pas activee !
    echo.
    echo Verifiez que :
    echo 1. Vous avez bien enleve le ";" devant "extension=zip"
    echo 2. Vous avez sauvegarde le fichier php.ini
    echo 3. Vous avez redémarre Apache
    echo 4. Vous avez ferme et rouvert ce terminal
    echo.
    echo Fermez ce terminal, rouvrez-en un nouveau, et relancez ce script.
    echo.
    pause
    exit /b 1
)

echo [OK] Extension ZIP activee avec succes !
echo.
echo ========================================
echo   INSTALLATION DE COMPOSER
echo ========================================
echo.
echo Installation en cours... (2-3 minutes)
echo.

REM Nettoyer
if exist "vendor" rmdir /s /q "vendor" 2>nul
if exist "composer.lock" del /f /q "composer.lock" 2>nul

REM Installer
composer install --no-interaction --prefer-dist

if errorlevel 1 (
    echo.
    echo [ERREUR] L'installation a echoue
    echo.
    pause
    exit /b 1
)

echo.
echo ========================================
echo   INSTALLATION TERMINEE !
echo ========================================
echo.
echo Prochaines etapes :
echo.
echo 1. Creer la base de donnees :
echo    CREATE DATABASE blog_laravel;
echo.
echo 2. Configurer :
echo    setup.bat
echo.
echo 3. Lancer :
echo    php artisan serve
echo.
echo 4. Ouvrir : http://localhost:8000
echo.
pause
