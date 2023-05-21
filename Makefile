install:
	composer install

lint:
	composer exec --verbose phpcs -- --standard=PSR12 app routes
