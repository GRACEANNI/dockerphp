FROM webdevops/php-nginx:8.2
EXPOSE 80
COPY . /app
RUN chmod 777 /app -R