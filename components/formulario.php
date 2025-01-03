<div class="container row content-center d-flex justify-content-center align-items-center">
  <div class="col-8 ">

    <h2>¡Contáctanos!</h2>
    <p>Estamos aquí para ayudarte. Completa el formulario a continuación y nos pondremos en contacto contigo lo antes posible.</p>
    <form action="" method="get" class="formulario" onsubmit="vGenerales(event)">
      <div>
        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" placeholder="Miguel" oninput="validarNombre()" required class="form-control is-invalid">
        <div class="vNombre"></div>
      </div>

      <div>
        <label for="surname">Apellido</label>
        <input type="text" name="surname" id="surname" placeholder="Jimenez" oninput="vSurname()" required class="form-control is-invalid">
        <div class="vSurname"></div>
      </div>

      <div>
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" oninput="vEmail()" required class="form-control is-invalid" placeholder="Example@gmail.com">
        <div class="vEmail"></div>
      </div>

      <div>
        <label for="checkbox">Acepto todos los Terminos y Condiciones</label>
        <input type="checkbox" name="checkbox" id="checkbox" onclick="vCheckbox()">
        <div class="vCheckbox"></div>
      </div>

      <div>
        <button id="btn" class="btn-secondary" type="submit" onclick="vGenerales(event)">Enviar</button>
        <div class="vBtn"></div>
      </div>
    </form>
  </div>
</div>