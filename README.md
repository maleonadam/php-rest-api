# PHP REST API

> This is a simple PHP REST API from with no framework.

## Quick Start

Import the myblog.sql file, change the params in the config/Database.php file to your own

## Test the APIs with Postman

After changing the params in the config/Database.php file to your own, test the below APIs with Postman:

### for categories

http://localhost/php-rest-api/api/category/read.php //GET Request
http://localhost/php-rest-api/api/category/read_single.php?id={id} //GET Request
http://localhost/php-rest-api/api/category/create.php //POST Request
http://localhost/php-rest-api/api/category/update.php?id={id} //PUT Request
http://localhost/php-rest-api/api/category/delete.php?id={id} //DELETE Request

### for posts

http://localhost/php-rest-api/api/posts/read.php //GET Request
http://localhost/php-rest-api/api/posts/read_single.php?id={id} //GET Request
http://localhost/php-rest-api/api/posts/create.php //POST Request
http://localhost/php-rest-api/api/posts/update.php?id={id} //PUT Request
http://localhost/php-rest-api/api/posts/delete.php?id={id} //DELETE Request
