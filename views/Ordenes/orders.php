<?php 
  include_once "../../app/config.php";
  include_once "../../app/OrderController.php";
  include_once "../../app/ProductController.php";
  include_once "../../app/ClientController.php";
  include_once "../../app/CouponController.php";

  if(!isset($_SESSION['user_data'])){
    header('Location: ' .BASE_PATH. '?error=Error de autenticación, inicie sesión.');
    exit;
  }
  else{
    $orderController = new OrderController();
    $profileData = $orderController->getOrders();
    $orders = $profileData['data'];

    $clientController = new ClientController();
    $clienteData = $clientController->getClients();
    $clients = $clienteData['data'];

    $cuponController = new CouponController();
    $cuponData = $cuponController->getCoupons();
    $cupons = $cuponData['data'];

    $productController = new ProductController();
    $producteData = $productController->getproducts();
    $products = $producteData['data'];
  }
  $error_message = isset($_GET['error']) ? $_GET['error'] : '';

?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <title>Lista de Ordenes | </title>
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
                  <li class="breadcrumb-item" aria-current="page">Ordenes</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Ordenes</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->


        <!-- [ Main Content ] start -->
        <div class="row">
          <div class="col-lg-12">
          
              <form action="">
                <div class="mb-3 row">
                  <label class="col-form-label col-lg-3 col-sm-12 text-lg-end">Selector de Rango</label>
                  <div class="col-lg-4 col-md-9 col-sm-12">
                    <div class="input-daterange input-group" id="pc-datepicker-5">
                      <input type="date" class="form-control text-left" placeholder="Start date" name="range-start" />
                      <span class="input-group-text">a</span>
                      <input type="date" class="form-control text-end" placeholder="End date" name="range-end" />
                    </div>
                  </div>
                  <button type="button" class="btn btn-light-primary m-0 col-form-label col-lg-2 col-sm-12">
                  Buscar por fecha
                  </button>
                  <button type="button" class="btn btn-light-danger m-0 col-form-label col-lg-2 col-sm-12">
                  Limpiar
                  </button>
                </div>
              </form>

            <div class="card shadow-none">
              <div class="card-header">
                <h5>Ordenes</h5>
                <div class="card-header-right">
                  <button type="button" class="btn btn-light-warning m-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Agregar Orden
                  </button>
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
                          <h5 class="modal-title" id="exampleModalLabel"><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Agregar Orden</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                        </div>
                        <form action="order" method="POST" onsubmit="return validarFormulario()">
                        <input type="hidden" name="action" value="storeOrder">
                        <input type="hidden" name="global_token" value="<?= $_SESSION['global_token']; ?>">
                          <div class="modal-body">
                            <div class="mb-3">
                              <label class="form-label">Folio</label>
                              <input type="number" class="form-control" id="folio" name="folio" placeholder="Ingresar Folio" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Total</label>
                              <input type="number" class="form-control" id="total" name="total" placeholder="Ingresar Total" />
                            </div>
                            <div class="mb-3">
                                <label for="is_paid" class="form-label">Está Pagado</label>
                                <select id="is_paid" name="is_paid" class="form-select">
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                            </div><!-- listo -->
                            <div class="mb-3">
                                <label for="client_id" class="form-label">Cliente</label>
                                <select id="client_id" name="client_id" class="form-select">
                                    <?php if (!empty($clients)) : ?>
                                        <?php foreach ($clients as $client) : ?>
                                            <option value="">Selecciona un cliente</option>
                                            <option value="<?= htmlspecialchars($client['id']) ?>">
                                                <?= htmlspecialchars($client['name'])?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value="">No hay clientes disponibles</option>
                                    <?php endif; ?>
                                </select>
                            </div><!-- listo -->
                            <div class="mb-3">
                                <label for="shipping_address_id" class="form-label">Dirección de Envío</label>
                                <select id="address_id" name="address_id" class="form-select">
                                    <?php 
                                    if (!empty($clients)) : ?>
                                        <?php foreach ($clients as $client) : ?>
                                            <?php if (!empty($client['addresses'])) : ?>
                                                <?php foreach ($client['addresses'] as $address) : ?>
                                                    <option value="">Selecciona una direccion</option>
                                                    <option value="<?= htmlspecialchars($address['id']) ?>">
                                                        <?= htmlspecialchars($address['street_and_use_number']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <option value="">No hay direcciones disponibles para este cliente</option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value="">No hay clientes disponibles</option>
                                    <?php endif; ?>
                                </select>
                            </div><!-- listo -->
                            <div class="mb-3">
                                <label for="is_paid" class="form-label">Estado de Orden</label>
                                <select id="order_status_id" name="order_status_id" class="form-select">
                                    <option value="1">Pendiente de pago</option>
                                    <option value="2">Pagada</option>
                                    <option value="3">Enviado</option>
                                    <option value="4">Abandonada</option>
                                    <option value="5">Pendiente de enviar</option>
                                    <option value="6">Cancelada></option>
                                </select>
                            </div><!-- listo -->
                            <div class="mb-3">
                                <label for="is_paid" class="form-label">Tipo De Pago</label>
                                <select id="payment_type_id" name="payment_type_id" class="form-select">
                                    <option value="1">Efectivo</option>
                                    <option value="2">Tarjeta</option>
                                    <option value="3">Transferencia</option>
                                </select>
                            </div><!-- listo -->
                            <div class="mb-3">
                                <label for="coupon_id" class="form-label">Cupón</label>
                                <select id="coupon_id" name="coupon_id" class="form-select">
                                    <?php if (!empty($cupons)) : ?>
                                        <?php foreach ($cupons as $cupon) : ?>
                                            <option value="<?= htmlspecialchars($cupon['id']) ?>">
                                                <?= htmlspecialchars($cupon['code'])?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value="">No hay cupones disponibles</option>
                                    <?php endif; ?>
                                </select>
                                <div class="mb-3">
                                  <label for="producto_original" class="form-label">Productos</label>
                                  <select name="producto" id="producto_original" class="form-select mb-2" onchange="updatePresentations()">
                                    <option value="">Selecciona un producto</option>
                                    <?php foreach ($products as $product): ?>
                                      <option value="<?= htmlspecialchars($product['id']) ?>" data-presentations='<?= htmlspecialchars(json_encode($product['presentations'])) ?>'>
                                        <?= htmlspecialchars($product['name']) ?>
                                      </option>
                                    <?php endforeach; ?>
                                  </select>

                                  <label for="presentacion_original" class="form-label">Presentaciones</label>
                                  <select name="presentations" id="presentacion_original" class="form-select mb-2">
                                    <option value="">Selecciona una presentación</option>
                                  </select>
                                </div><!-- listo pendiente-->

                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
                              <button type="submit" class="btn btn-light-primary">Guardar cambios</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body shadow border-0">
                <div class="table-responsive">
                  <table id="report-table" class="table table-bordered table-striped mb-0">
                    <thead>
                      <tr>
                        <th class="border-top-0">Folio</th>
                        <th class="border-top-0">Total</th>
                        <th class="border-top-0">Se pagó</th>
                        <th class="border-top-0">Cliente</th>
                        <th class="border-top-0">Dirección</th>
                        <th class="border-top-0">Estado de la orden</th>
                        <th class="border-top-0">Tipo de Pago</th>
                        <th class="border-top-0">Cupón</th>
                        <th class="border-top-0">Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                        <td><?= !empty($order['folio']) ? htmlspecialchars($order['folio']) : 'N/A' ?></td>
                        <td><?= isset($order['total']) ? number_format($order['total'], 2) : 'N/A' ?></td>
                        <td><?= isset($order['is_paid']) ? ($order['is_paid'] ? 'Sí' : 'No') : 'N/A' ?></td>
                        <td><?= !empty($order['client']['name']) ? htmlspecialchars($order['client']['name']) : 'N/A' ?></td>
                        <td><?= !empty($order['address']['street_and_use_number']) ? htmlspecialchars($order['address']['street_and_use_number']) : 'N/A' ?></td>
                        <td><?= !empty($order['order_status']['name']) ? htmlspecialchars($order['order_status']['name']) : 'N/A' ?></td>
                        <td><?= !empty($order['payment_type']['name']) ? htmlspecialchars($order['payment_type']['name']) : 'N/A' ?></td>
                        <td><?= !empty($order['coupon']['name']) ? htmlspecialchars($order['coupon']['name']) : 'N/A' ?></td>

                            <td>
                                <a href="" class="btn btn-sm btn-light-info me-1" data-bs-toggle="modal" 
                                data-bs-target="#exampleModal1"><i class="feather icon-edit"></i></a>
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
                                        <h5 class="modal-title" id="exampleModalLabel"><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Modificar Orden</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                        </div>
                                        <form action="order" method="POST">
                                        <input type="hidden" name="action" value="updateOrder">
                                        <input type="hidden" name="global_token" value="<?= $_SESSION['global_token']; ?>">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($order['id']); ?>">
                                        <input type="hidden" name="order_status_id" value="<?= htmlspecialchars($order['order_status_id']); ?>">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label for="status" class="form-label">Estado de Orden</label>
                                              <select id="status" name="order_status_id" class="form-select">
                                              <option value="1" <?= $order['order_status_id'] == 1 ? 'selected' : ''; ?>>Pendiente de pago</option>
                                              <option value="2" <?= $order['order_status_id'] == 2 ? 'selected' : ''; ?>>Pagada</option>
                                              <option value="3" <?= $order['order_status_id'] == 3 ? 'selected' : ''; ?>>Enviada</option>
                                              <option value="4" <?= $order['order_status_id'] == 4 ? 'selected' : ''; ?>>Abandonada</option>
                                              <option value="5" <?= $order['order_status_id'] == 5 ? 'selected' : ''; ?>>Pendiente de enviar</option>
                                              <option value="6" <?= $order['order_status_id'] == 6 ? 'selected' : ''; ?>>Cancelada</option>
                                            </select>
                                          </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Aceptar</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>   

                                <a href="<?= BASE_PATH ?>order_details/<?= $order['id'] ?? 0 ?>" class="btn btn-sm btn-light-success me-1">
                                  <i class="feather icon-eye"></i>
                                </a>

                                <form action="order" method="POST" style="display: inline;">
                                  <input type="hidden" name="action" value="deleteOrder">
                                  <input type="hidden" name="global_token" value="<?= $_SESSION['global_token']; ?>">
                                  <input type="hidden" name="id" value="<?= htmlspecialchars($order['id']); ?>">

                                  <button type="submit" class="btn btn-sm btn-light-danger" 
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este elemento?')">
                                    <i class="feather icon-trash-2"></i>
                                  </button>
                                </form>
                            </td>
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

    <script>
      function validarFormulario() {
        // Obtener los valores de los campos
        const id = document.getElementById("id").value.trim();
        const folio = document.getElementById("folio").value.trim();
        const total = document.getElementById("total").value.trim();
        const isPaid = document.getElementById("is_paid").value.trim();
        const clientId = document.getElementById("client_id").value.trim();
        const addressId = document.getElementById("address_id").value.trim();
        const orderStatusId = document.getElementById("order_status_id").value.trim();
        const paymentTypeId = document.getElementById("payment_type_id").value.trim();
        const cuponId = document.getElementById("cupon_id").value.trim();

        if (id === "" || isNaN(id) || id <= 0) {
          alert("Por favor, ingrese un ID válido (número mayor a 0).");
          return false;
        }

        if (folio === "" || isNaN(folio) || folio <= 0) {
          alert("Por favor, ingrese un folio válido (número mayor a 0).");
          return false;
        }

        if (total === "" || isNaN(total) || total <= 0) {
          alert("Por favor, ingrese un total válido (número mayor a 0).");
          return false;
        }

        if (isPaid !== "1" && isPaid !== "0") {
          alert("Por favor, seleccione si está pagado o no.");
          return false;
        }

        if (clientId === "" || isNaN(clientId) || clientId <= 0) {
          alert("Por favor, ingrese un ID de cliente válido (número mayor a 0).");
          return false;
        }

        if (addressId === "" || isNaN(addressId) || addressId <= 0) {
          alert("Por favor, ingrese un ID de dirección válido (número mayor a 0).");
          return false;
        }

        if (orderStatusId === "" || isNaN(orderStatusId) || orderStatusId <= 0) {
          alert("Por favor, ingrese un ID del estado de orden válido (número mayor a 0).");
          return false;
        }

        if (paymentTypeId === "" || isNaN(paymentTypeId) || paymentTypeId <= 0) {
          alert("Por favor, ingrese un ID del tipo de pago válido (número mayor a 0).");
          return false;
        }

        if (cuponId === "" || isNaN(cuponId) || cuponId < 0) {
          alert("Por favor, ingrese un ID del cupón válido (número mayor o igual a 0).");
          return false;
        }

        return true;
      }
    </script>

    <script type="text/javascript">
      function addProduct() {
        let productoOptions = document.getElementById('producto_original').innerHTML;

        let presentacionOptions = document.getElementById('presentacion_original').innerHTML;

        let newCode = `
          <div class="mb-3">
            <select name="producto[]" class="form-select mb-2">
              ${productoOptions}
            </select>
            <select name="presentación[]" class="form-select mb-2">
              ${presentacionOptions}
            </select>
          </div>
        `;

        document.getElementById('otro_producto').innerHTML += newCode;
      }
    </script>
    <script>
      function updatePresentations() {
        const productSelect = document.getElementById('producto_original');
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const presentations = selectedOption.getAttribute('data-presentations');

        const presentationSelect = document.getElementById('presentacion_original');
        presentationSelect.innerHTML = '<option value="">Selecciona una presentación</option>';

        if (presentations) {
          const parsedPresentations = JSON.parse(presentations);
          parsedPresentations.forEach(presentation => {
            const option = document.createElement('option');
            option.value = presentation.id;
            option.textContent = presentation.description;
            presentationSelect.appendChild(option);
          });
        }
      }
    </script>


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
