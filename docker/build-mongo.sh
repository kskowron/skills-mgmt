#!/bin/bash

. app.properties

# Application have to be rebuild after db containers rebuild
docker stop $APPFULLCONT
docker stop $APPCONSOLECONT

#remove containers
docker rm -f $APPFULLCONT
docker rm -f $APPCONSOLECONT

echo "MongoDB Removing old containers and images....."

#stop containers if running
docker stop $MONGOCONT
docekr stop create_mongo

#remove containers
docker rm -f $MONGOCONT
docker rm -f create_mongo

#remove images
docker rmi -f jarek/mongodb
echo "MongoDB Removing old containers and images..DONE!"

#build images
echo "MongoDB Building base images and database initialization..."

#create mongo db users
docker build -t jarek/mongodb mongo
docker run  -v $DATA_DIR/$MONGODIR:/data/db --name create_mongo jarek/mongodb /create_users.sh $MONGOADMIN $MONGOADMINPASS $MONGODB $MONGODBUSER $MONGODBUSERPASS
docker rm create_mongo

#run server images
docker run -d -p $IP_MONGO:$MONGOPORT:27017 -v $DATA_DIR/$MONGODIR:/data/db --name $MONGOCONT jarek/mongodb


