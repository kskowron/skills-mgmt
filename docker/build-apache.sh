#!/bin/bash

. app.properties

echo "APACHE Removing old containers and images....."
#stop containers if running
docker stop $APACHECONT
#remove containers
docker rm -f $APACHECONT
#remove images
docker rmi -f jarek/apache
echo "APACHE Removing old containers and images..DONE!"

#create directory for data
docker build -t jarek/apache apache

#run server images
docker run -d -p 127.0.0.1:$APACHEPORT:80 --name $APACHECONT --link $MYSQLCONT:$MYSQLCONT --link $MONGOCONT:$MONGOCONT jarek/apache
echo Apache server is not running please build separately
