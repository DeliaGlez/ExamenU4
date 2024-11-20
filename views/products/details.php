<?php 
  include_once "../../app/config.php";
  include_once "../../app/AuthController.php";
  include_once "../../app/ProductController.php";

  if(!isset($_SESSION['user_data'])){
    header('Location: ' .BASE_PATH. '?error=Error de autenticación, inicie sesión.');
    exit;
  }
  else{
    $authController = new AuthController();
    $productController = new ProductController();

    $link = $_SERVER['REQUEST_URI'];
    $link_array = explode('/', $link);
    $productSlug = end($link_array);

    $profileData = $authController->getProfile();
    $productData = $productController->getProductBySlug($productSlug);

    
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
                  <li class="breadcrumb-item"><a href="">Productos</a></li>
                  <li class="breadcrumb-item" aria-current="page">Detalles de Producto</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Detalles de Producto</h2>
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
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="sticky-md-top product-sticky">
                      <div id="carouselExampleCaptions" class="carousel slide ecomm-prod-slider" data-bs-ride="carousel">
                        <div class="carousel-inner bg-light rounded position-relative">
                          <div class="card-body position-absolute bottom-0 end-0">
                            <ul class="list-inline ms-auto mb-0 prod-likes">
                              <li class="list-inline-item m-0">
                                <a href="#" class="avtar avtar-xs text-white text-hover-primary">
                                  <i class="ti ti-zoom-in f-18"></i>
                                </a>
                              </li>
                              <li class="list-inline-item m-0">
                                <a href="#" class="avtar avtar-xs text-white text-hover-primary">
                                  <i class="ti ti-zoom-out f-18"></i>
                                </a>
                              </li>
                              <li class="list-inline-item m-0">
                                <a href="#" class="avtar avtar-xs text-white text-hover-primary">
                                  <i class="ti ti-rotate-clockwise f-18"></i>
                                </a>
                              </li>
                            </ul>
                          </div>
                          <div class="carousel-item active">
                            <img src="<?= htmlspecialchars($products['cover']) ?>" class="d-block w-100" alt="Product images" />
                          </div>
                        </div>
                        <ol class="list-inline carousel-indicators position-relative product-carousel-indicators my-sm-3 mx-0">
                          <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="list-inline-item w-25 h-auto active">
                            <img src="<?= htmlspecialchars($products['cover']) ?>" class="d-block wid-50 rounded" alt="Product images" />
                          </li>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <h4 class="my-3"><?= htmlspecialchars($products['name']) ?></h4>
                    <h5>(Cambiar a Marca Del Producto)</h5>
                    <h6 class="mt-4 mb-sm-3 mb-2 f-w-500"><?= htmlspecialchars($products['description']) ?></h6>
                    <div class="mb-3 row">
                      
                    </div>
                    <h2 class="mb-4"
                      ><b>$299.00</b>
                    </h2>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header pb-0">
                <ul class="nav nav-tabs profile-tabs mb-0" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a
                      class="nav-link active"
                      id="ecomtab-tab-1"
                      data-bs-toggle="tab"
                      href="#ecomtab-1"
                      role="tab"
                      aria-controls="ecomtab-1"
                      aria-selected="true"
                      >Características
                    </a>
                  </li>
                  <li class="nav-item">
                    <a
                      class="nav-link "
                      id="ecomtab-tab-2"
                      data-bs-toggle="tab"
                      href="#ecomtab-2"
                      role="tab"
                      aria-controls="ecomtab-2"
                      aria-selected="true"
                      >Etiquetas
                    </a>
                  </li>
                  <li class="nav-item">
                    <a
                      class="nav-link "
                      id="ecomtab-tab-3"
                      data-bs-toggle="tab"
                      href="#ecomtab-3"
                      role="tab"
                      aria-controls="ecomtab-3"
                      aria-selected="true"
                      >Categorías
                    </a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane show active" id="ecomtab-1" role="tabpanel" aria-labelledby="ecomtab-tab-1">
                    <div class="table-responsive">
                      <p class="text-muted">
                        It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially
                        unchanged. It was popularized in the 1960s with the release of Lestrade sheets containing Lorem Ipsum passages, and
                        more recently with desktop publishing software like PageMaker including versions of Lorem Ipsum.
                      </p>
                    </div>
                  </div>
                  <div class="tab-pane show" id="ecomtab-2" role="tabpanel" aria-labelledby="ecomtab-tab-2">
                    <div class="table-responsive">
                      <p class="">
                      <div class="table-responsive">
                          <table id="report-table" class="table table-bordered table-striped mb-0">
                            <thead>
                              <tr>
                                <th class="border-top-0">Nombre de Etiqueta</th>
                                <th class="border-top-0">Slug</th>
                                <th class="border-top-0">Descripción</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Apple</td>
                                <td>apple</td>
                                <td>Prdouctos de la marca apple</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </p>
                    </div>
                  </div>
                  <div class="tab-pane show" id="ecomtab-3" role="tabpanel" aria-labelledby="ecomtab-tab-3">
                    <div class="table-responsive">
                      <table id="report-table" class="table table-bordered table-striped mb-0">
                        <thead>
                          <tr>
                            <th class="border-top-0">Nombre de Categoría</th>
                            <th class="border-top-0">Slug</th>
                            <th class="border-top-0">Descripción</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Apple</td>
                            <td>apple</td>
                            <td>Prdouctos de la Categoría deportivo</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card shadow-none">
              <div class="card-header">
                <h5>Presentaciones</h5>
                <div class="card-header-right">
                  <button type="button" class="btn btn-light-warning m-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Agregar Presentación
                  </button>
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
                            ><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Agregar Presentación</h5
                          >
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                        </div>
                        <form onsubmit="return validarFormulario()">
                          <div class="modal-body">
                            <div class="mb-3">
                              <label class="form-label">Descripción</label>
                              <input type="text" class="form-control" id="description" name="description" placeholder="Ingresar Descripción" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Código</label>
                              <input type="text" class="form-control" id="code" name="code" placeholder="Ingresar Código" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Peso en Gramos</label>
                              <input type="number" class="form-control" id="weight_in_grams" name="weight_in_grams" placeholder="Ingresar Peso en Gramos" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Estado</label>
                              <input type="text" class="form-control" id="status" name="status" placeholder="Ingresar Estado" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Subir Imagen de Perfil</label>
                              <input type="file" class="form-control" name="cover" id="cover" accept="image/*" required/>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Stock</label>
                              <input type="number" class="form-control" id="stock" name="stock" placeholder="Ingresar Cantidad de Stock" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Stock Mínimo</label>
                              <input type="number" class="form-control" id="stock_min" name="stock_min" placeholder="Ingresar Stock Mínimo" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Stock Máximo</label>
                              <input type="number" class="form-control" id="stock_max" name="stock_max" placeholder="Ingresar Stock Máximo" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Precio</label>
                              <input type="number" class="form-control" id="amount" name="amount" placeholder="Ingresar Precio del Producto" />
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
                </div>
              </div>

              <div class="card-body shadow border-0">
                <div class="table-responsive">
                  <table id="report-table" class="table table-bordered table-striped mb-0">
                    <thead>
                      <tr>
                        <th class="border-top-0">Imagen</th>
                        <th class="border-top-0">Descripción</th>
                        <th class="border-top-0">Código</th>
                        <th class="border-top-0">Peso</th>
                        <th class="border-top-0">Estado</th>
                        <th class="border-top-0">Precio</th>
                        <th class="border-top-0">Stock</th>
                        <th class="border-top-0">Stock Min</th>
                        <th class="border-top-0">Stock Max</th>
                        <th class="border-top-0">Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <img src="<?= BASE_PATH ?>assets/images/gallery-grid/img-grd-gal-11.jpg" alt="imagen" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                        </td>
                        <td>Descripción del producto</td>
                        <td>271204</td>
                        <td>100 gramos</td>
                        <td>Disponible</td>
                        <td>$1,000</td>
                        <td>3</td>
                        <td>1</td>
                        <td>50</td>
                        <td>
                          <a href="" class="btn btn-sm btn-light-success me-1" data-bs-toggle="modal" data-bs-target="#exampleModal1"><i class="feather icon-edit"></i>
                          </a>
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
                                  <h5 class="modal-title" id="exampleModalLabel"
                                    ><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Modificar Presentación</h5
                                  >
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                </div>
                                <form onsubmit="return validarFormulario()">
                                  <div class="modal-body">
                                    <div class="mb-3">
                                      <label class="form-label">Descripción</label>
                                      <input type="text" class="form-control" id="description" name="description" placeholder="Ingresar Descripción" />
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Código</label>
                                      <input type="text" class="form-control" id="code" name="code" placeholder="Ingresar Código" />
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Peso en Gramos</label>
                                      <input type="number" class="form-control" id="weight_in_grams" name="weight_in_grams" placeholder="Ingresar Peso en Gramos" />
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Estado</label>
                                      <input type="text" class="form-control" id="status" name="status" placeholder="Ingresar Estado" />
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Stock</label>
                                      <input type="number" class="form-control" id="stock" name="stock" placeholder="Ingresar Cantidad de Stock" />
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Stock Mínimo</label>
                                      <input type="number" class="form-control" id="stock_min" name="stock_min" placeholder="Ingresar Stock Mínimo" />
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Stock Máximo</label>
                                      <input type="number" class="form-control" id="stock_max" name="stock_max" placeholder="Ingresar Stock Máximo" />
                                    </div>
                                    <div class="mb-3">
                                      <label class="form-label">Precio</label>
                                      <input type="number" class="form-control" id="amount" name="amount" placeholder="Ingresar Precio del Producto" />
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
                          <a href="" class="btn btn-sm btn-light-danger"><i class="feather icon-trash-2"></i></a>
                          <a href="" class="btn btn-sm btn-light-warning me-1" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i class="feather icon-book-open"></i>
                          </a>
                          <div
                            class="modal fade"
                            id="exampleModal2"
                            tabindex="-1"
                            role="dialog"
                            aria-labelledby="exampleModalLabel2"
                            aria-hidden="true"
                          >
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 80%;">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel"
                                    ><i data-feather="user" class="icon-svg-primary wid-20 me-2"></i>Ordenes de la Presentación</h5
                                  >
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                </div>
                                <div class="table-responsive">
                                  <table id="report-table" class="table table-bordered table-striped mb-0">
                                    <thead>
                                      <tr>
                                        <th>Folio</th>
                                        <th>Total</th>
                                        <th>Está Pagado</th>
                                        <th>Cliente</th>
                                        <th>Dirección</th>
                                        <th>Estado de la Orden</th>
                                        <th>Método de Pago</th>
                                        <th>Cupón</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>1</td>
                                        <td>$1,000</td>
                                        <td>Si</td>
                                        <td>Juan Perez</td>
                                        <td>Chametla</td>
                                        <td>Enviado</td>
                                        <td>Tarjeta</td>
                                        <td>Promo10off</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            

          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>
    
    <?php 

      include "../layouts/footer.php";

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
      // quantity start
      function increaseValue(temp) {
        var value = parseInt(document.getElementById(temp).value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById(temp).value = value;
      }

      function decreaseValue(temp) {
        var value = parseInt(document.getElementById(temp).value, 10);
        value = isNaN(value) ? 0 : value;
        value < 1 ? (value = 1) : '';
        value--;
        document.getElementById(temp).value = value;
      }
      // quantity end
      </script>
      
      <script>
        function validarFormulario() {
          const slug = document.getElementById("productSlug").value.trim();
          const description = document.getElementById("description").value.trim();
          const code = document.getElementById("code").value.trim();
          const weight = document.getElementById("weight_in_grams").value.trim();
          const status = document.getElementById("status").value.trim();
          const stock = document.getElementById("stock").value.trim();
          const stockMin = document.getElementById("stock_min").value.trim();
          const stockMax = document.getElementById("stock_max").value.trim();
          const amount = document.getElementById("amount").value.trim();

          if (slug === "") {
            alert("Por favor, ingrese un slug válido.");
            return false;
          }
          if (!/^[a-z0-9-]+$/.test(slug)) {
            alert("El slug solo puede contener letras minúsculas, números y guiones.");
            return false;
          }

          if (description === "") {
            alert("Por favor, ingrese una descripción.");
            return false;
          }
          if (description.length < 10) {
            alert("La descripción debe tener al menos 10 caracteres.");
            return false;
          }

          if (code === "") {
            alert("Por favor, ingrese un código válido.");
            return false;
          }

          if (weight === "" || isNaN(weight) || weight <= 0) {
            alert("Por favor, ingrese un peso válido en gramos (mayor a 0).");
            return false;
          }

          if (status === "") {
            alert("Por favor, ingrese un estado válido.");
            return false;
          }

          if (stock === "" || isNaN(stock) || stock < 0) {
            alert("Por favor, ingrese un valor válido para el stock.");
            return false;
          }

          if (stockMin === "" || isNaN(stockMin) || stockMin < 0) {
            alert("Por favor, ingrese un valor válido para el stock mínimo.");
            return false;
          }

          if (stockMax === "" || isNaN(stockMax) || stockMax < stockMin) {
            alert("El stock máximo debe ser mayor o igual al stock mínimo.");
            return false;
          }

          if (amount === "" || isNaN(amount) || amount <= 0) {
            alert("Por favor, ingrese un valor mayor a 0");
            return false;
          }
          return true;
        }
      </script>

    
    <?php 

      include "../layouts/modals.php";

      ?>

  </body>
  <!-- [Body] end -->
</html>
