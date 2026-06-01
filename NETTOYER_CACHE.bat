@echo off
chcp 65001 >nul
echo ========================================
echo   NETTOYAGE DU CACHE LARAVEL
echo ========================================
echo.

echo [1/4] Nettoyage du cache de configuration...
php artisan config:clear

echo.
echo [2/4] Nettoyage du cache de routes...
php artisan route:clear

echo.
echo [3/4] Nettoyage du cache de vues...
php artisan view:clear

echo.
echo [4/4] Nettoyage du cache général...
php artisan cache:clear

echo.
echo ========================================
echo   ✅ CACHE NETTOYÉ !
echo ========================================
echo.
echo Rafraîchissez votre navigateur (Ctrl+F5)
echo.
pause
