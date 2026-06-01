@echo off
chcp 65001 >nul
echo ========================================
echo   MISE À JOUR DU BLOG PERSONNEL
echo ========================================
echo.
echo Ce script va appliquer les nouvelles migrations
echo pour transformer votre blog en blog personnel.
echo.
echo IMPORTANT : Assurez-vous d'avoir sauvegardé
echo votre base de données avant de continuer !
echo.
pause

echo.
echo [1/3] Application des migrations...
echo.
php artisan migrate
if %errorlevel% neq 0 (
    echo.
    echo ❌ ERREUR lors des migrations !
    echo Vérifiez que MySQL est démarré et que la base existe.
    pause
    exit /b 1
)

echo.
echo [2/3] Création du lien de stockage...
echo.
php artisan storage:link
if %errorlevel% neq 0 (
    echo.
    echo ⚠️  Le lien existe peut-être déjà, ce n'est pas grave.
)

echo.
echo [3/3] Nettoyage du cache...
echo.
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo.
echo ========================================
echo   ✅ MISE À JOUR TERMINÉE !
echo ========================================
echo.
echo Votre blog est maintenant un blog personnel avec :
echo   - Rôle Propriétaire (owner) : peut publier
echo   - Rôle Visiteur (visitor) : peut commenter et liker
echo   - Support multi-média (images, vidéos, documents)
echo   - Système de likes
echo   - Page À propos personnalisée
echo.
echo Comptes de test (si vous avez exécuté le seeder) :
echo   Propriétaire : owner@blog.com / password
echo   Visiteur 1   : visitor1@blog.com / password
echo   Visiteur 2   : visitor2@blog.com / password
echo.
echo Pour démarrer le serveur :
echo   php artisan serve
echo.
echo Consultez MISE_A_JOUR_BLOG_PERSONNEL.md pour plus d'infos.
echo.
pause
