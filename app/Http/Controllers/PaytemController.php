<?php

namespace App\Http\Controllers;

use App\Config;
use App\Package;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// Class to generate checksum
class PaytmChecksum{

    private static $iv = "@@@@&&&&####$$$$";

    static public function encrypt($input, $key) {
        $key = html_entity_decode($key);

        if(function_exists('openssl_encrypt')){
            $data = openssl_encrypt ( $input , "AES-128-CBC" , $key, 0, self::$iv );
        } else {
            $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
            $input = self::pkcs5Pad($input, $size);
            $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
            mcrypt_generic_init($td, $key, self::$iv);
            $data = mcrypt_generic($td, $input);
            mcrypt_generic_deinit($td);
            mcrypt_module_close($td);
            $data = base64_encode($data);
        }
        return $data;
    }

    static public function decrypt($encrypted, $key) {
        $key = html_entity_decode($key);
        
        if(function_exists('openssl_decrypt')){
            $data = openssl_decrypt ( $encrypted , "AES-128-CBC" , $key, 0, self::$iv );
        } else {
            $encrypted = base64_decode($encrypted);
            $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
            mcrypt_generic_init($td, $key, self::$iv);
            $data = mdecrypt_generic($td, $encrypted);
            mcrypt_generic_deinit($td);
            mcrypt_module_close($td);
            $data = self::pkcs5Unpad($data);
            $data = rtrim($data);
        }
        return $data;
    }

    static public function generateSignature($params, $key) {
        if(!is_array($params) && !is_string($params)){
            throw new Exception("string or array expected, ".gettype($params)." given");			
        }
        if(is_array($params)){
            $params = self::getStringByParams($params);			
        }
        return self::generateSignatureByString($params, $key);
    }

    static public function verifySignature($params, $key, $checksum){
        if(!is_array($params) && !is_string($params)){
            throw new Exception("string or array expected, ".gettype($params)." given");
        }
        if(isset($params['CHECKSUMHASH'])){
            unset($params['CHECKSUMHASH']);
        }
        if(is_array($params)){
            $params = self::getStringByParams($params);
        }		
        return self::verifySignatureByString($params, $key, $checksum);
    }

    static private function generateSignatureByString($params, $key){
        $salt = self::generateRandomString(4);
        return self::calculateChecksum($params, $key, $salt);
    }

    static private function verifySignatureByString($params, $key, $checksum){
        $paytm_hash = self::decrypt($checksum, $key);
        $salt = substr($paytm_hash, -4);
        return $paytm_hash == self::calculateHash($params, $salt) ? true : false;
    }

    static private function generateRandomString($length) {
        $random = "";
        srand((double) microtime() * 1000000);

        $data = "9876543210ZYXWVUTSRQPONMLKJIHGFEDCBAabcdefghijklmnopqrstuvwxyz!@#$&_";	

        for ($i = 0; $i < $length; $i++) {
            $random .= substr($data, (rand() % (strlen($data))), 1);
        }

        return $random;
    }

    static private function getStringByParams($params) {
        ksort($params);		
        $params = array_map(function ($value){
            return ($value !== null && strtolower($value) !== "null") ? $value : "";
          }, $params);
        return implode("|", $params);
    }

    static private function calculateHash($params, $salt){
        $finalString = $params . "|" . $salt;
        $hash = hash("sha256", $finalString);
        return $hash . $salt;
    }

    static private function calculateChecksum($params, $key, $salt){
        $hashString = self::calculateHash($params, $salt);
        return self::encrypt($hashString, $key);
    }

    static private function pkcs5Pad($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    static private function pkcs5Unpad($text) {
        $pad = ord($text[strlen($text) - 1]);
        if ($pad > strlen($text))
            return false;
        return substr($text, 0, -1 * $pad);
    }
}

class PaytemController extends Controller
{
  
    public function index()
    {
        return view('paytm.index');
    }

    public function store(Request $request)
    {

        $plan = Package::findorfail($request->plan_id);
        $config = Config::first();
        $user_id = auth()->id();
        $user = User::find($user_id);
        $order_id = uniqid() . (string) $user_id;

        if (Session::has('coupon_applied')) {
            $amount = $plan->amount - Session::get('coupon_applied')['amount'];
        } else {
            $amount = $plan->amount;
        }

        Session::put('amount', $amount);
        Session::put('plan', $plan->id);
        $data_for_request = $this->handlePaytmRequest($order_id, $amount);
        if ($config->paytm_test == 1) {
            // for live
            $paytm_txn_url = 'https://securegw.paytm.in/theia/processTransaction';
        } else {
            // fir testing
            $paytm_txn_url = 'https://securegw-stage.paytm.in/theia/processTransaction';
        }

        $paramList = $data_for_request['paramList'];
        $checkSum = $data_for_request['checkSum'];
        return view('paytm.paytemMarchant', compact('amount', 'paytm_txn_url', 'paramList', 'checkSum'));

    }

