docker-compose up --build -d
docker-compose exec app compose i
docker-compose exec app apk add --update nodejs npm
docker-compose exec app npm i
docker-compose exec app npm run build
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
