#!/bin/bash

. app.properties

echo "Removing old containers and images....."
#stop containers if running
docker stop $APPFULLCONT
docker stop $APPCONSOLECONT

#remove containers
docker rm -f $APPFULLCONT
docker rm -f $APPCONSOLECONT
#remove images
docker rmi -f jarek/apache_full
echo "Removing old containers and images..DONE!"

#build images

rm apache_full/tmp/app.tar
tar -cf apache_full/tmp/app.tar -C $SOURCE common  \
		frontend \
		backend \
		console \
		vendor \
		composer.json \
		yii init .bowerrc requirements.php \
		--exclude='web/assets/*' \
		--exclude='runtime/*' \
		--exclude='nbproject' 

docker build -t jarek/apache_full apache_full

echo Please rebuild console application: ./build-console.sh
echo You can stop/start container using command: docker start/stop $APPFULLCONT
docker run -d -p 127.0.0.1:80:80 --name $APPFULLCONT --link $MYSQLCONT:$MYSQLCONT --link $MONGOCONT:$MONGOCONT jarek/apache_full

