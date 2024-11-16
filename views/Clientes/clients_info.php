<?php 
  include_once "../../app/config.php";
  include_once "../../app/AuthController.php";
  include_once "../../app/ClientController.php";
  include_once "../../app/LevelController.php";
  include_once "../../app/AddressController.php";

  if(!isset($_SESSION['user_data'])){
    header('Location: ' .BASE_PATH. '?error=Error de autenticación, inicie sesión.');
    exit;
  }
  else{
    $authController = new AuthController();
    $clientController = new ClientController();
    $levelController = new LevelController();
    $addressController = new AddressController();

    $link = $_SERVER['REQUEST_URI'];
    $link_array = explode('/', $link);
    $clientId = end($link_array);

    $profileData = $authController->getProfile();
    $levelsData = $levelController->getLevels();
    $clientData = $clientController->getClient($clientId);
    
    
    $client = $clientData['data'];
    $levels = $levelsData['data'];
    $user = $profileData['data'];
    
  }
  $error_message = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <title>Perfil de Cliente  | </title>
    <?php 
      include "../layouts/head.php";
    ?>
  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->

  <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
  <?php if (!empty($error_message)): ?> 
      <script> 
        document.addEventListener('DOMContentLoaded', function() {
          swal("Error", "<?php echo htmlspecialchars($error_message); ?>", "error").then((value) => { window.location.href = '<?= BASE_PATH ?>'; });;
        });
      </script> 
  <?php endif; ?>
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
                  <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>clients">Clientes</a></li>
                  <li class="breadcrumb-item" aria-current="page">Perfil de Cliente</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Perfil de Cliente</h2>
                </div>
              </div>
            </div>
          </div>
          <div class="text-end btn-page mt-3">
              <button onclick="window.location.href = '<?= BASE_PATH ?>clients'" class="btn btn-primary">Regresar</button>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-sm-12">
            <div class="row">
              <div class="col-lg-5 col-xxl-3">
                <div class="card overflow-hidden">
                  <div class="card-body position-relative">
                    <div class="text-center mt-3">
                      <div class="chat-avtar d-inline-flex mx-auto">
                        <img
                          class="rounded-circle img-fluid wid-90 img-thumbnail"
                          src="<?= BASE_PATH ?>assets/images/user/avatar-1.jpg"
                          alt="User image"
                        />
                        <i class="chat-badge bg-success me-2 mb-2"></i>
                      </div>
                      <h5 class="mb-0"><?= htmlspecialchars($client['name']) ?></h5>
                      <p class="text-muted text-sm">Contáctame <a href="" class="link-primary"> <?= htmlspecialchars($client['email']) ?> </a> </p>
                    </div>
                  </div>
                  <div
                    class="nav flex-column nav-pills list-group list-group-flush account-pills mb-0"
                    id="user-set-tab"
                    role="tablist"
                    aria-orientation="vertical"
                  >
                    <a
                      class="nav-link list-group-item list-group-item-action active"
                      id="user-set-profile-tab"
                      data-bs-toggle="pill"
                      href="#user-set-profile"
                      role="tab"
                      aria-controls="user-set-profile"
                      aria-selected="true"
                    >
                      <span class="f-w-500"><i class="ph-duotone ph-user-circle m-r-10"></i>Datos del Cliente</span>
                    </a>
                  </div>
                </div>
                
                <div class="card statistics-card-1 overflow-hidden">
                  <div class="card-body">
                    <img src="<?= BASE_PATH ?>assets/images/widget/img-status-4.svg" alt="img" class="img-fluid img-bg" />
                    <h5 class="mb-4">Total en Compras</h5>
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
              </div>
              
              <div class="col-lg-7 col-xxl-9">
                <div class="tab-content" id="user-set-tabContent">
                  <div class="tab-pane fade show active" id="user-set-profile" role="tabpanel" aria-labelledby="user-set-profile-tab">
                    
                    <div class="card">
                      <div class="card-header">
                        <h5>Datos Personales</h5>
                      </div>
                      <div class="card-body">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item px-0 pt-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Nombre completo</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($client['name']) ?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Número celular</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($client['phone_number']) ?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Correo</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($client['email']) ?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Cuenta con suscripción</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($client['is_suscribed']) ? 'Sí' : 'No' ?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Nivel de usuario</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($client['level']['name']) ?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Porcentaje de descuento para el cliente</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= htmlspecialchars($client['level']['percentage_discount']) ?>%</p>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>

                    <div class="card shadow-none">
                      <div class="card-header">
                        <h5>Direcciones</h5>
                        <div class="card-header-right">
                          <button type="button" class="btn btn-light-warning m-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          Agregar Dirección
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
                                    ><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Agregar Dirección</h5
                                  >
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                </div>
                                <form method="POST" action="adress" enctype="multipart/form-data" onsubmit="return validarFormulario()">
                                  <div class="modal-body">
                                    <div class="mb-3">
                                      <label class="form-label">Nombre</label>
                                      <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Jorge" />
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Apellido</label>
                                      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Perez" />
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Dirección</label>
                                      <input type="text" class="form-control" id="street_and_use_number" name="street_and_use_number" placeholder="Chametla #2945" />
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Apartamento</label>
                                      <input class="form-control" type="text" id="apartment" name="apartment" />
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Código Postal</label>
                                      <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="23046" />
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Ciudad</label>
                                      <input type="text" class="form-control" id="city" name="city" placeholder="La Paz" />
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Estado</label>
                                      <input type="text" class="form-control" id="province" name="province" placeholder="Baja Clifornia Sur" />
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Número de Teléfono</label>
                                      <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="612 123 4567" />
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Dirección de Facturación</label>
                                      <input class="form-check-input input-primary" type="checkbox" id="is_billing_address" name="is_billing_address" value="1"/>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-light-primary">Agregar Dirección</button>
                                  </div>
                                    <input type="hidden" name="action" value="storeAddress"/>
                                    <input type="hidden" id="client_id" name="client_id" value="<?= $client['id'] ?>" />
                                    <input type="text" name="global_token" value=<?= $_SESSION['global_token'] ?> hidden>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="card-body">
                        <div class="table-responsive">
                          <table id="report-table" class="table table-bordered table-striped mb-0">
                            <thead>
                              <tr>
                                <th class="border-top-0">Nombre</th>
                                <th class="border-top-0">Apellido</th>
                                <th class="border-top-0">Dirección</th>
                                <th class="border-top-0">Apartamento</th>
                                <th class="border-top-0">Código Postal</th>
                                <th class="border-top-0">Ciudad</th>
                                <th class="border-top-0">Estado</th>
                                <th class="border-top-0">Número</th>
                                <th class="border-top-0">Dirección de Facturación</th>
                                <th class="border-top-0">Acción</th>
                              </tr>
                            </thead>
                            <tbody>
                              <!-- Aqui va a ir el ciclo para recorrer los usuarios y llenar la tabla -->
                              <?php foreach ($client['addresses'] as $address): ?>
                              <tr>
                                <td><?= htmlspecialchars($address['first_name'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($address['last_name'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($address['street_and_use_number'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($address['apartment'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($address['postal_code'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($address['city'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($address['province'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($address['phone_number'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($address['is_billing_address'] ? 'Sí' : 'No') ?></td>
                                <td>
                                <a href="#" class="btn btn-sm btn-light-success me-1" data-bs-toggle="modal" data-bs-target="#exampleModal1"
                                  data-id="<?= htmlspecialchars($address['id']) ?>"
                                  data-first-name="<?= htmlspecialchars($address['first_name'] ?? 'N/A') ?>"
                                  data-last-name="<?= htmlspecialchars($address['last_name'] ?? 'N/A') ?>"
                                  data-street-and-use-number="<?= htmlspecialchars($address['street_and_use_number'] ?? 'N/A') ?>"
                                  data-apartment="<?= htmlspecialchars($address['apartment'] ?? 'N/A') ?>"
                                  data-postal-code="<?= htmlspecialchars($address['postal_code'] ?? 'N/A') ?>"
                                  data-city="<?= htmlspecialchars($address['city'] ?? 'N/A') ?>"
                                  data-province="<?= htmlspecialchars($address['province'] ?? 'N/A') ?>"
                                  data-phone-number="<?= htmlspecialchars($address['phone_number'] ?? 'N/A') ?>"
                                  data-is-billing-address="<?= htmlspecialchars($address['is_billing_address']) ?>">
                                  <i class="feather icon-edit"></i>
                                <a href="#" onclick="remove(<?= $client['id'] ?>, <?= $address['id']  ?>)" class="btn btn-sm btn-light-danger">
                                    <i class="feather icon-trash-2"></i>
                                </a>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                                <!-- Modal  editar (para no perderme)-->
                                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                          <i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Modificar Dirección
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form method="POST" action="address" enctype="multipart/form-data">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name_edit" />
                                          </div>
                                          <div class="mb-3">
                                            <label class="form-label">Apellido</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name_edit"  />
                                          </div>
                                          <div class="mb-3">
                                            <label class="form-label">Dirección</label>
                                            <input type="text" class="form-control" id="street_and_use_number" name="street_and_use_number_edit" />
                                          </div>
                                          <div class="mb-3">
                                            <label class="form-label">Apartamento</label>
                                            <input class="form-control" type="text" id="apartment" name="apartment_edit" />
                                          </div>
                                          <div class="mb-3">
                                            <label class="form-label">Código Postal</label>
                                            <input type="text" class="form-control" id="postal_code" name="postal_code_edit" />
                                          </div>
                                          <div class="mb-3">
                                            <label class="form-label">Ciudad</label>
                                            <input type="text" class="form-control" id="city" name="city_edit" />
                                          </div>
                                          <div class="mb-3">
                                            <label class="form-label">Estado</label>
                                            <input type="text" class="form-control" id="province" name="province_edit" />
                                          </div>
                                          <div class="mb-3">
                                            <label class="form-label">Número de Teléfono</label>
                                            <input type="text" class="form-control" id="phone_number" name="phone_number_edit" />
                                          </div>
                                          <div class="mb-3">
                                            <label class="form-label">Dirección de Facturación</label>
                                            <input class="form-check-input input-primary" type="checkbox" id="is_billing_address" name="is_billing_address_edit" />
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
                                          <button type="submit" class="btn btn-light-primary">Modificar Dirección</button>
                                        </div>
                                          <input type="hidden" name="action" value="updateAddress"/>
                                          <input type="hidden" id="client_id" name="client_id" value="<?= $client['id'] ?>" />
                                          <input type="hidden" id="id" name="id" value="" />
                                          <input type="text" name="global_token" value=<?= $_SESSION['global_token'] ?> hidden>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                        </div>
                      </div>

                    </div>
                    

                    <div class="card shadow-none">
                      <div class="card-header">
                        <h5>Pedidos</h5>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table id="report-table" class="table table-bordered table-striped mb-0">
                            <thead>
                              <tr>
                                <th class="border-top-0">ID</th>
                                <th class="border-top-0">Folio</th>
                                <th class="border-top-0">Total</th>
                                <th class="border-top-0">Se pagó?</th>
                                <th class="border-top-0">Estado de la orden</th>
                              </tr>
                            </thead>
                            <tbody>
                              <!-- Aqui va a ir el ciclo para recorrer los usuarios y llenar la tabla -->
                              <?php foreach ($client['orders'] as $order): ?>
                              <tr>
                                <td><?= htmlspecialchars($order['id'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($order['folio'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($order['total'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($order['is_paid'] ? 'Sí' : 'No') ?></td>
                                <td><?= htmlspecialchars($order['order_status'] ['name']?? 'N/A') ?></td>
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
          </div>
          <form id="delete-form" action="address" method="POST">
            <input type="hidden" name="action" value="deleteAddress" />
            <input type="hidden" id="delete-address-id" name="id" />
            <input type="hidden" id="delete-client-id" name="client_id" />
            <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
          </form>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>
    <script>
      function validarFormulario() {
        const firstName = document.getElementById("first_name").value.trim();
        const lastName = document.getElementById("last_name").value.trim();
        const address = document.getElementById("street_and_use_number").value.trim();
        const postalCode = document.getElementById("postal_code").value.trim();
        const city = document.getElementById("city").value.trim();
        const province = document.getElementById("province").value.trim();
        const phoneNumber = document.getElementById("phone_number").value.trim();

        if (firstName === "") {
          alert("Por favor ingrese su nombre.");
          return false;
        }

        if (lastName === "") {
          alert("Por favor ingrese su apellido.");
          return false;
        }

        if (address === "") {
          alert("Por favor ingrese su dirección.");
          return false;
        }

        if (postalCode === "") {
          alert("Por favor ingrese su código postal.");
          return false;
        }

        if (city === "") {
          alert("Por favor ingrese su ciudad.");
          return false;
        }

        if (province === "") {
          alert("Por favor ingrese su estado.");
          return false;
        }

        const phonePattern = /^\d{10,}$/;
        if (!phonePattern.test(phoneNumber)) {
          alert("Por favor ingrese un número de teléfono válido (al menos 10 dígitos).");
          return false;
        }

        const postalCodePattern = /^\d{4,6}$/;
        if (!postalCodePattern.test(postalCode)) {
          alert("Por favor ingrese un código postal válido (entre 4 y 6 dígitos).");
          return false;
        }

        return true;
      }
    </script>
    <script>
      document.querySelector('form').addEventListener('submit', function (event) {
        const billingCheckbox = document.getElementById('is_billing_address');

        if (!billingCheckbox.checked) {
          const hiddenBilling = document.createElement('input');
          hiddenBilling.type = 'hidden';
          hiddenBilling.name = 'is_billing_address';
          hiddenBilling.value = '0';
          this.appendChild(hiddenBilling);
        }
      });
    </script>
    <?php if (!empty($error_message) || isset($_GET['message'])): ?> 
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          const urlParams = new URLSearchParams(window.location.search);
          const successMessage = urlParams.get('message');
          const errorMessage = urlParams.get('error');

          if (successMessage) {
            swal("Éxito", successMessage, "success")
              .then(() => {
                // quita ulr clean
                window.history.replaceState({}, document.title, "<?= BASE_PATH ?>clients/". clientId);
              });
          } else if (errorMessage) {
            swal("Error", errorMessage, "error")
              .then(() => {
                // quita ulr clean
                window.history.replaceState({}, document.title, "<?= BASE_PATH ?>clients/". clientId);
              });
          }
        });
      </script>
    <?php endif; ?>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.btn-light-success');

        editButtons.forEach(button => {
          button.addEventListener('click', function() {
            const id = button.getAttribute('data-id');
            const firstName = button.getAttribute('data-first-name');
            const lastName = button.getAttribute('data-last-name');
            const streetAndUseNumber = button.getAttribute('data-street-and-use-number');
            const apartment = button.getAttribute('data-apartment');
            const postalCode = button.getAttribute('data-postal-code');
            const city = button.getAttribute('data-city');
            const province = button.getAttribute('data-province');
            const phoneNumber = button.getAttribute('data-phone-number');
            const isBillingAddress = button.getAttribute('data-is-billing-address');

            console.log(firstName, lastName, streetAndUseNumber, apartment, postalCode, city, province, phoneNumber, isBillingAddress);

            document.getElementById('id').value = id;
            document.querySelector('[name="first_name_edit"]').value = firstName;
            document.querySelector('[name="last_name_edit"]').value = lastName;
            document.querySelector('[name="street_and_use_number_edit"]').value = streetAndUseNumber;
            document.querySelector('[name="apartment_edit"]').value = apartment;
            document.querySelector('[name="postal_code_edit"]').value = postalCode;
            document.querySelector('[name="city_edit"]').value = city;
            document.querySelector('[name="province_edit"]').value = province;
            document.querySelector('[name="phone_number_edit"]').value = phoneNumber;
            document.querySelector('[name="is_billing_address_edit"]').checked = isBillingAddress === '1';
          });
        });
      });
    </script>
    <script>
      function remove(clientId, addressId) {
        console.log("Client ID:", clientId, "Address ID:", addressId); //pruebas
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this address!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                // Actualiza los valores en el formulario
                document.getElementById("delete-client-id").value = clientId;
                document.getElementById("delete-address-id").value = addressId;

                // Enviar el formulario
                document.getElementById("delete-form").submit();
            }
        });
    }
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
    </body>
    <!-- [Body] end -->
</html>