    public function paytmapi(Request $request)
    {

        // Codes to generate Txn Token

    $paytmParams = array();

    // $mid = "iMmzIy35443290520668";
    // $mkey = "v34X7A%VaHok!fjK";
    // $callbackUrl = null;
    // $website =  null;
    // $orderId = "123456789AB";
    // $amount = "1000";
    // $custId = "1";
    // $mode = "2";
    // $testing = "0";
     $request=json_decode($request->getContent());
     
        $mid = $request->mid;
        $mkey = $request->mkey;
        $callbackUrl = $request->callbackUrl;
        $website =  $request->website;
        $orderId = $request->orderId;
        $amount = $request->amount;
        $custId = $request->custId;
        $mode = $request->mode;
        $testing = $request->testing;

    if($callbackUrl == null) {
        if ($testing =="0") {
            // for live
            $callbackUrl = "https://securegw.paytm.in/theia/paytmCallback?ORDER_ID=$orderId";
        } else {
            // for testing
            $callbackUrl = "https://securegw-stages.paytm.in/theia/paytmCallback?ORDER_ID=$orderId";
        }
    }

    if($website == null) {
        $website =  "DEFAULT";
    }
    
    $paytmParams["body"] = array(
        "requestType" => "Payment",
        'mid' => $mid,
        'websiteName' => $website,
        'orderId' => $orderId,
        'callbackUrl' => $callbackUrl,
        "txnAmount"     => array(
            'value' => $amount,
            "currency"  => "INR",
        ),
        "userInfo"      => array(
            'custId' => $custId,
        ),
        
    );

    if ($mode == "1") {
        // "Mode 1 So Net Banking"
        $paytmParams['body']
            ["enablePaymentMode"] = array(array(
            "mode"=> "NET_BANKING",
            ));
    } else if ($mode == "0") {
        // "Mode 0 So BALANCE"
        $paytmParams['body']
            ["enablePaymentMode"] = array(array(
            "mode"=> "BALANCE",
            ));
    } else if ($mode == "2") {
        // "Mode 2 So UPI"
        $paytmParams['body']
            ["enablePaymentMode"] = array(array(
            "mode"=> "UPI",
            ));
    } else if ($mode == "3") {
        // "Mode 3 So CC"
        $paytmParams['body']
            ["enablePaymentMode"] = array(array(
            "mode"=> "CREDIT_CARD"
            ));
    }

    $checkSum = "";

    $checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), "$mkey");

    $paytmParams["head"] = array(
        "signature"    => $checksum
    );
    
    $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

    if ($testing =="0") {
        // for live
        $url = "https://securegw.paytm.in/theia/api/v1/initiateTransaction?mid=$mid&orderId=$orderId";
    } else {
        // for testing
        $url = "https://securegw-stages.paytm.in/theia/api/v1/initiateTransaction?mid=$mid&orderId=$orderId";
    }

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json")); 
    $response = curl_exec($ch);

