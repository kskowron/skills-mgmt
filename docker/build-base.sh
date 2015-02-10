#!/bin/bash

. app.properties

echo "Removing old containers and images....."
#stop containers if running
docker stop $MONGOCONT
docker stop $MYSQLCONT
docker stop $APACHECONT
docker stop create_schemas
#remove containers
docker rm -f $MONGOCONT
docker rm -f $MYSQLCONT
docker rm -f $APACHECONT
docker rm -f create_schemas
#remove images
docker rmi -f jarek/mongodb
docker rmi -f jarek/mysqldb
docker rmi -f jarek/apache
echo "Removing old containers and images..DONE!"

#create directory for data
rm -r $DATA_DIR/$MYSQLDIR
rm -r $DATA_DIR/$MONGODIR
rm -r $DATA_DIR/$LOGDIR

mkdir $DATA_DIR/$MYSQLDIR
mkdir $DATA_DIR/$MONGODIR
mkdir $DATA_DIR/$LOGDIR


#build images
echo "Building base images and database initialization..."
docker build -t jarek/mongodb mongo
docker build -t jarek/mysqldb mysql
docker build -t jarek/apache apache

#create  db schemas - first initialize db if not exists
docker run -v $DATA_DIR/$MYSQLDIR:/var/lib/mysql -e MYSQL_PASS=$MYSQLPASS --name create_schemas jarek/mysqldb /create_db.sh $MYSQLSCHEMA
docker rm -f create_schemas

#run server images
docker run -d -p 127.0.0.1:$MYSQLPORT:3306  -v $DATA_DIR/$MYSQLDIR:/var/lib/mysql -e MYSQL_PASS=$MYSQLPASS --name $MYSQLCONT jarek/mysqldb
docker run -d -p 127.0.0.1:$MONGOPORT:27017 -v $DATA_DIR/$MONGODIR:/data/db --name $MONGOCONT jarek/mongodb
docker run -d -p 127.0.0.1:$APACHEPORT:80 --name $APACHECONT --link $MYSQLCONT:$MYSQLCONT --link $MONGOCONT:$MONGOCONT jarek/apache
echo Apache server is not running please build separately


echo "Build images.."
docker images 
echo "Containers..."
docker ps -a
echo "Running containers"
docker ps

