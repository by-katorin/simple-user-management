FROM nginx:alpine

COPY ./.docker/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www

CMD ["nginx", "-g", "daemon off;"]