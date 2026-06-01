@echo off
cls
echo ========================================
echo   BLOG LARAVEL - Demarrage
echo ========================================
echo.

REM Verifier si l'installation est complete
if not exist "vendor\autoload.php" (
    echo [ERREUR] Installation incomplete !
    echo.
    echo L'installation de Composer n'est pas terminee.
    echo Veuillez attendre la fin de l'installation en cours.
    echo.
    echo OU executez manuellement :
    echo composer install
    echo.
    pause
    exit /b 1
)

echo [OK] Dependances installees
echo.

REM Verifier la cle d'application
findstr /C:"APP_KEY=base64:" .env >nul 2>&1
if errorlevel 1 (
    echo Generation de la cle d'application...
    php artisan key:generate --force
    echo.
)

echo [OK] Cle d'application configuree
echo.

REM Verifier la base de donnees
echo Verification de la base de donnees...
php artisan migrate:status >nul 2>&1
if errorlevel 1 (
    echo.
    echo [ATTENTION] Base de donnees non configuree !
    echo.
    echo Etapes a suivre :
    echo 1. Creer la base de donnees 'blog_laravel' dans MySQL
    echo 2. Verifier les parametres dans le fichier .env
    echo 3. Executer : php artisan migrate
    echo 4. Executer : php artisan db:seed --class=AdminSeeder
    echo.
    set /p continuer="Voulez-vous continuer quand meme ? (O/N) : "
    if /i not "%continuer%"=="O" exit /b 1
)

echo.
echo ========================================
echo   LANCEMENT DU SERVEUR
echo ========================================
echo.
echo Le blog sera accessible sur :
echo.
echo    http://localhost:8000
echo.
echo Comptes de test :
echo    Admin : admin@blog.com / password
echo    User  : user@blog.com / password
echo.
echo Appuyez sur Ctrl+C pour arreter le serveur
echo.
echo ========================================
echo.

php artisan serve --host=127.0.0.1 --port=8000
