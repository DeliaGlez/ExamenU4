<?php 
  include_once "../../app/config.php";
  include_once "../../app/AuthController.php";
  include_once "../../app/CouponController.php";

  if(!isset($_SESSION['user_data'])){
    header('Location: ' .BASE_PATH. '?error=Error de autenticación, inicie sesión.');
    exit;
  }
  else{
    $authController = new AuthController();
    $couponController = new CouponController();

    $link = $_SERVER['REQUEST_URI'];
    $link_array = explode('/', $link);
    $couponId = end($link_array);

    $profileData = $authController->getProfile();
    $couponData = $couponController->getCoupon($couponId);

    $user = $profileData['data'];
    $coupon = $couponData['data'];
    //var_dump($coupon);

  }
  $error_message = isset($_GET['error']) ? $_GET['error'] : '';
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
        
        <div class="card statistics-card-1 overflow-hidden">
          <div class="card-body">
            <img src="<?= BASE_PATH ?>assets/images/widget/img-status-4.svg" alt="img" class="img-fluid img-bg" />
            <h5 class="mb-4">Total Descontado</h5>
            <div class="d-flex align-items-center mt-3">
              <h3 class="f-w-300 d-flex align-items-center m-b-0">$23,000</h3>
            </div>
            <div class="progress" style="height: 7px">
              <div
                class="progress-bar bg-brand-color-3"
                role="progressbar"
                style="width: 100%"
                aria-valuenow="100"
                aria-valuemin="0"
                aria-valuemax="100"
              ></div>
            </div>
          </div>
        </div>
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
                                <p class="mb-1 text-muted">Nombre del cupón</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($coupon['name']) ?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Código</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($coupon['code']) ?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Porcentaje descuento</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($coupon['percentage_discount']) ?>%</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Costo mínimo para descuento</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($coupon['min_amount_required']) ?>$</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Cantidad mínima de productos</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($coupon['min_product_required']) ?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Fecha de Inicio</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($coupon['start_date']) ?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Fecha de Expiración</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($coupon['end_date']) ?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Usos máximos</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($coupon['max_uses']) ?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Usos totales</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($coupon['count_uses']) ?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Valido solo en la primera compra</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($coupon['valid_only_first_purchase']? 'Sí' : 'No') ?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Estado</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($coupon['status'])? 'Activio' : 'Inactivo' ?></p>
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
                      <?php foreach ($coupon['orders'] as $order): ?>
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
                            <td><?= htmlspecialchars($order['id'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($order['folio'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($order['total'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($order['is_paid'] ? 'Sí' : 'No') ?></td>
                            <td><?= htmlspecialchars($order['client_id'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($order['address_id'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($order['order_status_id'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($order['payment_type_id'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($order['coupon_id'] ?? 'N/A') ?></td>
                        </tr>
                      <?php endforeach; ?>
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
