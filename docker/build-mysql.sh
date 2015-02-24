#!/bin/bash

. app.properties

echo "MYSQL Removing old containers and images....."
#stop containers if running
docker stop $MYSQLCONT
docker stop create_schemas
#remove containers
docker rm -f $MYSQLCONT
docker rm -f create_schemas
#remove images
docker rmi -f jarek/mysqldb
echo "MYSQL Removing old containers and images..DONE!"

#create directory for data
rm -r $DATA_DIR/$MYSQLDIR
rm -r $DATA_DIR/$LOGDIR

mkdir $DATA_DIR/$MYSQLDIR
mkdir $DATA_DIR/$LOGDIR

#build images
echo "MYSQL Building base images and database initialization..."
docker build -t jarek/mysqldb mysql

#create  db schemas - first initialize db if not exists
docker run -v $DATA_DIR/$MYSQLDIR:/var/lib/mysql -e MYSQL_PASS=$MYSQLPASS --name create_schemas jarek/mysqldb /create_db.sh $MYSQLSCHEMA
docker rm -f create_schemas

#run server images
docker run -d -p 127.0.0.1:$MYSQLPORT:3306  -v $DATA_DIR/$MYSQLDIR:/var/lib/mysql -e MYSQL_PASS=$MYSQLPASS --name $MYSQLCONT jarek/mysqldb
