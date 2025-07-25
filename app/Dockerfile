FROM php:8.2-fpm

# 1. Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libsqlite3-dev \
    libcurl4-openssl-dev \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# 2. Instalar extensiones PHP principales
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    zip \
    pdo_mysql \
    mysqli \
    gd \
    mbstring \
    curl \
    pdo_sqlite \
    opcache \
    bcmath \
    exif \
    pcntl \
    xml 

# 3. Configurar soporte CGI (solución al error)
# No se necesita instalar como extensión separada, ya que está integrado
# Pero si necesitas el binario CGI, instálalo así:
# RUN set -eux; \
#     cd /usr/src; \
#     # Descargar fuente de PHP
#     curl -fsSL -o php.tar.xz "https://www.php.net/distributions/php-${PHP_VERSION}.tar.xz"; \
#     tar -xf php.tar.xz -C /usr/src --strip-components=1; \
#     # Configurar y compilar solo el CGI
#     ./configure --disable-all --enable-cgi; \
#     make -j "$(nproc)"; \
#     make install-cgi; \
#     # Limpiar
#     rm -rf /usr/src/php* /tmp/*

# 4. Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# 5. Configurar entorno PHP
RUN { \
    echo 'memory_limit = 256M'; \
    echo 'upload_max_filesize = 64M'; \
    echo 'post_max_size = 64M'; \
    echo 'opcache.enable=1'; \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.max_accelerated_files=10000'; \
    } > /usr/local/etc/php/conf.d/custom.ini

# 6. Definir directorio de trabajo
WORKDIR /var/www/html

# 7. Copiar dependencias de Composer
COPY composer.json composer.lock ./

# 8. Instalar dependencias de Composer
RUN composer install --no-dev --no-scripts --no-autoloader

# 9. Copiar aplicación
COPY . .

# 10. Finalizar configuración
RUN composer dump-autoload --optimize

# FROM php:8.2-fpm

# # 1. Instalar dependencias del sistema (capa estable)
# RUN apt-get update && apt-get install -y \
#     unzip \
#     git \
#     curl \
#     libzip-dev \
#     && docker-php-ext-install zip \
#     && rm -rf /var/lib/apt/lists/*

# # 2. Instalar Composer globalmente (capa estable)
# RUN curl -sS https://getcomposer.org/installer | php -- \
#     --install-dir=/usr/local/bin \
#     --filename=composer

# # 3. Definir directorio de trabajo
# WORKDIR /var/www/html

# # 4. Copiar SOLO archivos de dependencias de Composer
# COPY composer.json composer.lock ./

# # 5. Instalar dependencias de Composer (capa semi-estable)
# RUN composer install --no-dev --no-scripts --no-autoloader

# # 6. Copiar el resto de la aplicación (capa volátil)
# COPY . .

# # 7. Finalizar configuración (autoloader, scripts, etc.)
# RUN composer dump-autoload --optimize


# FROM php:8.2-fpm

# # Instalar dependencias del sistema y Composer
# RUN apt-get update && apt-get install -y \
#     unzip \
#     git \
#     curl \
#     libzip-dev \
#     && docker-php-ext-install zip

# # Instalar Composer globalmente
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# # Definir directorio de trabajo
# WORKDIR /var/www/html