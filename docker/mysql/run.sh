#!/bin/bash
/initialize_db.sh 
exec mysqld_safe
