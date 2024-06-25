## Library inventory

### Install

- Clone the git repository into the working directory

``` git@github.com:petrina/test_2024_06_24.git ```

- Create database
- Create a .env file based on the example and change the database connection in it. Example:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library
DB_USERNAME=root
DB_PASSWORD=password
```

- Install composer

``` composer install ```

- Run migration

``` php artisan migrate ```

- Optional. Change permissions for a folder `storage`

```  sudo chmod -R 777 storage ```

- Create Auth keys for users

``` php artisan passport:client --personal ```

This is done so that the first user becomes an administrator

- Fill the database

``` php artisan db:seed ```


- Start Web server

``` php artisan serve ```

### Usage

All requests are sent in json format

#### Registration

POST ```/api/registration```

Request

```
{
    "name": "John Doe",
    "email": "johndo222e@example.com",
    "password": "password",
    "password_confirmation": "password"
}
```

Response

```
{ "registration": "success" }
```

#### Authorization

POST ```/api/login```

Request

```
{ 
    "email": "johndo222e@example.com",
    "password": "password"
} 
```

Response

You receive a bearer token, which must be inserted into all requests in the Authorization header with next format:

``` Authorizarion: Bearer YOUR_TOKEN ```

Users have two types of roles - reader and admin. The reader has the right to take and return books. Admin has full rights.

#### Authors

CRUD ```/api/authors```

to show what fields exist, creation is shown as an example

POST ```/api/authors```

Request

```
{
    "name": "someName" ,
    "surname" : "someSurname"
}
```

#### Books

CRUD ```/api/books```

to show what fields exist, creation is shown as an example

POST ```/api/books```

Request

```
{
    "title" : "book",
    "description" : "description",
    "author_ids" : [4]
}
```
If the database does not contain the required author, you can create it along with the book. In this case the request will look like this

```
{
    "title" : "book",
    "description" : "description",
    "author_ids" : [10000],
    "author_name" : "testName",
    "author_surname" : "testSurName"

}
```

#### Copy Book

CRUD ```/api/copy_book```

to show what fields exist, creation is shown as an example

POST ```/api/copy_book```

Request

```
{
    "book_id" : 1, 
    "inventory_no" : "Some_Inventory_Number"
}
```

#### Give the book to the reader

POST ```/api/book_state/give```

Request

```
{
    "copy_book_id" : 1,
    "user_id" : 1
}
```

#### Returning a book to the library

POST ```/api/book_state/return```

Request

```
{
    "copy_book_id" : 1
}
```
