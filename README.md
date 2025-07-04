Claro, aquí tienes todo el contenido del README.md en texto plano para que puedas copiarlo fácilmente:

# Proyecto Symfony - Prueba Técnica

Repositorio: https://github.com/juanrabp24/QuentalTest

---

## Despliegue y configuración en entorno Windows con WSL y Docker

Esta guía describe cómo desplegar y ejecutar el proyecto usando WSL (Ubuntu 22.04 LTS) y Docker Desktop en Windows.

### Requisitos previos

- **Docker Desktop** para Windows  
  Instalar desde:  
  https://docs.docker.com/desktop/setup/install/windows-install/

- **WSL 2 (Subsistema de Windows para Linux)**  
  Recomendado usar Ubuntu 22.04 LTS.

### Configuración previa

1. Reinicia tu ordenador y entra en la BIOS/UEFI para verificar que la virtualización está habilitada (Hyper-V para Intel/AMD).

2. Instala Ubuntu 22.04 LTS desde la Microsoft Store si no lo tienes ya instalado.

---

### Clonar el proyecto

Clona el repositorio utilizando un token de acceso personal de GitHub para evitar problemas de autenticación:

- Crear token en: https://github.com/settings/tokens
- Clonar usando HTTPS con token o SSH según tu configuración.

```bash
git clone https://github.com/juanrabp24/QuentalTest.git
cd QuentalTest

---

### Construir y levantar contenedores Docker

Desde la raíz del proyecto:

bash
docker compose build
```

Para iniciar los contenedores:

```bash
docker compose up -d
```

También puedes arrancar los contenedores desde Docker Desktop si prefieres interfaz gráfica.

---

### Acceder al contenedor PHP/Apache

Para ejecutar comandos dentro del contenedor (como instalar dependencias con Composer):

```bash
docker exec -it symfony_php_apache bash
```

Dentro del contenedor, instala las dependencias de PHP con:

```bash
composer install
```

---

### Configurar acceso local al proyecto

Para acceder al proyecto en el navegador usando el dominio personalizado `quental.test`, añade esta línea al archivo `hosts` de Windows:

```
127.0.0.1 quental.test
```

* El archivo `hosts` se encuentra en:
  `C:\Windows\System32\drivers\etc\hosts`

* Para editarlo, abre el Bloc de notas o tu editor preferido **como administrador** (clic derecho → Ejecutar como administrador).

* Guarda los cambios.

---

### Abrir el proyecto en el navegador

Finalmente, abre tu navegador y visita:

```
http://quental.test
```

* NOTA: Para editar cualquier parte del codigo si quieres permisos
  `sudo chmod -R 775 var/www/html/QuentalTest`

