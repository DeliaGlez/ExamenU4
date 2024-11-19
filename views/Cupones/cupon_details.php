<?php 
  include_once "../../app/config.php";
  include_once "../../app/UserController.php";

  if(!isset($_SESSION['user_data'])){
    header('Location: ' .BASE_PATH. '?error=Error de autenticación, inicie sesión.');
    exit;
  }
  else{
    $userController = new UserController();

    $profileData = $userController->getUsers();
    $users = $profileData['data'];
  }
?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <title>Detalle del Cupón| </title>
    <?php 
      include "../layouts/head.php";
    ?>
    </head>
    <!-- [Head] end -->
    <!-- [Body] Start -->

    <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <?php 
      include "../layouts/sidebar.php";
    ?>

    <?php 
      include "../layouts/nav.php";
    ?>
    <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col-md-12">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                  <li class="breadcrumb-item" aria-current="page">Detalle del Cupón</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Detalle del Cupón</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->


        <!-- [ Main Content ] start -->
        
    <div class="row">
        <div class="col-lg-12">
        <div class="card">
                      <div class="card-header">
                        <h5>Datos Del Cupón</h5>
                      </div>
                      <div class="card-body">
                        <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">ID</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">1</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Código</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">dfjae</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Porcentaje descuento</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">20%</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Total de Descuentos</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">$20,000</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Costo mínimo para descuento</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">$1,000</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Cantidad mínima de productos</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">3</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Fecha de Inicio</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">10-2-2024</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Fecha de Expiración</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">10-2-2024</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Usos máximos</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">20</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Usos totales</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">5</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Valido solo en la primera compra</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">No</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Estado</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">1</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Tipo de cupón</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">Descuento</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">ID de la rama</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">1</p>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>

          
                
        </div>

    </div>





    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-none">
              <div class="card-header">
                <h5>Lista de Usos del Cupón</h5>
              </div>
              <div class="card-body shadow border-0">
                <div class="table-responsive">
                  <table id="report-table" class="table table-bordered table-striped mb-0">
                    <thead>
                      <tr>
                        <th class="border-top-0">ID de Orden</th>
                        <th class="border-top-0">Folio</th>
                        <th class="border-top-0">Total</th>
                        <th class="border-top-0">Está Pagado</th>
                        <th class="border-top-0">ID de Cliente</th>
                        <th class="border-top-0">ID de Dirección</th>
                        <th class="border-top-0">ID de Estado de Orden</th>
                        <th class="border-top-0">ID de Tipo de Pago</th>
                        <th class="border-top-0">ID de Cupón</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>123</td>
                            <td>$1,000</td>
                            <td>Si</td>
                            <td>2</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>4</td>
                        </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ Main Content ] end -->

    <?php 

      include "../layouts/footer.php";

    ?>
    
    <?php 

      include "../layouts/modals.php";

    ?>

    <?php 

      include "../layouts/scripts.php";

    ?>
 <!-- Required Js -->
<script src="../assets/js/plugins/popper.min.js"></script>
<script src="../assets/js/plugins/simplebar.min.js"></script>
<script src="../assets/js/plugins/bootstrap.min.js"></script>
<script src="../assets/js/fonts/custom-font.js"></script>
<script src="../assets/js/pcoded.js"></script>
<script src="../assets/js/plugins/feather.min.js"></script>


  </body>
  <!-- [Body] end -->
</html>
