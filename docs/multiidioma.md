# Estado actual del desarrollo de la funcionalidad multiidioma (Abril 2025)

---

## Objetivo
Implementar un selector de idioma robusto que permita cambiar entre español e inglés, persistiendo la preferencia del usuario y aplicando el idioma en toda la aplicación (incluyendo Livewire y navegación SPA).

---

## Estado actual
- **La funcionalidad de cambio de idioma NO está operativa de forma robusta.**
- El selector de idioma existe y emite eventos correctamente.
- Se intentó persistir el idioma en la sesión, en localStorage y en una cookie, pero ninguna opción logró sincronizar el idioma de manera confiable entre frontend y backend en todos los contextos.
- El middleware `SetLocale` está implementado y probado para leer tanto de la sesión como de la cookie `locale`.
- El log confirma que el idioma nunca cambia en el backend, a pesar de los intentos desde el frontend.

---

## Resumen de intentos y enfoques probados
1. **Persistencia en sesión:**
   - Se guardó el idioma en `session(['locale' => $lang])` desde el selector y desde una ruta dedicada (`/set-locale/{lang}`).
   - El middleware `SetLocale` lee de la sesión.
   - El idioma nunca se actualiza en la sesión entre requests.

2. **Persistencia en localStorage + sincronización con backend:**
   - Se guarda el idioma en localStorage y se intenta sincronizar con el backend mediante fetch/redirección.
   - El backend nunca refleja el cambio de idioma en la sesión.

3. **Uso de cookie `locale`:**
   - Se escribe una cookie desde JS y el middleware la lee con `$request->cookie('locale', ...)`.
   - El backend sigue sin reflejar el cambio de idioma.

4. **Redirección forzada tras el cambio de idioma:**
   - Se intentó forzar recarga/redirección tras actualizar localStorage/cookie.
   - El backend sigue sin reflejar el cambio.

5. **Logs y depuración:**
   - Se añadieron logs detallados en el middleware y en la ruta de sincronización.
   - El log muestra que el idioma nunca cambia en el backend, aunque el evento de cambio de idioma sí se dispara en el frontend.

---

## Posibles causas del bug
- Problemas con la persistencia de la sesión de Laravel (driver, cookies, dominio, permisos, etc).
- Restricciones de la versión de Livewire o su modo SPA.
- El navegador podría estar bloqueando cookies o la sesión.
- Algún otro middleware o configuración de Laravel que sobreescribe/restablece el locale.

---

## Decisión
Se suspende el desarrollo de esta funcionalidad hasta nuevo aviso. **El bug y los intentos quedan documentados para futuras referencias.**

---

## Próximos pasos sugeridos
- Revisar la configuración de sesión y cookies de Laravel en el entorno local y de producción.
- Probar el flujo en otro entorno/servidor limpio.
- Considerar una solución basada únicamente en frontend si la persistencia de sesión/cookie sigue fallando.
- Actualizar este documento si se retoma el desarrollo o se encuentra una solución.

---

> Última actualización: 2025-04-27
> Responsable: Equipo de desarrollo
