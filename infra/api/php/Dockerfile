FROM ubuntu:14.04

MAINTAINER Johann Saunier <johann_27@hotmail.fr>

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get install -y php5-common
RUN apt-get install -y php5-cli
RUN apt-get install -y php5-fpm
RUN apt-get install -y php5-mcrypt
RUN apt-get install -y php-pear
RUN apt-get install -y php5-mysql
RUN apt-get install -y php5-apcu
RUN apt-get install -y php5-gd
RUN apt-get install -y php5-imagick
RUN apt-get install -y php5-curl
RUN apt-get install -y php5-intl
RUN apt-get install -y php5-redis
RUN apt-get install -y php5-imap
RUN apt-get install -y php5-json
RUN apt-get install -y php5-dev
RUN apt-get install -y supervisor
RUN apt-get install -y git

# Install AMQP
RUN apt-get install -y pkg-config librabbitmq-dev
RUN cd /usr/lib && \
    git clone git://github.com/alanxz/rabbitmq-c.git && \
    cd rabbitmq-c && \
    git checkout v0.5.2 && \
    git submodule init && \
    git submodule update && \
    autoreconf -i && \
    ./configure && \
    make && \
    make install \
/

RUN pecl install amqp
RUN echo "extension=amqp.so" > /etc/php5/mods-available/amqp.ini
RUN php5enmod amqp

# Install mongo
RUN pecl install mongo
RUN echo "extension=mongo.so" > /etc/php5/mods-available/mongo.ini
RUN php5enmod mongo

# Install libevent
RUN apt-get install -y libevent-dev
RUN printf "\n" | pecl install channel://pecl.php.net/libevent-0.1.0
RUN echo "extension=libevent.so" > /etc/php5/mods-available/libevent.ini
RUN php5enmod libevent

# Download and install wkhtmltopdf
RUN apt-get install -y build-essential xorg libssl-dev libxrender-dev wget gdebi
RUN wget http://download.gna.org/wkhtmltopdf/0.12/0.12.2.1/wkhtmltox-0.12.2.1_linux-trusty-amd64.deb
RUN gdebi --n wkhtmltox-0.12.2.1_linux-trusty-amd64.deb

RUN sudo service php5-fpm stop
RUN sudo service supervisor stop

RUN mkdir -p /var/log/php/
RUN touch /var/log/php/php5-fpm.log

ADD php-fpm.ini /etc/php5/fpm/php.ini
ADD php-cli.ini /etc/php5/cli/php.ini
ADD api.pool.conf /etc/php5/fpm/pool.d/api.conf
ADD php-fpm.conf /etc/php5/fpm/php-fpm.conf

ADD supervisord/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
ADD supervisord/php.conf /etc/supervisor/conf.d/php.conf

RUN usermod -u 1000 www-data

RUN supervisorctl start php-fpm

CMD ["/usr/bin/supervisord"]

EXPOSE 9000 9001
