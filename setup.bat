@echo off
echo ========================================
echo   Installation du Blog Laravel
echo ========================================
echo.

echo [1/5] Generation de la cle d'application...
php artisan key:generate
echo.

echo [2/5] Execution des migrations...
php artisan migrate
echo.

echo [3/5] Creation des utilisateurs de test...
php artisan db:seed --class=AdminSeeder
echo.

echo [4/5] Creation du lien symbolique pour les images...
php artisan storage:link
echo.

echo [5/5] Nettoyage du cache...
php artisan config:clear
php artisan cache:clear
echo.

echo ========================================
echo   Installation terminee avec succes!
echo ========================================
echo.
echo Comptes de test crees :
echo - Admin : admin@blog.com / password
echo - User  : user@blog.com / password
echo.
echo Pour lancer le serveur, executez :
echo php artisan serve
echo.
echo Puis ouvrez : http://localhost:8000
echo.
pause
