FROM ubuntu:14.04

RUN apt-get update && apt-get install -y nginx

ADD nginx.conf /etc/nginx/
ADD api.conf /etc/nginx/sites-available/

RUN ln -s /etc/nginx/sites-available/api.conf /etc/nginx/sites-enabled/api

RUN rm /etc/nginx/sites-enabled/default
RUN echo "upstream php-api-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf

CMD ["nginx"]

EXPOSE 80
