#!/bin/bash

echo "========================================"
echo "  Installation du Blog Laravel"
echo "========================================"
echo ""

echo "[1/5] Génération de la clé d'application..."
php artisan key:generate
echo ""

echo "[2/5] Exécution des migrations..."
php artisan migrate
echo ""

echo "[3/5] Création des utilisateurs de test..."
php artisan db:seed --class=AdminSeeder
echo ""

echo "[4/5] Création du lien symbolique pour les images..."
php artisan storage:link
echo ""

echo "[5/5] Nettoyage du cache..."
php artisan config:clear
php artisan cache:clear
echo ""

echo "========================================"
echo "  Installation terminée avec succès!"
echo "========================================"
echo ""
echo "Comptes de test créés :"
echo "- Admin : admin@blog.com / password"
echo "- User  : user@blog.com / password"
echo ""
echo "Pour lancer le serveur, exécutez :"
echo "php artisan serve"
echo ""
echo "Puis ouvrez : http://localhost:8000"
echo ""
