setup:
	cp .env.example .env
	composer install
	php artisan key:generate
	npm install
	npm ci
	npm run build

migrate:
	php artisan migrate

seed:
	php artisan db:seed --class=TaskStatusSeeder

refresh:
	php artisan migrate:refresh
	php artisan db:seed --class=TaskStatusSeeder

start:
	php artisan serve

lint:
	composer exec --verbose phpcs -- --standard=PSR12 app routes

phpcbf:
	composer exec --verbose phpcbf -- --standard=PSR12 app routes

.PHONY: tests
tests:
	php artisan test

test-coverage:
	php artisan test --coverage-clover build/logs/clover.xml
