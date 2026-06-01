# Script pour activer ZIP et réinstaller Composer
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Activation ZIP et Installation" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Chemin du fichier php.ini
$phpIniPath = "C:\xampp\php\php.ini"

# Vérifier si le fichier existe
if (Test-Path $phpIniPath) {
    Write-Host "[1/5] Lecture du fichier php.ini..." -ForegroundColor Yellow
    
    # Lire le contenu
    $content = Get-Content $phpIniPath -Raw
    
    # Vérifier si ZIP est déjà activé
    if ($content -match "^extension=zip" -or $content -match "^;extension=zip") {
        Write-Host "[2/5] Activation de l'extension ZIP..." -ForegroundColor Yellow
        
        # Remplacer ;extension=zip par extension=zip
        $newContent = $content -replace ";extension=zip", "extension=zip"
        
        # Sauvegarder
        try {
            Set-Content -Path $phpIniPath -Value $newContent -Force
            Write-Host "    Extension ZIP activee avec succes!" -ForegroundColor Green
        } catch {
            Write-Host "    ERREUR: Impossible de modifier php.ini" -ForegroundColor Red
            Write-Host "    Veuillez executer ce script en tant qu'administrateur" -ForegroundColor Red
            Write-Host "    OU modifier manuellement le fichier:" -ForegroundColor Yellow
            Write-Host "    $phpIniPath" -ForegroundColor Yellow
            Write-Host "    Cherchez ';extension=zip' et enlevez le ';'" -ForegroundColor Yellow
            pause
            exit 1
        }
    } else {
        Write-Host "[2/5] Extension ZIP deja activee" -ForegroundColor Green
    }
} else {
    Write-Host "ERREUR: Fichier php.ini introuvable!" -ForegroundColor Red
    Write-Host "Chemin attendu: $phpIniPath" -ForegroundColor Yellow
    pause
    exit 1
}

Write-Host ""
Write-Host "[3/5] Nettoyage des fichiers temporaires..." -ForegroundColor Yellow

# Supprimer vendor si existe
if (Test-Path "vendor") {
    Remove-Item -Path "vendor" -Recurse -Force -ErrorAction SilentlyContinue
    Write-Host "    Dossier vendor supprime" -ForegroundColor Green
}

# Supprimer composer.lock
if (Test-Path "composer.lock") {
    Remove-Item -Path "composer.lock" -Force -ErrorAction SilentlyContinue
    Write-Host "    Fichier composer.lock supprime" -ForegroundColor Green
}

Write-Host ""
Write-Host "[4/5] Redemarrage d'Apache recommande..." -ForegroundColor Yellow
Write-Host "    Veuillez redemarrer Apache dans XAMPP Control Panel" -ForegroundColor Cyan
Write-Host ""
$restart = Read-Host "Avez-vous redémarre Apache ? (O/N)"

if ($restart -ne "O" -and $restart -ne "o") {
    Write-Host ""
    Write-Host "Veuillez redemarrer Apache et relancer ce script" -ForegroundColor Yellow
    pause
    exit 0
}

Write-Host ""
Write-Host "[5/5] Installation de Composer..." -ForegroundColor Yellow
Write-Host "    Cela peut prendre 2-3 minutes..." -ForegroundColor Cyan
Write-Host ""

# Installer avec Composer
composer install --no-interaction

if ($LASTEXITCODE -eq 0) {
    Write-Host ""
    Write-Host "========================================" -ForegroundColor Green
    Write-Host "  Installation terminee avec succes!" -ForegroundColor Green
    Write-Host "========================================" -ForegroundColor Green
    Write-Host ""
    Write-Host "Prochaines etapes:" -ForegroundColor Cyan
    Write-Host "1. Creer la base de donnees: CREATE DATABASE blog_laravel;" -ForegroundColor Yellow
    Write-Host "2. Executer: setup.bat" -ForegroundColor Yellow
    Write-Host "3. Lancer: php artisan serve" -ForegroundColor Yellow
    Write-Host "4. Ouvrir: http://localhost:8000" -ForegroundColor Yellow
    Write-Host ""
} else {
    Write-Host ""
    Write-Host "ERREUR lors de l'installation" -ForegroundColor Red
    Write-Host "Verifiez les messages d'erreur ci-dessus" -ForegroundColor Yellow
}

pause
