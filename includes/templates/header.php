<?php


if (!isset($_SESSION)) {
  session_start();  /// esta funcion para iniciar la session y poder ocopar la super global en esta pagina
}

$auth = $_SESSION['login'] ?? false;

?>


<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bienes Raices</title>
  <link rel="stylesheet" href="/build/css/app.css" />
</head>

<body>
  <header class="header <?php echo $inicio ? 'inicio' : ''
                        ?>">
    <div class="contenedor contenido-header">
      <div class="barra">
        <a href="/"><img src="/build/img/logo.svg" alt="Logo" /></a>

        <div class="mobile-menu">
          <img src="/build/img/barras.svg" alt="menu mobile" />
        </div>
        <!--.mobile-menu-->
        <div class="derecha">
          <img src="/build/img/dark-mode.svg" alt="icono dark mode" class="dark-mode-boton" />
          <nav class="navegacion">
            <a href="nosotros.php">Nosotros</a>
            <a href="anuncios.php">Anuncios</a>
            <a href="blog.php">Blog</a>
            <a href="contacto.php">Contacto</a>
            <?php if ($auth) :  ?>
              <a href="cerrar-sesion.php">Cerrar sesion</a>
            <?php elseif (!$auth) : ?>
              <a href="login.php">iniciar sesion</a>
            <?php endif; ?>

          </nav>
        </div>
        <!--.derecha-->
      </div>
      <!--.barra-->
      <?php if ($inicio) { ?>
        <h1>Venta de casas y Departamentos Exclusivos de lujo</h1>
      <?php } ?>
    </div>
    <!--.contenedor-->
  </header>