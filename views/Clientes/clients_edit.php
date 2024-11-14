<?php 
  include_once "../../app/config.php";
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
                      <h5 class="mb-0">Anshan Handgun</h5>
                      <p class="text-muted text-sm">Contáctame <a href="" class="link-primary"> @anshanhandgun </a> </p>
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
                      <form action="" enctype="multipart/form-data" onsubmit="return validarFormulario()">
                        <div class="card">
                          <div class="card-header">
                              <h5>Actualizar datos</h5>
                          </div>
                          <div class="card-body">
                              <div class="row">
                              <div class="col-sm-12">
                                  <div class="mb-3">
                                  <label class="form-label">Nombre</label>
                                  <input type="text" class="form-control" value="Anshan" name="name" id="name" />
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="mb-3">
                                  <label class="form-label">Correo</label>
                                  <input type="email" class="form-control" value="anshan.dh81@gmail.com" name="email" id="email" />
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="mb-3">
                                  <label class="form-label">Número de contacto</label>
                                  <input type="number" class="form-control" value="6121234567" name="number" id="number" />
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="mb-3">
                                  <label class="form-label">Está suscrito?</label>
                                  <input type="number" class="form-control" value="1" name="is_suscribed" id="is_suscribed" />
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="mb-3">
                                  <label class="form-label">Nivel de Cliente</label>
                                  <input type="number" class="form-control" value="1" name="level_id" id="level_id" />
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
        const email = document.getElementById("email").value.trim();
        const number = document.getElementById("number").value.trim();
        const isSuscribed = document.getElementById("is_suscribed").value.trim();
        const levelId = document.getElementById("level_id").value.trim();

        if (name === "") {
          alert("Por favor ingrese su nombre.");
          return false;
        }

        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (email === "" || !emailPattern.test(email)) {
          alert("Por favor ingrese un correo válido.");
          return false;
        }

        if (number === "" || isNaN(number) || number.length !== 10) {
          alert("Por favor ingrese un número de contacto válido de 10 dígitos.");
          return false;
        }

        if (isSuscribed === "" || (isSuscribed !== "0" && isSuscribed !== "1")) {
          alert("El campo 'Está suscrito?' debe ser 0 (No) o 1 (Sí).");
          return false;
        }

        if (levelId === "" || isNaN(levelId) || parseInt(levelId) <= 0) {
          alert("El campo 'Nivel de Cliente' debe ser un número positivo.");
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
    </body>
    <!-- [Body] end -->
</html>