    return $response;
        
        
    }

    
   
    public function handlePaytmRequest()
    {

        // Load all functions of encdec_paytm.php and config-paytm.php
        $this->getAllEncdecFunc();
        $this->getConfigPaytmSettings();

        $checkSum = "";
        $paramList = array();
        $user_id = auth()->id();
        $amount = Session::get('amount');
        $user = User::find($user_id);
        $order_id = uniqid() . (string) $user_id;
        // Create an array having all required parameters for creating checksum.
        $paramList["MID"] = env('PAYTM_MID');
        $paramList["ORDER_ID"] = $order_id;
        $paramList["CUST_ID"] = $order_id;
        $paramList["INDUSTRY_TYPE_ID"] = 'Retail';
        $paramList["CHANNEL_ID"] = 'WEB';
        $paramList["TXN_AMOUNT"] = $amount;
        $paramList["WEBSITE"] = 'DEFAULT';
        $paramList["CALLBACK_URL"] = url('/paytm-callback');
        $paytm_merchant_key = env('PAYTM_MERCHANT_KEY');

        //Here checksum string will return by getChecksumFromArray() function.
        $checkSum = getChecksumFromArray($paramList, $paytm_merchant_key);
        Session::forget('amount');
        return array(
            'checkSum' => $checkSum,
            'paramList' => $paramList,
        );
    }
    

    /**
     * Get all the functions from encdec_paytm.php
     */
    public function getAllEncdecFunc()
    {
        function encrypt_e($input, $ky)
        {
            $key = html_entity_decode($ky);
            $iv = "@@@@&&&&####$$$$";
            $data = openssl_encrypt($input, "AES-128-CBC", $key, 0, $iv);
            return $data;
        }

        function decrypt_e($crypt, $ky)
        {
            $key = html_entity_decode($ky);
            $iv = "@@@@&&&&####$$$$";
            $data = openssl_decrypt($crypt, "AES-128-CBC", $key, 0, $iv);
            return $data;
        }

        function pkcs5_pad_e($text, $blocksize)
        {
            $pad = $blocksize - (strlen($text) % $blocksize);
            return $text . str_repeat(chr($pad), $pad);
        }

        function pkcs5_unpad_e($text)
        {
            $pad = ord($text[strlen($text) - 1]);
            if ($pad > strlen($text)) {
                return false;
            }

            return substr($text, 0, -1 * $pad);
        }

        function generateSalt_e($length)
        {
            $random = "";
            srand((double) microtime() * 1000000);

            $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
            $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
            $data .= "0FGH45OP89";

            for ($i = 0; $i < $length; $i++) {
                $random .= substr($data, (rand() % (strlen($data))), 1);
            }

            return $random;
        }

        function checkString_e($value)
        {
            if ($value == 'null') {
                $value = '';
            }

            return $value;
        }

        function getChecksumFromArray($arrayList, $key, $sort = 1)
        {
            if ($sort != 0) {
                ksort($arrayList);
            }
            $str = getArray2Str($arrayList);
            $salt = generateSalt_e(4);
            $finalString = $str . "|" . $salt;
            $hash = hash("sha256", $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }
        function getChecksumFromString($str, $key)
        {

            $salt = generateSalt_e(4);
            $finalString = $str . "|" . $salt;
            $hash = hash("sha256", $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }

        function verifychecksum_e($arrayList, $key, $checksumvalue)
        {
            $arrayList = removeCheckSumParam($arrayList);
            ksort($arrayList);
            $str = getArray2StrForVerify($arrayList);
            $paytm_hash = decrypt_e($checksumvalue, $key);
            $salt = substr($paytm_hash, -4);

            $finalString = $str . "|" . $salt;

            $website_hash = hash("sha256", $finalString);
            $website_hash .= $salt;

            $validFlag = "FALSE";
            if ($website_hash == $paytm_hash) {
                $validFlag = "TRUE";
            } else {
                $validFlag = "FALSE";
            }
            return $validFlag;
        }

        function verifychecksum_eFromStr($str, $key, $checksumvalue)
        {
            $paytm_hash = decrypt_e($checksumvalue, $key);
            $salt = substr($paytm_hash, -4);

            $finalString = $str . "|" . $salt;

            $website_hash = hash("sha256", $finalString);
            $website_hash .= $salt;

            $validFlag = "FALSE";
            if ($website_hash == $paytm_hash) {
                $validFlag = "TRUE";
            } else {
                $validFlag = "FALSE";
            }
            return $validFlag;
        }

        function getArray2Str($arrayList)
        {
            $findme = 'REFUND';
            $findmepipe = '|';
            $paramStr = "";
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                $pos = strpos($value, $findme);
                $pospipe = strpos($value, $findmepipe);
                if ($pos !== false || $pospipe !== false) {
                    continue;
                }

                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }

        function getArray2StrForVerify($arrayList)
        {
            $paramStr = "";
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }

        function redirect2PG($paramList, $key)
        {
            $hashString = getchecksumFromArray($paramList, $key);
            $checksum = encrypt_e($hashString, $key);
        }

        function removeCheckSumParam($arrayList)
        {
            if (isset($arrayList["CHECKSUMHASH"])) {
                unset($arrayList["CHECKSUMHASH"]);
            }
            return $arrayList;
        }

        function getTxnStatus($requestParamList)
        {
            return callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
        }

        function getTxnStatusNew($requestParamList)
        {
            return callNewAPI(PAYTM_STATUS_QUERY_NEW_URL, $requestParamList);
        }

        function initiateTxnRefund($requestParamList)
        {
            $CHECKSUM = getRefundChecksumFromArray($requestParamList, PAYTM_MERCHANT_KEY, 0);
            $requestParamList["CHECKSUM"] = $CHECKSUM;
            return callAPI(PAYTM_REFUND_URL, $requestParamList);
        }

        function callAPI($apiURL, $requestParamList)
        {
            $jsonResponse = "";
            $responseParamList = array();
            $JsonData = json_encode($requestParamList);
            $postData = 'JsonData=' . urlencode($JsonData);
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($postData))
            );
            $jsonResponse = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse, true);
            return $responseParamList;
        }

        function callNewAPI($apiURL, $requestParamList)
        {
            $jsonResponse = "";
            $responseParamList = array();
            $JsonData = json_encode($requestParamList);
            $postData = 'JsonData=' . urlencode($JsonData);
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($postData))
            );
            $jsonResponse = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse, true);
            return $responseParamList;
        }
        function getRefundChecksumFromArray($arrayList, $key, $sort = 1)
        {
            if ($sort != 0) {
                ksort($arrayList);
            }
            $str = getRefundArray2Str($arrayList);
            $salt = generateSalt_e(4);
            $finalString = $str . "|" . $salt;
            $hash = hash("sha256", $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }
        function getRefundArray2Str($arrayList)
        {
            $findmepipe = '|';
            $paramStr = "";
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                $pospipe = strpos($value, $findmepipe);
                if ($pospipe !== false) {
                    continue;
                }

                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= "|" . checkString_e($value);
                }
            }
            return $paramStr;
        }
        function callRefundAPI($refundApiURL, $requestParamList)
        {
            $jsonResponse = "";
            $responseParamList = array();
            $JsonData = json_encode($requestParamList);
            $postData = 'JsonData=' . urlencode($JsonData);
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_URL, $refundApiURL);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $jsonResponse = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse, true);
            return $responseParamList;
        }
    }

    /**
     * Config Paytm Settings from config_paytm.php file of paytm kit
     */
    public function getConfigPaytmSettings()
    {
        define('PAYTM_ENVIRONMENT', 'TEST'); // PROD
        define('PAYTM_MERCHANT_KEY', env('PAYTM_MERCHANT_KEY')); //Change this constant's value with Merchant key downloaded from portal
        define('PAYTM_MERCHANT_MID', env('PAYTM_MERCHANT_MID')); //Change this constant's value with MID (Merchant ID) received from Paytm
        define('PAYTM_MERCHANT_WEBSITE', 'DEFAULT'); //Change this constant's value with Website name received from Paytm

        $PAYTM_STATUS_QUERY_NEW_URL = 'https://securegw-stage.paytm.in/merchant-status/getTxnStatus';
        $PAYTM_TXN_URL = 'https://securegw-stage.paytm.in/theia/processTransaction';
        if (PAYTM_ENVIRONMENT == 'PROD') {
            $PAYTM_STATUS_QUERY_NEW_URL = 'https://securegw.paytm.in/merchant-status/getTxnStatus';
            $PAYTM_TXN_URL = 'https://securegw.paytm.in/theia/processTransaction';
        }
        define('PAYTM_REFUND_URL', '');
        define('PAYTM_STATUS_QUERY_URL', $PAYTM_STATUS_QUERY_NEW_URL);
        define('PAYTM_STATUS_QUERY_NEW_URL', $PAYTM_STATUS_QUERY_NEW_URL);
        define('PAYTM_TXN_URL', $PAYTM_TXN_URL);
    }

    public function paytmCallback(Request $request)
    {
        $plan_id = Session::get('plan');

        $order_id = $request['ORDERID'];
        $plan = Package::findorfail($plan_id);
        $user_id = auth()->id();
        $user = User::find($user_id);

        $session_amount = session()->has('coupon_applied') ? session()->get('coupon_applied')['amount'] : 0;

        if ('TXN_SUCCESS' === $request['STATUS']) {

            $payment_id = $request['TXNID'];
            $payment_amount = $plan->amount - $session_amount;
            $payment_method = 'PAYTM';
            $payment_status = 1;
            $plan_id = $plan->id;
            $checkout = new SubscriptionController;
            return $checkout->subscribe($payment_id, $payment_method, $plan_id, $payment_status, $payment_amount);

        } else if ('TXN_FAILURE' === $request['STATUS']) {
            return redirect('/')->with('delete', __('Payment Failed !'));
        }

        Session::forget('plan');
    }
}
