<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Restaurar Contraseña - Aventura GO</title>
  <link rel="stylesheet" href="public/assets/extras/reset_pasword/resetPasword.css" />
</head>

<body>
  <!-- Fondo con desenfoque -->
  <div class="fondo"></div>
  <img src="public/assets/extras/reset_pasword/img/Rectangle 179.png" alt="Fondo" class="fondo">


  <div class="contenedor">

    <form action="generar-clave" method="POST">

      <div class="formulario">
        <img src="public/assets/extras/reset_pasword/img/REDES-LOGO 1.png" alt="Logo Aventura GO" class="logo" />
        <h2>RESTAURAR CONTRASEÑA</h2>

        <p class="instruccion">Ingresa tu correo electrónico</p>
        <input type="email" name="email" placeholder="email" class="entrada" />

        <p class="nota">Te enviaremos un código de verificación al correo que escribiste.</p>

        <button class="btn">Continuar →</button>
      </div>
    </form>

    <div class="imagen">
      <img src="public/assets/extras/reset_pasword/img/Rectangle 179.png" alt="Imagen de aventura" />
    </div>
  </div>

</body>

</html>