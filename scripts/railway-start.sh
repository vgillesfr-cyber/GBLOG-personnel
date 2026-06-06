#!/usr/bin/env bash
set -e

echo "=== GBLOG - Démarrage Railway ==="

php artisan config:clear

echo "→ Migrations..."
php artisan migrate --force

echo "→ Compte propriétaire..."
php artisan owner:ensure

echo "→ Lien storage..."
php artisan storage:link --force 2>/dev/null || php artisan storage:link || true

PORT="${PORT:-8000}"
echo "→ Serveur sur le port ${PORT}..."
exec php artisan serve --host=0.0.0.0 --port="${PORT}"
