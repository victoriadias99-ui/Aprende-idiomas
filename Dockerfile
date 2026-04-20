FROM dunglas/frankenphp:latest

# Extensiones PHP requeridas por el proyecto
RUN install-php-extensions \
    pdo \
    pdo_mysql \
    mysqli \
    curl \
    mbstring \
    intl \
    opcache \
    gd \
    zip

# Copiar configs de performance ANTES del source para cachear el layer
COPY Caddyfile /etc/frankenphp/Caddyfile
COPY php.ini /usr/local/etc/php/conf.d/zz-app.ini

# Source del proyecto
RUN rm -rf /app/public
WORKDIR /app
COPY . /app/
RUN ln -s /app /app/public

EXPOSE 8080
