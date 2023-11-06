![GitHub](https://img.shields.io/github/license/albertguedes/lapong-docker) ![GitHub language count](https://img.shields.io/github/languages/count/albertguedes/lapong-docker) ![GitHub last commit](https://img.shields.io/github/last-commit/albertguedes/lapong-docker)

# LAPONG Docker
#### A Docker development environment with Laravel, PostgreSQL and Nginx ##

This project aims create a minimal viable development environment with Laravel, 
PostgreSQL and Nginx, in minimal docker environment, i.e., less then it, nothing
 work. 

This environment is more simple then Laravel Sail, and LAPONG has PostgresSQL 
natively, while Sail not.

This project is possible thanks the official images for Nginx, PHP and 
PostgreSQL, which do great job.

The scheme is usual: we have 3 containers, each of then with a Nginx, a PHP-FPM 
and a PostgreSQL 
containers and an 'src' folder for the laravel source code. All images use 
[Alpine Linux](https://www.alpinelinux.org) as base system to reduce the size of
containers.

The laravel app can be developed and maintained independently of the project,
and can use your own git repository, what helps to keep the projects clean and 
easy to maintain. 

## Installation

To install the package, clone the repository


```
$ git clone https://github.com/albertguedes/lapong-docker.git
```

goes to the folder project and run the docker compose:


```
$ docker-compose up -d
```


Now, run in your browser the address "http://localhost:8080" to see the laravel 
app.

There are a fresh installation of laravel on src folder where I create a 
'TestController' and a 'test' view page (and respective route '/test' ) where 
you will see the javascript and css in action, both via Nginx, because of the 
PHP-FPM that dont run static files, only php scripts.
This is useful to separate the front and back end of an project.

## Configuration

Each folder - 'db', 'php' and 'webserver' - has a custom dockerfile that you can 
edit to add/remove more options, but as you can see, they have almost anything 
ready to work. 
The official images come with many options enabled by default. See on references 
the documentation on [dockhub](https://dockhub.com) of each image.

The "webserver/nginx" folder has a "default.config", where you can adjust to 
your project. Remember that the nginx is only for shared static files, not to 
execute scripts.

# Scripts and tools

I create too the __dockli__ : a bash script to run the composer and artisan 
commands (and  linux command too) inside php-fpm container, to turn unnecessary 
exec a large and complicated docker command all time.
Just go to the src folder, turn dockli script executable and run it:

```.../src# ./dockli ls```

```.../src# ./dockli composer``` 

```.../src# ./dockli php artisan``` 

Edit and customize the script as you wish.

## References

- Docker Documentation : [https://docs.docker.com/](https://docs.docker.com/)
- Nginx Documentation: [https://nginx.org/en/docs/](https://nginx.org/en/docs/)
- PHP FPM Documentation: [https://www.php.net/manual/en/install.fpm.php](https://www.php.net/manual/en/install.fpm.php) 
- Laravel Documentation: [https://laravel.com/docs/](https://laravel.com/docs/)
- PostgreSQL Documentation: [https://www.postgresql.org/docs/current/index.html](https://www.postgresql.org/docs/current/index.html)
- Docker images:
    - nginx: [https://hub.docker.com/_/nginx](https://hub.docker.com/_/nginx)
    - php: [https://hub.docker.com/_/php](https://hub.docker.com/_/php)
    - postgresql: [https://hub.docker.com/_/postgres](https://hub.docker.com/_/postgres)
