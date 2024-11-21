<?php 
  include_once "../app/config.php";
  include_once "../app/AuthController.php";
  include_once "../app/ProductController.php";
  include_once "../app/BrandController.php";
  include_once "../app/TagController.php";
  include_once "../app/CategoryController.php";

  if(!isset($_SESSION['user_data'])){
    header('Location: ' .BASE_PATH. '?error=Error de autenticación, inicie sesión.');
    exit;
  }
  else{
    $authController = new AuthController();
    $productController = new ProductController();
    $brandController = new BrandController();
    $categoryController = new CategoryController();
    $tagController = new TagController();

    $profileData = $authController->getProfile();
    $productData = $productController->getProducts();
    $brandData = $brandController->getBrands();
    $categoryData= $categoryController->getCategories();
    $tagData = $tagController->getTags();

    $tags = $tagData['data'];
    $categories = $categoryData['data'];
    $brands = $brandData['data'];
    $products = $productData ['data'];
    $user = $profileData['data'];
    
  }
  $error_message = isset($_GET['error']) ? $_GET['error'] : '';
?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
     <?php 

      include "layouts/head.php";

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
                  <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                  <li class="breadcrumb-item" aria-current="page">Productos</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Productos</h2>
                </div>
              </div>
            </div>
          </div>

          <button type="button" class="btn btn-light-warning m-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Crear Producto
          </button>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-sm-12">
            <div class="ecom-wrapper">
              <div class="ecom-content">
                <div class="row">
                  <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                      
                    <div class="col-sm-6 col-xl-4">
                      <div class="card product-card">
                        <div class="card-img-top">
                          <a href="<?= BASE_PATH ?>products/<?= $product['slug'] ?>">
                            <img src=<?= htmlspecialchars($product['cover']) ?> alt="image" class="img-prod img-fluid" />
                          </a>
                        </div>
                        <div class="card-body">
                        <a href="<?= BASE_PATH ?>products/<?= $product['slug'] ?>">
                            <h4 class="prod-content mb-0 text-truncate"><?= htmlspecialchars($product['name']) ?></h4>
                          </a>
                          <div class="d-flex align-items-center justify-content-between mt-2 mb-3 flex-wrap gap-1">
                            <p class="mb-0 text-muted"
                              ><b><?= htmlspecialchars($product['slug']) ?></b>
                            </p>
                          </div>
                          <div class="d-flex">
                            <div class="flex-shrink-0">
                            <?php
                              $product['categories'] = array_map("unserialize", array_unique(array_map("serialize", $product['categories'])));
                              $product['tags'] = array_map("unserialize", array_unique(array_map("serialize", $product['tags'])));
                            ?>
                            <a 
                              href="#" class="btn btn-sm btn-light-success me-1" data-bs-toggle="modal" data-bs-target="#exampleModal1"
                                data-id="<?= htmlspecialchars($product['id']) ?>"
                                data-name="<?= htmlspecialchars($product['name'] ?? 'N/A') ?>"
                                data-description="<?= htmlspecialchars($product['description'] ?? 'N/A') ?>"
                                data-slug="<?= htmlspecialchars($product['slug'] ?? 'N/A') ?>"
                                data-features="<?= htmlspecialchars($product['features'] ?? 'N/A') ?>"
                                data-brand="<?= htmlspecialchars($product['brand']['id'] ?? 'N/A') ?>"
                                data-categories="<?= htmlspecialchars(json_encode(array_map(function($category) {
                                    return ['id' => $category['id'], 'name' => $category['name']];
                                }, $product['categories']))) ?>"
                                data-tags="<?= htmlspecialchars(json_encode(array_map(function($tag) {
                                    return ['id' => $tag['id'], 'name' => $tag['name']];
                                }, $product['tags']))) ?>"
                              >
                                <i class="ti ti-edit f-18"></i>
                              </a>
                            </div>
                            <div class="flex-shrink-0">
                              <a href="" onclick="remove(<?= $product['id'] ?>)" class="avtar avtar-s btn-link-danger btn-prod-card" data-bs-toggle="offcanvas">
                                <i class="ti ti-trash f-18"></i>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>
    <!-- [  Editar ] end -->
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
          <form method="POST" action="product" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  name="name"
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
                  required
                />
              </div>
              <div class="mb-3">
                <label class="form-label">Características</label>
                <input
                  type="text"
                  class="form-control"
                  id="features"
                  name="features"
                  required
                />
              </div>
              <div class="mb-3">
            <label class="form-label">Marca</label>
                  <select id="brand_id" name="brand_id" class="form-select">
                      <?php
                      foreach ($brands as $brand) {
                          $selected = ($brand['id'] == $currentBrandId) ? 'selected' : '';
                          echo "<option value=\"{$brand['id']}\" $selected>{$brand['name']}</option>";
                      }
                      ?>
                  </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Categoría</label>
                
                <select name="categories[]" id="categoria_original_edit" class="form-select" >
                  <?php foreach ($categories as $category): ?>
                      <option value="<?= htmlspecialchars($category['id']) ?>">
                          <?= htmlspecialchars($category['name']) ?>
                      </option>
                  <?php endforeach; ?>
                </select>

                <div id="otra_categoria_edit">
                </div>

                <button type="button" class="btn btn-primary mb-4" onclick="addCategoryEdit()">
                  Añadir otra categoría
                </button>
              </div>
              <div class="mb-3">
                <label class="form-label">Etiquetas</label>
                
                <select name="tags[]" id="etiqueta_original_edit" class="form-select" >
                  <?php foreach ($tags as $tag): ?>
                      <option value="<?= htmlspecialchars($tag['id']) ?>">
                          <?= htmlspecialchars($tag['name']) ?>
                      </option>
                  <?php endforeach; ?>
                </select>

                <div id="otra_etiqueta_edit">
                </div>

                <button type="button" class="btn btn-primary mb-4" onclick="addTagEdit()">
                  Añadir otra etiqueta
                </button>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-light-primary">Actualizar Producto</button>
            </div>
            <input type="hidden" id="id" name="id" value="<?= $product['id'] ?>" />
            <input type="hidden" name="action" value="updateProduct">
            <input type="hidden" name="global_token" value="<?= $_SESSION['global_token']; ?>">
          </form>
        </div>
      </div>
    </div>
    <form id="delete-form" action="product" method="POST">
      <input type="hidden" name="action" value="deleteProduct" />
      <input type="hidden" id="delete-product-id" name="id" />
      <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
    </form>
    <!-- [  Agregar ] end -->
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
              ><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Crear Producto</h5
            >
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
          </div>
          <form method="POST" action="product" enctype="multipart/form-data" >
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  name="name"
                  placeholder="Ingresar Nombre"
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
                  placeholder="Ingresar Slug"
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
                  placeholder="Ingresar Descripción del Producto"
                  required
                />
              </div>
              <div class="mb-3">
                <label class="form-label">Características</label>
                <input
                  type="text"
                  class="form-control"
                  id="features"
                  name="features"
                  placeholder="Ingresar Características del Producto"
                  required
                />
              </div>
              <div class="mb-3">
                <label class="form-label">Marca</label>
                <select id="brand_id" name="brand_id" class="form-select">
                    <?php
                      foreach ($brands as $brand) {
                        echo "<option value=\"{$brand['id']}\">{$brand['name']}</option>";
                      }
                    ?>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Agregar Imagen</label>
                <input
                  type="file"
                  class="form-control"
                  name="cover"
                  id="cover"
                  accept="image/*"
                />
              </div>
              <div class="mb-3">
                <label class="form-label">Categoría</label>
                
                <select name="categories[]" id="categoria_original" class="form-select">
                    <?php
                      foreach ($categories as $category) {
                        echo "<option value=\"{$category['id']}\">{$category['name']}</option>";
                      }
                    ?>
                </select>

                <div id="otra_categoria">
                </div>

                <button type="button" class="btn btn-primary mb-4" onclick="addCategory()">
                  Añadir otra categoría
                </button>
              </div>
              <div class="mb-3">
                <label class="form-label">Etiquetas</label>
                
                <select name="tags[]" id="etiqueta_original" class="form-select">
                    <?php
                      foreach ($tags as $tag) {
                        echo "<option value=\"{$tag['id']}\">{$tag['name']}</option>";
                      }
                    ?>
                </select>

                <div id="otra_etiqueta">
                </div>

                <button type="button" class="btn btn-primary mb-4" onclick="addTag()">
                  Añadir otra etiqueta
                </button>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-light-primary">Crear Producto</button>
            </div>
              <input type="hidden" name="action" value="storeProduct">
              <input type="hidden" name="global_token" value="<?= $_SESSION['global_token']; ?>">
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

    <script type="text/javascript">
      function addCategory() {
        
        let category = document.getElementById('categoria_original').innerHTML

         
        let new_code = '<select name="category[]"  class="form-select">'
        new_code += category; 
        new_code += '</select>'

        var nuevoElementoHTML = document.getElementById('otra_categoria').innerHTML + new_code ; 
        
        document.getElementById("otra_categoria").innerHTML = nuevoElementoHTML;

      }
    </script>

    <script type="text/javascript">
      function addTag() {
        
        let tag = document.getElementById('etiqueta_original').innerHTML

         
        let new_code = '<select name="tag[]"  class="form-select">'
        new_code += tag; 
        new_code += '</select>'

        var nuevoElementoHTML = document.getElementById('otra_etiqueta').innerHTML + new_code ; 
        
        document.getElementById("otra_etiqueta").innerHTML = nuevoElementoHTML;

      }
    </script>


    <script type="text/javascript">
      let categoryCount = 0;
      function addCategoryEdit() {
        // Obtener las opciones del select original
        const originalOptions = document.getElementById('categoria_original_edit').innerHTML;

        // Crear un nuevo select independiente
        const newSelect = document.createElement('select');
        newSelect.name = "categories[]";
        newSelect.className = "form-select";

        // Generar un id único para el nuevo select
        categoryCount++;
        newSelect.id = "categoria_original_edit_" + categoryCount;

        newSelect.innerHTML = originalOptions;

        // Agregar el nuevo select al contenedor
        document.getElementById('otra_categoria_edit').appendChild(newSelect);
      }
    </script>

    <script type="text/javascript">
      function addTagEdit() {
        let tagCount = 0;
        // Obtener las opciones del select original
        const originalOptions = document.getElementById('etiqueta_original_edit').innerHTML;

        // Crear un nuevo select independiente
        const newSelect = document.createElement('select');
        newSelect.name = "tags[]";
        newSelect.className = "form-select";

        // Generar un id único para el nuevo select
        tagCount++;
        newSelect.id = "etiqueta_original_edit_" + tagCount;
        
        newSelect.innerHTML = originalOptions;

        // Agregar el nuevo select al contenedor
        document.getElementById('otra_etiqueta_edit').appendChild(newSelect);
      }
    </script>



