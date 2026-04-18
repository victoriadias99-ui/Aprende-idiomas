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

# FrankenPHP sirve desde /app/public por defecto
WORKDIR /app/public
COPY . /app/public/

# Railway proporciona $PORT dinamicamente. Sintaxis de Caddy
# ({$VAR:default}) se resuelve en runtime, a diferencia de ENV
# con expansion de shell que se evalua solo en build time.
ENV SERVER_NAME=":{$PORT:80}"
