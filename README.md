# News-Aggregator

## Setup Instructions

### Prerequisites
- Ensure you have [PHP](https://www.php.net/downloads) installed (Recommended: PHP 8.x).
- Install [Composer](https://getcomposer.org/download/).
- Install [Laravel](https://laravel.com/docs/).
- Ensure you have [Docker](https://docs.docker.com/get-docker/) installed.
- Install [Docker Compose](https://docs.docker.com/compose/install/).

### Running the Laravel Project
1. Clone this repository:
   ```bash
   git clone https://github.com/AINS11/News-Aggregator.git
   cd News-Aggregator
   ```
2. Install dependencies using Composer:
   ```bash
   composer install
   ```
3. Copy the environment file and set up your configuration:
   ```bash
   cp .env.example .env
   ```
4. Generate the application key:
   ```bash
   php artisan key:generate
   ```
5. Run database migrations:
   ```bash
   php artisan migrate --seed
   ```
6. Start the development server:
   ```bash
   php artisan serve
   ```
7. Access the application at:
   ```
   http://localhost:8000
   ```

### Running the Docker Environment
1. Pull the required Docker images:
   ```bash
   docker pull shubhamahire393/news-aggregator-phpmyadmin
   docker pull shubhamahire393/news-aggregator-db
   docker pull shubhamahire393/news-aggregator-node
   docker pull shubhamahire393/news-aggregator-app
   ```
2. Start the containers using Docker Compose:
   ```bash
   docker-compose up -d
   ```
3. Verify the containers are running:
   ```bash
   docker ps
   ```
4. Access the application at:
   ```
   http://localhost:8000
   ```
To stop the containers, run:
```bash
   docker-compose down
```

### Steps to Follow if Errors Occur After Pulling from Docker
1. Enter the application container:
   ```bash
   docker exec -it news-aggregator-app bash
   ```
2. Install required PHP extensions:
   ```bash
   docker-php-ext-install pdo pdo_mysql
   ```
3. Re-run database migrations:
   ```bash
   php artisan migrate:fresh
   ```
4. Exit the container:
   ```bash
   exit
   ```
5. Restart the application container:
   ```bash
   docker restart news-aggregator-app
   ```

### Unit Testing
Run the following command to execute unit tests:
```bash
php artisan test
```

### Enabling Scheduling
To enable scheduling that fetches data every minute, run:
```bash
php artisan run:scheduler
```

## API Documentation
- [MediaStack API](https://mediastack.com/documentation)
- [NewsAPI](https://newsapi.org/docs/endpoints/everything)
- [The Guardian API](https://open-platform.theguardian.com/documentation)

