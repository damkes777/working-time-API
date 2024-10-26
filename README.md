## SET UP
If vendor directory is not present at root directory of project, execute command:

    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

Copy file `.env.example` to `.env`

Move to the root directory of the project and execute the following command:

    ./vendor/bin/sail up -d