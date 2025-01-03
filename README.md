# Velocity Bikes

Velocity Bikes es un ecommerce dedicado a la venta de accesorios, repuestos e indumentaria para motos. Este proyecto incluye funcionalidades tanto para usuarios como para administradores, permitiendo gestionar productos y realizar compras de manera eficiente.

## Tecnologías utilizadas

- **PHP**: Lógica del servidor y conexión a la base de datos.
- **JavaScript**: Interactividad y validaciones del lado del cliente.
- **Bootstrap**: Diseño responsivo y componentes visuales.
- **XAMPP**: Servidor local para PHP y MySQL.
- **MySQL**: Base de datos para almacenar productos, usuarios y pedidos.

## Características principales

### Apartados del sitio web:

1. **Inicio**: Página principal con información destacada, promociones y novedades.
2. **Catálogo**: Listado completo de productos disponibles para la venta.
3. **Contacto**: Formulario para que los usuarios puedan comunicarse con el equipo de soporte.
4. **Login**: Sistema de autenticación para usuarios y administradores.

### Roles:

- **Administrador**:

  - Publicar nuevos productos.
  - Eliminar productos existentes.
  - Gestionar la base de datos de productos.

- **Usuario**:
  - Navegar por el catálogo de productos.
  - Comprar productos.

## Estructura del proyecto

### Frontend

- **Bootstrap** para el diseño y la estructura visual.
- **JavaScript** para la validación de formularios y la interactividad.

### Backend

- **PHP** para la lógica del servidor y procesamiento de datos.
- **MySQL** para almacenar datos de usuarios, productos y pedidos.

### Archivos y carpetas principales

- `index.php`: Página principal del sitio.
- `components/`: Contiene los componentes reutilizables como navbar, footer, y secciones de contenido.
- `resource/`: Archivos JavaScript para funcionalidades específicas como efectos visuales (partículas).
- `assets/css/`: Archivos CSS personalizados.

## Instalación y configuración

### Prerrequisitos

- XAMPP (o cualquier servidor local que soporte PHP y MySQL).

### Pasos

1. Clona este repositorio en tu servidor local:

   ```bash
   git clone https://github.com/tu-usuario/VelocityBikes.git
   ```

2. Copia el proyecto a la carpeta `htdocs` de XAMPP.

3. Importa la base de datos:

   - Accede a `http://localhost/phpmyadmin`.
   - Crea una nueva base de datos llamada `velocitybikes`.
   - Importa el archivo `database/velocitybikes.sql` (incluido en el repositorio).

4. Configura el acceso a la base de datos en el archivo `config.php`:

   ```php
   <?php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'velocitybikes');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ?>
   ```

5. Inicia el servidor de XAMPP y accede a `http://localhost/VelocityBikes`.

## Funcionalidades destacadas

- **Gestor de productos**: Permite al administrador publicar y eliminar productos.
- **Sistema de login**: Diferenciación entre usuarios y administradores.
- **Carrito de compras**: Los usuarios pueden agregar productos y realizar pedidos.
- **Interfaz responsiva**: Diseño adaptable a distintos dispositivos gracias a Bootstrap.

## Capturas de pantalla

_(Incluir capturas de pantalla del proyecto si están disponibles.)_

## Contribución

Si deseas contribuir a este proyecto:

1. Realiza un fork del repositorio.
2. Crea una rama para tu nueva funcionalidad:
   ```bash
   git checkout -b nueva-funcionalidad
   ```
3. Realiza tus cambios y haz commit:
   ```bash
   git commit -m "Agregada nueva funcionalidad"
   ```
4. Envía un pull request.

## Licencia

Este proyecto está bajo la licencia MIT. Consulta el archivo `LICENSE` para más detalles.

---

**Autor:** Miguel S. Jimenez V.  
Para más información, contáctanos en la sección de Contacto del sitio web.
