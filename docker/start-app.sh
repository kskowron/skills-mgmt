#!/bin/bash

. app.properties
echo "Start application"
docker start $MONGOCONT 
docker start $MYSQLCONT
docker start $APPFULLCONT
 
