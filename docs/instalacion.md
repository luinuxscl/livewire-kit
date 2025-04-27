# Instalación

Sigue estos pasos para instalar LikePlatform:

1. Clona el repositorio:
   ```bash
   git clone https://github.com/luinuxscl/livewire-kit.git
   ```
2. Entra al directorio del proyecto:
   ```bash
   cd livewire-kit
   ```
3. Instala dependencias de PHP y JavaScript:
   ```bash
   composer install
   npm install && npm run dev
   ```
4. Copia el archivo `.env.example` a `.env` y configura tus variables de entorno:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
5. Configura la base de datos en el archivo `.env`.
6. Ejecuta las migraciones:
   ```bash
   php artisan migrate
   ```

¡Listo! El proyecto debería estar funcionando en `http://localhost:8000` tras ejecutar:

```bash
php artisan serve
```
