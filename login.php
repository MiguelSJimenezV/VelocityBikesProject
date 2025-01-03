<!DOCTYPE html>
<html lang="es" data-bs-theme="auto">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.122.0">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/blog/">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <!-- Custom styles for this template -->
  <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->

  <title>Velocity Bikes</title>
</head>

<body>
  <?php
  require 'components/navbar.php';
  ?>
  <style>
    #particles-js {
      position: fixed;
      top: 0;
      right: 0;
      height: 100%;
      width: 100%;
      z-index: -1;
    }
  </style>
  <div id="particles-js" class="bg-black"></div>
  <div class="container py-5">
    <div class='d-flex aling-items-center justify-content-center'>
      <div class='g-0 p-5 shadow-sm bg-dark text-light rounded-5 w-50'>
        <h2 class="mb-3 h2">Inicio de sesión</h2>
        <p>usuario: admin - user</p>
        <p>contraseña: davinci</p>
        <form action="" id="loginForm" method="post">
          <div class="mb-2">
            <label class="form-label" for="username">Usuario:</label>
            <input class="form-control" type="text" id="username" name="username" placeholder="Nombre de Usuario" required>
          </div>
          <div class="mb-2">
            <label class="form-label" for="password">Contraseña:</label>
            <input class="form-control" type="text" id="password" name="password" placeholder="Ingrese su Contraseña" required>
          </div>
          <div class="d-flex justify-content-end">
            <button class="btn btn-warning mt-4 px-4" type="submit">Iniciar sesión</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php
  require 'components/footer.php';
  ?>
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="resource/fondo.js"></script>
  <script>
    $(document).ready(function() {
      $('#loginForm').on('submit', function(event) {
        event.preventDefault(); // Prevenir el envío predeterminado del formulario
        $.ajax({
          url: 'iniciar_sesion.php',
          method: 'POST',
          dataType: 'json',
          data: $(this).serialize(),
          success: function(response) {
            if (response.success) {
              alert('Inicio de sesión exitoso');
              window.location.href = response.redirect; // Redirigir basado en la respuesta del servidor
            } else {
              alert(response.message);
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error en la solicitud: ' + textStatus + ', ' + errorThrown);
            alert('Error en la solicitud. Inténtalo de nuevo.');
          }
        });
      });
    });
  </script>


</body>

</html>