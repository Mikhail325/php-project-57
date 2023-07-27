lint:
	composer exec --verbose phpcs -- --standard=PSR12 php-project-57
phpstan:
	vendor/bin/phpstan analyse --level 8 php-project-57
install:
	composer install