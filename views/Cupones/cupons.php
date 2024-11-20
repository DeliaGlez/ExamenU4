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

    $profileData = $authController->getProfile();
    $cuponData = $couponController->getCoupons();

    $user = $profileData['data'];
    $cupones = $cuponData['data'];

  }
  $error_message = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <title>Lista de cupones | </title>
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
                  <li class="breadcrumb-item" aria-current="page">Cupones</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Cupones</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
          <div class="col-lg-12">
            <div class="card shadow-none">
              <div class="card-header">
                <h5>Cupones</h5>
                <div class="card-header-right">
                  <button type="button" class="btn btn-light-warning m-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Agregar Cupón
                  </button>
                </div>
              </div>
              <div class="card-body shadow border-0">
                <div class="table-responsive">
                  <table id="report-table" class="table table-bordered table-striped mb-0">
                    <thead>
                      <tr>
                        <th class="border-top-0">ID</th>
                        <th class="border-top-0">Nombre</th>
                        <th class="border-top-0">Código</th>
                        <th class="border-top-0">Porcentaje Descuento</th>
                        <th class="border-top-0">Costo Mínimo</th>
                        <th class="border-top-0">Cantidad Productos Mínima</th>
                        <th class="border-top-0">Fecha de Inicio</th>
                        <th class="border-top-0">Fecha de Finalización</th>
                        <th class="border-top-0">Límite de Usos</th>
                        <th class="border-top-0">Usos</th>
                        <th class="border-top-0">Valido en Primera Compra</th>
                        <th class="border-top-0">Estado</th>
                        <th class="border-top-0">Tipo de Cupón</th>
                        <th class="border-top-0">ID de Rama</th>
                        <th class="border-top-0">Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                    <!-- [Body] Start -->
                      <?php if (!empty($cupones)): ?>
                          <?php foreach ($cupones as $cupon): ?>
                        <tr>
                            <td><?= htmlspecialchars($cupon['id']) ?></td>
                            <td><?= htmlspecialchars($cupon['name']) ?></td>
                            <td><?= htmlspecialchars($cupon['code']) ?></td>
                            <td><?= htmlspecialchars($cupon['percentage_discount']) ?>%</td>
                            <td><?= htmlspecialchars($cupon['min_amount_required']) ?>$</td>
                            <td><?= htmlspecialchars($cupon['min_product_required']) ?></td>
                            <td><?= htmlspecialchars($cupon['start_date']) ?></td>
                            <td><?= htmlspecialchars($cupon['end_date']) ?></td>
                            <td><?= htmlspecialchars($cupon['max_uses']) ?></td>
                            <td><?= htmlspecialchars($cupon['count_uses']) ?></td>
                            <td><?= htmlspecialchars($cupon['valid_only_first_purchase']? 'Sí' : 'No') ?></td>
                            <td><?= htmlspecialchars($cupon['status'])? 'Activio' : 'Inactivo' ?></td>
                            <td><?= htmlspecialchars($cupon['couponable_type']) ?></td>
                            <td><?= htmlspecialchars($cupon['branch_id']) ?></td>
                            <td>
                                <a href="" class="btn btn-sm btn-light-info me-1" data-bs-toggle="modal" data-bs-target="#exampleModal1"
                                  data-id="<?= htmlspecialchars($cupon['id']) ?>"
                                  data-name="<?= htmlspecialchars($cupon['name'] ?? 'N/A') ?>"
                                  data-code="<?= htmlspecialchars($cupon['code'] ?? 'N/A') ?>"
                                  data-percentage-discount="<?= htmlspecialchars($cupon['percentage_discount'] ?? 'N/A') ?>"
                                  data-min-amount-required="<?= htmlspecialchars($cupon['min_amount_required'] ?? 'N/A') ?>"
                                  data-min-product-required="<?= htmlspecialchars($cupon['min_product_required'] ?? 'N/A') ?>"
                                  data-start-date="<?= htmlspecialchars($cupon['start_date'] ?? 'N/A') ?>"
                                  data-end-date="<?= htmlspecialchars($cupon['end_date'] ?? 'N/A') ?>"
                                  data-max-uses="<?= htmlspecialchars($cupon['max_uses'] ?? 'N/A') ?>"
                                  data-count-uses="<?= htmlspecialchars($cupon['count_uses']) ?>"
                                  data-valid-only-first-purchase="<?= htmlspecialchars($cupon['valid_only_first_purchase']) ?>"
                                  data-status="<?= htmlspecialchars($cupon['status']) ?>">
                                <i class="feather icon-edit"></i></a>
                                <a href="<?= BASE_PATH ?>cupon_details/<?= htmlspecialchars($cupon['id']) ?>" class="btn btn-sm btn-light-success me-1"><i class="feather icon-eye"></i></a> 
                            </td>
                            <?php endforeach; ?>
                          <?php endif; ?>
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
    <!-- [ Editar ]  -->
    <div
      class="modal fade"
      id="exampleModal1"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel1"
      aria-hidden="true"
  >
      <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Modificar Cupón</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
          </div>
          <form method="POST" action="coupon" enctype="multipart/form-data"  onsubmit="return validarFormulario()">
          <div class="modal-body">
          <div class="mb-3">
              <label class="form-label">Nombre</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Ingresar Nombre" />
              </div>
              <div class="mb-3">
              <label class="form-label">Código</label>
              <input type="text" class="form-control" id="code" name="code" placeholder="Ingresar Código" />
              </div>
              <div class="mb-3">
              <label class="form-label">Porcentaje de Descuento</label>
              <input type="number" class="form-control" id="percentage_discount" name="percentage_discount" placeholder="Ingresar Porcentaje de Descuento" />
              </div>
              <div class="mb-3">
              <label class="form-label">Mínimo de Costo</label>
              <input type="number" class="form-control" id="min_amount_required" name="min_amount_required" placeholder="Ingresar Mínimo de Costo" />
              </div>
              <div class="mb-3">
              <label class="form-label">Mínimo de Productos</label>
              <input type="number" class="form-control" id="min_product_required" name="min_product_required" placeholder="Ingresar Mínimo de Productos" />
              </div>
              <div class="mb-3">
              <label class="form-label">Fecha de Inicio</label>
              <input type="date" class="form-control" id="start_date" name="start_date" />
              </div>
              <div class="mb-3">
              <label class="form-label">Fecha de Expiración</label>
              <input type="date" class="form-control" id="end_date" name="end_date" />
              </div>
              <div class="mb-3">
              <label class="form-label">Usos Máximos</label>
              <input type="number" class="form-control" id="max_uses" name="max_uses" placeholder="Ingresar Usos Máximos" />
              </div>
              <div class="mb-3">
              <label class="form-label">Total de usos</label>
              <input type="number" class="form-control" id="count_uses" name="count_uses" placeholder="Ingresar Total de Usos" />
              </div>
              <div class="mb-3">
                  <label for="" class="form-label">Válido solo en primeras compras</label>
                  <select id="valid_only_first_purchase" name="valid_only_first_purchase" class="form-select">
                      <option value="1">Si</option>
                      <option value="0">No</option>
                  </select>
              </div>
              <div class="mb-3">
              <div class="mb-3">
              <label class="form-label">Estado</label>
              <select class="form-control" id="status" name="status">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-light-primary">Guardar cambios</button>
          </div>
            <input type="hidden" name="action" value="updateCoupon"/>
            <input type="hidden" id="id" name="id" value="" />
            <input type="text" name="global_token" value=<?= $_SESSION['global_token'] ?> hidden>
          </form>
      </div>
      </div>
  </div>
