### Hexlet tests and linter status:
[![hexlet-check](https://github.com/Mikhail325/php-project-57/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/Mikhail325/php-project-57/actions/workflows/hexlet-check.yml)
[![testGit](https://github.com/Mikhail325/php-project-57/actions/workflows/github-actions.yml/badge.svg)](https://github.com/Mikhail325/php-project-57/actions/workflows/github-actions.yml)
<a href="https://codeclimate.com/github/Mikhail325/php-project-57/maintainability"><img src="https://api.codeclimate.com/v1/badges/f0ecb7cea5d737580e40/maintainability" /></a>
<a href="https://codeclimate.com/github/Mikhail325/php-project-57/test_coverage"><img src="https://api.codeclimate.com/v1/badges/f0ecb7cea5d737580e40/test_coverage" /></a>

# Анализатор страниц
Task Manager – система управления задачами, подобная http://www.redmine.org/. Она позволяет ставить задачи, назначать исполнителей и менять их статусы. Для работы с системой требуется регистрация и аутентификация.

Пример реализации сайта: https://php-project-57-s33x.onrender.com/

## Минимальные требования
* Composer >= 2.2;
* PHP >= 8.1;
* GNU Make >= 4.3;
* npm >= 18.0;
* Node >= 16.0;
* PostgreSQL >= 14.8;
* Docker >= 24.0.

## Инструкции по установке

С клонируйте репозиторий с GitHub и перейдите в директорию проекта используя команды:
```
git clone https://github.com/Mikhail325/php-project-57.git
cd php-project-57
```
### Инструкции по установке c помощью GNU Make

* Для установки зависимостей используйте команду **make install**.
* Для сборки проэкта используйте команду **npm run build**.
* Для запуска сайта используйте команду **php artisan serve**.

### Инструкции по установке c помощью Docker

* Для установки зависимостей используйте команду **make build**.
* Для запуска сайта используйте команду **make run**.

### Проверка работы сайта

Откройте в браузере ссылку **http://localhost:8000** и убедитесь, что сайт открылся.