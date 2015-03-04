#!/bin/bash

. app.properties

echo "Start application"
. start-db.sh

docker start $APPFULLCONT

 
