<?php 
  include_once "../../app/config.php";
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
            <div class="card shadow-none">
              <div class="card-header">
                <h5>Cupones</h5>
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
                        <form onsubmit="return validarFormulario()">
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
                            </div>
                            <div class="mb-3">
                                <label for="is_paid" class="form-label">Cliente</label>
                                <select id="is_paid" name="is_paid" class="form-select">
                                    <option value="1">Nombre 1</option>
                                    <option value="0">Nombre 2</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="is_paid" class="form-label">Dirección de Envío</label>
                                <select id="is_paid" name="is_paid" class="form-select">
                                    <option value="1">Dirección 1</option>
                                    <option value="0">Dirección 2</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="is_paid" class="form-label">Estado de Orden</label>
                                <select id="is_paid" name="is_paid" class="form-select">
                                    <option value="1">Completado</option>
                                    <option value="0">(Rellenar con todos los posibles)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="is_paid" class="form-label">Tipo De Pago</label>
                                <select id="is_paid" name="is_paid" class="form-select">
                                    <option value="1">Tarjeta</option>
                                    <option value="0">(Rellenar con todos los posibles)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="is_paid" class="form-label">Cupón</label>
                                <select id="is_paid" name="is_paid" class="form-select">
                                    <option value="1">10off</option>
                                    <option value="0">(Rellenar con todos los posibles)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Productos en la Orden</label>

                              <select name="producto[]" id="producto_original" class="form-select mb-2">
                                <option value="Producto 1">Producto 1</option>
                                <option value="Producto 2">Producto 2</option>
                                <option value="Producto 3">Producto 3</option>
                              </select>

                              <select name="presentación[]" id="presentación_original" class="form-select mb-2">
                                <option value="Presentación A">Presentación A</option>
                                <option value="Presentación B">Presentación B</option>
                                <option value="Presentación C">Presentación C</option>
                              </select>

                              <div id="otro_producto"></div>

                              <button type="button" class="btn btn-primary mb-4" onclick="addProduct()">
                                Añadir otro producto
                              </button>
                            </div>

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
                        <th class="border-top-0">ID</th>
                        <th class="border-top-0">Folio</th>
                        <th class="border-top-0">Total</th>
                        <th class="border-top-0">Se pagó</th>
                        <th class="border-top-0">ID de Cliente</th>
                        <th class="border-top-0">ID de Dirección</th>
                        <th class="border-top-0">Estado de la orden</th>
                        <th class="border-top-0">ID del Tipo de Pago</th>
                        <th class="border-top-0">ID del Cupón</th>
                        <th class="border-top-0">ID del Cliente</th>
                        <th class="border-top-0">Nombre del Cliente</th>
                        <th class="border-top-0">Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>31824</td>
                            <td>$12,500</td>
                            <td>Si</td>
                            <td>4</td>
                            <td>6</td>
                            <td>Entregado</td>
                            <td>1</td>
                            <td>2</td>
                            <td>14</td>
                            <td>Jose Lopez</td>
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
                                        <form onsubmit="return validarFormulario()">
                                        <div class="modal-body">
                                        <div class="mb-3">
                                          <label for="is_paid" class="form-label">Estado de Orden</label>
                                            <select id="is_paid" name="is_paid" class="form-select">
                                              <option value="1">Completado</option>
                                              <option value="0">(Rellenar con todos los posibles)</option>
                                          </select>
                                        </div>

                                      </form>
                                    </div>
                                  </div>
                                </div>   
                                <a href="<?= BASE_PATH ?>order_details" class="btn btn-sm btn-light-success me-1"><i class="feather icon-eye"></i></a> 

                                <a href="#" onclick="remove(<?= $client['id'] ?>)" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                            </td>
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

        let presentacionOptions = document.getElementById('presentación_original').innerHTML;

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
