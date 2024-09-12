run:
	docker compose up -d
stop:
	docker compose down
build:
	docker exec task-fpm sh -c 'composer install && bin/console doctrine:migrations:migrate'
test:
	docker exec task-fpm bin/phpunit