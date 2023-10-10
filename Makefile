install:
	composer install
validate:
	composer validate
lint:
	composer exec --verbose phpcs -- --standard=PSR12 app config routes lang tests
lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 app config routes lang tests
phpstan:
	composer exec phpstan --ansi analyse
test:
	php artisan optimize:clear && php artisan test --testsuite=Feature
start-db:
	sudo service postgresql start
prepare-db:
	php artisan migrate:fresh --seed
env:
	php -r "file_exists('.env') || copy('.env.example', '.env');"
setup: env install prepare-db lint test