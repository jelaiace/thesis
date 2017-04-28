# Thesis
This is a school scheduling application for a dissertation.

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
artisan db:seed # Optional. Leave out to set a clean database.
```