# Comandos Artisan `likeplatform`

Esta documentación describe los comandos personalizados con prefijo `likeplatform:` ubicados en `app/Console/Commands`.

---

## likeplatform:root

**Descripción:**
Crear o actualizar un usuario con rol `root`. Este comando marca automáticamente el correo del usuario como verificado.

**Firma:**
```
php artisan likeplatform:root {name?} {email?} {password?}
```

**Parámetros:**
- `name` (opcional): Nombre del usuario. Si no se proporciona, se solicitará interactivamente.
- `email` (opcional): Correo electrónico. Si no se proporciona, se solicitará interactivamente.
- `password` (opcional): Contraseña. Si no se proporciona, se solicitará de forma segura.

**Comportamiento:**
- Crea un nuevo usuario o actualiza uno existente con el correo proporcionado
- Establece automáticamente `email_verified_at` con la fecha/hora actual
- Asigna el rol `root` al usuario
- La contraseña se hashea automáticamente antes de guardarse

**Ejemplo de uso interactivo:**
```bash
php artisan likeplatform:root
```

**Ejemplo con parámetros:**
```bash
php artisan likeplatform:root "Juan Pérez" juan@ejemplo.com "MiContraseñaSegura123"
```

**Nota:** Los usuarios creados con este comando no necesitan verificar su correo electrónico, ya que se marcan automáticamente como verificados.

---

## likeplatform:user:list

**Descripción:**
Listar en consola todos los usuarios que tienen un rol específico.

**Firma:**
```
php artisan likeplatform:user:list {role?}
```

**Parámetros:**
- `role` (opcional): Nombre del rol a filtrar. Si se omite, se pregunta en tiempo de ejecución.

**Ejemplo:**
```bash
php artisan likeplatform:user:list admin
```

---

## likeplatform:db:backup

**Descripción:**
Genera un respaldo de la base de datos y lo guarda en `storage/app/backups`.

**Firma:**
```
php artisan likeplatform:db:backup {connection?}
```

**Parámetros:**
- `connection` (opcional): Nombre de la conexión definida en `config/database.php`. Por defecto usa la conexión `default`.

**Ejemplo:**
```bash
php artisan likeplatform:db:backup mysql
```

---

## likeplatform:db:list-backups

**Descripción:**
Muestra una tabla con los archivos de respaldo existentes en `storage/app/backups`.

**Firma:**
```
php artisan likeplatform:db:list-backups
```

**Ejemplo:**
```bash
php artisan likeplatform:db:list-backups
```
