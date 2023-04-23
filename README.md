<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

</p>

## Acerca del Proyecto

Este es un Proyecto de Prueba como parte del proceso de reclutamiento para la empresa a la que aplico. El mismo consta de la realización de un aplicativo que, a travéz de un CRUD RESTFUL, permita la creación de tareas, actualizacíon, eliminar y cambiar el estado de las mismas. Con un front-end amigable y reactivo al usuario. Se proporció un esquema de como debía ser la parte visual y los requerimientos del mismo.
Para este proyecto se utiliza la versión de Laravel 8.12 y se complementa con el framework de front-end Livewire 2.12.

### Requisitos del sistema (Versión Laravel 8.12):
- Versión PHP 7.4.5
- composer ^2.0
- git ^2.0

### Pasos a seguir para su instalación:
- Asegurarse de que el servidor donde se alojará el proyecto cumpla con los requicitos de las versiones indicadas. 
- Una vez posicionado dentro del servidor y en la ruta deseada, clonar este proyecto desde su repositorio en gitHub: [https://github.com/ArturoAtencio/prueba-millicom](https://github.com/ArturoAtencio/prueba-millicom). Para esto, ejecute el comando: `git clone git@github.com:ArturoAtencio/prueba-millicom.git`.
- Se recomienda posicionarse sobre la rama mas actualizada del proyecto, en este caso: *`develop`*
- Una vez clonado el proyecto, acceder a la carpeta del mismo: `cd prueba-millicom`. (o el nombre de carpeta designado cuando se clonó el mismo).
- Dentro del proyecto, debe ejectuar los siguientes comandos:
    - **`composer install`** (Para que composer instale las dependencias de la aplicación automaticamente).
    - **`composer update`** (Para verificar que los paquetes necesarios, estén actualizados).
    - **`composer dump-autoload`** (Verifica y re-gerena el archivo `autoload.php` en la carpeta vendor).
- Configurar dentro del servidor la ruta y la ip deseadas (archivo hosts) para hacer visible esta aplicación. En mi caso, yo utilicé **Vagrant**, con el ambiente de desarrollo **Homestead**, una maquina virtual basada en Linux Ubuntu, recomendada por los creadores del framework. En caso de usar xampp u otro similar, configurar el htdocs.
- Levantar el servidor y probar la aplicación en el browser mediante el url o ip predefinidos.

### Configuraciones extras:
- Se debe crear la base de datos a la que apuntará la aplicacion. En la siguiente sección se muestran los pasos a seguir.
- Luego, se debe configurar el archivo `.env` e indicarle las credenciales correctas que apunten a la base de datos (ip, base de datos, usuario y contraseña).
- Una vez creada la base de datos, y se deben correr las migraciones de la aplicación para que esta genere las tablas necesarias. Adicional, se insertan registros a las tablas mediante seeders. Comando a seguir: `php artisan migrate --seed`. Con esto se generaran las tablas y los seeders se encargaran de insertar unos pocos datos iniciales, con proposito demostrativo.
- Ya con esto, hemos terminado la instalación del proyecto.

### Configuracion de base de datos:
- Una vez posicionados sobre el servidor que alojará la base de datos, se deben seguir los siguientes comandos:
    - **`mysq -u:[su usario] -p[su contraseña (opcional)]`** (Con esto ingresamos a la consola de *MYSQL*).
    - **`CREATE DATABASE prueba_millicom;`** (Creamos la base de datos con el nombre deseado).
    - **`show databases;`** (Nos permite revisar todas las bases de datos en el sistema, y confirmamos que se haya creado la nuestra).
    - **`use prueba_milicom; [O el nombre establecido]`** (Nos posiciona sobre la base de datos creada).
- A continuación, la creación de los *Store Procedures*:

    - Primero el de crear tarea:
    - **`DELIMITER // ;`**
    - **`Create PROCEDURE SP_insert_task(IN p_title varchar(100), IN p_user_id int, IN p_completed int)`** 
    - **`BEGIN`**
    - **`insert into tasks(title, user_id, completed) values(p_title, p_user_id, p_completed);`** 
    - **`END`**

    - Segundo el de actualziar tarea:
    - **`DELIMITER // ;`**
    - **`Create PROCEDURE SP_update_task(IN p_id int, IN p_title varchar(100), IN p_user_id int, IN p_completed int)`** 
    - **`BEGIN`**    
    - **`UPDATE tasks`**
    - **`SET`**
    - **`title=p_title, user_id=p_user_id, completed=p_completed WHERE id=p_id;`**
    - **`END`**

    - Tercero el de eliminar tarea:
    - **`DELIMITER // ;`**
    - **`Create PROCEDURE SP_delete_task(IN p_id int)`**
    - **`BEGIN `**
    - **`DELETE from tasks`**
    - **`WHERE id=p_id;`**
    - **`END //`**

- Con estos hemos terminado la creacion de la base de datos y los store procedures requeridos.
- ***Nota aclaratoria***: En los requerimientos se solicitaban 4 Store Procedures, entre ellos un SP para Actualizar y otro SP para modificar, pero solo se crearon 3 ya que el *`sp_update_task()`* sirve para ambas funcionalidades.

# ¡Muchísimas Gracias!
