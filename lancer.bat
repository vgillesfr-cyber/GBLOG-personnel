@echo off
echo ========================================
echo   Lancement du Blog Laravel
echo ========================================
echo.

echo Verification de l'installation...
echo.

REM Verifier si vendor existe
if not exist "vendor\" (
    echo Installation des dependances en cours...
    echo Veuillez patienter...
    composer install --no-interaction
    echo.
)

echo Verification de la cle d'application...
php artisan key:generate --force
echo.

echo ========================================
echo   Demarrage du serveur...
echo ========================================
echo.
echo Le blog sera accessible sur :
echo http://localhost:8000
echo.
echo Comptes de test :
echo - Admin : admin@blog.com / password
echo - User  : user@blog.com / password
echo.
echo Appuyez sur Ctrl+C pour arreter le serveur
echo.

php artisan serve
