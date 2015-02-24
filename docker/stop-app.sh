#!/bin/bash

. app.properties
echo "Stop application"
docker stop $MONGOCONT 
docker stop $MYSQLCONT
docker stop $APPFULLCONT
 
