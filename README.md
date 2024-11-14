Here’s a `README.md` file to help you document your project setup and usage with Docker and Composer.

---

# Future Driver App

This project is a Symfony-based API Platform application, configured to run in a Docker environment. It leverages PostgreSQL as the database, Redis for caching, and Composer for dependency management. Follow these instructions to set up and run the project locally.

## Prerequisites

Ensure you have the following installed:
- **Docker** and **Docker Compose** for container management.
- **Composer** for managing PHP dependencies.
- **PHP** version 8.2 or higher.

## Project Structure

- **PHP (Symfony)**: Handles the core application logic and API routes, built with [API Platform](https://api-platform.com) and Symfony.
- **Redis**: Caching layer.
- **PostgreSQL**: Main database for application data, with a separate instance for testing.

## Services Overview

The `docker-compose.yml` defines the following services:

- **php**: The main application container, exposing port `8000`.
- **composer_installation**: A one-time setup container that installs Composer dependencies.
- **redis**: Caching server using Redis, exposed on port `6379`.
- **db**: PostgreSQL database for main application data, on port `5432`.
- **db_test**: PostgreSQL database for testing, exposed on port `5433`.

## Installation

1. **Clone the repository** and navigate to the project directory.

   ```bash
   git clone https://github.com/yah-ya/future-driver-challenge.git
   cd future-driver-app
   ```

2. **Build and start the Docker containers**:

   ```bash
   docker-compose up --build
   ```

   This will:
    - Install Composer dependencies.
    - Start the application on [http://localhost:8000](http://localhost:8000).

3. **Set up the environment variables** by creating a `.env.local` file in the root directory, with any necessary overrides:

   ```bash
   cp .env .env.local
   ```

   Configure your PostgreSQL credentials here as follows (replace values if necessary):

   ```env
   DATABASE_URL="postgresql://fd_db:secret@db:5432/fd_db"
   ```

4. **Run database migrations** to set up the initial schema:

   ```bash
   docker-compose exec php php bin/console doctrine:migrations:migrate
   ```

5. **Load fixtures** (optional) to seed the database with sample data:

   ```bash
   docker-compose exec php php bin/console doctrine:fixtures:load
   ```

## Available Commands

### Running Tests

The project includes PHPUnit for testing. Run the following command to execute tests:

```bash
docker-compose exec php php bin/phpunit
```

### Running Console Commands

Symfony Console commands can be run as follows:

```bash
docker-compose exec php php bin/console <command>
```

For example, to clear the cache:

```bash
docker-compose exec php php bin/console cache:clear
```

## Key Dependencies

- **[API Platform](https://api-platform.com/)**: Simplifies API creation, uses OpenAPI, JSON-LD, Hydra, and more.
- **[Doctrine ORM](https://www.doctrine-project.org/)**: Provides robust database handling with entities and migrations.
- **[Nelmio CORS Bundle](https://github.com/nelmio/NelmioCorsBundle)**: Configures CORS headers, essential for cross-origin requests.
- **[Symfony Security Bundle](https://symfony.com/doc/current/security.html)**: Manages role-based access control, with configurations in `config/packages/security.yaml`.
- **[Redis](https://redis.io/)**: Used as a caching layer for optimizing performance.

## Development Guidelines

### Running the Application

To access the application, open [http://localhost:8000](http://localhost:8000) in your browser.

### Setting Up API Endpoints

API endpoints can be configured in `config/routes.yaml` or directly with annotations in the entity classes. To inspect available routes, use:

```bash
docker-compose exec php php bin/console debug:router
```

### Composer Dependencies

Dependencies are defined in `composer.json`, with notable packages such as:
- **symfony/console**: For managing custom commands.
- **symfony/serializer**: Used to serialize and deserialize data in various formats.
- **phpdocumentor/reflection-docblock**: Enhances code documentation capabilities.

### Accessing the Database

- **Main database**: Accessible via `localhost:5432` with credentials as specified in `docker-compose.yml`.
- **Test database**: Accessible via `localhost:5433`.

## Troubleshooting

- **Database errors**: Ensure containers are running, then check `.env.local` for correct database URLs.
- **CORS issues**: Adjust `nelmio_cors` settings in `config/packages/nelmio_cors.yaml`.
- **404 errors on API routes**: Check `config/routes.yaml` and ensure routes are properly defined.

---