
# README - Despliegue Symfony con Docker (Apache)

## Requisitos

- Docker instalado ([https://docs.docker.com/get-docker/](https://docs.docker.com/get-docker/))
- Docker Compose instalado ([https://docs.docker.com/compose/install/](https://docs.docker.com/compose/install/))
- (Opcional) WSL2 si usas Windows ([https://learn.microsoft.com/en-us/windows/wsl/install](https://learn.microsoft.com/en-us/windows/wsl/install/))

---

## Estructura recomendada de Docker

- `Dockerfile` para la imagen PHP + Symfony + Apache
- `docker-compose.yml` para servicios: PHP+Apache, base de datos (MySQL o Postgres), etc.

---

## Ejemplo básico de `docker-compose.yml`

```yaml
version: '3.8'

services:
  web:
    build:
      context: .
      dockerfile: Dockerfile
    container_name: symfony_web
    volumes:
      - ./:/var/www/html
    ports:
      - "8080:80"
    environment:
      APP_ENV: dev
    depends_on:
      - db

  db:
    image: mysql:8.0
    container_name: symfony_db
    environment:
      MYSQL_ROOT_PASSWORD: rootpassword
      MYSQL_DATABASE: symfony
      MYSQL_USER: symfony
      MYSQL_PASSWORD: symfony
    ports:
      - "3306:3306"
    volumes:
      - db_data:/var/lib/mysql

volumes:
  db_data:
```

---

## Ejemplo básico de `Dockerfile`

```dockerfile
FROM php:8.2-apache

# Instalar extensiones necesarias para Symfony
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git \
    && docker-php-ext-install zip pdo_mysql

# Habilitar mod_rewrite de Apache (necesario para Symfony)
RUN a2enmod rewrite

# Copiar configuración de Apache personalizada si tienes (opcional)
# COPY docker/apache/symfony.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

EXPOSE 80
CMD ["apache2-foreground"]
```

---

## (Opcional) Configuración Apache (`docker/apache/symfony.conf`)

```apache
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot /var/www/html/public

    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

---

## Comandos útiles

```bash
# Construir las imágenes y levantar contenedores
docker-compose up -d --build

# Ver logs del contenedor web
docker-compose logs -f web

# Acceder al contenedor para ejecutar comandos
docker exec -it symfony_web bash

# Instalar dependencias Symfony dentro del contenedor
composer install

# Ejecutar migraciones
php bin/console doctrine:migrations:migrate

# Parar contenedores
docker-compose down
```

---

## Acceso a la aplicación

Después de levantar el contenedor, la app será accesible en:  
[http://localhost:8080](http://localhost:8080)
