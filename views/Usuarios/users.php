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

  $error_message = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <title>Lista de usuarios | </title>
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
                  <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                  <li class="breadcrumb-item" aria-current="page">Usuarios</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Usuarios</h2>
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
                <h5>Usuarios</h5>
                <div class="card-header-right">
                  <button type="button" class="btn btn-light-warning m-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Agregar Usuario
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
                            ><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Agregar Usuario</h5
                          >
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                        </div>
                        <form action="user" method="POST" enctype="multipart/form-data">
                          <input type="hidden" name="action" value="storeUser">
                          <input type="hidden" name="global_token" value="<?= $_SESSION['global_token']; ?>">
                          <div class="modal-body">
                            <small id="emailHelp" class="form-text text-muted mb-2 mt-0">
                              Nunca compartiremos tu correo con externos.
                            </small>
                            <div class="mb-3">
                              <label class="form-label">Nombre</label>
                              <input type="text" class="form-control" id="name" name="name" placeholder="Ingresar Nombre" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Apellido</label>
                              <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Ingresar Apellido" required/>
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
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-light-primary">Agregar usuarios</button>
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
                        <th class="border-top-0">Rol</th>
                        <th class="border-top-0">Fecha de creación</th>
                        <th class="border-top-0">Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['name'] . ' ' . $user['lastname']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['role']) ?></td>
                            <td><?= htmlspecialchars($user['created_at']) ?></td>
                            <td>
                              <a href="users_edit?id=<?= htmlspecialchars($user['id']) ?>" class="btn btn-sm btn-light-success me-1"><i class="feather icon-edit"></i></a> 
                              
                              <form action="user" method="POST" style="display: inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="global_token" value="<?= $_SESSION['global_token']; ?>">
                                <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id']); ?>">

                                <button type="submit" class="btn btn-sm btn-light-danger" 
                                   onclick="return confirm('¿Estás seguro de que deseas eliminar este elemento?')">
                                  <i class="feather icon-trash-2"></i>
                                </button>
                              </form>

                              <a href="users_info?id=<?= htmlspecialchars($user['id']) ?>" class="btn btn-sm btn-light-info me-1"><i class="feather icon-eye"></i></a>
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
        const name = document.getElementById("name").value.trim();
        const lastname = document.getElementById("lastname").value.trim();
        const email = document.getElementById("email").value.trim();
        const phone = document.getElementById("phone_number").value.trim();
        const password = document.getElementById("password").value.trim();
        const passwordConfirm = document.getElementById("passwordConfirm").value.trim();
        const profilePhoto = document.getElementById("profile_photo_file").files.length;

        if (!name || !lastname || !email || !phone || !password || !passwordConfirm || profilePhoto === 0) {
          alert("Por favor, completa todos los campos.");
          return false;
        }

        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(email)) {
          alert("Por favor, ingresa un correo electrónico válido.");
          return false;
        }

        const phonePattern = /^[0-9]+$/;
        if (!phonePattern.test(phone)) {
          alert("Por favor, ingresa un número de teléfono válido (solo dígitos).");
          return false;
        }

        if (password !== passwordConfirm) {
          alert("Las contraseñas no coinciden.");
          return false;
        }
        return true;
      }
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
                window.history.replaceState({}, document.title, "<?= BASE_PATH ?>users");
              });
          } else if (errorMessage) {
            swal("Error", errorMessage, "error")
              .then(() => {
                // quita ulr clean
                window.history.replaceState({}, document.title, "<?= BASE_PATH ?>users");
              });
          }
        });
      </script>
    <?php endif; ?>

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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


  </body>
  <!-- [Body] end -->
</html>
