# Resturant App

Restful Apis to create a quiz bulder application

## Built using
- PHP Laravel 9
- Nginx
- PHP 8.1.0
- MySQL
- Redis

## Project Setup

1 - Clone this repo
```
git clone git@git.toptal.com:screening/Syed-M-Shaheer-Hussain.git {yourproject}
cd {yourproject}
cp src/.env.example src/.env
```

2 - Updatate you db username and passoword in the env

3 - You will to run the following command to run migration and setup the DB
```
composer install
php artisan migrate
```
4 - Make sure Redis is setup as the application is using redis to cache the temporary url link of a file

5 - To Run the project you can use the following command
```
php artisan serve
```
6 - After the project is setup you can access the api endpoints using the following base URL (port can be different)
```
http://localhost:8080/api/
```

7 - The corn jon is added as a console command, you can view it by typing the follwoing command
```
php artisan list
```
You will see a scheduled command under "hourly" section named "hourly:cleanup", the purpose of which is to clean up records older than 30 days

8 - You can run run it manually using the following command 
```
php artisa hourly:cleanup
```
It will also print out the number of records cleaned up

## API Docs

Following is the link to API Documentation of Resturant App

https://documenter.getpostman.com/view/23884862/2s8YzQX4X2

