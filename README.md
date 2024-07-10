
# Book's Ratings Demo Site

A simple site to rate books.




## API Reference

#### Register a new user

```http
  GET /register
```

#### Create a book

```http
  GET /books/create
```

#### Show books

```http
  GET /books
```

#### Show a book by id

```http
  GET /books/${book}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `book`      | `int` | **Required**. Id of book to fetch |


## Run Locally

Clone the project

```bash
  git clone https://github.com/serhiidorn/books.git
```

Install dependencies

```bash
  composer install
```

Copy the .env file

```bash
  cp .env.example .env
```

Change the .env file to ...

```bash
  APP_URL=http://127.0.0.1:8000

  FILESYSTEM_DISK=public

  and DB credentials
```
Generate the app key

```bash
  php artisan key:generate
```
Generate storage link

```bash
  php artisan storage:link
```

Run the migrations

```bash
  php artisan migrate
```

Run the local server

```bash
  php artisan serve
```
    