#!/bin/bash

. app.properties
echo "Stop application"
docker stop $APPFULLCONT
. stop-db.sh

