setup:
	cp .env.example .env
	composer install
	npm ci
	npm run build

start:
	php artisan serve

lint:
	composer exec --verbose phpcs -- --standard=PSR12 app routes

phpcbf:
	composer exec --verbose phpcbf -- --standard=PSR12 app routes

refresh:
	php artisan migrate:refresh
	php artisan db:seed --class=TaskStatusSeeder

.PHONY: tests
tests:
	php artisan test

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover storage/logs/clover.xml	
