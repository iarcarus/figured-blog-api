# Figured Blog API Project

## Project setup
```
PHP: "^7.0.0",
Laravel: "^5.6.0",
Mysql
MongoDB
Composer
```

## Project setup
```
run composer install
duplicates .env.example as .env
run "php artisan key:generate"
fill .env with your systems configurations
run "composer dump-autoload"
run "php artisan migrate"
run "php artisan db:seed"

```

### Run serve
```
run "php artisan serve"
```

### Run your tests
```
vendor/phpunit/phpunit/phpunit --configuration phpunit.xml 
```

