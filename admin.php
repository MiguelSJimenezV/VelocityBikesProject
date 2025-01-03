<!DOCTYPE html>
<html lang="es" data-bs-theme="auto">

<head>
  <script src="../assets/js/color-modes.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">

  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/blog/">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- libreria de iconos fontawesome-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <!-- CSS -->
  <link rel="stylesheet" href="./assets/css/mod.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.css">



  <!-- Custom styles for this template -->
  <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">

  <title>Velocity Bikes</title>

</head>

<body>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



  <?php
  require_once "class/Productos.php";
  require_once "class/Usuarios.php";
  require_once 'components/navbar.php';


  session_start();

  if (!$_SESSION['id']) {
    header('location: login.php');
    exit();
  }
  if ($_SESSION['rol'] == 0) {
    header('location: index.php');
    exit();
  }

  

  

  // Obtener el catálogo de productos
  $miObjeto = new Productos;
  $Productos = $miObjeto->traer_catalogo();


  // Procesar parámetros de filtrado y ordenado
  $marca = isset($_GET['marca']) ? $_GET['marca'] : null;
  $anio_lanzamiento = isset($_GET['anio_lanzamiento']) ? $_GET['anio_lanzamiento'] : null;
  $orden = isset($_GET['orden']) ? $_GET['orden'] : null;

  // Filtrar según los parámetros recibidos
  if ($marca) {
    $Productos = array_filter($Productos, function ($producto) use ($marca) {
      return $producto->marca === $marca;
    });
  }

  if ($anio_lanzamiento) {
    $Productos = array_filter($Productos, function ($producto) use ($anio_lanzamiento) {
      return $producto->anio_lanzamiento == $anio_lanzamiento;
    });
  }

  // Ordenar según el parámetro recibido

  if ($orden) {
    if ($orden === 'asc') {
      usort($Productos, function ($a, $b) {
        return $a->precio - $b->precio;
      });
    } elseif ($orden === 'desc') {
      usort($Productos, function ($a, $b) {
        return $b->precio - $a->precio;
      });
    }
  }

  ?>
  <div class="container">
    <div class="py-3">
      <h1 class="text-center mb-2 fw-bold">¡Bienvenido/a <?php echo $_SESSION['username'] ?>!</h1>
      <div class="d-flex justify-content-center">
        <button id="logout" class="btn btn-warning  px-4">Cerrar session</button>
      </div>
    </div>

    <div class="bg-dark p-5 text-light rounded-5">
      <h2 class="text-center mb-5">Gestión de Productos</h2>
      <form id="filtrado-ordenado" action="" method="GET">
        <div class="row">
          <div class="col-4">
            <label for="marca" class="form-label">Marca</label>
            <select name="marca" id="marca" class="form-select">
              <option value="">Todas</option>
              <option value="ShockMaster">ShockMaster</option>
              <option value="TechMount">TechMount</option>
              <option value="DryRide">DryRide</option>
              <option value="Aerotech">Aerotech</option>
            </select>
          </div>
          <div class="col-4">
            <label for="anio_lanzamiento" class="form-label">Año de lanzamiento:</label>
            <select name="anio_lanzamiento" id="anio_lanzamiento" class="form-select">
              <option value="">Todos</option>
              <option value="2024">2024</option>
              <option value="2023">2023</option>
              <option value="2022">2022</option>
            </select>
          </div>
          <div class="col-4">
            <label for="orden" class="form-label">Ordenar por Precio:</label>
            <select name="orden" id="orden" class="form-select">
              <option value="">Sin Orden</option>
              <option value="asc">Ascendente</option>
              <option value="desc">Descendente</option>
            </select>
          </div>
        </div>
        <div class="d-flex justify-content-end">
          <button class="btn btn-warning mt-4 px-4" type="submit">Aplicar</button>
        </div>
      </form>
    </div>
  </div>

  <div class="d-flex justify-content-center" id="agregarProducto">
    <button id="agregarProducto" class="btn btn-warning my-3 px-5 py-2"><span class="h4 fw-bold">Agregar
        Producto</span></button>
  </div>
  <div class="p-1">
    <div class="p-3">
      <div class="row">
        <div class="col-12">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Marca</th>
                <th scope="col">Año de lanzamiento</th>
                <th scope="col">Descripción</th>
                <th scope="col">Material</th>
                <th scope="col">Talle disponible</th>
                <th scope="col">Color disponible</th>
                <th scope="col">Cantidad disponible</th>
                <th scope="col">Imagen</th>
                <th scope="col">Categoría</th>
                <th scope="col">Precio</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($Productos as $producto) : ?>
                <tr>
                  <th scope="row"><?= $producto->id ?></th>
                  <td><?= $producto->nombre ?></td>
                  <td><?= $producto->marca ?></td>
                  <td><?= $producto->anio_lanzamiento ?></td>
                  <td><?= $producto->descripcion ?></td>
                  <td><?= $producto->material ?></td>
                  <td><?= $producto->talle_disponible ?></td>
                  <td><?= $producto->color_disponible ?></td>
                  <td><?= $producto->cantidad_disponible ?></td>
                  <td><img class="w-50" src="<?= $producto->imagen ?>"></td>
                  <td><?= $producto->categoria ?></td>
                  <td><?= $producto->precio ?></td>
                  <td>
                    <div class="d-flex justify-content-center">

                      <button class="editar-producto btn btn-warning mt-4" data-id="<?= $producto->id ?>" data-nombre="<?= $producto->nombre ?>" data-marca="<?= $producto->marca ?>" data-anio_lanzamiento="<?= $producto->anio_lanzamiento ?>" data-descripcion="<?= $producto->descripcion ?>" data-descripcion_larga="<?= $producto->descripcion_larga ?>" data-material="<?= $producto->material ?>" data-talle_disponible="<?= $producto->talle_disponible ?>" data-color_disponible="<?= $producto->color_disponible ?>" data-cantidad_disponible="<?= $producto->cantidad_disponible ?>" data-imagen="<?= $producto->imagen ?>" data-categoria="<?= $producto->precio ?>" data-precio="<?= $producto->precio ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Editar</button>
                    </div>

                    <div class="d-flex justify-content-center">
                      <button class="btn btn-warning mt-4" onclick="eliminarProducto(<?= $producto->id ?>)">Eliminar</button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para editar el producto -->
  <div id="modalEditar" class="modal">
    <div class="modal-content bg-dark text-light">
      <h2>Editar Producto</h2>
      <form id="formularioEditar" class="px-5 mt-2 ">
        <!-- Campos de edición -->
        <div class="row">
          <div class="col-6">
            <input type="hidden" id="editId" name="editId" placeholder="ID" class="form-control mb-2">

            <label for="editNombre">Nombre</label>
            <input type="text" id="editNombre" name="editNombre" placeholder="Nombre" class="form-control mb-2">

            <label for="editMarca">Marca</label>
            <input type="text" id="editMarca" name="editMarca" placeholder="Marca" class="form-control mb-2">

            <label for="editAnioLanzamiento">Año de Lanzamiento</label>
            <input type="text" id="editAnioLanzamiento" name="editAnioLanzamiento" placeholder="Año de lanzamiento" class="form-control mb-2">

            <label for="editDescripcion">Descripcion</label>
            <input type="text" id="editDescripcion" name="editDescripcion" placeholder="Descripción" class="form-control mb-2">

            <label for="editDescripcionLarga">Descripcion Larga</label>
            <input type="text" id="editDescripcionLarga" name="editDescripcionLarga" placeholder="Descripción larga" class="form-control mb-2">

            <label for="editMaterial">Material</label>
            <input type="text" id="editMaterial" name="editMaterial" placeholder="Material" class="form-control mb-2">


          </div>
          <div class="col-6">

            <label for="editTalleDisponible">Talle Disponible</label>
            <input type="text" id="editTalleDisponible" name="editTalleDisponible" placeholder="Talle disponible" class="form-control mb-2">

            <label for="editColorDisponible">Color Disponible</label>
            <input type="text" id="editColorDisponible" name="editColorDisponible" placeholder="Color disponible" class="form-control mb-2">

            <label for="editCantidadDisponible">Cantidad Disponible</label>
            <input type="text" id="editCantidadDisponible" name="editCantidadDisponible" placeholder="Cantidad disponible" class="form-control mb-2">

            <label for="editImagen">Ruta de la Imagen</label>
            <input type="text" id="editImagen" name="editImagen" placeholder="Imagen" class="form-control mb-2">

            <label for="editCategoria">Categoria</label>
            <input type="text" id="editCategoria" name="editCategoria" placeholder="Categoría" class="form-control mb-2">

            <label for="editPrecio">Precio</label>
            <input type="text" id="editPrecio" name="editPrecio" placeholder="Precio" class="form-control mb-2">
          </div>
        </div>
        <div class="d-flex justify-content-end">
          <button type="button" id="guardarProducto" name="guardar" class="btn btn-warning px-4">Guardar</button>
        </div>

      </form>
    </div>
  </div>

  <!-- Estilos CSS para el modal -->
  <style>
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
      background-color: white;
      margin: 10% auto;
      padding: 20px;
      width: 80%;
    }
  </style>

  <script>
    // Función para abrir el modal de edición y rellenar los campos con los datos del producto
    $(document).on('click', '.editar-producto', function() {
      // Obtener los datos del atributo data del botón
      var id = $(this).data('id');
      var nombre = $(this).data('nombre');
      var marca = $(this).data('marca');
      var anio_lanzamiento = $(this).data('anio_lanzamiento');
      var descripcion = $(this).data('descripcion');
      var descripcion_larga = $(this).data('descripcion_larga');
      var material = $(this).data('material');
      var talle_disponible = $(this).data('talle_disponible');
      var color_disponible = $(this).data('color_disponible');
      var cantidad_disponible = $(this).data('cantidad_disponible');
      var imagen = $(this).data('imagen');
      var categoria = $(this).data('categoria');
      var precio = $(this).data('precio');

      // Rellenar los campos del formulario con los datos del producto
      $('#editId').val(id);
      $('#editNombre').val(nombre);
      $('#editMarca').val(marca);
      $('#editAnioLanzamiento').val(anio_lanzamiento);
      $('#editDescripcion').val(descripcion);
      $('#editDescripcionLarga').val(descripcion_larga);
      $('#editMaterial').val(material);
      $('#editTalleDisponible').val(talle_disponible);
      $('#editColorDisponible').val(color_disponible);
      $('#editCantidadDisponible').val(cantidad_disponible);
      $('#editImagen').val(imagen);
      $('#editCategoria').val(categoria);
      $('#editPrecio').val(precio);

      // Mostrar el modal
      $('#modalEditar').show();
    });

    // Función para guardar los cambios
    // Controlador de eventos para el botón "Guardar"
    $('#guardarProducto').on('click', function() {
      // Obtener los valores de los campos del formulario
      var id = $('#editId').val();
      var nombre = $('#editNombre').val();
      var marca = $('#editMarca').val();
      var anio_lanzamiento = $('#editAnioLanzamiento').val();
      var descripcion = $('#editDescripcion').val();
      var descripcion_larga = $('#editDescripcionLarga').val();
      var material = $('#editMaterial').val();
      var talle_disponible = $('#editTalleDisponible').val();
      var color_disponible = $('#editColorDisponible').val();
      var cantidad_disponible = $('#editCantidadDisponible').val();
      var imagen = $('#editImagen').val();
      var categoria = $('#editCategoria').val();
      var precio = $('#editPrecio').val();

      // Crear un objeto con los datos a enviar al servidor
      var data = {
        id: id,
        nombre: nombre,
        marca: marca,
        anio_lanzamiento: anio_lanzamiento,
        descripcion: descripcion,
        descripcion_larga: descripcion_larga,
        material: material,
        talle_disponible: talle_disponible,
        color_disponible: color_disponible,
        cantidad_disponible: cantidad_disponible,
        imagen: imagen,
        categoria: categoria,
        precio: precio
      };

      // Enviar la solicitud AJAX al servidor
      $.ajax({
        url: 'guardar_producto.php', // URL del script PHP que procesará la solicitud
        method: 'POST',
        data: data,
        success: function(response) {
          // La solicitud se ha completado con éxito  
          // Cerrar el modal
          $('#modalEditar').hide();
          location.reload();
        },
        error: function(xhr, status, error) {
          // Se produjo un error en la solicitud     
          console.error(error);
        }
      });
    });

    function eliminarProducto(id) {
      if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
        $.ajax({
          type: "POST",
          url: "eliminar_producto.php",
          data: {
            id: id
          },
          success: function(response) {
            // Procesar la respuesta del servidor       
            // Eliminación exitosa
            alert("Producto eliminado correctamente");
            // Actualizar la página o realizar alguna otra acción necesaria
            location.reload();
          },
          error: function() {
            // Error de conexión u otro error en la solicitud AJAX
            alert("Error en la solicitud AJAX");
          }
        });
      }
    }
  </script>


  <!-- Modal Agregar Producto -->
  <div id="modalAgregar" class="modal">
    <div class="modal-content bg-dark text-light">
      <h2>Agregar Producto</h2>
      <form id="formularioAgregar" class="px-5 mt-2 ">
        <!-- Campos de edición -->
        <div class="row">
          <div class="col-6">
            <input type="hidden" id="addId" name="addId" placeholder="ID" class="form-control mb-2">

            <label for="addNombre">Nombre</label>
            <input type="text" id="addNombre" name="addNombre" placeholder="Nombre" class="form-control mb-2">

            <label for="addMarca">Marca</label>
            <input type="text" id="addMarca" name="addMarca" placeholder="Marca" class="form-control mb-2">

            <label for="addAnioLanzamiento">Año de Lanzamiento</label>
            <input type="text" id="addAnioLanzamiento" name="addAnioLanzamiento" placeholder="Año de lanzamiento" class="form-control mb-2">

            <label for="addDescripcion">Descripcion</label>
            <input type="text" id="addDescripcion" name="addDescripcion" placeholder="Descripción" class="form-control mb-2">

            <label for="addDescripcionLarga">Descripcion Larga</label>
            <input type="text" id="addDescripcionLarga" name="addDescripcionLarga" placeholder="Descripción larga" class="form-control mb-2">

            <label for="addMaterial">Material</label>
            <input type="text" id="addMaterial" name="addMaterial" placeholder="Material" class="form-control mb-2">


          </div>
          <div class="col-6">

            <label for="addTalleDisponible">Talle Disponible</label>
            <input type="text" id="addTalleDisponible" name="addTalleDisponible" placeholder="Talle disponible" class="form-control mb-2">

            <label for="addColorDisponible">Color Disponible</label>
            <input type="text" id="addColorDisponible" name="addColorDisponible" placeholder="Color disponible" class="form-control mb-2">

            <label for="addCantidadDisponible">Cantidad Disponible</label>
            <input type="text" id="addCantidadDisponible" name="addCantidadDisponible" placeholder="Cantidad disponible" class="form-control mb-2">

            <label for="addImagen">Ruta de la Imagen</label>
            <input type="text" id="addImagen" name="addImagen" placeholder="Imagen" class="form-control mb-2">

            <label for="addCategoria">Categoria</label>
            <input type="text" id="addCategoria" name="addCategoria" placeholder="Categoría" class="form-control mb-2">

            <label for="addPrecio">Precio</label>
            <input type="text" id="addPrecio" name="addPrecio" placeholder="Precio" class="form-control mb-2">
          </div>
        </div>
        <div class="d-flex justify-content-end">
          <button type="button" id="guardarProducto2" name="guardar" class="btn btn-warning px-4">Guardar</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Abrir modal para agregar producto
    $(document).on('click', '#agregarProducto', function() {
      // Limpiar los campos del formulario
      $('#addNombre').val('');
      $('#addMarca').val('');
      $('#addAnioLanzamiento').val('');
      $('#addDescripcion').val('');
      $('#addDescripcionLarga').val('');
      $('#addMaterial').val('');
      $('#addTalleDisponible').val('');
      $('#addColorDisponible').val('');
      $('#addCantidadDisponible').val('');
      $('#addImagen').val('');
      $('#addCategoria').val('');
      $('#addPrecio').val('');

      // Mostrar el modal
      $('#modalAgregar').show();
    });

    // Guardar producto
    $(document).on('click', '#guardarProducto2', function() {
      // Obtener los valores de los inputs
      var nombre = $('#addNombre').val();
      var marca = $('#addMarca').val();
      var anio_lanzamiento = $('#addAnioLanzamiento').val();
      var descripcion = $('#addDescripcion').val();
      var descripcion_larga = $('#addDescripcionLarga').val();
      var material = $('#addMaterial').val();
      var talle_disponible = $('#addTalleDisponible').val();
      var color_disponible = $('#addColorDisponible').val();
      var cantidad_disponible = $('#addCantidadDisponible').val();
      var imagen = $('#addImagen').val();
      var categoria = $('#addCategoria').val();
      var precio = $('#addPrecio').val();

      // Crear un objeto con los datos a enviar al servidor
      var data = {
        nombre: nombre,
        marca: marca,
        anio_lanzamiento: anio_lanzamiento,
        descripcion: descripcion,
        descripcion_larga: descripcion_larga,
        material: material,
        talle_disponible: talle_disponible,
        color_disponible: color_disponible,
        cantidad_disponible: cantidad_disponible,
        imagen: imagen,
        categoria: categoria,
        precio: precio
      };

      // Realizar la solicitud AJAX para guardar el producto
      $.ajax({
        type: "POST",
        url: "agregar_producto.php",
        data: data,
        success: function(response) {
          // Procesar la respuesta del servidor    
          // Guardado exitoso
          alert("Producto agregado correctamente");
          // Actualizar 
          location.reload();
        },
        error: function() {
          // Error de conexión 
          alert("Error en la solicitud AJAX");
        }
      });
    });

    document.getElementById('logout').addEventListener('click', function() {
      window.location.href = 'logout.php';
    });

    function cerrarSesion() {
      fetch('logout.php', {
          method: 'POST',
        })
        .then(response => {
          if (response.ok) {
            function mostrarPopup(mensaje) {
              Swal.fire({
                icon: 'warning',
                title: 'Desconexión por inactividad',
                text: mensaje,
                showConfirmButton: false,
                timer: 2000 // Tiempo en milisegundos antes de cerrar automáticamente
              }).then((result) => {
                // Redirigir a la página de inicio de sesión después de cerrar el pop-up
                window.location.href = 'login.php';
              });
            }
          } else {
            console.error('Error al cerrar sesión:', response.statusText);
          }
        })
        .catch(error => {
          console.error('Error al cerrar sesión:', error);
        });
    }

    const TIEMPO_INACTIVIDAD = 6000; // 10 minutos
    let tiempoInactivo;

    function resetearTiempoInactivo() {
      clearTimeout(tiempoInactivo);
      tiempoInactivo = setTimeout(() => {
        cerrarSesion();
      }, TIEMPO_INACTIVIDAD);
    }

    function mostrarPopup(mensaje) {
      alert(mensaje); // Mostrar pop-up con el mensaje de desconexión por inactividad
    }

    document.addEventListener('mousemove', resetearTiempoInactivo);
    document.addEventListener('keypress', resetearTiempoInactivo);

    // Llamar a resetearTiempoInactivo al cargar la página
    resetearTiempoInactivo();
  </script>

  <style>
    /* Personalización de SweetAlert2 */
    .swal2-popup {
      background-color: #fff;
      border-radius: 8px;
      border: 2px solid #dcdcdc;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      font-family: Arial, sans-serif;
    }

    .swal2-title {
      color: #333;
      font-size: 18px;
      font-weight: bold;
    }

    .swal2-content {
      color: #555;
      font-size: 16px;
    }

    .swal2-icon {
      font-size: 40px;
      color: #ffc107;
      /* Color del icono (amarillo en este ejemplo) */
    }
  </style>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Boostrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <!-- Particulas Fondo -->
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
  <!-- Activacion de particulas -->
  <script src="./resource/fondo.js"></script>
  <!-- Incluir SweetAlert2 CSS y JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>


  <!-- Jquerys -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Validaciones -->
  <script src="./resource/formValid.js"></script>
</body>

</html>