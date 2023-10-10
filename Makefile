lint:
	composer exec --verbose phpcs -- --standard=PSR12 app routes tests
install:
	composer install
build:
	docker build -t user_name/task-manager .
run:	
	docker run -p 8000:8000 user_name/task-manager
test:
	php artisan test --testsuite=Feature