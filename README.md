# 🐘 PHP Backend — Desarrollo Web en Entorno Servidor

Colección de proyectos PHP del módulo **Desarrollo Web en Entorno Servidor** (2º DAW): desde formularios y sesiones hasta CRUD con PDO, POO y generación de PDF.

---

## ⭐ Proyectos destacados

| Proyecto | Qué demuestra | Carpeta |
|----------|---------------|---------|
| **CRUD de productos con PDO** | Patrón Repository, consultas preparadas, `FETCH_CLASS` | `ejercicioclase/SQL/` |
| **Miniforo** | Separación `app/` y `web/`, plantillas, `.htaccess`, análisis de texto con UTF-8 | `ejercicioclase/Miniforo/` |
| **Generación de PDF** | Composer + mPDF | `pdfejemplo/` |
| **Bicis eléctricas** | Lectura y procesado de CSV, POO | `ejercicioclase/BiciElectrica/` |
| **Casino / Frutería** | Flujo de varias páginas con sesiones | `ejercicioclase/casino_v0/`, `ejercicioclase/fruteria/` |
| **Sesiones y cookies** | Contador de visitas, sesiones temporales | `cockies/` |

<!-- TODO: añade 2-3 capturas (miniforo, CRUD, PDF generado) -->

## 🛠️ Stack

**PHP 8 · MySQL · PDO · Composer · mPDF · HTML5 / CSS3 · Apache (XAMPP)**

## 🚀 Ejecutar en local

```bash
git clone https://github.com/3r4yn/php-backend-daw.git
# Copia la carpeta a htdocs de XAMPP o lanza el servidor embebido:
cd php-backend-daw
php -S localhost:8000

# Para el ejemplo de PDF, instala las dependencias:
cd pdfejemplo && composer install
```

Para el CRUD, importa el script SQL y ajusta las credenciales de conexión en el archivo correspondiente.

## 🧠 Decisiones técnicas

- **Consultas preparadas con `bindValue`** en todo el acceso a datos para evitar inyección SQL.
- **Patrón Repository** (`ProductoRepository`): la lógica SQL vive en una sola clase y el resto del código trabaja con objetos `Producto`.
- **`PDO::FETCH_CLASS`** para mapear filas directamente a objetos, sin arrays intermedios.
- **Tipado de retorno** (`: bool`, `: int`, `: string`) y funciones `mb_*` para tratar bien tildes y eñes.
- **Dependencias con Composer:** `vendor/` queda fuera del repositorio y se instala con `composer install`.

## 👤 Autor

**Brayan** — Estudiante de 2º DAW · [GitHub](https://github.com/3r4yn)
