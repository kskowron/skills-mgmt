#!/bin/bash

. app.properties


STOPContainer(){
  if [ "$(docker ps | grep $1)" != "" ] 
	then
	echo "$1 stopping container..."
        docker stop $1
        echo "$1 container stopped. DONE!"
  fi
}

STARTContainer(){
  if [ "$(docker ps | grep $1)" == "" ] 
	then
	echo "$1 starting container..."
        docker start $1
        echo "$1 container started. DONE!"
  fi
}


REMOVEContainer() {
    STOPContainer $1
    if [ "$(docker ps -a | grep $1)" != "" ] 
	then
	echo "$1 removing container..."
        docker rm -f $1
        echo "$1 container removed. DONE!"
    fi
}

REMOVEImage() {
    if [ "$(docker images | grep $1)" != "" ] 
	then
	echo "$1 removing image ..."
        docker rmi -f $1
        echo "$1 image removed. DONE!"
    fi
    
}

# MySQL start/stop/run

CREATEDBMySQL() {
    REMOVEContainer create_schemas
    docker run -v $DATA_DIR/$MYSQLDIR:/var/lib/mysql -e MYSQL_PASS=$MYSQLPASS --name create_schemas jarek/mysqldb /create_db.sh $MYSQLSCHEMA
    REMOVEContainer create_schemas
}

RUNMySQL() {
    REMOVEMySQL
    docker run -d -p $IP_MYSQL:$MYSQLPORT:3306  -v $DATA_DIR/$MYSQLDIR:/var/lib/mysql -e MYSQL_PASS=$MYSQLPASS --name $MYSQLCONT jarek/mysqldb
}

STOPMySQL() {
    STOPContainer $MYSQLCONT
}

STARTMySQL() {
    STARTContainer $MYSQLCONT
}

REMOVEMySQL(){
    REMOVEContainer $MYSQLCONT
}

REMOVEIMAGEMySQL(){
    REMOVEImage jarek/mysqldb
}


# MongoDB start/stop/run

RUNMongo() {
    REMOVEMongo
    docker run -d -p $IP_MONGO:$MONGOPORT:27017 -v $DATA_DIR/$MONGODIR:/data/db --name $MONGOCONT jarek/mongodb
}

CREATEDBMongo() {
    REMOVEContainer create_mongo
    docker run  -v $DATA_DIR/$MONGODIR:/data/db --name create_mongo jarek/mongodb /create_users.sh $MONGOADMIN $MONGOADMINPASS $MONGODB $MONGODBUSER $MONGODBUSERPASS
    REMOVEContainer create_mongo
}

STOPMongo() {
    STOPContainer $MONGOCONT
}

STARTMongo() {
    STARTContainer $MONGOCONT
}

REMOVEMongo() {
    REMOVEContainer $MONGOCONT
}

REMOVEIMAGEMongo() {
    REMOVEImage jarek/mongodb
}

# Applications
RUNFront() {
    REMOVEContainer $APPFRONTCONT
    docker run -d -p $IP_APACHE:$APPFRONTPORT:80 --name $APPFRONTCONT --link $MYSQLCONT:$MYSQLCONT --link $MONGOCONT:$MONGOCONT jarek/apache_full /front.sh
}

RUNBack() {
    REMOVEContainer $APPBACKCONT
    docker run -d -p $IP_APACHE:$APPBACKPORT:80 --name $APPBACKCONT --link $MYSQLCONT:$MYSQLCONT --link $MONGOCONT:$MONGOCONT jarek/apache_full /back.sh
}

RUNConsole() {
    docker exec -it $APPFRONTCONT /bin/bash
}


STOPFront() {
    STOPContainer $APPFRONTCONT
}

STARTFront() {
    STARTContainer $APPFRONTCONT
}

STOPBack() {
    STOPContainer $APPBACKCONT
}

STARTBack() {
    STARTContainer $APPBACKCONT
}

REMOVEFront() {
    REMOVEContainer $APPFRONTCONT
}

REMOVEBack() {
    REMOVEContainer $APPBACKCONT
}

REMOVEIMAGEApp(){
    REMOVEFront
    REMOVEBack
    REMOVEImage jarek/apache_full
}

# Apache functions

REMOVEApache() {
    REMOVEContainer $APACHECONT
}

REMOVEIMAGEApache() {
    REMOVEFront
    REMOVEBack
    REMOVEImage jarek/apache_full
    REMOVEImage jarek/apache
}

