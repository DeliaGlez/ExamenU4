<?php 
  include_once "../../app/config.php";
?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <title>Detalle de la Orden | </title>
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
                  <li class="breadcrumb-item"><a href="">Home</a></li>
                  <li class="breadcrumb-item"><a href="">Ordenes</a></li>
                  <li class="breadcrumb-item" aria-current="page">Detalle de la Orden</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Detalle de la Orden</h2>
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
                <h5>Datos De la Orden</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <!-- <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">ID</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">1</p>
                                </div>
                            </div>
                            </li> -->
                            <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Folio</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">61274</p>
                                </div>
                            </div>
                            </li>
                            <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Total</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">$4,000</p>
                                </div>
                            </div>
                            </li>
                            <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Está pagado</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">Si</p>
                                </div>
                            </div>
                            </li>

                            <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">ID del Tipo de Pago</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">1</p>
                                </div>
                            </div>
                            </li>
                            <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">ID de Cupón</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">5</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-header">
                <h5>Datos Del Cliente</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <!-- <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">ID</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">4</p>
                                </div>
                            </div>
                            </li> -->
                            <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Nombre</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">Marshall Parker</p>
                                </div>
                            </div>
                            </li>
                            <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Correo Electrónico</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">mapa_46@gmail.com</p>
                                </div>
                            </div>
                            </li>
                            <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Celular</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">6127384765</p>
                                </div>
                            </div>
                            </li>
                            <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Está Suscrito</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">Si</p>
                                </div>
                            </div>
                            </li>
                            <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Nivel de ID</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">1</p>
                                </div>
                            </div>
                        </li> 
                    </ul>
                </div>
                <div class="card-header">
                <h5>Datos de la Dirección</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <!-- <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">ID</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">4</p>
                                </div>
                            </div>
                        </li> -->
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Nombre</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">Marshall </p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Apellido</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">Parker </p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Calle y Número</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">Calle articulo 743, 123 </p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Apartamento</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">No</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Código Postal</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">21123 </p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Ciudad</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">La Paz</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Estado</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">Baja California Sur</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Número de Celular</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">61234567</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Es dirección de facturación</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">No</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-header">
                <h5>Estado de la Orden</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Pediente de pago</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-header">
                <h5>Cupón Utilizado</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Nombre del Cupón</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">10% off</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Porcentaje Descontado</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">10%</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-header">
                <h5>Método de Pago</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Tipo de Pago</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">Efectivo</p>
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
                <h5>Lista de Productos en la Orden</h5>
              </div>
              <div class="card-body shadow border-0">
                <div class="table-responsive">
                  <table id="report-table" class="table table-bordered table-striped mb-0">
                    <thead>
                      <tr>
                        <th class="border-top-0">Imagen</th>
                        <th class="border-top-0">descripción</th>
                        <th class="border-top-0">Código</th>
                        <th class="border-top-0">Peso en gramos</th>
                        <th class="border-top-0">Stock</th>
                        <th class="border-top-0">Precio</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img src="" class="d-block wid-50 rounded" alt="Product images"></td>
                            <td>desc</td>
                            <td>Mesa12</td>
                            <td>500</td>
                            <td>10</td>
                            <td>$5,000</td>
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
