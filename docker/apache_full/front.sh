#!/bin/bash
rm -fr /var/www/html && ln -s /app/frontend/web /var/www/html
chown www-data:www-data /app -R
source /etc/apache2/envvars
exec apache2 -D FOREGROUND
