# Plan de Implementación: Verificación de Email

## Fase 1: Configuración Inicial

- [x] **1.1. Modificar el modelo User**
  - [x] Implementar la interfaz `MustVerifyEmail` en `App\Models\User`
  - [x] Verificar que el trait `Notifiable` esté siendo utilizado
  - [x] Asegurar que el evento `Registered` se dispache después del registro exitoso

- [x] **1.2. Verificar/Actualizar la base de datos**
  - [x] Confirmar que la tabla `users` tenga la columna `email_verified_at`
  - [x] No es necesaria migración adicional (la columna ya existe)

## Fase 2: Rutas y Controladores

- [x] **2.1. Rutas de verificación**
  - [x] Ruta para mostrar aviso de verificación (`verification.notice`) - Ya existía
  - [x] Ruta para manejar la verificación (`verification.verify`) - Ya existía
  - [x] Ruta para reenviar el correo de verificación (`verification.send`) - Agregada

- [x] **2.2. Middleware de protección**
  - [x] Aplicar el middleware `verified` a las rutas que requieran verificación de correo
  - [x] Configurar redirección para usuarios no verificados (configuración por defecto de Laravel)

## Fase 3: Vistas y Notificaciones

- [x] **3.1. Verificar vistas necesarias**
  - [x] Verificada vista existente en `resources/views/livewire/auth/verify-email.blade.php`
  - [x] La vista incluye botón para reenviar el correo de verificación
  - [x] La vista es responsive y sigue el diseño de la aplicación

- [x] **3.2. Personalizar notificaciones**
  - [x] Creada notificación personalizada en `app/Notifications/VerifyEmail.php`
  - [x] Creada plantilla personalizada en `resources/views/emails/verify-email.blade.php`
  - [x] La notificación utiliza la plantilla personalizada

## Fase 4: Configuración de Correo

- [x] **4.1. Configurar variables de entorno**
  - [x] Configuración de Mailtrap en `.env`
    ```
    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=4d73054987d90c
    MAIL_PASSWORD=0c40aeaa67d821
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS="no-reply@example.com"
    MAIL_FROM_NAME="${APP_NAME}"
    ```
  - [x] Configurada dirección de correo del remitente

- [x] **4.2. Probar el envío de correos**
  - [x] Creado comando de prueba: `php artisan test:verification-email email@example.com`
  - [x] Para reenviar el correo: `php artisan test:verification-email email@example.com --resend`
  - [x] Verificar en Mailtrap que los correos se reciben correctamente

## Fase 5: Personalización Avanzada (Opcional)

- [ ] **5.1. Personalizar eventos**
  - Escuchar el evento `Verified` para acciones post-verificación
  - Personalizar el comportamiento del evento `EmailVerificationNotificationSent`

- [ ] **5.2. Crear notificación personalizada**
  - Extender la clase `VerifyEmail` para personalizar el correo
  - Sobrescribir métodos según sea necesario

## Fase 6: Pruebas

- [ ] **6.1. Pruebas manuales**
  - Probar registro de nuevo usuario
  - Verificar recepción del correo
  - Probar el enlace de verificación
  - Verificar acceso a rutas protegidas
  - Probar reenvío de correo de verificación

- [ ] **6.2. Pruebas automatizadas**
  - Crear pruebas unitarias para el flujo de verificación
  - Probar casos de error (enlace expirado, firma inválida, etc.)

## Fase 7: Documentación

- [ ] **7.1. Documentación técnica**
  - Documentar el flujo de verificación
  - Especificar rutas y controladores involucrados

- [ ] **7.2. Guía de usuario**
  - Crear instrucciones para usuarios finales
  - Incluir solución de problemas comunes

## Fase 8: Despliegue

- [ ] **8.1. Configuración de producción**
  - Asegurar que la configuración de correo esté lista para producción
  - Verificar que las URLs de verificación usen HTTPS

- [ ] **8.2. Monitoreo**
  - Configurar alertas para fallos en el envío de correos
  - Monitorear tasas de verificación de usuarios

## Notas Adicionales

- Este plan asume el uso de Laravel 12 con el stack de autenticación predeterminado
- Las tareas opcionales pueden omitirse según las necesidades del proyecto
- Se recomienda realizar pruebas exhaustivas en entorno de desarrollo antes de implementar en producción
