FROM webdevops/php-nginx:8.2
EXPOSE 80
EXPOSE 9000
COPY . /app
RUN chmod 666 /app
CMD ["nginx", "-g", "daemon off;"]
