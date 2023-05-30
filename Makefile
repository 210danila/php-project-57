install:
	composer install

start:
	php artisan serve

lint:
	composer exec --verbose phpcs -- --standard=PSR12 app routes

routes:
	php artisan route:list
