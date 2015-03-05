#!/bin/bash

. functions.sh

# Application have to be rebuild after db containers rebuild
REMOVEFront
REMOVEBack

echo "MongoDB Removing old containers and images....."
REMOVEMongo

#remove images
REMOVEIMAGEMongo
echo "MongoDB Removing old containers and images..DONE!"

#build images
echo "MongoDB Building base images and database initialization..."
docker build -t jarek/mongodb mongo

#Create empty database
CREATEDBMongo

#run server images
RUNMongo


