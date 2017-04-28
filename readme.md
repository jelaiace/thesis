# Thesis
This is a school scheduling application for a dissertation.

## Tools
- [Laravel 5.4](laravel.com)
- [MySQL](https://www.mysql.com/)
- [Bootstrap](http://getbootstrap.com/)
- [jQuery](https://jquery.com/)
- [React Timesheet](github.com/srph/react-timesheet)

## Requirements
- [Xampp 7.0.15 (PHP 7.1, MySQL 5.6)](https://www.apachefriends.org/index.html)
- [Composer](https://getcomposer.org/doc/00-intro.md#installation-windows)

## Setup
- **Install dependencies**
```bash
composer install
```

- **Setup environment file** &mdash; Afterwards, don't forget to check `.env` and fill up the database fields properly.
```bash
cp .env.example .env
```

- **Generate key**
```bash
artisan key:generate
```

- **Run database migrations**
```bash
artisan migrate
# Optional. Leave out to set a clean database.
# However, you will need to fill out the fields yourself.
artisan db:seed
```