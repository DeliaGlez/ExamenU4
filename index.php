<?php 
  include_once "app/config.php";
?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->
  <head>
    <title>Iniciar Sesión | </title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="description"
      content="Light Able admin and dashboard template offer a variety of UI elements and pages, ensuring your admin panel is both fast and effective."
    />
    <meta name="author" content="phoenixcoded" />

    <!-- [Favicon] icon -->
    <link rel="icon" href="<?= BASE_PATH ?>assets/images/favicon.svg" type="image/x-icon" />
    <!-- [Google Font : Public Sans] icon -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
    <!-- [phosphor Icons] https://phosphoricons.com/ -->
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/fonts/phosphor/duotone/style.css" />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/fonts/tabler-icons.min.css" />
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/fonts/feather.css" />
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/fonts/fontawesome.css" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/fonts/material.css" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/css/style.css" id="main-style-link" />
    <link rel="stylesheet" href="<?= BASE_PATH ?>assets/css/style-preset.css" />

  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->
  <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
      <div class="loader-track">
        <div class="loader-fill"></div>
      </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <div class="auth-main v2">
      <div class="bg-overlay bg-dark"></div>
      <div class="auth-wrapper">
        <div class="auth-sidecontent"> 
          <div class="auth-sidefooter">
            <!-- <img src="<?= BASE_PATH ?>assets/images/login_img.jpg" class="img-brand img-fluid" alt="images" /> -->
            <!-- Imagen no disponible debido a colision con el código de jsquery -->
            <hr class="mb-3 mt-4" />
            <div class="row">
              <div class="col my-1">
                <p class="m-0">Hecho con ♥ por <a href="" target="_blank"> SAT (Sobres A Tomar)</a></p>
              </div>
              <div class="col-auto my-1">
                <ul class="list-inline footer-link mb-0">
                  <li class="list-inline-item"><a href="">Home</a></li>
                  <li class="list-inline-item"><a href="">Documentación</a></li>
                  <li class="list-inline-item"><a href="">Soporte</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="auth-form">
          <div class="card my-5 mx-3">
            <div class="card-body">
              <h4 class="f-w-500 mb-1">Inicia sesión con tu correo</h4>
              <p class="mb-3">No tienes cuenta? <a href="<?= BASE_PATH ?>register" class="link-primary ms-1">Regístrate aquí</a></p>
              <!-- FORMULARIO DE INICIO DE SESIÓN -->
              <form action="">
                <div class="mb-3">
                  <input type="email" class="form-control" id="floatingInput" placeholder="Correo electrónico" required name="email" />
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" id="floatingInput1" placeholder="Contraseña" required name="password"/>
                </div>
                <div class="d-flex mt-1 justify-content-between align-items-center">
                  <div class="form-check">
                    <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" required/>
                    <label class="form-check-label text-muted" for="customCheckc1">Recordarme</label>
                  </div>
                  <a href="">
                    <h6 class="text-secondary f-w-400 mb-0">Olvidaste tu contraseña?</h6>
                  </a>
                </div>
                <div class="d-grid mt-4">
                  <button type="button" class="btn btn-primary" onclick="window.location.href='<?= BASE_PATH ?>home'">Iniciar sesión</button>
                </div>
              </form>
              <div class="saprator my-3">
                <span>O inicia sesión con</span>
              </div>
              <div class="text-center">
                <ul class="list-inline mx-auto mt-3 mb-0">
                  <li class="list-inline-item">
                    <a href="" class="avtar avtar-s rounded-circle bg-facebook" target="_blank">
                      <i class="fab fa-facebook-f text-white"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="" class="avtar avtar-s rounded-circle bg-twitter" target="_blank">
                      <i class="fab fa-twitter text-white"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="" class="avtar avtar-s rounded-circle bg-googleplus" target="_blank">
                      <i class="fab fa-google text-white"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ Main Content ] end -->
    <!-- Required Js -->
    <script src="<?= BASE_PATH ?>assets/js/plugins/popper.min.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/plugins/simplebar.min.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/plugins/bootstrap.min.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/fonts/custom-font.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/pcoded.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/plugins/feather.min.js"></script>

       
    <!-- <script>
      layout_change('light');
    </script>
       
    <script>
      layout_sidebar_change('light');
    </script>
      
    <script>
      change_box_container('false');
    </script>
     
    <script>
      layout_caption_change('true');
    </script>
       
    <script>
      layout_rtl_change('false');
    </script>
     
    <script>
      preset_change('preset-1');
    </script>
     -->

  </body>
</html>
