<?php
include_once "config.php";

if(!isset($_SESSION['user_data'])){
    header('Location: ' .BASE_PATH. '?error=Error de autenticación, inicie sesión.');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {

        if (isset($_SESSION['global_token']) && $_SESSION['global_token'] === $_POST['global_token']){
            $action = $_POST['action'];
            $presentationController = new PresentationController();
            
            switch ($action) {
                case 'storePresentation':
                    $productSlug = $_POST['product_slug'];
                    $idProduct = $_POST['product_id'];
                    $description = $_POST['description']; 
                    $code = $_POST['code'];
                    $weight_in_grams = $_POST['weight_in_grams'];
                    $status = $_POST['status'];
                    $cover = $_FILES['cover']['tmp_name'];
                    $stock = $_POST['stock']; 
                    $stock_min = $_POST['stock_min']; 
                    $stock_max = $_POST['stock_max']; 
                    $amount = $_POST['amount']; 

                    $presentationController->storePresentation($productSlug,$idProduct,$description,$code,$weight_in_grams,$status,$cover,$stock,$stock_min,$stock_max,$amount);

                    break;
                case 'deletePresentation':
                    $productSlug = $_POST['product_slug'];
                    $idPresentation = $_POST['id']; 
                    $presentationController->deletePresentation($productSlug,$idPresentation);
                    break;
                case 'updatePresentation':
                    $productSlug = $_POST['product_slug'];
                    $idPresentation = $_POST['id']; 
                    $idProduct = $_POST['product_id'];
                    $description = $_POST['description']; 
                    $code = $_POST['code'];
                    $weight_in_grams = $_POST['weight_in_grams'];
                    $status = $_POST['status'];
                    $cover = $_FILES['cover']['tmp_name'];
                    $stock = $_POST['stock']; 
                    $stock_min = $_POST['stock_min']; 
                    $stock_max = $_POST['stock_max']; 
                    $amount = $_POST['amount']; 
 
                    $presentationController->updatePresentation($productSlug,$idPresentation,$idProduct,$description,$code,$weight_in_grams,$status,$stock,$stock_min,$stock_max,$amount);
                break;
                default:
                    echo "Accion desconocida";
                    break;
            }
        } 
    }
}
class PresentationController
{
    public function storePresentation($productSlug,$idProduct, $description, $code, $weight_in_grams, $status, $cover, $stock, $stock_min, $stock_max, $amount) {
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();
    
        $postFields = [
            'product_id' => $idProduct,
            'description' => $description,
            'code' => $code,
            'weight_in_grams' => $weight_in_grams,
            'status' => $status,
            'stock' => $stock,
            'stock_min' => $stock_min,
            'stock_max' => $stock_max,
            'amount' => $amount,
        ];
    
        if ($cover) {
            $postFields['cover'] = new CURLFILE($cover);
        }
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations',
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
        $this->returnToFrontAlert($result, 4,$productSlug);
    }
    

    public function getPresentation($idPresentation){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations/'. intval($idPresentation),
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


    public function getPresentationsOfProduct($idProduct){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations/product/'. intval($idProduct),
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

    public function updatePresentation($productSlug,$idPresentation,$idProduct, $description, $code, $weight_in_grams, $status, $stock, $stock_min, $stock_max, $amount) {
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
    
        $postFields = [
            'id' => $idPresentation,
            'product_id' => $idProduct,
            'description' => $description,
            'code' => $code,
            'weight_in_grams' => $weight_in_grams,
            'status' => $status,
            'stock' => $stock,
            'stock_min' => $stock_min,
            'stock_max' => $stock_max,
            'amount' => $amount,
        ];
    
        $postData = http_build_query($postFields);
    
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations',
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
        $this->returnToFrontAlert($result, 4,$productSlug);
    }
    
    
    public function deletePresentation($productSlug,$idPresentation){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations/'. intval($idPresentation),
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
        $this->returnToFrontAlert($result, 2,$productSlug); 
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

    public function returnToFrontAlert($data, $code,$productSlug){
        if (isset($data['code']) && $data['code'] === intval($code)) { // Envio del mensaje mediante url success
            header('Location: ' . BASE_PATH . 'products/'. $productSlug .'?message=' . urlencode($data['message'])); 
        } 
        else{
            $message = isset($data['message']) ? $data['message'] : 'Error desconocido'; 
            header('Location: ' . BASE_PATH . 'products/'. $productSlug .'?error=' . urlencode($message)); 
        }
        exit;
    }
}
?>