### Despues de Descargar de github
Ejecute los siguientes comandos en orden

composer install
composer update

### crear el archivo .env con las siguientes configuraciones

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=to-do
DB_USERNAME=root
DB_PASSWORD=

###

php artisan key:generate
php artisan storage:link
composer dump-autoload
php artisan migrate
php artisan serve

### acerca del projecto

## Ecosistema de la técnologia
Se utilizo Eloquent una herramienta integrada en el framework de laravel para simplificar la interacción con la base de datos al proporcionar una capa de abstracción orientada a objetos. Esto permite escribir consultas de base de datos de manera más intuitiva y legible, lo que ahorra tiempo y reduce la posibilidad de cometer errores.

Eloquent y la validación de datos en Laravel siguen convenciones y buenas prácticas de desarrollo, lo que ayuda a mantener un código limpio y consistente en toda la aplicación. las validaciones se pueden encontrar de formar ejemplificada en el UserController para validar la creación de usuario, login, etc.

## Autenticación y Control de Acceso
Para esto se uso la libreria Passport, para generar tokens de acceso para los usuarios que se van Registrando en el sistema.

El middleware de autenticación (auth) en Laravel se utiliza para proteger las rutas de acceso no autorizado. Cuando se aplica el middleware auth a una ruta o grupo de rutas, Laravel verifica si el usuario ha iniciado sesión. Si el usuario no ha iniciado sesión, Laravel redirige al usuario a la página de inicio de sesión o bloquea su uso hasta haber ingresado la auth en la cabezera de la solicitud http. 

La combinación de middleware y autenticación (auth) en Laravel ofrece varios beneficios:

Protección de rutas sensibles: Puedes proteger las rutas que requieren autenticación para acceder, asegurando que solo los usuarios autenticados puedan ver su contenido.

Control de acceso: Laravel proporciona una forma fácil de controlar el acceso a diferentes partes de tu aplicación basado en roles y permisos.

Seguridad: Al proteger las rutas con autenticación, reduces el riesgo de accesos no autorizados a partes sensibles de tu aplicación.

