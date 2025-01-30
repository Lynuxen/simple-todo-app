<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About Simple TODO List

This is a simple web app which allows users to create TODO lists that contain multiple tasks inside. The app has been
implemented using PHP Laravel and PostgreSQL.

## Running the app

The local machine should have the following installed:
- PHP
- Composer
- Laravel
- NodeJS
- Docker Desktop

First, populate the `.env` file with your preferred database settings. An example would be:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=todo_1forfit
DB_USERNAME=demouser
DB_PASSWORD=demopw
```


Run the following commands inside the root directory to get the app up and running.

`docker-compose up -d`

This will get the latest image for the PostgreSQL container and run it. After the container is running, enter:

```
npm install && npm run build
php artisan migrate
composer run dev
```

This will generate the frontend assets, create the tables in the database and run the server of the app.

You can also change the timezone in the `config/app.php` file if you want to test the app with local time.

## App Description
### TODO lists
A TODO list has at least one or multiple tasks. When creating a new TODO list, a task must also be provided.
Multiple tasks can be provided during the creation of a TODO list.
The title of the TODO list can be modified anytime. If one or more tasks haven't been completed, the list will
also show as not completed. If the list has only one task and that task is deleted, the list will also be deleted.
The list can be manually deleted as well.

If all tasks have been completed, the list will display completed. Adding a new task automatically sets the status
of the list to not completed.

### Tasks

Each task has a `TITLE`, `DESCRIPTION` and `DEADLINE`. A task must have a title and a deadline, but the description
is optional. The deadline cannot be set before the current time (in minutes). If the deadline has expired, the status of
the task cannot be changed, and will remain with whatever it was before the deadline. The task cannot be edited
(such as changing the title or description) as well after the deadline. However, it can be deleted.
