#!/bin/bash

. app.properties


echo "Build MYSQL...................................."
. build-mysql.sh
echo "Build MongoDB.................................."
. build-mongo.sh
echo "Build Apache base.............................."
. build-apache.sh
echo "Build Application containers..................."
. build-apps.sh

echo "Created images................................."
docker images 
echo "Created Containers............................."
docker ps -a
echo "Running containers............................."
docker ps

