# Guía para Ejecutar el Proyecto Symfony

## Requisitos Previos

- **PHP**: Versión 7.4 o superior.
- **Composer**: Gestor de dependencias para PHP.
- **Symfony CLI**: Herramienta de línea de comandos de Symfony.

## Pasos para Ejecutar el Proyecto
### 1. Clonar el Repositorio

Si aún no tienes el repositorio del proyecto, clónalo ejecutando el siguiente comando:

```bash
git clone https://github.com/feliqe/symfony-backend-api.git
cd symfony-backend-api
```
### 2. Instalar las Dependencias del Proyecto

Ejecuta el siguiente comando para instalar todas las dependencias definidas en el archivo composer.json:

```bash
composer install
```

### 3. Activar el Servidor Symfony
Para iniciar el servidor web de Symfony, ejecuta el siguiente comando que se cambio de purto para poder correr ambos proyectos:

```bash
symfony server:start --port=8080
```

### 4. Acceder al Proyecto
Abre tu navegador y accede a:

```bash
[http://localhost:8080]
```
### 5. Detener el Servidor
Para detener el servidor de Symfony, ejecuta:

```bash
symfony server:stop
```

### CRUD API con JSON

El proyecto expone endpoints en formato JSON para realizar operaciones CRUD sobre tasks. Las funciones del controlador consumen estas APIs permitiendo la creación, lectura, actualización y eliminación de tareas en el backend. Cada operación se maneja mediante peticiones HTTP que procesan datos en formato JSON, garantizando una comunicación eficiente entre el cliente y el servidor


