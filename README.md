# beer-app

Setup application

Please follow these steps:

-    git clone or download and extract this repository
-    cp .env.dist .env (update all entries in .env file - remember to change database_url to point into db container)
-    docker-compose up --build -d
-    docker inspect `your_db_container_id` |  grep IPAddress - this address should go to the .env file
-    docker-compose exec php-fpm bash composer install
-    docker inspect `your_webserver_container_id` |  grep IPAddress
-    add to /etc/hosts `your_webserver_container_id    beerapp.local` to access documentation in the browser

You can find API docs in your configured host (e.g `http://beerapp.local/api/doc`). NelmioApiDocBundle is used to generate documentation.

docker

    build and run containers: $ docker-compose up -d
    access php console: $ docker-compose exec php-fpm bash

php/api

    composer: $ composer require <package_name>
    symfony console: $ bin/console make:entity Hello


-------------------------

Import Data:

- docker-compose exec php-fpm bash
- bin/console app:beer:import

If setup went well we should see an information that import was successful.
All data can be accessed through the browser.