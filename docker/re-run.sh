#!/bin/bash

. app.properties

# Stop containers 
. stop-app.sh

#re-run containers
docker rm $MYSQLCONT
docker run -d -p 127.0.0.1:$MYSQLPORT:3306  -v $DATA_DIR/$MYSQLDIR:/var/lib/mysql -e MYSQL_PASS=$MYSQLPASS --name $MYSQLCONT jarek/mysqldb

docker rm $MONGOCONT
docker run -d -p $IP_MONGO:$MONGOPORT:27017 -v $DATA_DIR/$MONGODIR:/data/db --name $MONGOCONT jarek/mongodb

docker rm $APPFULLCONT
docker run -d -p $IP_APACHE:80 --name $APPFULLCONT --link $MYSQLCONT:$MYSQLCONT --link $MONGOCONT:$MONGOCONT jarek/apache_full

