# Collective-orders
Tool to manage grouped orders

<br>

## Prerequisites
PHP 7.1 or better

<br>


## Project installation 
Copy past the project files on your server.

Chmod the file `logs.txt` to 777.

Download the vendors : `composer install`.

Configure the constants in `config.php`.


<br>

## Set the cron tab
In a terminal, log as root then type `crontab -e` and add that kind of line:
```
* * * * 0 php /var/www/html/sendTheFormOfTheWeek.php 2>&1
```
