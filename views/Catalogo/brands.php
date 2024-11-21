<?php 
  include_once "../../app/config.php";
  include_once "../../app/AuthController.php";
  include_once "../../app/BrandController.php";

  if(!isset($_SESSION['user_data'])){
    header('Location: ' .BASE_PATH. '?error=Error de autenticación, inicie sesión.');
    exit;
  }
  else{
    $authController = new AuthController();
    $brandController = new BrandController();

    $profileData = $authController->getProfile();
    $brandData = $brandController->getBrands();

    $brands = $brandData['data'];
    $user = $profileData['data'];
    
  }
  $error_message = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <title>Lista de Marcas | </title>
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
                  <li class="breadcrumb-item" aria-current="page">Marcas</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Marcas</h2>
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
                <h5>Marcas</h5>
                <div class="card-header-right">
                  <button type="button" class="btn btn-light-warning m-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Agregar Marca
                  </button>
                </div>
              </div>
              <div class="card-body shadow border-0">
                <div class="table-responsive">
                  <table id="report-table" class="table table-bordered table-striped mb-0">
                    <thead>
                      <tr>
                        <th class="border-top-0">ID</th>
                        <th class="border-top-0">Nombre de Marca</th>
                        <th class="border-top-0">Descripción de la Marca</th>
                        <th class="border-top-0">Slug de Marca</th>
                        <th class="border-top-0">Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($brands)): ?>
                      <?php foreach ($brands as $brand): ?>
                      <tr>
                        <td><?= htmlspecialchars($brand['id']) ?></td> 
                        <td><?= htmlspecialchars($brand['name']) ?></td>
                        <td><?= htmlspecialchars($brand['description']) ?></td>
                        <td><?= htmlspecialchars($brand['slug']) ?></td>
                        <td>
                          <a 
                          href="#" class="btn btn-sm btn-light-success me-1" data-bs-toggle="modal" data-bs-target="#exampleModal1"
                            data-id="<?= htmlspecialchars($brand['id']) ?>"
                            data-name="<?= htmlspecialchars($brand['name'] ?? 'N/A') ?>"
                            data-description="<?= htmlspecialchars($brand['description'] ?? 'N/A') ?>"
                            data-slug="<?= htmlspecialchars($brand['slug'] ?? 'N/A') ?>"
                          >
                            <i class="feather icon-edit"></i>
                          </a>
                          <a href="<?= BASE_PATH ?>brands_products/<?= htmlspecialchars($brand['id']) ?>" class="btn btn-sm btn-light-info me-1"><i class="feather icon-eye"></i></a>
                          <a href="#" onclick="remove(<?= $brand['id'] ?>)" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                        </td>
                        <?php endforeach; ?>
                      <?php endif; ?>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <form id="delete-form" action="brand" method="POST">
      <input type="hidden" name="action" value="deleteBrand" />
      <input type="hidden" id="delete-brand-id" name="id" />
      <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
    </form>
    <div
      class="modal fade"
      id="exampleModal1"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel1"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">
              <i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>
              Modificar Marca
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <form method="POST" action="brand" enctype="multipart/form-data" onsubmit="return validarFormulario()">
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Nuevo Nombre de Marca</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  name="name"
                />
              </div>
              <div class="mb-3">
                <label class="form-label">Nueva Descripción de Marca</label> 
                <input
                  type="text"
                  class="form-control"
                  id="description"
                  name="description"
                />
              </div>
              <div class="mb-3">
                <label class="form-label">Nuevo Slug de Marca</label> 
                <input
                  type="text"
                  class="form-control"
                  id="slug"
                  name="slug"
                />
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-light-danger"
                data-bs-dismiss="modal"
              >
                Cerrar
              </button>
              <button type="submit" class="btn btn-light-primary">
                Guardar cambios
              </button>
            </div>
            <input type="hidden" id="id" name="id" value="<?= $brand['id'] ?>" />
            <input type="hidden" name="action" value="updateBrand"/>
            <input type="text" name="global_token" value=<?= $_SESSION['global_token'] ?> hidden>
          </form>
        </div>
      </div>
    </div>
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
              ><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Agregar Marca</h5
            >
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
          </div>
          <form  method="POST" action="brand" onsubmit="return validarFormulario()">
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label"> Nuevo Nombre de Marca</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Ingresar Nombre" />
              </div>
              <div class="mb-3">
                <label class="form-label"> Nueva Descripción de Marca</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Ingresar Descripción" /> 
              </div>
              <div class="mb-3">
                <label class="form-label"> Nuevo Slug de Marca</label>
                <input type="text" class="form-control" id="slug" name="slug" placeholder="Ingresar Slug" /> 
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-light-primary">Guardar cambios</button>
            </div>
            <input type="hidden" name="action" value="storeBrand"/>
            <input type="text" name="global_token" value=<?= $_SESSION['global_token'] ?> hidden>
          </form>
        </div>
      </div>
    </div>
    <!-- [ Main Content ] end -->
    <script>
      function validarFormulario() {
        const name = document.getElementsByName("name")[0].value.trim();
        const description = document.getElementsByName("description")[1].value.trim();
        const slug = document.getElementsByName("slug")[2].value.trim();

        if (name === "") {
          alert("Por favor, ingrese un nombre válido para la marca.");
          return false;
        }
        if (name.length < 3) {
          alert("El nombre de la marca debe tener al menos 3 caracteres.");
          return false;
        }

        if (description === "") {
          alert("Por favor, ingrese una descripción para la marca.");
          return false;
        }
        if (description.length < 10) {
          alert("La descripción debe tener al menos 10 caracteres.");
          return false;
        }

        if (slug === "") {
          alert("Por favor, ingrese un slug válido para la marca.");
          return false;
        }
        if (!/^[a-z0-9-]+$/.test(slug)) {
          alert("El slug solo puede contener letras minúsculas, números y guiones.");
          return false;
        }
        return true;
      }
    </script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.btn-light-success');

        editButtons.forEach(button => {
          button.addEventListener('click', function() {
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const description = button.getAttribute('data-description');
            const slug = button.getAttribute('data-slug');

            console.log(id, name, description, slug,);

            document.getElementById('id').value = id;
            document.getElementById('name').value = name;
            document.getElementById('description').value = description;
            document.getElementById('slug').value = slug;
          });
        });
      });
    </script>
    <script>
      function remove(brandId) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this address!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                // Actualiza los valores en el formulario
                document.getElementById("delete-brand-id").value = brandId;
                // Enviar el formulario
                document.getElementById("delete-form").submit();
            }
        });
    }
    </script>
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
                window.history.replaceState({}, document.title, "<?= BASE_PATH ?>brands");
              });
          } else if (errorMessage) {
            swal("Error", errorMessage, "error")
              .then(() => {
                // quita ulr clean
                window.history.replaceState({}, document.title, "<?= BASE_PATH ?>brands");
              });
          }
        });
      </script>
    <?php endif; ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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


  </body>
  <!-- [Body] end -->
</html>
