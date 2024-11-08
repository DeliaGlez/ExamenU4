<?php 
  include_once "../app/config.php";
?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <title>Perfil de usuario  | </title>
    <?php 
      include "layouts/head.php";
    ?>
  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->

  <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">

  <?php 
    include "layouts/sidebar.php";
  ?>

  <?php 
    include "layouts/nav.php";
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
                  <li class="breadcrumb-item" aria-current="page">Perfil de usuario</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Perfil de usuario</h2>
                </div>
              </div>
            </div>
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
                      id="user-set-profile-tab"
                      data-bs-toggle="pill"
                      href="#user-set-profile"
                      role="tab"
                      aria-controls="user-set-profile"
                      aria-selected="true"
                    >
                      <span class="f-w-500"><i class="ph-duotone ph-user-circle m-r-10"></i>Resumen de perfil</span>
                    </a>
                    <a
                      class="nav-link list-group-item list-group-item-action"
                      id="user-set-information-tab"
                      data-bs-toggle="pill"
                      href="#user-set-information"
                      role="tab"
                      aria-controls="user-set-information"
                      aria-selected="false"
                    >
                      <span class="f-w-500"><i class="ph-duotone ph-clipboard-text m-r-10"></i>Actualizar datos</span>
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
                                <p class="mb-0">Anshan Handgun</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Número celular</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">(+1-876) 8654 239 581</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Correo</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">anshan.dh81@gmail.com</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Creado por</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">Jose Lopez</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Rol</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">Administrador</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Fecha de Creación</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">2024-10-30</p>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row">
                              <div class="col-md-6">
                                <p class="mb-1 text-muted">Última modificación</p>
                              </div>
                              <div class="col-md-6">
                                <p class="mb-0">2024-10-30</p>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="user-set-information" role="tabpanel" aria-labelledby="user-set-information-tab">
                    <form action="">
                      <div class="card">
                        <div class="card-header">
                          <h5>Actualizar datos</h5>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" value="Anshan" name="name"/>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="mb-3">
                                <label class="form-label">Apellido</label>
                                <input type="text" class="form-control" value="Handgun" name="lastname"/>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="mb-3">
                                <label class="form-label">Número de contacto</label>
                                <input type="text" class="form-control" value="(+99) 9999 999 999" name="number"/>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="mb-3">
                                  <label class="form-label">Correo </span></label>
                                  <input type="email" class="form-control" value="anshan.dh81@gmail.com" name="email"/>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="mb-3">
                                  <label class="form-label">Contraseña </span></label>
                                  <input type="password" class="form-control" value="1234" name="password"/>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="text-end btn-page">
                        <div class="btn btn-outline-secondary">Cancelar</div>
                        <div class="btn btn-primary">UActualizar perfil</div>
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
    <?php 

      include "layouts/footer.php";

    ?>
    
    <?php 

      include "layouts/modals.php";

    ?>
    
    <?php 

        include "layouts/scripts.php";

    ?>
    </body>
    <!-- [Body] end -->
</html>
