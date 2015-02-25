#!/bin/bash
. app.properties
echo "Stop databases..."
docker stop $MONGOCONT 
docker stop $MYSQLCONT
 
