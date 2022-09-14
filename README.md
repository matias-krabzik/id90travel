## Id90Travel Challenge

### Inicializar el proyecto

Ejecutar: 

```
composer install 
composer dump-autoload
php -S localhost:8881 -t public/
```

### Utilización

Ingresar a http://localhost:8881/, seleccionar la aerolínea, ingresar el usuario y contraseña. 
Al estar autenticado, se muestra el formulario para la búsqueda de Hoteles, completar los filtros y realizar la búsqueda. 

### Ejecutar los tests

```
./vendor/bin/phpunit
```
