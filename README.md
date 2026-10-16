# Trabajo Práctico N° 2 de Programación III

Trabajo hecho por Atencio Kevin y Bernachea Gabriela, de tercer año de Analisis y desarrollo de Software

Construido con [CodeIgniter 4](https://codeigniter.com) (PHP) + MySQL/MariaDB (XAMPP/LAMPP)

## Requisitos

- XAMPP (Windows) o LAMPP (Linux) con Apache y MySQL/MariaDB
- PHP 8.1 o superior
- [Composer](https://getcomposer.org)
- Git

## Instalación

### 1. Clonar el repositorio dentro de `htdocs`

**Windows**
```
cd C:\xampp\htdocs
git clone https://github.com/G4-crypto-Berna/tp2programacion tp2programacion
cd tp2programacion
```

**Linux**
```
cd /opt/lampp/htdocs
git clone https://github.com/G4-crypto-Berna/tp2programacion tp2programacion
cd tp2programacion
```

### 2. Instalar las dependencias

```
composer install
```

### 3. Configurar la aplicación

Este proyecto **no usa el archivo `.env`**: la configuración se hace directamente en dos archivos de `app/Config/`.

**`app/Config/App.php`**: ajustar la URL base según cómo se acceda al proyecto:

```php
public string $baseURL = 'http://localhost/tp2programacion/public/';
```

Si se usa el servidor de desarrollo de CodeIgniter (`php spark serve`), la URL base es `http://localhost:8080/`.

**`app/Config/Database.php`**: en el arreglo `$default`, completar los datos de conexión:

```php
'hostname' => 'localhost',
'username' => 'root',
'password' => '',          // vacío por defecto en XAMPP/LAMPP
'database' => 'preguntas',
'DBDriver' => 'MySQLi',
```


### 4. Dar permisos a la carpeta `writable/` (solo Linux)

Apache necesita poder escribir en `writable/` (caché, logs y sesiones):

```
mkdir -p writable/cache writable/logs writable/session writable/uploads
sudo chmod -R 775 writable
sudo chown -R $USER:daemon writable
```

### 5. Crear la base de datos con el archivo que se encuentra en app/database/preguntas.sql

Iniciar MySQL (desde el Panel de Control de XAMPP, o en Linux con `sudo /opt/lampp/lampp start`) e importar el esquema:

- **Vía phpMyAdmin:** importar el script `database/preguntas.sql`.
- **Vía consola (Windows):**
```
  C:\xampp\mysql\bin\mysql -u root -e "source C:/xampp/htdocs/tp2programacion/database/preguntas.sql"
```
- **Vía consola (Linux):**
```
  /opt/lampp/bin/mysql -u root -e "source /opt/lampp/htdocs/tp2programacion/database/preguntas.sql"
```

El script crea la base `preguntas` y todas sus tablas si no existen.

### 6. Levantar la aplicación

Con Apache iniciado, entrar a:

```
http://localhost/tp2programacion/public/
```

Alternativa sin Apache, usando el servidor de desarrollo de CodeIgniter:

```
php spark serve
```

(en ese caso, la URL base en `App.php` debe ser `http://localhost:8080/`).

Todo lo que se puede hacer con este sistema web de gestion

- Registro de usuarios con opcion a usar el sitema en modo invitado sin loguearse
- creacion de axamenes guardados por id
- creacion de preguntas sin maximo
- Sorteo de preguntas al azar, con la cantidad definida por el usuario y sin repetir preguntas entre sorteos (con opción de reiniciar el sorteo).


