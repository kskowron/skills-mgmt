FROM jarek/apache
MAINTAINER Jarosław Kozak <jaroslaw.kozak68@hmail.com>

#add aplication
ADD tmp/app.tar /app

# please create properties file with exchangeServer=your.exchange.owa.serwer
# or change app configuration to use plain authentication
COPY ./tmp/properties.txt /app/common/config/properties.txt

ADD front.sh /front.sh
ADD back.sh /back.sh

RUN chmod 755 /*.sh

# COPY skills.conf /etc/apache2/conf-enabled/
EXPOSE 80
WORKDIR /app
CMD ["/front.sh"]
