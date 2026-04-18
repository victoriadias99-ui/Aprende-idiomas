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

WORKDIR /app
COPY . /app/

# Caddyfile custom (root=/app en lugar del default /app/public)
COPY Caddyfile /etc/frankenphp/Caddyfile

EXPOSE 8080
