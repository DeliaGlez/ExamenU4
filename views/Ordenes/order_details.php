<?php 
  include_once "../../app/config.php";
  include_once "../../app/OrderController.php";
  include_once "../../app/LevelController.php";

  if(!isset($_SESSION['user_data'])){
    header('Location: ' .BASE_PATH. '?error=Error de autenticación, inicie sesión.');
    exit;
  }
  else{
    $orderController = new OrderController();
    $levelController = new LevelController();
    
    $link = $_SERVER['REQUEST_URI'];
    $link_array = explode('/', $link);
    $orderId = end($link_array);

    
    $orderData = $orderController->getOrder($orderId);
    $order = $orderData['data'];
    if (empty($order)) {
      header('Location: ' .BASE_PATH. 'orders');
    exit;
    }
    
    if (!empty($order['client'])) {
      // Obtener el nivel del cliente
      $levelData = $levelController->getLevel($order['client']['level_id']);
      $level = $levelData['data'] ?? null;
    }
    

    

  }
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
                <ul class="">
                <ul class="">
                  <li class="list-group-item px-0 pt-0">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Folio</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($order['folio'] ?? 'Información no existente') ?></p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-0 pt-0">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Total</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0">$<?= isset($order['total']) ? number_format($order['total'], 2) : '0.00' ?></p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-0 pt-0">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Está pagado</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0"><?= isset($order['is_paid']) && $order['is_paid'] ? 'Sí' : 'No' ?></p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-0 pt-0">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Estado</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($order['order_status']['name'] ?? 'Información no existente') ?></p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item px-0 pt-0">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Tipo de Pago</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($order['payment_type']['name'] ?? 'Información no existente') ?></p>
                            </div>
                        </div>
                    </li>
                </ul>


                </div>
            </div> 
            
            <div class="card">
                <div class="card-header">
                <h5>Datos Del Cliente</h5>
                </div>
                <div class="card-body">
                <?php if (!empty($order['client'])): ?>
                    <ul class="">
                            <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Nombre</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($order['client']['name']) ?></p>
                                </div>
                            </div>
                            </li>
                            <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Correo</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($order['client']['email']) ?></p>
                                </div>
                            </div>
                            </li>
                            <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Celular</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($order['client']['phone_number']) ?></p>
                                </div>
                            </div>
                            </li>

                            <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Está suscrito</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0"><?= $order['client']['is_suscribed'] ? 'Sí' : 'No' ?></p>
                                </div>
                            </div>
                            </li>
                            <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Nivel</p>
                                </div>
                                <div class="col-md-6">
                                <?= !empty($level) ? htmlspecialchars($level['name']) : 'Nivel no encontrado' ?>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <?php else: ?>
                    <p class="text-muted">Información del cliente no existente.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                <h5>Dirección de envío</h5>
                </div>
                <div class="card-body">
                <?php if (!empty($order['address'])): ?>
                    <ul class="">
                        <li class="list-group-item px-0 pt-0">
                        <div class="row">
                            <div class="col-md-6">
                            <p class="mb-1 text-muted">Nombre</p>
                            </div>
                            <div class="col-md-6">
                            <p class="mb-0"><?= htmlspecialchars($order['address']['first_name']? : 'N/A') ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            <p class="mb-1 text-muted">Apellido</p>
                            </div>
                            <div class="col-md-6">
                            <p class="mb-0"><?= htmlspecialchars($order['address']['last_name']? : 'N/A') ?></p>
                            </div>
                        </div>
                        </li>
                        <li class="list-group-item px-0 pt-0">
                        <div class="row">
                            <div class="col-md-6">
                            <p class="mb-1 text-muted">Calle y número</p>
                            </div>
                            <div class="col-md-6">
                            <p class="mb-0"><?= htmlspecialchars($order['address']['street_and_use_number']? : 'N/A') ?></p>
                            </div>
                        </div>
                        </li>
                        <li class="list-group-item px-0 pt-0">
                        <div class="row">
                            <div class="col-md-6">
                            <p class="mb-1 text-muted">Apartamento</p>
                            </div>
                            <div class="col-md-6">
                            <p class="mb-0"><?= htmlspecialchars($order['address']['apartment']? : 'N/A') ?></p>
                            </div>
                        </div>
                        </li>

                        <li class="list-group-item px-0 pt-0">
                        <div class="row">
                            <div class="col-md-6">
                            <p class="mb-1 text-muted">Código postal</p>
                            </div>
                            <div class="col-md-6">
                            <p class="mb-0"><?= htmlspecialchars($order['address']['postal_code']? : 'N/A') ?></p>
                            </div>
                        </div>
                        </li>
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Ciudad</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($order['address']['city']? : 'N/A') ?></p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Estado</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($order['address']['province']? : 'N/A') ?></p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Celular</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($order['address']['phone_number']? : 'N/A') ?></p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Es dirección de facturación</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0"><?= $order['address']['is_billing_address'] ? 'Sí' : 'No' ?></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <?php else: ?>
                    <p class="text-muted">Información de la dirección no existente.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                <h5>Cupón Usado </h5>
                </div>
                <div class="card-body">
                <?php if (!empty($order['coupon'])): ?>
                    <ul class="">
                            <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Nombre de cupón</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($order['coupon']['name']) ?></p>
                                </div>
                            </div>
                            </li>
                            <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Código</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($order['coupon']['code']) ?></p>
                                </div>
                            </div>
                            </li>
                            <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Porcentaje de descuento</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($order['coupon']['percentage_discount'] ?? 'N/A') ?>%</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                <p class="mb-1 text-muted">Monto de descuento</p>
                                </div>
                                <div class="col-md-6">
                                <p class="mb-0">$<?= htmlspecialchars($order['coupon']['amount_discount'] ?? 'N/A') ?></p>
                                </div>
                            </div>
                            </li>

                    </ul>
                    <?php else: ?>
                    <p class="text-muted">Información del cupón no existente.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h5>Productos comprados</h5>
              </div>
              <div class="card-body shadow border-0">
                <div class="table-responsive">
                  <table id="report-table" class="table table-bordered table-striped mb-0">
                    <thead>
                      <tr>
                        <th class="border-top-0">Imagen</th>
                        <th class="border-top-0">Descripción</th>
                        <th class="border-top-0">Código</th>
                        <th class="border-top-0">Peso</th>
                        <th class="border-top-0">Estado</th>
                        <th class="border-top-0">Precio</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($order['presentations'])): ?>
                            <?php foreach ($order['presentations'] as $presentation): ?>
                                <tr>
                                    <td>
                                        <img src="<?= BASE_PATH ?>assets/images/products/<?= htmlspecialchars($presentation['cover']) ?>" alt="Imagen" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                                    </td>
                                    <td><?= htmlspecialchars($presentation['description']) ?></td>
                                    <td><?= htmlspecialchars($presentation['code']) ?></td>
                                    <td><?= htmlspecialchars($presentation['weight_in_grams']) ?> gramos</td>
                                    <td><?= htmlspecialchars($presentation['status']) ?></td>
                                    <td>$<?= number_format($presentation['current_price']['amount'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No hay productos comprados.</td>
                            </tr>
                        <?php endif; ?>
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
