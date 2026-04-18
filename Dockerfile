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

# Copiamos el codigo a /app/public porque es el docroot default
# de FrankenPHP. WORKDIR /app/public para el COPY.
WORKDIR /app/public
COPY . /app/public/

EXPOSE 8080
