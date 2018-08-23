### setup project

 - Clone repository
 - make .env file from .env.example
 - run `composer install`
 - to run project `php -S localhost:8000 -t public`

## API doc
- use below in `.env`
```
SWAGGER_GENERATE_ALWAYS=false
SWAGGER_LUME_CONST_HOST=localhost:8000
SWAGGER_VERSION=2.0
```
- run `php artisan swagger-lume:generate`
- run `php artisan swagger-lume:views-publish`
- run `cd public`
- run `php -S localhost:8000 index.php`
- open browser and go to `http://localhost:8000/api/documentation`

## Limitations
- API doc is not generated and not configured for this use case.
- Auth is disabled, but it can be enabled and used with scopes



