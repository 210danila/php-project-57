install:
	composer install

start:
	php artisan serve

lint:
	composer exec --verbose phpcs -- --standard=PSR12 app routes

phpcbf:
	composer exec --verbose phpcbf -- --standard=PSR12 app routes

refresh:
	php artisan migrate:refresh
	php artisan db:seed --class=TaskStatusSeeder

test:
	php artisan make:test --	
