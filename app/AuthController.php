<?php 

include_once "config.php";

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
			header('Location: ' . BASE_PATH );
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
        session_unset();
        session_destroy();
        header('Location: ' . BASE_PATH);
        
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


}


?>