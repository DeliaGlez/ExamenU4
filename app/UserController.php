<?php 

include_once "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {

        if (isset($_SESSION['global_token']) && $_SESSION['global_token'] === $_POST['global_token']){
            $action = $_POST['action'];
            $authController = new UserController();
            
            switch ($action) {
                case 'storeUser':
                    $name = $_POST['name'];
                    $lastname = $_POST['lastname'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone_number'];
                    $password = $_POST['password'];
                    $photo = $_FILES['profile_photo_file']['tmp_name'];

                    $authController->storeUser($name,$lastname,$email,$phone,$password,$photo);

                    break;
                case 'updateUser':
                    $id= $_POST['id'];
                    $name = $_POST['name'];
                    $lastname = $_POST['lastname'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone_number'];
                    $password = $_POST['password'];
                    $photo = isset($_FILES['profile_photo_file']['tmp_name']) ? $_FILES['profile_photo_file']['tmp_name'] : null;
                    
                    $authController->updateUser($id, $name, $lastname, $email, $phone, $password, $photo);
                 case 'updateProfileImage': // En caso de actualizar solo la foto
                    $id= $_POST['id'];
                    $photo = $_FILES['profile_photo_file']['tmp_name'];

                    $authController->updateProfileImage($id,$photo);
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

    public function storeUser($name,$lastname,$email,$phone,$password,$photo){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $userData = isset($_SESSION['user_data']) ? $_SESSION['user_data'] : null;

        if ($userData) {
            $createdBy = $userData['name'] . ' ' . $userData['lastname'];
        } else {
            header('Location: ' . BASE_PATH); // Redireccionar al login si no existe la información de la sesión
            exit(); 
        }
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'phone_number' => $phone,
            'created_by' => $createdBy,
            'role' => 'Administrador',
            'password' => $password,
            'profile_photo_file'=> new CURLFILE($photo)),
            CURLOPT_HTTPHEADER => array(
              'Authorization: Bearer ' . $token
            ),
          ));


        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response, true);
        return $this->returnToFront($result, 4);  
    }

    public function updateUser($id, $name, $lastname, $email, $phone, $password, $photo=null) {
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();

        $postFields = array('id' => $id);

        if (!empty($name)) $postFields['name'] = $name; 
        if (!empty($lastname)) $postFields['lastname'] = $lastname; 
        if (!empty($email)) $postFields['email'] = $email; 
        if (!empty($phone)) $postFields['phone_number'] = $phone; 
        if (!empty($password)) $postFields['password'] = $password;

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users',
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
        $resultUpdateData= $this->returnToFront($result, 4);

        if ($resultUpdateData['success'] && $photo) { 
            $curl = curl_init(); 
            curl_setopt_array($curl, array( CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users/avatar', 
            CURLOPT_RETURNTRANSFER => true, 
            CURLOPT_ENCODING => '', 
            CURLOPT_MAXREDIRS => 10, 
            CURLOPT_TIMEOUT => 0, 
            CURLOPT_FOLLOWLOCATION => true, 
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
            CURLOPT_CUSTOMREQUEST => 'POST', 
            CURLOPT_POSTFIELDS => array('id' => $id, 'profile_photo_file' => new CURLFILE($photo)), 
            CURLOPT_HTTPHEADER => array( 'Authorization: Bearer ' . $token ), )); 
            
            $response = curl_exec($curl); 
            curl_close($curl); 
            $resultProfileUpdate = json_decode($response, true);
            return $this->returnToFront($resultProfileUpdate, 4);
             
        } 
            return $this->returnToFront($result, 4);
    }
    
    public function updateProfileImage($id,$photo){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users/avatar',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('id' => $id,'profile_photo_file'=> new CURLFILE($photo)),
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
}



?>