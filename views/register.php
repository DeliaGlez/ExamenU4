<?php 
  include_once "../app/config.php";
?>
<!doctype html>
<html lang="en">
    <!-- [Head] start -->
    <head>
    <title>Registro | </title>
    <?php 
      include "layouts/head.php";
    ?>
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
                        <!-- <img src="../assets/images/logo-dark.svg" class="img-brand img-fluid" alt="images" /> -->
                        <!-- Imagen no disponible debido a colision con el código de jsquery -->
                        <hr class="mb-3 mt-4" />
                        <div class="row">
                            <div class="col my-1">
                                <p class="m-0">Hecho con ♥ por <a href="" target="_blank"> SAT (Sobres A Tomar)</a></p>
                            </div>
                            <div class="col-auto my-1">
                                <ul class="list-inline footer-link mb-0">
                                    <li class="list-inline-item"><a href="">Home</a></li>
                                    <li class="list-inline-item"><a href="" target="_blank">Documentación</a></li>
                                    <li class="list-inline-item"><a href="" target="_blank">Soporte</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="auth-form">
                    <div class="card my-5 mx-3">
                        <div class="card-body">
                            <h4 class="f-w-500 mb-1">Regístrate con tu correo</h4>
                            <p class="mb-3">Ya tienes una cuenta? <a href="<?= BASE_PATH ?>login" class="link-primary">Inicia sesión</a></p>
                            <!-- FORMULARIO DE REGISTRO DE CUENTA -->
                             <form action="">
                                 <div class="row">
                                     <div class="col-sm-6">
                                         <div class="mb-3">
                                             <input type="text" class="form-control" placeholder="Nombre" required name="name"/>
                                         </div>
                                     </div>
                                     <div class="col-sm-6">
                                         <div class="mb-3">
                                             <input type="text" class="form-control" placeholder="Apellido" required name="lastname"/>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="mb-3">
                                     <input type="email" class="form-control" placeholder="Correo electrónico" required name="email"/>
                                 </div>
                                 <div class="mb-3">
                                     <input type="number" class="form-control" placeholder="Número de teléfono" required name="number"/>
                                 </div>
                                 <div class="mb-3">
                                     <input type="password" class="form-control" placeholder="Contraseña" required name="password"/>
                                 </div>
                                 <div class="mb-3">
                                     <input type="password" class="form-control" placeholder="Confirmar contraseña" required name="passwordconfirmation"/>
                                 </div>
                                 <div class="d-flex mt-1 justify-content-between">
                                     <div class="form-check">
                                         <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" required/>
                                         <label class="form-check-label text-muted" for="customCheckc1">Acepto los términos & condiciones</label>
                                     </div>
                                 </div>
                                 <div class="d-grid mt-4">
                                     <button type="button" class="btn btn-primary" onclick="window.location.href='<?= BASE_PATH ?>login'">Crear cuenta</button>
                                 </div>
                             </form>
                            <div class="saprator my-3">
                                <span>O continúa con</span>
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
        <?php 

            include "layouts/scripts.php";

        ?>
    </body>
  <!-- [Body] end -->
</html>
