#Setting up the project

## Required
- php8.1 or greater

## Vendor files

- Run `composer install`, it will add upload vendor

## Database

- Create Database Schema (example `CREATE SCHEMA laravelapi ;`)
- Create `.env` file based on `.env.example`  and change DB_DATABASE value to name of the schema (from example `laravelapi`) and DB_PASSWORD value to Your password 
- Run `php artisan migrate` in project directory

## Run server
- You can run `php artisan serve` and it will run your local sever and you get server name (example `http://127.0.0.1:8000/`)

## Unit Tests

- To start unit test run `php artisan test`

## Testing Without Unit Tests

- You can test this api using postman, just make a `post` api call to url `{YourServerName}/api/submit` with data 
`"name": "John Doe",`
`"email": "john.doe@example.com",`
`"message": "This is a test message."`

## Troubleshooting 

- If you got error `access denied`, change permission for folders in `storage` directory

