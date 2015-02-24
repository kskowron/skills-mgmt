#!/bin/bash

. app.properties
echo "Start app console.."
docker exec -it $APPCONSOLECONT /bin/bash 
