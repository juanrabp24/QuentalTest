FROM mysql:8.0

COPY my.cnf /etc/mysql/conf.d/my.cnf

# Opcional: agregar un script para crear el usuario con permisos remotos
COPY init.sql /docker-entrypoint-initdb.d/init.sql
