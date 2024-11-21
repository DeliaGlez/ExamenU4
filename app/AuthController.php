<?php 

include_once "config.php";

if(!isset($_SESSION['user_data'])){
    header('Location: ' .BASE_PATH. '?error=Error de autenticación, inicie sesión.');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {

        if (isset($_SESSION['global_token']) && $_SESSION['global_token'] === $_POST['global_token']){

            $action = $_POST['action'];
            $authController = new AuthController();
            
            switch ($action) {
                case 'login':
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $authController->login($email, $password);
                    break;

                case 'logout':
                    $email = $_POST['email'];
                    $authController->logout($email);
                    break;
                case 'updateProfile':
                    $name = $_POST['name'];
                    $lastname = $_POST['lastname'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone_number'];
                    $password = $_POST['password'];
                    $photo = isset($_FILES['profile_photo_file']['tmp_name']) ? $_FILES['profile_photo_file']['tmp_name'] : null;
                    
                    $authController->updateProfile( $name, $lastname, $email, $phone, $password, $photo);
                    break;
                default:
                    echo "Accion desconocida";
                    break;
            }
        } 
    }
}


class AuthController
{


	public function login($email=null,$password=null)
	{  

        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'email' => $email,       
                'password' => $password  
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $data = json_decode($response, true);

        if (isset($data['data']['token'])) {
            $_SESSION['token'] = $data['data']['token'];
            $_SESSION['user_id'] = $data['data']['id'];  
            $_SESSION['user_data'] = $data['data'];
			header('Location: ' . BASE_PATH . 'home');
		} 
		else {
            // Mensaje de error a través de URL 
            header('Location: ' . BASE_PATH . '?error=' . urlencode($data['message']));
        }

	}

	public function logout($email)
    {
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/logout',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('email' => $email),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $token
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response, true);

        if (isset($result['code']) && $result['code'] === 2) { 
            
            session_unset();
            session_destroy();
            header('Location: ' . BASE_PATH);

        } 

        
    }

    public function getProfile(){
        $userId = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
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

        if (isset($result['code']) && $result['code'] === 4) { // Formato de respuesta exitosa 
            return [ 'success' => true, 
            'data' => $result['data'],
            'message' => $result['message'] ];
         } else { // Formato de error en la respuesta 
            return [ 'success' => false, 
            'message' => isset($result['message']) ? $result['message'] : 'Error desconocido' ]; 
        }
	
    }

    public function updateProfile($name, $lastname, $email, $phone, $password, $photo=null) {
        $id = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $flag = false; 
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
    
        if (isset($result['code']) && $result['code'] === 4) { 
            $flag = true;
        } else {
            $message = isset($result['message']) ? $result['message'] : 'Error desconocido'; 
            header('Location: ' . BASE_PATH . 'profile?error=' . urlencode($message)); 
            exit; 
        }
    
        // Update de la foto de perfil si los datos fueron exitosos
        if ($flag && $photo) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users/avatar',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('id' => $id, 'profile_photo_file' => new CURLFILE($photo)),
                CURLOPT_HTTPHEADER => array('Authorization: Bearer ' . $token),
            ));
            
            $response = curl_exec($curl); 
            curl_close($curl); 
            
            $resultProfileUpdate = json_decode($response, true);
            $this->returnToFrontAlert($resultProfileUpdate, 4); //Enviar el resultado de la foto mediante URL
        } else {
            // Si no foto, redirige con éxito a el perfil del usuario
            header('Location: ' . BASE_PATH . 'profile?message=' . urlencode($result['message']));
            exit;
        }
    }

    public function returnToFrontAlert($data, $code){
        if (isset($data['code']) && $data['code'] === intval($code)) { // Envio del mensaje con éxito mediante url success
            header('Location: ' . BASE_PATH . 'profile?message=' . urlencode($data['message'])); 
        } 
        else{
            $message = isset($data['message']) ? $data['message'] : 'Error desconocido'; 
            header('Location: ' . BASE_PATH . 'profile?error=' . urlencode($message)); // Envio del mensaje mediante url error
        }
        exit;
    }
    


}


?>