# meto

## Dev Setup

Clone the develop branch:

```
$ git clone https://gitlab.com/gmgarrison/meto-whatsapp.git
```

Set up a mysql database in your dev environment.

Copy .env.example to .env and update the settings accordingly.

Run the following commands:

```
$ composer install
$ npm install
$ php artisan key:generate
$ php artisan migrate --seed
```