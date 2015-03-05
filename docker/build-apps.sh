#!/bin/bash

. functions.sh

echo "Please ensure that databases containers are up and running..."
echo "Removing old containers and images..."
#remove images
REMOVEIMAGEApp

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

#You can customize it e.g. include console dir 
echo "Starting application containers..."
echo You can stop/start frontend container using command: docker start/stop $APPFRONTCONT
echo You can stop/start backend container using command: docker start/stop $APPBACKCONT
RUNFront
RUNBack
