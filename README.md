# Менеджер Задач

### Hexlet tests and linter status:
[![hexlet-check](https://github.com/210danila/php-project-57/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/210danila/php-project-57/actions/workflows/hexlet-check.yml)
[![CI](https://github.com/210danila/php-project-57/actions/workflows/main.yml/badge.svg)](https://github.com/210danila/php-project-57/actions/workflows/main.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/f3b63cc7aa1af7e4e153/maintainability)](https://codeclimate.com/github/210danila/php-project-57/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/f3b63cc7aa1af7e4e153/test_coverage)](https://codeclimate.com/github/210danila/php-project-57/test_coverage)

### 4ый проект хекслет менеджер задач

[Тык](https://project-57.fly.dev)

__Иструкция по установке:__
- Перед началом необходимо установить nodejs и postgresql:
> sudo apt install nodejs

[Установка Postgresql](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-postgresql-on-ubuntu-20-04)

В php.ini раскомментируйте строки, если в их начале стоит ';'

> ;extension=php_pdo_pgsql.dll

> ;extension=php_pdo_pgsql.dll

- Установите зависимости комндой:
> make setup
- Установите значение переменной DATABASE_URL в файле .env формата:

> postgresql://{user}:{password}@{host}:{port}/{db}

- Запустите проект с помощью команды:
> make start

Для сброса базы данных и наполнения ее фиктивными данными используйте команду:
> make resfresh
