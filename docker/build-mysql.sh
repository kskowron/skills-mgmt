#!/bin/bash

. functions.sh

# Application have to be rebuild after db containers rebuild
REMOVEFront
REMOVEBack

echo "MYSQL Removing old containers and images....."
REMOVEMySQL
REMOVEContainer create_schemas
REMOVEIMAGEMySQL
echo "MYSQL Removing old containers and images..DONE!"

#build images
echo "MYSQL Building base images and database initialization..."
docker build -t jarek/mysqldb mysql

CREATEDBMySQL
RUNMySQL

