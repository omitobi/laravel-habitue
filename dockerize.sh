#!/bin/sh

docker-compose build

docker-compose up -d --remove-orphans

docker-compose exec bundle composer install