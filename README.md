# Laravel Roster Test Assessment

## How to Run

`docker compose up`

## How to run unitest

-   Go into docker container

`docker exec -it {docker_container_id} bash`

-   Inside docker container, you need to run this command.

`php artisan test`

## Excel file parse testing

Inside project, you can find the `data.xlsx` file, and you can use this file for import testing.

## Postman

-   Just need to import the `postman/roster.postman_collection.json` file to your postman and test all the api endpoints
