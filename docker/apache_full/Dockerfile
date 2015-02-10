FROM jarek/apache
MAINTAINER Jarosław Kozak <jaroslaw.kozak68@hmail.com>

#add aplication
ADD tmp/app.tar /app

# COPY skills.conf /etc/apache2/conf-enabled/
EXPOSE 80
WORKDIR /app
CMD ["/run.sh"]
