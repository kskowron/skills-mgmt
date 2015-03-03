#!/bin/bash

. app.properties

#Nedeed for selinux enabled hosts
chcon -Rt svirt_sandbox_file_t $DATA_DIR

#create directory for data
rm -r $DATA_DIR/$MONGODIR
mkdir $DATA_DIR/$MONGODIR

#create directory for data
rm -r $DATA_DIR/$MYSQLDIR
rm -r $DATA_DIR/$LOGDIR

mkdir $DATA_DIR/$MYSQLDIR
mkdir $DATA_DIR/$LOGDIR

