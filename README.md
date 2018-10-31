# beer-app

Setup application (this is for ubuntu - for other systems there might be additional steps to do)

Please follow these steps:

-    git clone or download and extract this repository
-    cp .env.dist .env (update all entries in .env file - remember to change database_url to point into db container)
-    docker-compose up --build -d
-    docker ps - to check ID of containers
-    docker inspect `your_db_container_id` |  grep IPAddress - this address should go to the .env file
-    docker inspect `your_webserver_container_id` |  grep IPAddress
-    add to /etc/hosts `your_webserver_container_id    beerapp.local` to access documentation in the browser
-    docker-compose exec php-fpm bash
-    inside container run `composer install` 


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
- bin/console doctrine:migrations:migrate
- bin/console app:beer:import

If setup went well we should see an information that import was successful.
All data can be accessed through the browser.

Brewers:

- $ curl -X POST -H "Content-Type: application/json" beerapp.local/api/brewer/list -d 

Beers:

- $ curl -X POST -H "Content-Type: application/json" beerapp.local/api/beer/list -d 
- $ curl -X POST -H "Content-Type: application/json" beerapp.local/api/beer/{id} -d 