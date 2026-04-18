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

# Eliminar el /app/public vacio de la imagen base, copiar codigo
# directo a /app y symlinkear /app/public -> /app para que
# FrankenPHP encuentre los archivos con su default SCRIPT_FILENAME.
RUN rm -rf /app/public
WORKDIR /app
COPY . /app/
RUN ln -s /app /app/public

EXPOSE 8080
