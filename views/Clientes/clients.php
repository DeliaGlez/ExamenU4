<?php 
  include_once "../../app/config.php";
?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <title>Lista de clientes | </title>
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
                  <li class="breadcrumb-item" aria-current="page">Clientes</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Clientes</h2>
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
                <h5>Clientes</h5>
                <div class="card-header-right">
                  <button type="button" class="btn btn-light-warning m-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Agregar Cliente
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
                          <h5 class="modal-title" id="exampleModalLabel"
                            ><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Agregar Clientes</h5
                          >
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                        </div>
                        <form onsubmit="return validarFormulario()">
                          <div class="modal-body">
                            <div class="mb-3">
                              <label class="form-label">Nombre</label>
                              <input type="text" class="form-control" id="name" name="name" placeholder="Ingresar Nombre" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Correo Electrónico</label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Número de Teléfono</label>
                              <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Número de Teléfono" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Contraseña</label>
                              <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Subir Imagen de Perfil</label>
                              <input type="file" class="form-control" name="profile_photo_file" id="profile_photo_file" accept="image/*" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Contraseña</label>
                              <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Está suscrito?</label>
                              <input class="form-check-input input-primary" type="checkbox" id="is_suscribed" name="is_suscribed" />
                            </div>
                            <div class="mb-3">
                              <label for="nivelCliente" class="form-label">Nivel de Cliente</label>
                              <select id="nivelCliente" name="nivelCliente" class="form-select">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                              </select>
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
                        <th class="border-top-0">Nombre</th>
                        <th class="border-top-0">Correo</th>
                        <th class="border-top-0">Número</th>
                        <th class="border-top-0">Está suscrito?</th>
                        <th class="border-top-0">Nivel de Cliente</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Aqui va a ir el ciclo para recorrer los clientes y llenar la tabla -->
                      <tr>
                        <td>1</td>
                        <td>Pepe Jason</td>
                        <td><a href="" class="link-secondary">pepe@gmail.com</a></td>
                        <td>6121234567</td>
                        <td>No</td>
                        <td>Normal</td>
                        <td>
                          <a href="<?= BASE_PATH ?>clients_edit" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a>
                          <a href="" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                          <a href="<?= BASE_PATH ?>clients_info" class="btn btn-sm btn-light-info"><i class="feather icon-eye"></i></a>
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
        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const phoneNumber = document.getElementById("phone_number").value.trim();
        const password = document.getElementById("password").value.trim();
        const profilePhoto = document.getElementById("profile_photo_file").value;
        const isSubscribed = document.getElementById("is_suscribed").checked;
        const nivelCliente = document.getElementById("nivelCliente").value;

        if (name === "") {
          alert("Por favor ingrese su nombre.");
          return false;
        }

        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(email)) {
          alert("Por favor ingrese un correo electrónico válido.");
          return false;
        }

        const phonePattern = /^\d{10,}$/;
        if (!phonePattern.test(phoneNumber)) {
          alert("Por favor ingrese un número de teléfono válido de al menos 10 dígitos.");
          return false;
        }

        if (password.length < 5) {
          alert("La contraseña debe tener al menos 5 caracteres.");
          return false;
        }

        if (!profilePhoto) {
          alert("Por favor suba una imagen de perfil.");
          return false;
        }

        if (!isSubscribed) {
          alert("Debe estar suscrito para continuar.");
          return false;
        }

        if (!nivelCliente) {
          alert("Por favor seleccione un nivel de cliente.");
          return false;
        }

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
<script src="../../assets/js/plugins/popper.min.js"></script>
<script src="../../assets/js/plugins/simplebar.min.js"></script>
<script src="../../assets/js/plugins/bootstrap.min.js"></script>
<script src="../../assets/js/fonts/custom-font.js"></script>
<script src="../../assets/js/pcoded.js"></script>
<script src="../../assets/js/plugins/feather.min.js"></script>


  </body>
  <!-- [Body] end -->
</html>
