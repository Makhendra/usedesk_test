Проект разработан с использованием laravel версии 7.20.0

Тестовое задание:

Написать приложение на laravel, реализующее базовый API для работы с клиентами. 

У клиента есть имя, фамилия, один или более номеров телефона, один или более почтовых ящиков. 

Нужно сделать пять методов: 
1. добавления, 
2. просмотра, 
3. изменения, 
4. удаления, 
5. поиска клиента. 

Поиск осуществляется в четырех вариантах: по имени и фамилии, телефону, почте или по всем предыдущим опциям одновременно. 

Тип поиска передается в параметре запроса. 

Доступ к API осуществляется по токену. 

Необходимо вести лог всех операций через API с сохранением авторства.

## Требования
- PHP >= 7.2.5
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Установка

``` git clone ```
``` composer install  ```
``` cp .env.example .env  ```
``` change .env  ```
``` php artisan key:generate ```
``` php artisan migrate ```
``` php artisan db:seed ```
