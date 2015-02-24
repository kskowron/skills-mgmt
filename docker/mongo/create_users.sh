#!/bin/bash 

SCRIPT=users.js
LOG="/var/log/mongodb/mongod.log"

echo "MongoDB starting ..... "
mongod > /dev/null 2>&1 &

echo "MongoDB creating users ..."
cat /template.js >& $SCRIPT
echo "use admin;" >> $SCRIPT
echo "db.createUser(\
  {\
    user: \"$1\",\
    pwd: \"$2\",\
    roles: [ \"userAdminAnyDatabase\", \"readWriteAnyDatabase\", \"dbAdminAnyDatabase\" ] 
  }
);" >> $SCRIPT
echo "use $3;" >> $SCRIPT
echo "db.createUser(\
  {\
    user: \"$4\",\
    pwd: \"$5\",\
    roles: [ { role: \"readWrite\", db: \"$3\"} ]\
  }
);" >> $SCRIPT

echo "use admin;" >> $SCRIPT
echo "db.shutdownServer({timeoutSecs: 60});" >> $SCRIPT

mongo --nodb < $SCRIPT

echo "MongoDb DONE!....."

rm $SCRIPT


