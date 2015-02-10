#!/bin/bash

. app.properties

echo "Removing old console containers....."
#stop containers if running
docker stop $APPCONSOLECONT
#remove containers
docker rm -f $APPCONSOLECONT
#remove images
docker rmi -f jarek/apache_full
echo "Removing old console containers..DONE!"

echo Now you can have an acess to the console typing `docker start $APPCONSOLECONT`

docker run -it --name $APPCONSOLECONT --link $MYSQLCONT:$MYSQLCONT --link $MONGOCONT:$MONGOCONT jarek/apache_full /bin/bash


