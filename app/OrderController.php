<?php
include_once "config.php";

if(!isset($_SESSION['user_data'])){
    header('Location: ' .BASE_PATH. '?error=Error de autenticación, inicie sesión.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {

        if (isset($_SESSION['global_token']) && $_SESSION['global_token'] === $_POST['global_token']){
            $action = $_POST['action'];
            $orderController = new OrderController();
            
            switch ($action) {
                case 'storeOrder':
                    $folio = $_POST['folio'];
                    $total = $_POST['total'];
                    $is_paid = $_POST['is_paid']; 
                    $client_id = $_POST['client_id']; 
                    $address_id = $_POST['address_id']; 
                    $order_status_id = $_POST['order_status_id']; 
                    $payment_type_id = $_POST['payment_type_id']; 
                    $coupon_id = $_POST['coupon_id'];
                    $presentations = $_POST['presentations']; 

                    $orderController->storeOrder($folio, $total, $is_paid, $client_id, $address_id, $order_status_id, $payment_type_id, $coupon_id, $presentations);

                    break;  
                case 'deleteOrder':
                    $idOrder = $_POST['id']; 
                    $orderController->deleteOrder($idOrder);
                    break;
                case 'updateOrder':
                    $idOrder = $_POST['id']; 
                    $order_status_id = $_POST['order_status_id']; 
 
                    $orderController->updateOrder($idOrder,$order_status_id);
                break;
                default:
                    echo "Accion desconocida";
                    break;
            }
        } 
    }
}
class OrderController
{
    public function storeOrder($folio, $total, $is_paid, $client_id, $address_id, $order_status_id, $payment_type_id, $coupon_id, $presentations) {
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();
    
        $postFields = [
            'folio' => $folio,
            'total' => $total,
            'is_paid' => $is_paid,
            'client_id' => $client_id,
            'address_id' => $address_id,
            'order_status_id' => $order_status_id,
            'payment_type_id' => $payment_type_id,
            
        ];
        if (!empty($coupon_id)) { 
            $postFields['coupon_id'] = $coupon_id;
        }
        foreach ($presentations as $index => $presentation) {
            $postFields["presentations[$index][id]"] = $presentation['id'];
            $postFields["presentations[$index][quantity]"] = $presentation['quantity'];
        }
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders',
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
    

    public function getOrder($idOrder){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders/details/'. intval($idOrder),
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


    public function getOrders(){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders',
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
    public function getOrdersBetweenDates($startDate, $endDate){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders/'.$startDate.'/'. $endDate,
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

    public function updateOrder($idOrder, $order_status_id) {
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();
        $postFields = [
            'id' => $idOrder,
            '$order_status_id' => $order_status_id,
        ];
    
        $postData = http_build_query($postFields);
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders',
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
    
    
    public function deleteOrder($idOrder){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/orders/'. intval($idOrder),
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
            header('Location: ' . BASE_PATH . 'orders?message=' . urlencode($data['message'])); 
        } 
        else{
            $message = isset($data['message']) ? $data['message'] : 'Algo salió mal, verifique los datos.'; 
            header('Location: ' . BASE_PATH . 'orders?error=' . urlencode($message)); 
        }
        exit;
    }
}
?>