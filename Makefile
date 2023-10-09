lint:
	composer exec --verbose phpcs -- --standard=PSR12 app routes tests
phpstan:
	vendor/bin/phpstan analyse -c phpstan.neon