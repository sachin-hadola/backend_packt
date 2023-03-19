
# Packt Assessment (Admin)

A project is about to build a Backend for the bookstore where admin can add, edit, delete the books and customers can search for a book and see the whole details about the book

## Tech Stack

**Programming Language:** PHP

**Framework:** Laravel 9.52.4

**Databse:** MySql


## Installation

Please follow the below steps to install the project

1. Clone the project

  git clone https://github.com/sachin-hadola/backend_packt.git

2. Install dependencies - Run following command

  composer install

3. Copy '.env.example' to '.env'

4. Create database and set your database credentials  in '.env' file

4. Create database tables & add records into database using below command

  php artisan migrate --seed

5. Generate the application key & clear the cache

  php artisan key:generate
  php artisan optimize:clear

6. Start laravel application use below command

 php artisan serve

    
## API Reference

For API use this link : https://docs.google.com/document/d/12E4GhhXWkRnYkqACoFGMLci-HTV2oWla7eJozwzalZ8/edit


