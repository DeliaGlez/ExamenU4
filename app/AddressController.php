<?php
include_once "config.php";

if(!isset($_SESSION['user_data'])){
    header('Location: ' .BASE_PATH. '?error=Error de autenticación, inicie sesión.');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {

        if (isset($_SESSION['global_token']) && $_SESSION['global_token'] === $_POST['global_token']){
            $action = $_POST['action'];
            $addressController = new AddressController(); 
            
            switch ($action) {
                case 'storeAddress':
                    $idClient = $_POST['client_id']; 
                    $firstName = $_POST['first_name'];
                    $lastName = $_POST['last_name'];
                    $street = $_POST['street_and_use_number'];
                    $apartament = $_POST['apartment'];
                    $postal = $_POST['postal_code'];
                    $city = $_POST['city'];
                    $province = $_POST['province'];
                    $phone = $_POST['phone_number'];
                    $isbillingAdress= $_POST['is_billing_address'];
                    
                    $addressController->storeAddress($idClient,$firstName,$lastName,$street,$apartament,$postal,$city,$province,$phone,$isbillingAdress);
                    break;

                case 'deleteAddress':
                    $idAdress = $_POST['id']; 
                    $addressController->deleteAddress($idAdress);
                    break;

                case 'updateAddress':
                    $idAddress = $_POST['id'];  // Pasar el id de la direccion, NO pasar el id del cliente.
                    $firstName = $_POST['first_name'];
                    $lastName = $_POST['last_name'];
                    $street = $_POST['street_and_use_number'];
                    $apartament = $_POST['apartment'];
                    $postal = $_POST['postal_code'];
                    $city = $_POST['city'];
                    $province = $_POST['province'];
                    $phone = $_POST['phone_number'];
                    $isbillingAdress= $_POST['is_billing_address'];
                    
                    $addressController->updateAddress($idAddress,$firstName,$lastName,$street,$apartament,$postal,$city,$province,$phone,$isbillingAdress);
                break;
                default:
                    echo "Accion desconocida";
                    break;
            }
        } 
    }
}
class AddressController
{
    public function storeAddress($idClient, $firstName, $lastName, $street, $apartament, $postal, $city, $province, $phone, $isbillingAdress)
    {
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/addresses',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'client_id' => $idClient,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'street_and_use_number' => $street,
                'apartment' => $apartament,
                'postal_code' => $postal,
                'city' => $city,
                'province' => $province,
                'phone_number' => $phone,
                'is_billing_address' => $isbillingAdress
            ),
            CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response, true);
        $this->returnToFrontAlert($result, 4); 
    }


    public function deleteAddress($idAdress)
    {
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/addresses/'. intval($idAdress),
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

    public function updateAddress($idAddress, $firstName, $lastName, $street, $apartament, $postal, $city, $province, $phone, $isbillingAdress)
    {
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();

        $postData = http_build_query(array(
            'id' => $idAddress,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'street_and_use_number' => $street,
            'apartment' => $apartament,
            'postal_code' => $postal,
            'city' => $city,
            'province' => $province,
            'phone_number' => $phone,
            'is_billing_address' => $isbillingAdress
        ));

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/addresses',
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
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response, true);
        $this->returnToFrontAlert($result, 4); 
    }


    public function returnToFrontAlert($data, $code){
        if (isset($data['code']) && $data['code'] === intval($code)) { // Envio del mensaje mediante url success
            header('Location: ' . BASE_PATH . 'address?message=' . urlencode($data['message'])); // TODO: Corregir la ruta, aun no esta definida
        } 
        else{
            $message = isset($data['message']) ? $data['message'] : 'Error desconocido'; 
            header('Location: ' . BASE_PATH . 'address?error=' . urlencode($message)); // TODO: Corregir la ruta, aun no esta definida
        }
        exit;
    }
}

?>