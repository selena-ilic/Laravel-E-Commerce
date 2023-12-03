#!/bin/bash

# Function to wait for a service to be available
wait_for_service() {
    echo "Waiting for $1:$2..."
    until nc -z -w 1 "$1" "$2"; do
        echo "Waiting for $1:$2..."
        sleep 1
    done
    echo "$1:$2 is available."
}

if [ ! -f vendor/autoload.php ]; then
    composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]; then
    echo "Creating .env file for env $APP_ENV"
    cp .env.example .env
else
    echo "File .env exists."
fi

role=${CONTAINER_ROLE:-app}

if [ "$role" = "app" ]; then
    # Wait for the database to be available
    wait_for_service "$DB_HOST" "$DB_PORT"

    php artisan migrate
    php artisan key:generate
    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear
    php artisan serve --port=$PORT --host=0.0.0.0 --env=.env
    exec docker-php-entrypoint "$@"
fi
