<?php 
  include_once "../../app/config.php";
  include_once "../../app/UserController.php";

  if (!isset($_SESSION['user_data'])) {
    header('Location: ' . BASE_PATH . '?error=Error de autenticación, inicie sesión.');
    exit;
  }

  if (isset($_GET['id'])) {
      $userId = intval($_GET['id']);
  } else {
      header('Location: users_list.php?error=No se especificó un ID de usuario.');
      exit;
  }

  $userController = new UserController();
  $profileData = $userController->getUserById($userId);

  if (!$profileData || empty($profileData['data'])) {
      header('Location: users_list.php?error=Usuario no encontrado.');
      exit;
  }

  $user = $profileData['data'];
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
                  <li class="breadcrumb-item"><a href="">Usuarios</a></li>
                  <li class="breadcrumb-item" aria-current="page">Visualizar Usuario</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Perfil de usuario</h2>
                </div>
              </div>
            </div>
          </div>
          <div class="text-end btn-page mt-3">
              <button onclick="window.location.href = '<?= BASE_PATH ?>users'" class="btn btn-primary">Regresar</button>
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
                          src="<?= $user['avatar'] ?>"
                          alt="User image"
                        />
                        <i class="chat-badge bg-success me-2 mb-2"></i>
                      </div>
                      <h5 class="mb-0"><?= $user['name'] . ' ' . $user['lastname'] ?></h5>
                      <p class="text-muted text-sm">Contáctame <a href="" class="link-primary"> <?= $user['email']?> </a> </p>
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
                      <span class="f-w-500"><i class="ph-duotone ph-user-circle m-r-10"></i>Datos del Usuario</span>
                    </a>
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
                                <p class="mb-0"><?= $user['name'] . ' ' . $user['lastname'] ?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Número celular</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= $user['phone_number']?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Correo</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= $user['email']?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Creado por</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= $user['created_by']?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Rol</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= $user['role']?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Fecha de Creación</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= $user['created_at']?></p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Última modificación</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0"><?= $user['updated_at']?></p>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
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
