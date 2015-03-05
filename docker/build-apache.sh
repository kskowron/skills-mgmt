#!/bin/bash

. functions.sh

echo "APACHE Removing old containers and images....."
#stop containers if running
REMOVEApache


#remove images
REMOVEIMAGEApache

echo "APACHE Removing old containers and images..DONE!"

#create directory for data
docker build -t jarek/apache apache

# run server images
echo DONE! Apache server is build.
