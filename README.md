# Descargar el código del proyecto

```bash
git clone https://github.com/padawansoftware/Blog.git
```

# Hacer que el dominio apunte a nuestro localhost (solo local)

```bash
127.0.0.1 blog.padawansoftware.local admin.blog.padawansoftware.local api.blog.padawansoftware.local media.blog.padawansoftware.local
```


# Configurar docker

Para facilitar la instalación del entorno, el proyecto se integra con docker y docker-compose. Si quieres hacer uso de ellos, deberás de tenerlos instalados.

En caso de que desees configurar el entonrno para tus necesidades, este es el momento. Dadas las particularidades de cada entorno, se definen dos ficheros docker-compose.yml, uno para el entono local y otro para el resto de entornos. Algunas de las diferencias son:

* Cuando se despliega en entorno local, se realiza el mapeo de algunos puertos al host en el que se ejecuta docker.
* Algunos contenedores, como es el caso de node, se mantienen activos para poder trackear y reconstruir los cambios que se realizan en los ficheros.

Además de estas diferencias, para cada entorno se define un fichero `docker/configs/{environment}.env`en los que se almacenan variables de entorno que serán pasadas a docker-compose cuando levante el proyecto.

# Instalar Magallanes

El proyecto integra el despliegue con la herramienta Magallanes, por lo que es necesario al menos el intérprete de PHP. Para instalarlo, ejecutar:

En el entorno local

```bash
bin/composer install`
```

En el resto de entornos

```bash
bin/composer install --no-dev
```


# Configurar mage.yml y crear los directorios

Modificar el fichero mage.yml para editar aspectos como el usuario que realiza el despliegue, el host de la instalación o la ruta en la que se despliega el proyecto. Revisar la configuración en:

https://www.magephp.com

Es necesario que los directorios en los cuales se despliega el proeyecto existan previamente. En el caso del entorno local no es necesario crear nada, ya que no se copiará el código a otro directorio.

# Instalar nginx-proxy y crear red de docker (solo entornos)

Si vamos a tener varios entornos instalados en el mismo anfitrión, es necesario recurrir a un proxy como punto único de entrada. Se recomienda utilizar la imagen de docker [nginx-proxy](https://github.com/jwilder/nginx-proxy). Esta imagen, utiliza una red para comunicarse con los contenedores docker, por ello es necesario crearla primero:

```bash
docker network create nginx-proxy
```

# Desplegar proyecto

Para desplegar el proyecto con magallanes, es necesario indicar el entorno:

```bash
bin/mage deploy ${environment}
```

Por defecto, los entornos configurados son:
* ***local***: utilizado para desarrollo en local
* ***development***: utilizado para provar el desarrollo
* ***preproduction***: utilizado para validar el desarrollo previo al paso a producción
* ***production***: utilizado en producción

# Ejecutar tareas de inicio

Desde el directorio de docker:

```bash
docker-compose exec php /root/bin/setup.sh
docker-compose exec media /root/bin/setup.sh
```

# Crear primer usuario
Para poder acceder al administrador, es necesario un usuario y constraseña, para ello hay que realizar manualmente un insert en la table User. El password está cifrado, por lo que es aconsejable utilizar el comando de symfony security:encode-password:

```bash
docker-compose exec php /var/www/admin/symfony/bin/console security:encode-password {password}
```