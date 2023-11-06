![GitHub](https://img.shields.io/github/license/albertguedes/lapong-docker) ![GitHub language count](https://img.shields.io/github/languages/count/albertguedes/lapong-docker) ![GitHub last commit](https://img.shields.io/github/last-commit/albertguedes/lapong-docker)

# LAPONG Docker - A Docker development environment with Laravel, PostgreSQL and Nginx

This project aims create a minimal viable development environment with Laravel, 
PostgreSQL and Nginx. In the docker, i.e., less then it, nothing work. 
This environment is more simple then Laravel Sail, and Lapong has PostgresSQL 
natively, Sail not.

This project is possible thanks the official images for nginx, php and 
postgresql, which do great job.

The scheme is usual: we have 3 containers with a nginx, a php and a postgresql 
containers and a 'app' folder for the source code in laravel. All images use 
[Alpine Linux](https://www.alpinelinux.org) as base system to reduce the size 
of containers.

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

## Configuration

Each folder - 'db', 'php' and 'webserver' - has a custom dockerfile tha you can 
edit to add more options, but as you can see, they have almost anything ready to
work. 
The official images come with many options enabled by default. See on references 
the documentation on [dockhub](https://dockhub.com) of each image.

The "webserver/nginx" folder has a "default.config", where you can adjust to 
your project.

## References

- Docker Documentation : [https://docs.docker.com/](https://docs.docker.com/)
- Nginx Documentation: [https://nginx.org/en/docs/](https://nginx.org/en/docs/)
- PHP FPM Documentation: [https://www.php.net/manual/pt_BR/install.fpm.php](https://www.php.net/manual/pt_BR/install.fpm.php) 
- Laravel Documentation: [https://laravel.com/docs/](https://laravel.com/docs/)
- PostgreSQL Documentation: [https://www.postgresql.org/docs/current/index.html](https://www.postgresql.org/docs/current/index.html)
- Docker images:
    - nginx: [https://hub.docker.com/_/nginx](https://hub.docker.com/_/nginx)
    - php: [https://hub.docker.com/_/php](https://hub.docker.com/_/php)
    - postgresql: [https://hub.docker.com/_/postgres](https://hub.docker.com/_/postgres)
