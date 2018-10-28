## Laravel API DDTD (Data Driven Test Development) Demo

<p align="center">
	<img src="https://github.com/programarivm/data-driven-test-development-demo/blob/master/resources/premier-league-logo.png" />
</p>

This is a simple demo that shows how to build a JWT-authenticated REST API from scratch by following a data-driven test development methodology. Let's run a few CRUD operations on the UK Premier League.

For further information please visit:

- [A Data-Driven Test Development (DDTD) Approach with PHPUnit](https://programarivm.com/data-driven-test-development-demo-ddtd-approach-with-phpunit/)

- [Data Driven Test Development Demo](https://github.com/programarivm/data-driven-test-development-demo/blob/master/README.md)

- [Dockerize a Laravel 5 App with PHP-FPM, NGINX and MySQL](https://programarivm.com/dockerize-a-laravel-5-app-with-php-fpm-nginx-and-mysql/)

### Start the Docker Services

    docker-compose up --build

### Install the Dependencies

	docker exec -it --user 1000:1000 football_php_fpm composer install

### Seed the Testing Database

Copy and paste the following variables into your `.env` file:

	DB_CONNECTION=mysql
	DB_HOST=192.168.64.3
	DB_PORT=3306
	DB_DATABASE=football
	DB_USERNAME=football
	DB_PASSWORD=password

Please note, the value of `DB_HOST` is replaced from `127.0.0.1` to `172.26.0.2`, which is the IP of the MySQL container. The `IPAddress` is obtained this way:

	docker inspect football_mysql

Then run:

    docker exec -it --user 1000:1000 football_php_fpm php artisan migrate
	docker exec -it --user 1000:1000 football_php_fpm php artisan db:seed --class=UsersTableSeeder

### Run the Tests

	docker exec -it --user 1000:1000 football_php_fpm php vendor/bin/phpunit

## API Endpoints

### `/auth`

| Method       | Description                                |
|--------------|--------------------------------------------|
| `POST`       | Gets a new access token                    |

Example:

	curl -X POST -H 'Content-Type: application/json' -i http://localhost:8080/api/auth --data '{
	    "username": "bob",
	    "password": "password"
	}'

    {
        "status": 200,
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNTMyMjg2NTIzfQ.Kz1WPilwEqbWevpGGDbVv3smAuzjhsjXtL7lbG4aQXk"
    }

### `/team/create`

| Method       | Description                                |
|--------------|--------------------------------------------|
| `POST`       | Creates a new team                         |

Example:

	curl -X POST -H 'Content-Type: application/json' -i http://localhost:8080/api/team/create --data '{
	    "name": "Arsenal",
	    "location": "Holloway, London",
	    "stadium": "Emirates Stadium",
	    "season": "2017-18"
	}'

    {
      "status": 401,
      "message": "Unauthorized"
    }

Example:

	curl -X POST -H 'Content-Type: application/json' -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNTQwNzUxOTExfQ.3iXVYLfBnUuAlpZJG5b9l_0XPo6dCum8jKNYEV6zbI0' -i http://localhost:8080/api/team/create --data '{
	    "name": "Arsenal",
	    "location": "Holloway, London",
	    "stadium": "Emirates Stadium",
	    "season": "2017-18"
	}'

	{
	  "data": {
	    "name": "Arsenal",
	    "location": "Holloway, London",
	    "stadium": "Emirates Stadium",
	    "season": "2017-18",
	    "updated_at": "2018-10-28 17:41:06",
	    "created_at": "2018-10-28 17:41:06",
	    "id": 42
	  }
	}

### `/team/{season}`

| Method       | Description                                |
|--------------|--------------------------------------------|
| `GET`        | Gets the teams in the given season         |

Example:

    curl -X GET -i http://localhost:8080/api/team/2017-18

    {
        "status": 401,
        "message": "Unauthorized"
    }

Example:

	curl -X GET -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNTQwNzUxOTExfQ.3iXVYLfBnUuAlpZJG5b9l_0XPo6dCum8jKNYEV6zbI0' -i http://localhost:8080/api/team/2017-18

    {
        "status": 200,
        "result": [{
            "id": 1,
            "name": "Arsenal",
            "location": "Holloway, London",
            "stadium": "Emirates Stadium",
            "season": "2017-18"
        }, {
            "id": 2,
            "name": "Bournemouth",
            "location": "Boscombe, Bournemouth",
            "stadium": "Vitality Stadium",
            "season": "2017-18"
        }, {
            "id": 3,
            "name": "Brighton and Hove Albion",
            "location": "Falmer, Brighton and Hove",
            "stadium": "Amex Stadium",
            "season": "2017-18"
        }, {
            "id": 4,
            "name": "Burnley",
            "location": "Burnley",
            "stadium": "Turf Moor",
            "season": "2017-18"
        }, {
            "id": 5,
            "name": "Chelsea",
            "location": "Fulham, London",
            "stadium": "Stamford Bridge",
            "season": "2017-18"
        }, {
            "id": 6,
            "name": "Crystal Palace",
            "location": "Selhurst, London",
            "stadium": "Selhurst Park",
            "season": "2017-18"
        }, {
            "id": 7,
            "name": "Everton",
            "location": "Liverpool",
            "stadium": "Goodison Park",
            "season": "2017-18"
        }, {
            "id": 8,
            "name": "Huddersfield Town",
            "location": "Huddersfield",
            "stadium": "John Smith's Stadium",
            "season": "2017-18"
        }, {
            "id": 9,
            "name": "Leicester City",
            "location": "Leicester",
            "stadium": "King Power Stadium",
            "season": "2017-18"
        }, {
            "id": 10,
            "name": "Liverpool",
            "location": "Liverpool",
            "stadium": "Anfield",
            "season": "2017-18"
        }, {
            "id": 11,
            "name": "Manchester City",
            "location": "Manchester, Greater Manchester",
            "stadium": "Etihad Stadium",
            "season": "2017-18"
        }, {
            "id": 12,
            "name": "Manchester United",
            "location": "Trafford, Greater Manchester",
            "stadium": "Old Trafford",
            "season": "2017-18"
        }, {
            "id": 13,
            "name": "Newcastle United",
            "location": "Newcastle upon Tyne",
            "stadium": "St James' Park",
            "season": "2017-18"
        }, {
            "id": 14,
            "name": "Southampton",
            "location": "Southampton",
            "stadium": "St Mary's Stadium",
            "season": "2017-18"
        }, {
            "id": 15,
            "name": "Stoke City",
            "location": "Stoke-on-Trent",
            "stadium": "bet365 Stadium",
            "season": "2017-18"
        }, {
            "id": 16,
            "name": "Swansea City",
            "location": "Swansea",
            "stadium": "Liberty Stadium",
            "season": "2017-18"
        }, {
            "id": 17,
            "name": "Tottenham Hotspur",
            "location": "Wembley, London",
            "stadium": "Wembley Stadium",
            "season": "2017-18"
        }, {
            "id": 18,
            "name": "Watford",
            "location": "Watford",
            "stadium": "Vicarage Road",
            "season": "2017-18"
        }, {
            "id": 19,
            "name": "West Bromwich Albion",
            "location": "West Bromwich",
            "stadium": "The Hawthorns",
            "season": "2017-18"
        }, {
            "id": 20,
            "name": "West Ham United",
            "location": "Stratford, London",
            "stadium": "London Stadium",
            "season": "2017-18"
        }]
    }

### `/team/update/{id}`

| Method       | Description                                |
|--------------|--------------------------------------------|
| `PUT`        | Updates the given team                     |

Example:

	curl -X PUT -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNTQwNzUxOTExfQ.3iXVYLfBnUuAlpZJG5b9l_0XPo6dCum8jKNYEV6zbI0' -i http://localhost:8080/api/team/update/12 --data '{
	        "location": "Manchester"
	    }'

	{
	  "data": {
	    "id": 12,
	    "name": "Manchester United",
	    "location": "Trafford, Greater Manchester",
	    "stadium": "Old Trafford",
	    "season": "2017-18",
	    "created_at": "2018-10-28 16:35:34",
	    "updated_at": "2018-10-28 16:35:34"
	  }
	}

Example:

	curl -X PUT -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNTQwNzUxOTExfQ.3iXVYLfBnUuAlpZJG5b9l_0XPo6dCum8jKNYEV6zbI0' -i http://localhost:8080/api/team/update/foo --data '{
			"location": "Manchester"
		}'

    {
      "status": 400,
      "message": "Bad Request"
    }

Example:

	curl -X PUT -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNTQwNzUxOTExfQ.3iXVYLfBnUuAlpZJG5b9l_0XPo6dCum8jKNYEV6zbI0' -i http://localhost:8080/api/team/update/7848765 --data '{
	        "location": "Manchester"
	    }'

    {
      "status": 404,
      "message": "Not Found"
    }

### `/team/delete/{id}`

| Method       | Description                                |
|--------------|--------------------------------------------|
| `DELETE`     | Deletes the given team                     |

Example:

	curl -X DELETE -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNTQwNzUxOTExfQ.3iXVYLfBnUuAlpZJG5b9l_0XPo6dCum8jKNYEV6zbI0' -i http://localhost:8080/api/team/delete/1

    {
      "status": 200,
      "message": "Team successfully deleted"
    }

Example:

	curl -X DELETE -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNTQwNzUxOTExfQ.3iXVYLfBnUuAlpZJG5b9l_0XPo6dCum8jKNYEV6zbI0' -i http://localhost:8080/api/team/delete/foo

    {
      "status": 400,
      "message": "Bad Request"
    }

Example:

	curl -X DELETE -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MiwiZXhwIjoxNTQwNzUxOTExfQ.3iXVYLfBnUuAlpZJG5b9l_0XPo6dCum8jKNYEV6zbI0' -i http://localhost:8080/api/team/delete/7848765

    {
      "status": 404,
      "message": "Not Found"
    }

## Contributions

Contributions are welcome.

- Feel free to send a pull request
- Drop an email at info@programarivm.com with the subject "Laravel API DDTD Demo"
- Leave me a comment on [Twitter](https://twitter.com/programarivm)
- Say hello on [Google+](https://plus.google.com/+Programarivm)

Many thanks.
