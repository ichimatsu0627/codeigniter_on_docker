# CodeIgniter on Docker

![PHP 7.2](https://img.shields.io/badge/PHP-7.2-green.svg)  
![CodeIgniter 3](https://img.shields.io/badge/CodeIgniter-3-orange.svg)  
![MySQL 5.7](https://img.shields.io/badge/MySQL-5.7-blue.svg)  

## Required

- OSX or Linux
- Git
- Docker
- Docker-compose

## Containers

- app
- php
- nginx
- mysql
- phpmyadmin

## Setup

1. Download

```
git clone git@github.com:ichimatsu0627/codeigniter_on_docker.git template.com
```
  
or Zip Download  

2. Change .env

```
vi environment/development/.env
```

- `ENVIRONMENT`: development, testing, production...etc
- `MYSQL_ROOT_PASSWORD`: Root password. required alphabet + number + sybol
- `MYSQL_USER`: Used by Codeigniter
- `MYSQL_PASSWORD`: `MYSQL_USER` password
- `MYSQL_HOST`: MySQL host
- `MYSQL_DATABASE`: Database name
- `PMA_USER`: fix root
- `PMA_PASSWORD`: same `MYSQL_ROOT_PASSWORD`
- `PMA_ARBITRARY`: ?
- `PMA_HOST`: same `MYSQL_HOST`


3. Docker up

```
cd site_container
docker-compose up --build -d
```
  
4. Browse template-ci
  
https://localhost:13000 or `http://{$IP}:13000`

5. Browse PhpMyAdmin
  
https://localhost:13002 or `http://{$IP}:13002`

