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
                              <label class="form-label">ID</label>
                              <input type="number" class="form-control" id="id" name="id" placeholder="Ingresar ID" />
                            </div>
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
                              <label class="form-label">ID de Cliente</label>
                              <input type="number" class="form-control" id="client_id" name="client_id" placeholder="Ingresar ID de Cliente" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">ID de Dirección</label>
                              <input type="number" class="form-control" id="address_id" name="address_id" placeholder="Ingresar ID de Dirección" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">ID del Estado de Orden</label>
                              <input type="number" class="form-control" id="order_status_id" name="order_status_id" placeholder="Ingresar ID del Estado de Orden" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">ID del Tipo de Pago</label>
                              <input type="number" class="form-control" id="payment_type_id" name="payment_type_id" placeholder="Ingresar ID del Tipo de Pago" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">ID del Cupón</label>
                              <input type="number" class="form-control" id="cupon_id" name="cupon_id" placeholder="Ingresar ID del Cupón" />
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
                                            <label class="form-label">ID</label>
                                            <input type="number" class="form-control" id="id" name="id" placeholder="Ingresar ID" />
                                          </div>
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
                                            <label class="form-label">ID de Cliente</label>
                                            <input type="number" class="form-control" id="client_id" name="client_id" placeholder="Ingresar ID de Cliente" />
                                          </div>
                                          <div class="mb-3">
                                            <label class="form-label">ID de Dirección</label>
                                            <input type="number" class="form-control" id="address_id" name="address_id" placeholder="Ingresar ID de Dirección" />
                                          </div>
                                          <div class="mb-3">
                                            <label class="form-label">ID del Estado de Orden</label>
                                            <input type="number" class="form-control" id="order_status_id" name="order_status_id" placeholder="Ingresar ID del Estado de Orden" />
                                          </div>
                                          <div class="mb-3">
                                            <label class="form-label">ID del Tipo de Pago</label>
                                            <input type="number" class="form-control" id="payment_type_id" name="payment_type_id" placeholder="Ingresar ID del Tipo de Pago" />
                                          </div>
                                          <div class="mb-3">
                                            <label class="form-label">ID del Cupón</label>
                                            <input type="number" class="form-control" id="cupon_id" name="cupon_id" placeholder="Ingresar ID del Cupón" />
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
                                <a href="<?= BASE_PATH ?>order_details" class="btn btn-sm btn-light-success me-1"><i class="feather icon-eye"></i></a> 
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

        // Validar campo ID
        if (id === "" || isNaN(id) || id <= 0) {
          alert("Por favor, ingrese un ID válido (número mayor a 0).");
          return false;
        }

        // Validar campo Folio
        if (folio === "" || isNaN(folio) || folio <= 0) {
          alert("Por favor, ingrese un folio válido (número mayor a 0).");
          return false;
        }

        // Validar campo Total
        if (total === "" || isNaN(total) || total <= 0) {
          alert("Por favor, ingrese un total válido (número mayor a 0).");
          return false;
        }

        // Validar campo Está Pagado
        if (isPaid !== "1" && isPaid !== "0") {
          alert("Por favor, seleccione si está pagado o no.");
          return false;
        }

        // Validar campo ID de Cliente
        if (clientId === "" || isNaN(clientId) || clientId <= 0) {
          alert("Por favor, ingrese un ID de cliente válido (número mayor a 0).");
          return false;
        }

        // Validar campo ID de Dirección
        if (addressId === "" || isNaN(addressId) || addressId <= 0) {
          alert("Por favor, ingrese un ID de dirección válido (número mayor a 0).");
          return false;
        }

        // Validar campo ID del Estado de Orden
        if (orderStatusId === "" || isNaN(orderStatusId) || orderStatusId <= 0) {
          alert("Por favor, ingrese un ID del estado de orden válido (número mayor a 0).");
          return false;
        }

        // Validar campo ID del Tipo de Pago
        if (paymentTypeId === "" || isNaN(paymentTypeId) || paymentTypeId <= 0) {
          alert("Por favor, ingrese un ID del tipo de pago válido (número mayor a 0).");
          return false;
        }

        // Validar campo ID del Cupón
        if (cuponId === "" || isNaN(cuponId) || cuponId < 0) {
          alert("Por favor, ingrese un ID del cupón válido (número mayor o igual a 0).");
          return false;
        }

        // Si todas las validaciones pasan
        return true;
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
