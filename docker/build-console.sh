#!/bin/bash

. app.properties

echo "Removing old console containers....."
#stop containers if running
docker stop $APPCONSOLECONT
#remove containers
docker rm -f $APPCONSOLECONT

echo "Removing old console containers..DONE!"

echo Now you can have an acess to the console typing `docker start $APPCONSOLECONT`
echo Please run ./yii migrate after container is started...
docker run -it --name $APPCONSOLECONT --link $MYSQLCONT:$MYSQLCONT --link $MONGOCONT:$MONGOCONT jarek/apache_full /bin/bash


