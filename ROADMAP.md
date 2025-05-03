# Roadmap de componentes

Este documento define el plan de trabajo para estandarizar y desarrollar los componentes de la aplicación.

- [ ] Etapa 1: Definición de estilos y tokens de diseño
  - [x] 1.1: Utilizar tokens de color ya definidos en Tailwind CSS y Flux UI.
  - [x] 1.2: Revisar tipografías y estilos base en `resources/css/app.css`.
  - [x] 1.3: Confirmado: no crear tokens nuevos; uso de Tailwind CSS y Flux UI existentes.
  - [x] 1.4: Revisar configuración de breakpoints de Tailwind CSS (ya definida).
  - [x] 1.5: Documentar tokens existentes en docs de Tailwind y Flux UI.

- [ ] Etapa 2: Auditoría de componentes existentes
  - [x] 2.1: Listar componentes libres de Flux UI disponibles: Button, Dropdown, Icon, Separator, Tooltip.
  - [x] 2.2: Inventariar componentes personalizados actuales: sistema de toast.
  - [x] 2.3: Identificar brechas o carencias: falta componente Card.
  - [x] 2.4: Priorizar desarrollo de Card.

- [ ] Etapa 3: Estandarización de estructura y estilos
  - [x] 3.1: Definir convención de nombres y estructura de carpetas.
  - [x] 3.2: Crear `resources/css/components.css` e importarlo en `resources/css/app.css`.
  - [x] 3.3: Establecer directrices de accesibilidad y contrastes. (descartada)
  - [x] 3.4: Guardar componentes personalizados en `resources/views/components/ui/`.

- [x] Etapa 4: Desarrollo de componentes base
  - [x] 4.1: Desarrollar componente Card en `resources/views/components/ui/card.blade.php`.
  - [x] 4.2: Documentar Card en `/docs/components/card.md`.
  - [x] 4.3: Integrar ejemplos de uso para Card.

- [ ] Etapa 5: Integración y pruebas
  - [x] 5.1: Integrar componentes en páginas de ejemplo.
  - [x] 5.2: Realizar pruebas de usabilidad y accesibilidad. (descartada)
  - [x] 5.3: Ajustar estilos según feedback. (postergada)

- [ ] Etapa 6: Documentación y publicación
  - [x] 6.1: Crear guía de uso de componentes.
  - [x] 6.2: Actualizar docs de personalización.
  - [x] 6.3: Revisar código, pruebas finales y merge.
  - [x] 6.4: Crear resumen de sistema de componentes en `docs/components/COMPONENTS-OVERVIEW.md`.