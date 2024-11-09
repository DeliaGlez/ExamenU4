<?php 

include_once "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {

        if(isset($_SESSION['global_token'])=== $_POST['global_token']){

            $action = $_POST['action'];
            $authController = new UserController();
            
            switch ($action) {
                case 'storeUser':
                    
                    break;

                default:
                    echo "Accion desconocida";
                    break;
            }
        } 
    }
}


class UserController
{
    public function getUsers(){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users',
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

    public function getUserById($userId){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users/' . intval($userId),
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

    public function deleteUser($userId){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users/'.intval($userId),
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

    public function storeUser(){
       
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