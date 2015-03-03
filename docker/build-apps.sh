#!/bin/bash

. app.properties

echo "Please ensure that database containers are up and running..."
echo "Removing old containers and images..."

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

#build console app
#You can customize it e.g. include console dir 

echo "Starting application containers..."
echo You can stop/start container using command: docker start/stop $APPFULLCONT
docker run -d -p $IP_APACHE:80 --name $APPFULLCONT --link $MYSQLCONT:$MYSQLCONT --link $MONGOCONT:$MONGOCONT jarek/apache_full

echo Now you can have an acess to the console typing `docker exec -it $APPCONSOLECONT /bin/bash`
echo Please run ./yii migrate after container is started...
docker run -d --name $APPCONSOLECONT --link $MYSQLCONT:$MYSQLCONT --link $MONGOCONT:$MONGOCONT jarek/apache_full /bin/bash
