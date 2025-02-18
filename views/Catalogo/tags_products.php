<?php 
  include_once "../../app/config.php";
  include_once "../../app/AuthController.php";
  include_once "../../app/TagController.php";

  if(!isset($_SESSION['user_data'])){
    header('Location: ' .BASE_PATH. '?error=Error de autenticación, inicie sesión.');
    exit;
  }
  else{
    $authController = new AuthController();
    $tagController = new TagController();

    $link = $_SERVER['REQUEST_URI'];
    $link_array = explode('/', $link);
    $tagId = end($link_array);

    $profileData = $authController->getProfile();
    $tagData = $tagController->getTag($tagId);

    $tag = $tagData ['data'];
    //var_dump($brand);
    $user = $profileData['data'];
    
  }
  $error_message = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <title>Productos de la Etiqueta Seleccionada | </title>
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
                  <li class="breadcrumb-item"><a href="">Etiquetas</a></li>
                  <li class="breadcrumb-item" aria-current="page">Productos de <?= htmlspecialchars($tag['name']) ?></li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Productos de <?= htmlspecialchars($tag['name']) ?></h2>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
          <?php if (!empty($tag)): ?>
              <?php foreach ($tag['products'] as $product): ?>
                  <div class="col-sm-6 col-xl-4">
                    <div class="card product-card">
                      <div class="card-img-top">
                        <a href="<?= BASE_PATH ?>products/<?= htmlspecialchars($product['slug']) ?>">
                          <img src="<?= htmlspecialchars($product['cover']) ?>" alt="image" class="img-prod img-fluid" />
                        </a>
                      </div>
                      <div class="card-body">
                        <a href="<?= BASE_PATH ?>products/<?= htmlspecialchars($product['slug']) ?>">
                          <p class="prod-content mb-0 text-muted"><?= htmlspecialchars($product['name'] ?? 'N/A') ?></p>
                        </a>
                        <div class="d-flex align-items-center justify-content-between mt-2 mb-3 flex-wrap gap-1">
                          <h4 class="mb-0 text-truncate"
                            ><b><?= htmlspecialchars($product['description'] ?? 'N/A') ?></b>
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                 <?php endif; ?> 
                </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>
    <div
      class="modal fade"
      id="exampleModal1"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              <i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>
              Modificar Producto
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" action="client" enctype="multipart/form-data" onsubmit="return validarFormulario()">
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  name="name"
                  placeholder="Ingresar Nuevo Nombre"
                  required
                />
              </div>
              <div class="mb-3">
                <label class="form-label">Slug</label>
                <input
                  type="text"
                  class="form-control"
                  id="slug"
                  name="slug"
                  placeholder="Ingresar Nuevo Slug"
                  required
                />
              </div>
              <div class="mb-3">
                <label class="form-label">Descripción</label>
                <input
                  type="text"
                  class="form-control"
                  id="description"
                  name="description"
                  placeholder="Ingresar Nueva Descripción"
                  required
                />
              </div>
              <div class="mb-3">
                <label class="form-label">Agregar Nueva Imagen</label>
                <input
                  type="file"
                  class="form-control"
                  name="cover"
                  id="cover"
                  accept="image/*"
                />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-light-primary">Guardar cambios</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script>
      function validarFormulario() {
        const name = document.getElementById("name").value.trim();
        const slug = document.getElementById("slug").value.trim();
        const description = document.getElementById("description").value.trim();
        const cover = document.getElementById("cover").files[0];

        if (name === "") {
          alert("Por favor, ingrese el nombre.");
          return false;
        }

        if (slug === "") {
          alert("Por favor, ingrese el slug.");
          return false;
        }

        if (description === "") {
          alert("Por favor, ingrese la descripción.");
          return false;
        }

        const slugPattern = /^[a-z0-9-]+$/;
        if (!slugPattern.test(slug)) {
          alert("El slug solo puede contener letras minúsculas, números y guiones.");
          return false;
        }

        if (cover) {
          const validExtensions = ["image/jpeg", "image/png", "image/jpg"];
          if (!validExtensions.includes(cover.type)) {
            alert("Por favor, seleccione un archivo de imagen válido (JPEG, PNG o JPG).");
            return false;
          }
          if (cover.size > 2 * 1024 * 1024) { // Limitar a 2MB
            alert("El tamaño de la imagen no debe exceder 2MB.");
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


    <!-- [Page Specific JS] start -->
    <script>
      // scroll-block
      var tc = document.querySelectorAll('.scroll-block');
      for (var t = 0; t < tc.length; t++) {
        new SimpleBar(tc[t]);
      }
    </script>
  </body>
  <!-- [Body] end -->
</html>
