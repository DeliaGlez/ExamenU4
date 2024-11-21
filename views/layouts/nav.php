<?php 
  include_once __DIR__ . "/../../app/config.php"; 
  include_once __DIR__ . "/../../app/UserController.php"; 

  $userController = new UserController();

    $profileData = $userController->getUsers();
    $users = $profileData['data'];
?>


 <!-- [ Header Topbar ] start -->
<header class="pc-header">
  <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
  <div class="me-auto pc-mob-drp">
    <ul class="list-unstyled">
      <!-- ======= Menu collapse Icon ===== -->
      <li class="pc-h-item pc-sidebar-collapse">
        <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
          <i class="ti ti-menu-2"></i>
        </a>
      </li>
      <li class="pc-h-item pc-sidebar-popup">
        <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
          <i class="ti ti-menu-2"></i>
        </a>
      </li>
      <li class="dropdown pc-h-item d-inline-flex d-md-none">
        <a
          class="pc-head-link dropdown-toggle arrow-none m-0"
          data-bs-toggle="dropdown"
          href="#"
          role="button"
          aria-haspopup="false"
          aria-expanded="false"
        >
          <i class="ph-duotone ph-magnifying-glass"></i>
        </a>
      </li>
    </ul>
  </div>
<!-- [Mobile Media Block end] -->
<div class="ms-auto">
  <ul class="list-unstyled">
    <li class="pc-h-item">
      <a class="pc-head-link pct-c-btn" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_pc_layout">
        <i class="ph-duotone ph-gear-six"></i>
      </a>
    </li>
    
    <li class="dropdown pc-h-item header-user-profile">
      <a
        class="pc-head-link dropdown-toggle arrow-none me-0"
        data-bs-toggle="dropdown"
        href="#"
        role="button"
        aria-haspopup="false"
        data-bs-auto-close="outside"
        aria-expanded="false"
      >
        <img src="<?= $user['avatar']?>" alt="user-image" class="user-avtar" />
      </a>
      <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
        <div class="dropdown-header d-flex align-items-center justify-content-between">
          <h5 class="m-0">Perfil</h5>
        </div>
        <div class="dropdown-body">
          <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
            <ul class="list-group list-group-flush w-100">
              <li class="list-group-item">
                <div class="d-flex align-items-center">
                  <div class="flex-shrink-0">
                    <img src="<?= $user['avatar']?>" alt="user-image" class="wid-50 rounded-circle" />
                  </div>
                  <div class="flex-grow-1 mx-3">
                    <h5 class="mb-0"><?= $user['name'] . ' ' . $user['lastname'] ?></h5>
                    <a class="link-primary" href=""><?= $user['email']?></a>
                  </div>
                  <span class="badge bg-primary">PRO</span>
                </div>
              </li>
              
              <li class="list-group-item">
                <a href="<?= BASE_PATH ?>profile" class="dropdown-item">
                  <span class="d-flex align-items-center">
                    <i class="ph-duotone ph-user-circle"></i>
                    <span>Perfil de Usuario</span>
                  </span>
                </a>
              
                <form action="auth" method="POST">
                  <input type="hidden" name="action" value="logout">
                  <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?? '' ?>">
                  <button class="dropdown-item" type="submit">
                    <span class="d-flex align-items-center">
                      <i class="ph-duotone ph-power"></i>
                      <span>Cerrar sesión</span>
                    </span>
                  </button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </li>
  </ul>
</div>
 </div>
 
</header>
<!-- [ Header ] end -->
