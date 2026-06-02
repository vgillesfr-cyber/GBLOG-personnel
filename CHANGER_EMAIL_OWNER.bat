@echo off
chcp 65001 >nul
echo ========================================
echo   CHANGER L'EMAIL DU PROPRIÉTAIRE
echo ========================================
echo.

set /p email="Entrez le nouvel email : "

echo.
echo Changement de l'email en cours...
php artisan owner:change-email %email%

echo.
pause
