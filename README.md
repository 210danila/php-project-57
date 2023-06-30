# Менеджер Задач

### Hexlet tests and linter status:
[![Actions Status](https://github.com/210danila/php-project-57/workflows/hexlet-check/badge.svg)](https://github.com/210danila/php-project-57/actions)
[![Maintainability](https://api.codeclimate.com/v1/badges/f3b63cc7aa1af7e4e153/maintainability)](https://codeclimate.com/github/210danila/php-project-57/maintainability)

### 4ый проект хекслет менеджер задач

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
  _postgresql://{user}:{password}@{host}:{port}/{db}_
  Например: 
> export DATABASE_URL=postgresql://username:mypassword@localhost:5432/mydb
- Запустите проект с помощью команды:
> make start

Для сброса базы данных и наполнения ее фиктивными данными используйте команду:
> make resfresh