<script>
      document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.btn-light-success');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const description = button.getAttribute('data-description');
            const slug = button.getAttribute('data-slug');
            const features = button.getAttribute('data-features');
            const brand = button.getAttribute('data-brand');
            let categories = JSON.parse(button.getAttribute('data-categories') || '[]');
            let tags = JSON.parse(button.getAttribute('data-tags') || '[]');

            console.log(id, name, description, slug, features, brand, categories, tags);

            document.getElementById('id').value = id;
            document.getElementById('name').value = name;
            document.getElementById('description').value = description;
            document.getElementById('slug').value = slug;
            document.getElementById('features').value = features;
            document.getElementById('brand_id').value = brand;

            if (!Array.isArray(categories)) {
              categories = [categories];
            }
            if (!Array.isArray(tags)) {
              tags = [tags];
            }

            // Llenar los select de categorias
            const categoryContainer = document.getElementById('otra_categoria_edit');
            categoryContainer.innerHTML = ''; // Limpiar los contenedores previos
            categories.forEach(category => {
                const categorySelect = document.createElement('select');
                categorySelect.name = "categories[]";
                categorySelect.className = "form-select";

                // Copiar las opciones disponibles
                const originalOptions = document.getElementById('categoria_original_edit').innerHTML;
                categorySelect.innerHTML = originalOptions;

                // Seleccionar la etiqueta correspondiente
                categorySelect.value = category.id;

                // Agregar el nuevo select al contenedor
                categoryContainer.appendChild(categorySelect);
            });

            // Llenar los select de etiquetas
            const tagContainer = document.getElementById('otra_etiqueta_edit');
            tagContainer.innerHTML = ''; // Limpiar los contenedores previos
            tags.forEach(tag => {
                const tagSelect = document.createElement('select');
                tagSelect.name = "tags[]";
                tagSelect.className = "form-select";

                // Copiar las opciones disponibles
                const originalOptions = document.getElementById('etiqueta_original_edit').innerHTML;
                tagSelect.innerHTML = originalOptions;

                // Seleccionar la etiqueta correspondiente
                tagSelect.value = tag.id;

                // Agregar el nuevo select al contenedor
                tagContainer.appendChild(tagSelect);
            });
        });
    });
});
    </script>

    <?php 

      include "layouts/footer.php";

    ?>
    
    <?php 

      include "layouts/modals.php";

    ?>

    <?php 

      include "layouts/scripts.php";

    ?>


    <!-- [Page Specific JS] start -->
    <script>
      // scroll-block
      var tc = document.querySelectorAll('.scroll-block');
      for (var t = 0; t < tc.length; t++) {
        new SimpleBar(tc[t]);
      }
    </script>
    <script>
      function remove(productID) {
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
                document.getElementById("delete-product-id").value = productID;
                // Enviar el formulario
                document.getElementById("delete-form").submit();
            }
        });
    }
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
                window.history.replaceState({}, document.title, "<?= BASE_PATH ?>home");
              });
          } else if (errorMessage) {
            swal("Error", errorMessage, "error")
              .then(() => {
                // quita ulr clean
                window.history.replaceState({}, document.title, "<?= BASE_PATH ?>home");
              });
          }
        });
      </script>
    <?php endif; ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </body>
  <!-- [Body] end -->
</html>
