<p align="center"><img src="https://cdn.techinasia.com/data/images/490749de1d15816f72ef0eebdb7b02b2.png" width="200"></p>


# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)


Clone the repository

    git clone https://github.com/alisyahbana/kiostix-api-test.git

Switch to the repo folder

    cd kiostix-api-test

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Generate a new JWT authentication secret key

    php artisan jwt:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate --seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

## 7. Get Books By Title 

Request List of books by title

path
```http
POST /api/books/title
```

payload
```javascript
{
  "title" : string
}
```

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `title` | `string` | **Required**. title of books |

response
```javascript
  [
    {
        "id" : integer,
        "title" : string,
        "author_id" : integer,
        "category_id" : integer,
        "created_at" : timestamp,
        "updated_at" : timestamp,
    }
  ]
```

## 8. Get Books By Author 

Request List of books by Author Name

path
```http
POST /api/books/author
```

payload
```javascript
{
  "name" ;: string
}
```

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `name` | `string` | **Required**. name of author |

response
```javascript
  [
    {
        "id" : integer,
        "title" : string,
        "author_id" : integer,
        "category_id" : integer,
        "created_at" : timestamp,
        "updated_at" : timestamp,
    }
  ]
```

## 9. Get Books By Category 

Request List of books with author by Category Name

path
```http
POST /api/books/category
```

payload
```javascript
{
  "name" : string
}
```

| Parameter | Type | Description |
| :--- | :--- | :--- |
| `name` | `string` | **Required**. name of category |

response
```javascript
  [
    {
        "id" : integer,
        "title" : string,
        "author_id" : integer,
        "category_id" : integer,
        "created_at" : timestamp,
        "updated_at" : timestamp,
        "author_name" : string
    }
  ]
```
