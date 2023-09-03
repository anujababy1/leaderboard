# Leaderboard Application.

A leaderboard application is a digital tool that keeps track of and displays rankings for individuals based on their performance or achievements in a particular competition, game, or activity.

-   This project is built with Vue.js (Vue 3 Options Api) for the frontend and Laravel (version 10) for the backend. The frontend and backend are interconnected through RESTful APIs.

-   Frontend Vue.js single-page application (SPA) incorporates several essential technologies for its development, including `Redux` for state management, `Vue Router` for client-side routing, `Axios` for making HTTP requests, and `Tailwind CSS` for styling and design.

-   The backend Laravel application utilizes Static Token Authentication to enhance the security of the REST APIs, with the incorporation of PHPUnit tests for robust testing.

## Project setup

### Clone the project

```bash
  git clone https://github.com/anujababy1/leaderboard.git
  cd leaderboard
```

### Backend setup (Laravel)

**_Using Docker_**

This project's repository includes Docker configurations. If Docker is installed on your machine, you can run this Laravel application using Docker. Laravel Sail is used for this purpose.

-   Create a `.env` file by copying `.env.example`. Provide the DB credentials and API_TOKEN value.

-   To install the application's dependencies, you can use a Docker container containing PHP and Composer. Run the following command:

    ```bash
        docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v $(pwd):/var/www/html \
        -w /var/www/html \
        laravelsail/php81-composer:latest \
        composer install --ignore-platform-reqs
    ```

-   Run Sail

    ```bash
    ./vendor/bin/sail up -d
    ```

-   Setup Application Key

    ```bash
    ./vendor/bin/sail artisan key:generate
    ```

-   Run database migrations

    ```bash
    ./vendor/bin/sail artisan migrate
    ```

-   Now, the application is available at `http://127.0.0.1:80`, and PHPMyAdmin is accessible at `http://127.0.0.1:8001`

-   To run the unit test test
    ```bash
    ./vendor/bin/sail test
    ```

**_Without Docker_**

If you don't have Docker installed, you will need PHP 8, MySQL, and Composer. You'll also need to install Composer dependencies manually. Alternatively, you can use XAMPP, WAMP, or LAMP for your development environment.

-   Create a `.env` file by copying `.env.example`. Provide the DB credentials and API_TOKEN value.

-   To install dependencies, run
    ```bash
    composer install
    ```
-   To generate an application key, run
    ```bash
    php artisan key:generate
    ```
-   To run migrations, use the command
    ```bash
    php artisan migrate
    ```
-   To start the development server, run
    ```bash
    php artisan serve
    ```
-   The application will be available at `http://127.0.0.1:8000`.

-   To run the tests

    Create a `.env.testing` file by copying `.env.testing.example`. Provide the testing database credentials and an application key inside the .env.testing file.

    Run the migrations for the testing database using the following command
    `     php artisan migrate --env=testing
`

    To run the tests, use the command
    `      php artisan test
`

### Frontend setup (Vue)

**_Using Docker_**

A Vue single-page application (SPA) is placed inside the `vue` directory. This includes Docker configurations.

-   To navigate to the project folder
    ```bash
    cd vue
    ```
-   Create a `.env` file by copying `.env.example`. Inside the environment file, provide the API server URL (backend URL) and API token.

-   Run this command to build the image on your local machine and start the container.
    ```bash
    docker-compose up -d
    ```
-   Install the project dependencies
    ```bash
    docker exec vite_docker npm install
    ```
-   Install the project dependencies
    ```bash
    docker exec vite_docker npm install
    ```
-   Running the Development Server
    ```bash
    docker exec vite_docker npm run dev
    ```
-   Now, the application is available at `http://localhost:8002`

**_Without Docker_**

If you don't have Docker installed, Node.js is required to run the application.

-   To navigate to the project folder
    ```bash
    cd vue
    ```
-   Create a `.env` file by copying `.env.example`. Inside the environment file, provide the API server URL (backend URL) and API token.

-   Install the project dependencies

    ```bash
    npm install
    ```

-   Running the Development Server
    ```bash
    npm run dev
    ```
-   Now, the application is available at `http://localhost:8002`

## API Reference

APIs for all CRUD operations related to competitors.

**Authentication** \
Authentication is required to access the APIs.You need to include an Authorization header with a valid access token in each request.

**Header**\
Accept : application/json\
Authorization : Bearer {token}

**Status Codes**\
200 - Success response (GET requests)\
201 - Success response (POST and PUT requests, indicating the creation of a new resource)\
204 - Success response (DELETE requests, indicating successful removal of a resource)\
500 - Internal server error\
422 - Validation error\
401 - Unauthorized request\
404 - Not found

#### Get all competitors

```http
  GET /api/competitors
```

| Parameter   | Type    | Description                                                                                        | Default     |
| :---------- | :------ | :------------------------------------------------------------------------------------------------- | ----------- |
| search_name | string  | Search by name (Optional)                                                                          | -           |
| order_by    | string  | Sort competitors (Optional) **/** Possible Values are `points-desc,points-asc, name-asc,name-desc` | points-desc |
| per_page    | integer | Number of results per page                                                                         | 10          |
| page        | integer | page of results to fetch                                                                           | 1           |

Request Body : { "search_name": "John", "order_by":"name-asc","per_page": 100,"page": 1}

Response Body :
{ “data”: [...], "total": 500, "per_page": 100, "current_page": 1, "last_page": 4, }

#### Get competitor

```http
  GET /api/competitors/${id}
```

Response Body :
{ "id": 1, "name": "John","age": 34,"address": "Toronto,CA","points": 12,"created_at":"2023-07-07T12:34:56Z",
"updated_at": "2023-07-07T12:34:56Z" }

#### Create competitor

```http
  POST /api/competitors
```

| Parameter | Type    | Description                                                                      |
| :-------- | :------ | :------------------------------------------------------------------------------- |
| name      | string  | **Required**. Competitor name                                                    |
| address   | string  | **Required**. Competitor address                                                 |
| age       | integer | **Required**. Competitor age (should be between 10 and 120)                      |
| points    | integer | **Required**.Points must begin at 0 and are not allowed to have negative values. |

Request Body : { "name": " John" , "address":" Toronto,CA" ,"age":34 ,"points": 12}

Response Body :
{ "id": 1, "name": "John","age": 34,"address": "Toronto,CA","points": 12,"created_at":"2023-07-07T12:34:56Z",
"updated_at": "2023-07-07T12:34:56Z" }

#### Update competitor

```http
  PUT /api/competitors/{id}
```

| Parameter | Type    | Description                                                                                                                         |
| :-------- | :------ | :---------------------------------------------------------------------------------------------------------------------------------- |
| name      | string  | Competitor name. The parameter is optional, but if it exists, it cannot be null.                                                    |
| address   | string  | Competitor address. The parameter is optional, but if it exists, it cannot be null.                                                 |
| age       | integer | Competitor age (should be between 10 and 120) . The parameter is optional, but if it exists, it cannot be null.                     |
| points    | integer | Points must begin at 0 and are not allowed to have negative values. The parameter is optional, but if it exists, it cannot be null. |

Request Body : { "name": " John" , "address":" Toronto,CA" ,"age":12 ,"points" : 32}

Response Body :
{ "id": 1, "name": "John","age": 12,"address": "Toronto,CA","points": 32,"created_at":"2023-07-07T12:34:56Z",
"updated_at": "2023-07-07T12:34:56Z" }

#### Delete competitor

```http
  DELETE /api/competitors/{id}
```
