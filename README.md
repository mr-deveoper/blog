# Blog.

# Description
web blogging platform built with laravel

# Requirements

- PHP `>= 7.3`
- MySQL `>=5.7`
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

# Requirements

1- Clone the Project or download it directly

2- go to project folder and run `composer install` to Install Dependencies

3- run this command to enable env file : `cp .env.example .env` then `php artisan key:generate`

4- change `DB_CONNECTION` , `DB_DATABASE` , `DB_USERNAME` , `DB_PASSWORD` data to your data 
- please note that `APP_ENV` must be equal to `testing` in order for unit and integration tests to work properly

5- after you change the db access run this command `php artisan migrate:refresh --seed` which will create required tables and insert dummy data

6- after that you can run `php artisan serve` and  browse the website as you wish 
- note : if you faced any error that is related to this `Supported methods: HEAD` please run this command `php artisan optimize` or this `php artisan route:cache` it's cache related problem

7- You should be able to visit browse website on http://localhost:8000

8- to test the api integration please run `php artisan schedule:run` which should be runing every hour so you should create a cron job to run it every hour like this `0 * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1`, if you didn't run it hourly it will not work and will give you this message `No scheduled commands are ready to run.`


# Credentials

there is a default credentials for admin will be generated 

- Access :
email: `admin@blog.com`

password: `123456789`

# Testing
To run integration tests:

`php artisan test`

