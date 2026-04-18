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

# El puerto se configura via la env var SERVER_NAME del servicio
# en Railway (sintaxis de Railway: ${{PORT}}) no aqui, porque ENV
# en Dockerfile se evalua en build-time donde $PORT no existe.
EXPOSE 80
