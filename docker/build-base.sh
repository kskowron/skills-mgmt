#!/bin/bash

. app.properties

echo "Build MYSQL...................................."
. build-mysql.sh
echo "Build MongoDB.................................."
. build-mongo.sh
echo "Build Apache base.............................."
. build-apache.sh
echo "Build Apache full.............................."
. build-full.sh
echo "Build console application......................"
. build-console.sh

echo "Created images................................."
docker images 
echo "Created Containers............................."
docker ps -a
echo "Running containers............................."
docker ps

