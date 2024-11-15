<?php
include_once "config.php";

if(!isset($_SESSION['user_data'])){
    header('Location: ' .BASE_PATH. '?error=Error de autenticación, inicie sesión.');
}
$tagController = new TagController();
echo json_encode($tagController->getTag(23));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {

        if (isset($_SESSION['global_token']) && $_SESSION['global_token'] === $_POST['global_token']){
            $action = $_POST['action'];
            $tagController = new TagController();
            
            switch ($action) {
                case 'storeTag':
                    $name = $_POST['name'];
                    $description = $_POST['description']; 
                    $slug = $_POST['slug'];
                    $tagController->storeTag($name,$description,$slug);

                    break;
                case 'deleteTag':
                    $idTag = $_POST['id']; 
                    $tagController->deleteTag($idTag);
                    break;
                case 'updateTag':
                    $idTag = $_POST['id']; 
                    $name = $_POST['name']; 
                    $description = $_POST['description']; 
                    $slug = $_POST['slug']; 
                    $tagController->updateTag($idTag,$name,$description,$slug);
                break;
                default:
                    echo "Accion desconocida";
                    break;
            }
        } 
    }
}
class TagController
{
    public function storeTag($name,$description,$slug){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/tags',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('name' => $name,'description' => $description,'slug' =>$slug),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response, true);
        $this->returnToFrontAlert($result, 4); 
    }

    public function getTag($idTag){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/tags/'. intval($idTag),
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


    public function getTags(){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/tags',
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

    public function updateTag($id, $name, $description, $slug) {
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
    
        $postData = http_build_query([
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'slug' => $slug,
        ]);
    
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/tags',
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
    
    public function deleteTag($idTag){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/tags/'. intval($idTag),
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
            header('Location: ' . BASE_PATH . 'tags?message=' . urlencode($data['message'])); //Corregir redireccion
        } 
        else{
            $message = isset($data['message']) ? $data['message'] : 'Error desconocido'; //Corregir redireccion
            header('Location: ' . BASE_PATH . 'tags?error=' . urlencode($message)); 
        }
        exit;
    }
}
?>