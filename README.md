# Laravel API - Challenge: API de Gestión de Contenido para un CMS Modular

API RESTful en PHP para un sistema CMS modular que permita la gestión de artículos, categorías y usuarios.

- **Laravel 12**: Framework base.
- **JWT Auth**: Autenticación JWT (php-open-source-saver/jwt-auth).
- **Blueprint**: Generación acelerada de código y estructuras.
- **Pest**: Testing simple.

## Pasos para Levantar el Proyecto

1. **Instalar dependencias de PHP:**
   ```bash
   composer install
   ```

2. **Configurar el entorno:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Configurar JWT (Token Secret):**
   ```bash
   php artisan jwt:secret
   ```

4. **Base de Datos:**
   Prepara tu base de datos (por defecto SQLite en `database/database.sqlite` o configura tu `.env`) y corre las migraciones:
   ```bash
   php artisan migrate
   ```

5. **Verificar que todo funcione (Tests):**
   Ejecuta la suite de pruebas con Pest:
   ```bash
   php artisan test
   ```
