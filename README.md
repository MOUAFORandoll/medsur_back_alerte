## run lumen microservice of alertes
`docker-compose up --remove-orphans`
## open projects (run the following command)
`docker-compose exec alerte composer install`
`docker-compose exec alerte php artisan migrate:fresh --seed
docker-compose exec alerte php artisan config:clear
docker-compose exec alerte php artisan cache:clear
docker-compose exec alerte php artisan config:cache`
`http://localhost:8003/`

## access on postgresql
`docker-compose exec alerte_postgresql psql -U postgres`