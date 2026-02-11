# Laravel API - Setup Rústico

Proyecto backend construido para velocidad y eficiencia usando:

- **Laravel 12**: Framework base.
- **JWT Auth**: Autenticación segura (php-open-source-saver/jwt-auth).
- **Blueprint**: Generación acelerada de código y estructuras.
- **Pest**: Testing elegante y simple.

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
