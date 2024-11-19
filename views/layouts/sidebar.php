<!-- [ Pre-loader ] start -->
    <div class="loader-bg">
      <div class="loader-track">
        <div class="loader-fill"></div>
      </div>
    </div>
    <!-- [ Pre-loader ] End -->
     <!-- [ Sidebar Menu ] start -->
    <nav class="pc-sidebar">
      <div class="navbar-wrapper">
        <div class="m-header">
          <a href="<?= BASE_PATH ?>home" class="b-brand text-primary">
            <!-- ========   Change your logo from here   ============ -->
            <img src="<?= BASE_PATH ?>assets/images/logo-dark.svg" alt="SAT" class="" />
            <span class="badge bg-brand-color-2 rounded-pill ms-2 theme-version">v1.2.0</span>
          </a>
        </div>
        <div class="navbar-content">
          <ul class="pc-navbar">
            <li class="pc-item pc-caption">
              <label>Navegación</label>
              <i class="ph-duotone ph-gauge"></i>
            </li>
            <li class="pc-item">
              <a href="<?= BASE_PATH ?>profile" class="pc-link">
                <span class="pc-micon">
                  <i class="ph-duotone ph-identification-card"></i>
                </span>
                <span class="pc-mtext">Perfil de Usuario</span>
              </a>
            </li>
            <li class="pc-item">
              <a href="<?= BASE_PATH ?>users" class="pc-link">
                <span class="pc-micon">
                  <i class="ph-duotone ph-identification-card"></i>
                </span>
                <span class="pc-mtext">Lista de Usuarios</span>
              </a>
            </li>
            <li class="pc-item">
              <a href="<?= BASE_PATH ?>clients" class="pc-link">
                <span class="pc-micon">
                  <i class="ph-duotone ph-identification-card"></i>
                </span>
                <span class="pc-mtext">Lista de Clientes</span>
              </a>
            </li>
            <li class="pc-item">
              <a href="<?= BASE_PATH ?>brands" class="pc-link">
                <span class="pc-micon">
                  <i class="ph-duotone ph-identification-card"></i>
                </span>
                <span class="pc-mtext">Lista de Marcas</span>
              </a>
            </li>
            <li class="pc-item">
              <a href="<?= BASE_PATH ?>tags" class="pc-link">
                <span class="pc-micon">
                  <i class="ph-duotone ph-identification-card"></i>
                </span>
                <span class="pc-mtext">Lista de Etiquetas</span>
              </a>
            </li>
            <li class="pc-item">
              <a href="<?= BASE_PATH ?>categorys" class="pc-link">
                <span class="pc-micon">
                  <i class="ph-duotone ph-identification-card"></i>
                </span>
                <span class="pc-mtext">Lista de Categorías</span>
              </a>
            </li>
            <li class="pc-item">
              <a href="<?= BASE_PATH ?>cupons" class="pc-link">
                <span class="pc-micon">
                  <i class="ph-duotone ph-identification-card"></i>
                </span>
                <span class="pc-mtext">Cupones</span>
              </a>
            </li>
            <li class="pc-item">
              <a href="<?= BASE_PATH ?>orders" class="pc-link">
                <span class="pc-micon">
                  <i class="ph-duotone ph-identification-card"></i>
                </span>
                <span class="pc-mtext">Ordenes</span>
              </a>
            </li>
          </ul>
        </div>
        <div class="card pc-user-card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <img src="<?= BASE_PATH ?>assets/images/user/avatar-1.jpg" alt="user-image" class="user-avtar wid-45 rounded-circle" />
              </div>
              <div class="flex-grow-1 ms-3">
                <div class="dropdown">
                  <a href="#" class="arrow-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,20">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1 me-2">
                        <h6 class="mb-0">Jonh Smith</h6>
                        <small>Administrator</small>
                      </div>
                      <div class="flex-shrink-0">
                        <div class="btn btn-icon btn-link-secondary avtar">
                          <i class="ph-duotone ph-windows-logo"></i>
                        </div>
                      </div>
                    </div>
                  </a>
                  <div class="dropdown-menu">
                    <ul>
                      <li>
                        <a class="pc-user-links" href="<?= BASE_PATH ?>profile">
                          <i class="ph-duotone ph-user"></i>
                          <span>Prefil de Usuario</span>
                        </a>
                      </li>
                      <li>
                        <a class="pc-user-links" href="<?= BASE_PATH ?>">
                          <i class="ph-duotone ph-power"></i>
                          <span>Cerrar Sesión</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <!-- [ Sidebar Menu ] end -->