<?php
include_once "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {

        if (isset($_SESSION['global_token']) && $_SESSION['global_token'] === $_POST['global_token']){
            $action = $_POST['action'];
            $clientController = new ClientController();
            
            switch ($action) {
                case 'storeUser':
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $phone = $_POST['phone_number'];
                    $isSubscribed= $_POST['is_subscribed'];
                    $levelId = $_POST['level_id'];
                    
                    $clientController->storeClient($name,$email,$password,$phone,$isSubscribed,$levelId);

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

    public function storeClient($name,$email,$password,$phone,$isSubscribed,$levelId){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';

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
        return $this->returnToFront($result, 4); 
   
    }

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
        return $this->returnToFront($result, 2);  
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
}


?>