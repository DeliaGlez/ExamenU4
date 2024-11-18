<?php
include_once "config.php";

if(!isset($_SESSION['user_data'])){
    header('Location: ' .BASE_PATH. '?error=Error de autenticación, inicie sesión.');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {

        if (isset($_SESSION['global_token']) && $_SESSION['global_token'] === $_POST['global_token']){
            $action = $_POST['action'];
            $productController = new ProductController();
            
            switch ($action) {
                case 'storeProduct':
                    $name = $_POST['name'];
                    $slug = $_POST['slug'];
                    $description = $_POST['description']; 
                    $features = $_POST['features']; 
                    $brand_id = $_POST['brand_id']; 
                    $cover = $_FILES['cover']['tmp_name'];
                    $categories = $_POST['categories'];
                    $tags = $_POST['tags']; 

                    $productController->storeProduct($name, $slug, $description, $features, $brand_id, $cover, $categories, $tags);

                    break;
                case 'deleteProduct':
                    $idProduct = $_POST['id']; 
                    $productController->deleteProduct($idProduct);
                    break;
                case 'updateProduct':
                    $idProduct = $_POST['id']; 
                    $name = $_POST['name'];
                    $slug = $_POST['slug'];
                    $description = $_POST['description']; 
                    $features = $_POST['features']; 
                    $brand_id = $_POST['brand_id']; 
                    $cover = $_FILES['cover']['tmp_name'];
                    $categories = $_POST['categories'];
                    $tags = $_POST['tags']; 
 
                    $productController->updateProduct($idProduct,$name, $slug, $description, $features, $brand_id, $cover, $categories, $tags);
                break;
                default:
                    echo "Accion desconocida";
                    break;
            }
        } 
    }
}
class ProductController
{
    public function storeProduct($name, $slug, $description, $features, $brand_id, $cover, $categories, $tags){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();

        $postFields = [
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'features' => $features,
            'brand_id' => $brand_id,
            'cover' => new CURLFILE($cover),
        ];

        foreach ($categories as $index => $category) {
            $postFields["categories[$index]"] = $category;
        }

        foreach ($tags as $index => $tag) {
            $postFields["tags[$index]"] = $tag;
        }
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response, true);
        $this->returnToFrontAlert($result, 4); 
    }

    public function getProductBySlug($slug){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/slug/'.$slug,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
          ));
        

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response, true);
        return $this->returnToFront($result, 4); 
    }


    public function getProducts(){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
          ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response, true);
        return $this->returnToFront($result, 4); 
    }

    public function updateProduct($idProduct, $name, $slug, $description, $features, $brand_id, $categories, $tags) {
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
    
        $postFields = [
            'id' => $idProduct,
            'name' => $name,
            'description' => $description,
            'slug' => $slug,
            'features' => $features,
            'brand_id' => $brand_id,
        ];
    
        foreach ($categories as $index => $category) {
            $postFields["categories[$index]"] = $category;
        }
    
        foreach ($tags as $index => $tag) {
            $postFields["tags[$index]"] = $tag;
        }
    
        $postData = http_build_query($postFields);
    
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Bearer ' . $token,
            ),
        ));
    
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response, true);
        $this->returnToFrontAlert($result, 4);
    }
    
    
    public function deleteProduct($idProduct){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/'. intval($idProduct),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
            ),
          ));

        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response, true);
        $this->returnToFrontAlert($result, 2); 
    }

    private function returnToFront($data, $code){
        if (isset($data['code']) && $data['code'] === intval($code)) { 
            return [ 
                'success' => true, 
                'data' => $data['data'],
                'message' => $data['message'] 
            ];
        } else {
            return [ 
                'success' => false, 
                'message' => isset($data['message']) ? $data['message'] : 'Error desconocido' 
            ];
        }
    }

    public function returnToFrontAlert($data, $code){
        if (isset($data['code']) && $data['code'] === intval($code)) { // Envio del mensaje mediante url success
            header('Location: ' . BASE_PATH . 'products?message=' . urlencode($data['message'])); //Corregir redireccion
        } 
        else{
            $message = isset($data['message']) ? $data['message'] : 'Error desconocido'; //Corregir redireccion
            header('Location: ' . BASE_PATH . 'products?error=' . urlencode($message)); 
        }
        exit;
    }
}
?>