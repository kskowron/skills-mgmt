#!/bin/bash

. functions.sh
echo "Stop application"
STOPFront
STOPBack
STOPMySQL
STOPMongo

