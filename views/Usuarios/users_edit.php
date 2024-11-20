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
                  <li class="breadcrumb-item" aria-current="page">Perfil de usuario</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Editar Usuario</h2>
                </div>
              </div>
            </div>
          </div>
          <div class="text-end btn-page mt-3">
            <button  onclick="window.location.href = '<?= BASE_PATH ?>users'" class="btn btn-primary">Regresar</button>
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
                    <form action="user" method= "POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="updateUser">
                    <input type="hidden" name="id" value="<?= $user['id']; ?>">
                    <input type="hidden" name="global_token" value="<?= $_SESSION['global_token']; ?>">
                        <div class="card">
                        <div class="card-header">
                            <h5>Actualizar datos</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" value="<?= $user['name']?>" name="name" id="name" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                <label class="form-label">Apellido</label>
                                <input type="text" class="form-control" value="<?= $user['lastname'] ?>" name="lastname" id="lastname" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                <label class="form-label">Número de contacto</label>
                                <input type="text" class="form-control" value="<?= $user['phone_number']?>" name="phone_number" id="phone_number" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                <label class="form-label">Correo</label>
                                <input type="email" class="form-control" value="<?= $user['email']?>" name="email" id="email" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                <label class="form-label">Nueva Contraseña</label>
                                <input type="password" class="form-control" name="password" id="password" />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                <label class="form-label">Subir Imagen de Perfil</label>
                                <input type="file" class="form-control" name="profile_photo_file" id="profile_photo_file" accept="image/*" />
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="text-end btn-page mt-3">
                            <button type="button" class="btn btn-outline-secondary">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Actualizar perfil</button>
                        </div>
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
        const lastname = document.getElementById("lastname").value.trim();
        const phoneNumber = document.getElementById("phone_number").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();
        const profilePhoto = document.getElementById("profile_photo_file").value;

        const nameRegex = /^[a-zA-Z\s]+$/;
        if (name === "") {
          alert("Por favor, ingrese su nombre.");
          return false;
        }
        if (!nameRegex.test(name)) {
          alert("El nombre no debe contener números ni caracteres especiales.");
          return false;
        }

        if (lastname === "") {
          alert("Por favor, ingrese su apellido.");
          return false;
        }
        if (!nameRegex.test(lastname)) {
          alert("El apellido no debe contener números ni caracteres especiales.");
          return false;
        }

        const phoneRegex = /^[0-9]{10}$/;
        if (!phoneRegex.test(phoneNumber)) {
          alert("Por favor, ingrese un número de contacto válido (10 dígitos).");
          return false;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
          alert("Por favor, ingrese un correo electrónico válido.");
          return false;
        }

        if (password !== "" && password.length < 6) {
          alert("La contraseña debe tener al menos 6 caracteres.");
          return false;
        }

        if (profilePhoto !== "") {
          const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
          if (!allowedExtensions.test(profilePhoto)) {
            alert("El archivo de imagen debe ser de tipo JPG, JPEG, PNG o GIF.");
            return false;
          }
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
    </body>
    <!-- [Body] end -->
</html>
