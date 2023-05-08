docker-compose up --force-recreate --build -d
docker-compose exec app php artisan migrate:fresh