<!-- [ Agregar ]  -->
  <div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Agregar Cupón</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
        </div>
        <form method="POST" action="coupon" enctype="multipart/form-data" onsubmit="return validarFormulario()">
          <div class="modal-body">
          <div class="mb-3">
              <label class="form-label">Nombre</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Ingresar Nombre" />
            </div>
            <div class="mb-3">
              <label class="form-label">Código</label>
              <input type="text" class="form-control" id="code" name="code" placeholder="Ingresar Código" />
            </div>
            <div class="mb-3">
              <label class="form-label">Porcentaje de Descuento</label>
              <input type="number" class="form-control" id="percentage_discount" name="percentage_discount" placeholder="Ingresar Porcentaje de Descuento" />
            </div>
            <div class="mb-3">
              <label class="form-label">Mínimo de Costo</label>
              <input type="number" class="form-control" id="min_amount_required" name="min_amount_required" placeholder="Ingresar Mínimo de Costo" />
            </div>
            <div class="mb-3">
              <label class="form-label">Mínimo de Productos</label>
              <input type="number" class="form-control" id="min_product_required" name="min_product_required" placeholder="Ingresar Mínimo de Productos" />
            </div>
            <div class="mb-3">
              <label class="form-label">Fecha de Inicio</label>
              <input type="date" class="form-control" id="start_date" name="start_date" />
            </div>
            <div class="mb-3">
              <label class="form-label">Fecha de Expiración</label>
              <input type="date" class="form-control" id="end_date" name="end_date" />
            </div>
            <div class="mb-3">
              <label class="form-label">Usos Máximos</label>
              <input type="number" class="form-control" id="max_uses" name="max_uses" placeholder="Ingresar Usos Máximos" />
            </div>
            <div class="mb-3">
              <label class="form-label">Total de usos</label>
              <input type="number" class="form-control" id="count_uses" name="count_uses" placeholder="Ingresar Total de Usos" />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Válido solo en primeras compras</label>
                <select id="valid_only_first_purchase" name="valid_only_first_purchase" class="form-select">
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Estado</label>
              <select class="form-control" id="status" name="status">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-light-primary">Guardar cambios</button>
          </div>
            <input type="hidden" name="action" value="storeCoupon"/>
            <input type="text" name="global_token" value=<?= $_SESSION['global_token'] ?> hidden>
        </form>
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
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.btn-light-info');

    editButtons.forEach(button => {
      button.addEventListener('click', function() {
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const code = button.getAttribute('data-code');
        const percentageDiscount = button.getAttribute('data-percentage-discount');
        const minAmountRequired = button.getAttribute('data-min-amount-required');
        const minProductRequired = button.getAttribute('data-min-product-required');
        const startDate = button.getAttribute('data-start-date');
        const endDate = button.getAttribute('data-end-date');
        const maxUses = button.getAttribute('data-max-uses');
        const countUses = button.getAttribute('data-count-uses');
        const validOnlyFirstPurchase = button.getAttribute('data-valid-only-first-purchase');
        const status = button.getAttribute('data-status');

        console.log(id, name, code, percentageDiscount, minAmountRequired, minProductRequired, startDate, endDate, maxUses, countUses, validOnlyFirstPurchase, status);

        document.getElementById('id').value = id;
        document.getElementById('name').value = name;
        document.getElementById('code').value = code;
        document.getElementById('percentage_discount').value = percentageDiscount;
        document.getElementById('min_amount_required').value = minAmountRequired;
        document.getElementById('min_product_required').value = minProductRequired;
        document.getElementById('start_date').value = startDate;
        document.getElementById('end_date').value = endDate;
        document.getElementById('max_uses').value = maxUses;
        document.getElementById('count_uses').value = countUses;
        document.getElementById('valid_only_first_purchase').value = validOnlyFirstPurchase == '1' ? '1' : '0';
        document.getElementById('status').value = status;
      });
    });
  });
</script>


  </body>
  <!-- [Body] end -->
</html>
