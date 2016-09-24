# Hair Salon

#### _A website to add stylists and clients for a hair salon using MySQL, September 23, 2016_

#### By _**Aimen Khakwani**_

## Description

This is a dynamic website that demonstrates a MySQL one-to-many relationship. It is geared towards hair solon owners. They can add stylists to the site, and for each stylist, add clients. The user can also update or delete both a stylist and clients (CRUD functionality).  
<img src="/web/img/screenshot.png" alt="a screenshot of the website">

## MySQL Commands
* mysql.server start
* mysql -uroot -proot
* SELECT DATABASE();
* SHOW DATABASES;
* CREATE DATABASE hair_salon;
* USE hair_salon;
* CREATE TABLE stylists (id serial PRIMARY KEY, name VARCHAR (255));
* DESCRIBE stylists;
* CREATE TABLE clients (id serial PRIMARY KEY, name VARCHAR (255), stylist_id INT);
* DESCRIBE clients;
* (started apache and copied database in phpmyadmin called hair_salon_test)
* SHOW DATABASES;

## Setup/Installation Requirements

* Clone the repository
* Using the command line, navigate to the project's root directory
* Install dependencies by running $ composer install
* Start MySQL by running the command $ /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot
* Start Apache by running the command $ apachectl start
* Import the MySQL file from localhost:8080/phpmyadmin/
* Navigate to the /web directory and start a local server with $ php -S localhost:8000
* Open a browser and go to the address http://localhost:8000 to view the application

## Known Bugs

There are no known bugs at this time.

## Support and Contact Details

For questions or comments, please contact me through GitHub.

## Technologies Used

* _PHP_
* _Silex_
* _Twig_
* _Bootstrap_
* _MySQL_

### License

*This website is licensed under the MIT license.*  
Copyright (c) 2016 **_Aimen Khakwani_**
