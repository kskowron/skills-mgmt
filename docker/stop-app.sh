#!/bin/bash

. app.properties
echo "Stop application"
docker stop $APPCONSOLECONT
docker stop $APPFULLCONT
. stop-db.sh

