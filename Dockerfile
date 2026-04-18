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
# en Railway. Usamos 8080 porque Railway routea a ese puerto por
# defecto cuando no hay target port explicito seteado.
EXPOSE 8080
