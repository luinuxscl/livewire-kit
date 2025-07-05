# Configuración de MailerSend para envío de correos

## Requisitos previos
- Tener una cuenta en [MailerSend](https://www.mailersend.com/)
- Tener un dominio verificado en MailerSend
- Tener un token SMTP generado en la sección "Sending" > "SMTP" de tu cuenta de MailerSend

## Configuración en el proyecto

### 1. Configuración de variables de entorno

Actualiza tu archivo `.env` con las siguientes variables:

```env
# Configuración de correo para producción (MailerSend)
MAIL_MAILER=smtp
MAIL_HOST=live.smtp.mailersend.net
MAIL_PORT=587
MAIL_USERNAME=MS_xxxxxxxxx  # Reemplaza con tu token SMTP
MAIL_PASSWORD=your-mailersend-smtp-token  # Reemplaza con tu token SMTP
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@tudominio.com"  # Usa un correo de tu dominio verificado
MAIL_FROM_NAME="${APP_NAME}"
```

### 2. Configuración para desarrollo (opcional)

Para desarrollo, puedes usar Mailtrap. Simplemente descomenta la configuración en tu `.env`:

```env
# Configuración para entorno de desarrollo (Mailtrap)
# MAIL_MAILER=smtp
# MAIL_HOST=sandbox.smtp.mailtrap.io
# MAIL_PORT=2525
# MAIL_USERNAME=your-mailtrap-username
# MAIL_PASSWORD=your-mailtrap-password
# MAIL_ENCRYPTION=tls
# MAIL_FROM_ADDRESS="hello@example.com"
# MAIL_FROM_NAME="${APP_NAME}"
```

## Verificación de la configuración

Puedes verificar que la configuración sea correcta creando un comando de prueba o usando Tinker:

```bash
php artisan tinker
```

Luego, ejecuta:

```php
Mail::raw('Este es un correo de prueba', function($message) {
    $message->to('tu-email@ejemplo.com')
            ->subject('Prueba de correo');
});
```

## Solución de problemas

### Errores comunes

1. **Error de autenticación**
   - Verifica que el token SMTP sea correcto
   - Asegúrate de que el token tenga permisos de envío

2. **Error de dominio no verificado**
   - Asegúrate de que el dominio del correo emisor (MAIL_FROM_ADDRESS) esté verificado en MailerSend

3. **Problemas de conexión**
   - Verifica que el puerto 587 no esté bloqueado por tu firewall
   - Intenta cambiar el puerto a 465 con encriptación SSL

## Mejores prácticas

1. **Seguridad**
   - Nunca compartas tus credenciales SMTP
   - Usa variables de entorno para almacenar credenciales
   - Considera usar un servicio de gestión de secretos en producción

2. **Rendimiento**
   - Usa colas para el envío de correos en producción
   - Configura reintentos automáticos para correos fallidos

3. **Entrega**
   - Configura SPF, DKIM y DMARC para mejorar la entrega
   - Monitorea la tasa de rebote y las quejas de spam

## Recursos adicionales

- [Documentación oficial de MailerSend](https://developers.mailersend.com/)
- [Guía de configuración SMTP de MailerSend](https://www.mailersend.com/help/smtp-relay)
- [Guía de configuración de DNS para correo](https://www.mailersend.com/help/domains)

---

**Nota:** Asegúrate de reemplazar todos los valores de ejemplo con tus credenciales reales antes de desplegar a producción.
