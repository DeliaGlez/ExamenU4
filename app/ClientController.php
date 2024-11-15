<?php
include_once "config.php";

if(!isset($_SESSION['user_data'])){
    header('Location: ' .BASE_PATH. '?error=Error de autenticación, inicie sesión.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {

        if (isset($_SESSION['global_token']) && $_SESSION['global_token'] === $_POST['global_token']){
            $action = $_POST['action'];
            $clientController = new ClientController();
            
            switch ($action) {
                case 'storeClient':
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone_number'];
                    $isSubscribed= $_POST['is_suscribed'];
                    $levelId = $_POST['level_id'];
                    
                    $clientController->storeClient($name,$email,$phone,$isSubscribed,$levelId);

                    break;
                case 'deleteClient':
                    $id = $_POST['id']; 
                    $clientController->deleteClient($id);
                    break;
                case 'updateClient':
                    $id = $_POST['id']; 
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone_number'];
                    $isSubscribed= $_POST['is_suscribed'];
                    $levelId = $_POST['level_id'];
                    
                    $clientController->updateClient($id,$name,$email,$phone,$isSubscribed,$levelId);
                break;
                default:
                    echo "Accion desconocida";
                    break;
            }
        } 
    }
}

class ClientController
{
    //Guardar cliente
    public function storeClient($name,$email,$password,$phone,$isSubscribed,$levelId){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('name' => $name,
            'email' => $email,
            'password' => $password,
            'phone_number' => $phone,
            'is_suscribed' => $isSubscribed,
            'level_id' => $levelId),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
          ));
          
        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response, true);
        $this->returnToFrontAlert($result, 4); 
   
    }

    // Eliminar cliente
    public function deleteClient($clientId){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients/'. intval($clientId),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));
  
        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response, true);
        $this->returnToFrontAlert($result, 2); 
    }

    // Actualizar cliente
    public function updateClient($id, $name, $email, $password, $phone, $isSubscribed, $levelId) {
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();
    
        $postFields = array(
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone,
            'is_suscribed' => $isSubscribed,
            'level_id' => $levelId,
        );
    
        if (!empty($password)) {
            $postFields['password'] = $password;
        }
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => http_build_query($postFields),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Bearer ' . $token
            ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
    
        $result = json_decode($response, true);
        $this->returnToFrontAlert($result, 4); 
    }

    // Obtener lista de clientes
    public function getClients(){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients',
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
    // Obtener informacion cliente
    public function getClient($clientId){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/clients/'. intval($clientId),
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
            header('Location: ' . BASE_PATH . 'clients?message=' . urlencode($data['message'])); 
        } 
        else{
            $message = isset($data['message']) ? $data['message'] : 'Error desconocido'; 
            header('Location: ' . BASE_PATH . 'clients?error=' . urlencode($message)); 
        }
        exit;
    }
}


?>