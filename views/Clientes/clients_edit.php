<?php 
  include_once "../../app/config.php";
  include_once "../../app/AuthController.php";
  include_once "../../app/ClientController.php";
  include_once "../../app/LevelController.php";

  if(!isset($_SESSION['user_data'])){
    header('Location: ' .BASE_PATH. '?error=Error de autenticación, inicie sesión.');
    exit;
  }
  else{
    $authController = new AuthController();
    $clientController = new ClientController();
    $levelController = new LevelController();

    $link = $_SERVER['REQUEST_URI'];
    $link_array = explode('/', $link);
    $clientId = end($link_array);

    $profileData = $authController->getProfile();
    $levelsData = $levelController->getLevels();
    $clientData = $clientController->getClient($clientId);
    
    $client = $clientData['data'];
    $levels = $levelsData['data'];
    //var_dump($client);
    $user = $profileData['data'];
    
  }
  $error_message = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <title>Perfil de usuario  | </title>
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
                  <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>clients">Clientes</a></li>
                  <li class="breadcrumb-item" aria-current="page">Modificar Cliente</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Editar Cliente</h2>
                </div>
              </div>
            </div>
          </div>
          <div class="text-end btn-page mt-3">
            <button  onclick="window.location.href = '<?= BASE_PATH ?>clients'" class="btn btn-primary">Regresar</button>
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
                      id="user-set-information-tab"
                      data-bs-toggle="pill"
                      href="#user-set-information"
                      role="tab"
                      aria-controls="user-set-information"
                      aria-selected="true"
                    >
                      <span class="f-w-500"><i class="ph-duotone ph-clipboard-text m-r-10"></i>Actualizar datos</span>
                    </a>
                  </div>
                </div>
                
              </div>
              <div class="col-lg-7 col-xxl-9">
                <div class="tab-content" id="user-set-tabContent">
                    <div class="tab-pane fade show active" id="user-set-profile" role="tabpanel" aria-labelledby="user-set-profile-tab">
                      <form method="POST" action="client" enctype="multipart/form-data" onsubmit="return validarFormulario()">
                        <div class="card">
                          <div class="card-header">
                              <h5>Actualizar datos</h5>
                          </div>
                          <div class="card-body">
                              <div class="row">
                              <div class="col-sm-12">
                                  <div class="mb-3">
                                  <label class="form-label">Nombre</label>
                                  <input type="text" class="form-control" value="<?= htmlspecialchars($client['name']?? 'Sin nombre') ?>" name="name" id="name" />
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="mb-3">
                                  <label class="form-label">Correo</label>
                                  <input type="email" class="form-control" value="<?= htmlspecialchars($client['email']?? 'Sin correo') ?>" name="email" id="email" />
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="mb-3">
                                  <label class="form-label">Número de contacto</label>
                                  <input type="number" class="form-control" value="<?= htmlspecialchars($client['phone_number']?? 'Sin telefono') ?>" name="phone_number" id="phone_number" />
                                  </div>
                              </div>
                              <div class="mb-3">
                                  <label for="level_id" class="form-label">Nivel de Cliente</label>
                                  <select id="level_id" name="level_id" class="form-select">
                                      <?php
                                      $levelIdCliente = isset($client['level']['id']) ? $client['level']['id'] : null;
                                      $nivelCorrecto = false;

                                      foreach ($levels as $level) {
                                          $levelId = htmlspecialchars($level['id']);
                                          $levelName = htmlspecialchars($level['name']);

                                          if ($levelId == $levelIdCliente) {
                                              $nivelCorrecto = true;
                                              $selected = 'selected';
                                              break;
                                          }
                                      }
                                      if (!$nivelCorrecto) {
                                          echo '<option value="" selected> Nivel incorrecto </option>';
                                      } else {
                                          foreach ($levels as $level) {
                                              $levelId = htmlspecialchars($level['id']);
                                              $levelName = htmlspecialchars($level['name']); 
                                              $selected = ($levelId == $levelIdCliente) ? 'selected' : '';
                                              echo "<option value=\"$levelId\" $selected>$levelName</option>";
                                          }
                                      }
                                      ?>
                                  </select>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Está suscrito?</label>
                                <input type="hidden" name="is_suscribed" value="0">
                                <input class="form-check-input input-primary" type="checkbox" id="is_suscribed" name="is_suscribed" value="1"
                                    <?php echo htmlspecialchars($client['is_suscribed']) ? 'checked' : ''; ?>>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="text-end btn-page mt-3">
                            <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='<?= BASE_PATH ?>clients'">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Actualizar perfil</button>
                        </div>
                        <input type="hidden" name="action" value="updateClient"/>
                        <input type="hidden" id="id" name="id" value="<?= $client['id'] ?>" />
                        <input type="text" name="global_token" value=<?= $_SESSION['global_token'] ?> hidden>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>
    <!-- [ Main Content ] end -->
    <script>
      function validarFormulario() {
        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const number = document.getElementById("number").value.trim();
        const nivelCliente = document.getElementById("level_id").value;
        const isSuscribed = document.getElementById("is_suscribed").checked;

        const namePattern = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
        if (name === "") {
          alert("Por favor ingrese su nombre.");
          return false;
        } else if (!namePattern.test(name)) {
          alert("El nombre solo puede contener letras y espacios.");
          return false;
        }

        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(email)) {
          alert("Por favor ingrese un correo electrónico válido.");
          return false;
        }

        const phonePattern = /^\d{10,}$/;
        if (!phonePattern.test(number)) {
          alert("Por favor ingrese un número de contacto válido de al menos 10 dígitos.");
          return false;
        }

        if (nivelCliente === "") {
          alert("Por favor seleccione un nivel de cliente.");
          return false;
        }

        if (!isSuscribed) {
          alert("Debe estar suscrito para continuar.");
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </body>
    <!-- [Body] end -->
</html>
