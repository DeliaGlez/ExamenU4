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
                    
                    <a
                      class="nav-link list-group-item list-group-item-action"
                      id="user-set-passwort-tab"
                      data-bs-toggle="pill"
                      href="#user-set-passwort"
                      role="tab"
                      aria-controls="user-set-passwort"
                      aria-selected="false"
                    >
                      <span class="f-w-500"><i class="ph-duotone ph-key m-r-10"></i>Cambiar Contraseña</span>
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
                          </div>
                        </div>
                      </div>
                      <div class="text-end btn-page">
                        <div class="btn btn-outline-secondary">Cancelar</div>
                        <div class="btn btn-primary">UActualizar perfil</div>
                      </div>
                    </form>
                  </div>
                  
                  <div class="tab-pane fade" id="user-set-passwort" role="tabpanel" aria-labelledby="user-set-passwort-tab">
                    <div class="card alert alert-warning p-0">
                      <div class="card-body">
                        <div class="d-flex align-items-center">
                          <div class="flex-grow-1 me-3">
                            <h4 class="alert-heading">Ten cuidado!</h4>
                            <p class="mb-2">Para más seguridad te recomendamos cambiar tu contraseña cada 3 meses.</p>
                            <a href="" class="alert-link"><u>No compartas tu contraseña</u></a>
                          </div>
                          <div class="flex-shrink-0">
                            <img src="<?= BASE_PATH ?>assets/images/application/img-accout-password-alert.png" alt="img" class="img-fluid wid-80" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header">
                        <h5>Cambiar contraseña</h5>
                      </div>
                      <div class="card-body">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item pt-0 px-0">
                            <div class="row mb-0">
                              <label class="col-form-label col-md-4 col-sm-12 text-md-end"
                                >Contraseña Actual <span class="text-danger">*</span>
                              </label>
                              <div class="col-md-8 col-sm-12">
                                <input type="password" class="form-control" name="password"/>
                                <div class="form-text"> Olvidaste tu contraseña? <a href="" class="link-primary">Presiona Aquí</a> </div>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item px-0">
                            <div class="row mb-0">
                              <label class="col-form-label col-md-4 col-sm-12 text-md-end"
                                >Nueva Contraseña <span class="text-danger">*</span></label
                              >
                              <div class="col-md-8 col-sm-12">
                                <input type="password" class="form-control" name="new_password"/>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item pb-0 px-0">
                            <div class="row mb-0">
                              <label class="col-form-label col-md-4 col-sm-12 text-md-end"
                                >Confirmar Contraseña <span class="text-danger">*</span></label
                              >
                              <div class="col-md-8 col-sm-12">
                                <input type="password" class="form-control" name="new_password_confirmation"/>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-body text-end">
                        <div class="btn btn-outline-secondary me-2">Cancelar</div>
                        <div class="btn btn-primary">Cambiar Contraseña</div>
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
