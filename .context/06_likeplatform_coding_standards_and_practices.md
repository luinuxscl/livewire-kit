# 06 - Estándares de Codificación y Buenas Prácticas para LikePlatform

Este documento establece las directrices de codificación y las mejores prácticas a seguir durante el desarrollo de LikePlatform, sus módulos y el LSMS. El objetivo es asegurar un código consistente, mantenible, legible y de alta calidad.

## Documentos de Referencia Obligatorios

Todo el desarrollo debe adherirse estrictamente a las convenciones y prácticas descritas en los siguientes documentos proporcionados:

1.  **`convenciones_nomenclatura_laravel.md`**:

    -   Este archivo detalla las convenciones de nomenclatura para todas las partes de la aplicación Laravel, incluyendo:
        -   Controladores (nombres de clase y métodos CRUD).
        -   Modelos Eloquent (nombres de clase, propiedades, métodos, relaciones).
        -   Tablas de Base de Datos (plural, snake_case), columnas (snake_case), claves primarias y foráneas.
        -   Tablas Pivot.
        -   Variables (camelCase).
        -   Traits (adjetivados, PascalCase).
        -   Archivos de Vista Blade (minúsculas, snake_case con guiones o guiones bajos).
        -   Rutas Nombradas.
        -   Archivos de Configuración.
        -   Archivos de Traducción.
        -   Clases de Servicio, Form Requests, Resources, etc.
    -   **Enlace/Contenido:** (Se asume que este archivo está en el mismo directorio de contexto o es accesible por la IA. Si no, su contenido debería ser embebido aquí).

2.  **`laravel_best_practices.md`**:

    -   Este archivo describe un conjunto de mejores prácticas para el desarrollo en Laravel, cubriendo aspectos como:
        -   Principio de Responsabilidad Única (SRP).
        -   Modelos "gordos", controladores "delgados".
        -   Uso de Clases de Servicio para la lógica de negocio.
        -   Validación (uso de Form Requests).
        -   No Repetirse (DRY).
        -   Priorizar Eloquent y Colecciones.
        -   Manejo de asignación en masa.
        -   Evitar consultas en plantillas Blade (problema N+1, carga ansiosa - eager loading).
        -   Uso de Inyección de Dependencias.
        -   Manejo de configuraciones (no usar `env()` directamente fuera de archivos de config).
        -   Formato de fechas y uso de accessors/mutators.
        -   Y otras prácticas recomendadas.
    -   **Enlace/Contenido:** (Misma consideración que el archivo anterior).

3.  **`contexto_creacion_packages.md`**:
    -   Define la información del autor (`Luis Sepulveda`, `luinuxscl`, `lsepulveda@outlook.com`, `https://like.cl`) y la estructura base para el archivo `composer.json` de todos los paquetes desarrollados bajo el vendor `luinuxscl`.
    -   Incluye la licencia (MIT) y consideraciones para la documentación de paquetes.
    -   **Enlace/Contenido:** (Misma consideración).

## Prácticas Adicionales Específicas para LikePlatform

-   **Tipado Estricto en PHP:**
    -   Todas las nuevas clases PHP deben comenzar con `declare(strict_types=1);`.
    -   Utilizar type hinting para parámetros de funciones/métodos y tipos de retorno siempre que sea posible.
-   **Pruebas Automatizadas:**
    -   Escribir pruebas unitarias (PHPUnit/Pest) para clases de servicio, modelos y lógica de negocio crítica.
    -   Escribir pruebas de integración/funcionales para endpoints de API, componentes Livewire y flujos de usuario importantes.
    -   Buscar una cobertura de código razonable.
-   **Formato de Código:**
    -   Utilizar Laravel Pint para formatear automáticamente el código PHP según los estándares de Laravel (PSR-12).
    -   Configurar el IDE para que use Pint al guardar archivos o mediante un hook de pre-commit.
-   **Comentarios de Código:**
    -   Priorizar código auto-documentado (nombres de variables y métodos claros).
    -   Añadir comentarios PHP DocBlocks (`/** ... */`) para todas las clases, métodos públicos y propiedades.
    -   Comentar bloques de lógica compleja o no obvia.
-   **Manejo de Excepciones:**
    -   Utilizar excepciones personalizadas cuando sea apropiado para mejorar la claridad del manejo de errores.
    -   Capturar excepciones específicas en lugar de `\Exception` genérica.
-   **Seguridad:**
    -   Seguir las mejores prácticas de seguridad de OWASP.
    -   Validar todos los datos de entrada (Form Requests).
    -   Escapar la salida para prevenir XSS (Blade lo hace por defecto, pero ser consciente).
    -   Usar Eloquent para prevenir inyección SQL.
    -   Aplicar políticas de autorización (`Gate`, `Policies`) para controlar el acceso a recursos.
-   **Variables de Entorno:**
    -   No confirmar archivos `.env` al repositorio. Utilizar `.env.example`.
    -   Todas las configuraciones sensibles o específicas del entorno deben estar en `.env` y ser accedidas mediante `config()` helpers.
-   **Traducciones (Internacionalización):**
    -   Todo el texto visible para el usuario (incluyendo mensajes de error y validación) debe usar las funciones de traducción de Laravel (`__('file.key')` o `@lang()`) para facilitar la futura internacionalización.
-   **Control de Versiones (Git):**
    -   Seguir un flujo de trabajo Git consistente (ej. GitFlow o GitHub Flow).
    -   Escribir mensajes de commit claros y descriptivos.
    -   Utilizar ramas para nuevas features y bug fixes.
    -   Realizar revisiones de código (Pull Requests).
