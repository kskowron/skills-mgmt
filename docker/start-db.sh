#!/bin/bash

. app.properties
echo "Start databases..."
docker start $MONGOCONT 
docker start $MYSQLCONT
 
