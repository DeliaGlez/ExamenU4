<?php
include_once "config.php";

if(!isset($_SESSION['user_data'])){
    header('Location: ' .BASE_PATH. '?error=Error de autenticación, inicie sesión.');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {

        if (isset($_SESSION['global_token']) && $_SESSION['global_token'] === $_POST['global_token']){
            $action = $_POST['action'];
            $couponController = new CouponController();
            
            switch ($action) {
                case 'storeCoupon':
                    $name = $_POST['name'];
                    $code = $_POST['code']; 
                    $percentageDiscount = $_POST['percentage_discount'];
                    $min_amount_required = $_POST['min_amount_required']; 
                    $min_product_required = $_POST['min_product_required']; 
                    $start_date = $_POST['start_date']; 
                    $end_date = $_POST['end_date']; 
                    $max_uses = $_POST['max_uses']; 
                    $count_uses = $_POST['count_uses']; 
                    $valid_only_first_purchase = $_POST['valid_only_first_purchase']; 
                    $status = $_POST['status']; 


                    $couponController->storeCoupon($name,$code,$percentageDiscount,$min_amount_required,$min_product_required,$start_date,$end_date,$max_uses,$count_uses,$valid_only_first_purchase,$status);

                    break;
                case 'deleteCoupon':
                    $idCoupon = $_POST['id']; 
                    $couponController->deleteCoupon($idCoupon);
                    break;
                case 'updateCoupon':
                    $idCoupon = $_POST['id']; 
                    $name = $_POST['name'];
                    $code = $_POST['code']; 
                    $percentageDiscount = $_POST['percentage_discount'];
                    $min_amount_required = $_POST['min_amount_required']; 
                    $min_product_required = $_POST['min_product_required']; 
                    $start_date = $_POST['start_date']; 
                    $end_date = $_POST['end_date']; 
                    $max_uses = $_POST['max_uses']; 
                    $count_uses = $_POST['count_uses']; 
                    $valid_only_first_purchase = $_POST['valid_only_first_purchase']; 
                    $status = $_POST['status']; 

                    $couponController->updateCoupon($idCoupon,$name,$code,$percentageDiscount,$min_amount_required,$min_product_required,$start_date,$end_date,$max_uses,$count_uses,$valid_only_first_purchase,$status);
                break;
                default:
                    echo "Accion desconocida";
                    break;
            }
        } 
    }
}
class CouponController
{
    public function storeCoupon($name,$code,$percentageDiscount,$min_amount_required,$min_product_required,$start_date,$end_date,$max_uses,$count_uses,$valid_only_first_purchase,$status){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();

        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/coupons',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('name' => $name,'code' => $code,'percentage_discount' => $percentageDiscount,
            'min_amount_required' =>$min_amount_required,'min_product_required' =>$min_product_required,'start_date' => $start_date,
            'end_date' => $end_date,'max_uses' => $max_uses,'count_uses' =>$count_uses,'valid_only_first_purchase' => $valid_only_first_purchase,
            'status' =>$status),
            CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $token
            ),
        ));
        

        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response, true);
        $this->returnToFrontAlert($result, 4); 
    }

    public function getCoupon($idCoupon){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/coupons/'. intval($idCoupon),
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


    public function getCoupons(){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/coupons',
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

    public function updateCoupon($idCoupon, $name, $code, $percentageDiscount, $min_amount_required, $min_product_required, $start_date, $end_date, $max_uses, $count_uses, $valid_only_first_purchase, $status) {
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
    
        $curl = curl_init();
    
        // Crear los datos con http_build_query
        $postFields = http_build_query([
            'id' => $idCoupon,
            'name' => $name,
            'code' => $code,
            'percentage_discount' => $percentageDiscount,
            'min_amount_required' => $min_amount_required,
            'min_product_required' => $min_product_required,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'max_uses' => $max_uses,
            'count_uses' => $count_uses,
            'valid_only_first_purchase' => $valid_only_first_purchase,
            'status' => $status,
        ]);
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/coupons',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => $postFields, 
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
    
    
    public function deleteCoupon($idCoupon){
        $token = isset($_SESSION['token']) ? $_SESSION['token'] : '';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/coupons/'. intval($idCoupon),
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

    public function getCouponTotals($idCoupon) { //Funcion para el widget de totales descontado
        $couponData = $this->getCoupon($idCoupon);
    
        if (!$couponData['success']) {
            return [
                'success' => false,
                'message' => 'No se pudo obtener el cupón: ' . $couponData['message']
            ];
        }
    
        $coupon = $couponData['data'];
        $orders = $coupon['orders'];
    
        if (empty($orders)) {
            return [
                'success' => true,
                'total_discounted' => 0,
                'message' => 'El cupón no tiene órdenes asociadas.'
            ];
        }
    
        $percentageDiscount = floatval($coupon['percentage_discount']); 
        $totalDiscounted = 0;
    
        foreach ($orders as $order) {
            $orderTotal = floatval($order['total']);
            $discount = ($orderTotal * $percentageDiscount) / 100;
            $totalDiscounted += $discount;
        }
    
        return [
            'success' => true,
            'total_discounted' => $totalDiscounted,
            'message' => 'Total calculado correctamente.'
        ];
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
            header('Location: ' . BASE_PATH . 'coupons?message=' . urlencode($data['message'])); 
        } 
        else{
            $message = isset($data['message']) ? $data['message'] : 'Algo salió mal, verifique los datos.'; 
            header('Location: ' . BASE_PATH . 'coupons?error=' . urlencode($message)); 
        }
        exit;
    }
}
?>