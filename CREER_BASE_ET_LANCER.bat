@echo off
cls
echo ========================================
echo   CONFIGURATION DU BLOG
echo ========================================
echo.

echo ETAPE 1 : Creation de la base de donnees
echo =========================================
echo.
echo Ouvrez phpMyAdmin dans votre navigateur :
echo http://localhost/phpmyadmin
echo.
echo Puis executez cette commande SQL :
echo.
echo CREATE DATABASE blog_laravel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
echo.
echo ========================================
echo.
set /p done="Avez-vous cree la base de donnees ? (O/N) : "

if /i not "%done%"=="O" (
    echo.
    echo Veuillez creer la base de donnees et relancer ce script.
    echo.
    pause
    exit /b 1
)

echo.
echo ETAPE 2 : Execution des migrations
echo ===================================
echo.

php artisan migrate --force

if errorlevel 1 (
    echo.
    echo [ERREUR] Les migrations ont echoue
    echo.
    echo Verifiez que :
    echo 1. La base de donnees 'blog_laravel' existe
    echo 2. MySQL est demarre dans XAMPP
    echo 3. Les parametres dans .env sont corrects
    echo.
    pause
    exit /b 1
)

echo.
echo [OK] Migrations executees avec succes !
echo.

echo ETAPE 3 : Creation des utilisateurs de test
echo =============================================
echo.

php artisan db:seed --class=AdminSeeder --force

if errorlevel 1 (
    echo.
    echo [ERREUR] La creation des utilisateurs a echoue
    echo.
    pause
    exit /b 1
)

echo.
echo [OK] Utilisateurs crees avec succes !
echo.

echo ETAPE 4 : Creation du lien pour les images
echo ============================================
echo.

php artisan storage:link

echo.
echo [OK] Lien cree avec succes !
echo.

echo ETAPE 5 : Nettoyage du cache
echo ==============================
echo.

php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo.
echo [OK] Cache nettoye !
echo.

echo ========================================
echo   CONFIGURATION TERMINEE !
echo ========================================
echo.
echo Le blog est pret a etre lance !
echo.
echo Comptes de test crees :
echo - Admin : admin@blog.com / password
echo - User  : user@blog.com / password
echo.
echo Pour lancer le blog :
echo   php artisan serve
echo.
echo Puis ouvrez : http://localhost:8000
echo.
pause
