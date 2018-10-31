FROM nginx:alpine

RUN apk update && apk add bash

RUN apk add openssl

RUN mkdir -p /etc/nginx/ssl
RUN openssl req -subj '/CN=localhost' -x509 -newkey rsa:4096 -nodes -keyout /etc/nginx/ssl/beerapp-key.pem -out /etc/nginx/ssl/beerapp-cert.pem -days 365
