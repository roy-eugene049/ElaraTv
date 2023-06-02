<?php

namespace Modules\MPesa\Http\Controllers;

use App\Http\Controllers\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Modules\MPesa\Models\MPesa;

class MPesaController extends Controller
{

    /**
     * Update the mpesa keys in .env file using this function.
     */

    public function updatesettings(Request $request)
    {

        $save = DotenvEditor::setKeys([
            'MPESA_CONSUMER_SECRET' => strip_tags($request->MPESA_CONSUMER_SECRET),
            'MPESA_COSUMER_KEY' => strip_tags($request->MPESA_COSUMER_KEY),
            'MPESA_ENBALE' => isset($request->MPESA_ENBALE) ? 1 : 0,
            'MID_TRANS_MODE' => $request->MPESA_SANDBOX ? 'live' : 'sandbox',
            'MPESA_SHORTCODE' => strip_tags($request->MPESA_SHORTCODE),
            'MPESA_PASSKEY' => strip_tags($request->MPESA_PASSKEY),
        ]);

        $this->registerurl($request);

        $save->save();

        return back()->with('added', 'MPesa Payment settings updated !');

    }

    /**
     * @return mpesa auth token to proccess the authorize transcation.
     */

    public function token()
    {

        $credentials = base64_encode(env('MPESA_COSUMER_KEY') . ':' . env('MPESA_CONSUMER_SECRET'));

        if (config('mpesa.MPESA_SANDBOX') == 1) {
            $tokenurl = secure_url('https://sandbox.safaricom.co.ke/oauth/v1/generate');
        } else {
            $tokenurl = secure_url('https://api.safaricom.co.ke/oauth/v1/generate');
        }

        env('MPESA_COSUMER_KEY');

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $credentials,
        ])->get($tokenurl, [
            'grant_type' => 'client_credentials',
        ]);

        if ($response->successful()) {

            $result = $response->json();

            return $result['access_token'];

        }

    }

    /**
     * @return response register URL for Mpesa.
     */

    public function registerurl($request)
    {

        if (config('mpesa.MPESA_SANDBOX') == 1) {
            $url = secure_url('https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl');
        } else {
            $url = secure_url('https://api.safaricom.co.ke/mpesa/c2b/v1/registerurl');
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $this->token())); //setting custom header

        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'ShortCode' => strip_tags($request->MPESA_SHORTCODE),
            'ResponseType' => ' ',
            'ConfirmationURL' => url('api/m/confirm'),
            'ValidationURL' => url('/api/m/validate'),
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);

        return $curl_response;

    }

    /**
     * @return base64 encoded password for Mpesa password at time of payment.
     */

    public function lipaNaMpesaPassword()
    {
        $lipa_time = date('Ymdhis');
        $passkey = config('mpesa.MPESA_PASSKEY');
        $BusinessShortCode = config('mpesa.MPESA_SHORTCODE');
        $timestamp = $lipa_time;
        $lipa_na_mpesa_password = base64_encode($BusinessShortCode . $passkey . $timestamp);
        return $lipa_na_mpesa_password;
    }

    /**
     * This function will stk push for Mpesa once this hit user should able to see MPesa popup on thier phone.
     * Upon successfull STK push you will recieve 0 Response code and checkout Id in response.
     */

    public function pay(Request $request)
    {

        /** Require price conversion file */

        if (!str_starts_with($request->phoneno, '254')) {

            return back()->withInput()->with('deleted','Invalid MPesa Phone no.');
        }

        if (config('mpesa.MPESA_SANDBOX') == 1) {
            $url = secure_url('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest');
        } else {
            $url = secure_url('https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest');
        }

        $amount = $request->amount;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $this->token())); //setting custom header

        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'BusinessShortCode' => config('mpesa.MPESA_SHORTCODE'),
            'Password' => $this->lipaNaMpesaPassword(),
            'Timestamp' => date('Ymdhis'),
            'TransactionType' => __("CustomerPayBillOnline"),
            'Amount' => round($amount),
            'PartyA' => strip_tags($request->phoneno),
            'PartyB' => config('mpesa.MPESA_SHORTCODE'),
            'PhoneNumber' => strip_tags($request->phoneno),
            'CallBackURL' => url('api/m/confirm'),
            'AccountReference' => trans('Payment for order'),
            'TransactionDesc' => trans('Payment for order'),
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $result = curl_exec($curl);

        $result = json_decode($result, true);

        if (isset($result['ResponseCode']) && $result['ResponseCode'] == 0) {
            $checkoutid = $result['CheckoutRequestID'];

            \Log::info(trans('Payment request sent...') . $checkoutid);

            /* Returning Waiting view file */

            return view('mpesa::front.await', compact('checkoutid'));

        } else {
            /* Inserting a fail payment log in failed_transcation table*/
            return back()->withInput()->with('deleted', $result['errorMessage']);
        }
    }

    /**
     * @return validation response and log in laravel.log file.
     */

    public function validation(Request $request)
    {
        \Log::debug($request->getContent());
    }

    public function confirm(Request $request)
    {

        $content = json_decode($request->getContent(), true);

        if ($content != null) {
            if ($content['Body']['stkCallback']['ResultCode'] == 0) {

                MPesa::create([
                    'checkoutid' => $content['Body']['stkCallback']['CheckoutRequestID'],
                    'rcode' => $content['Body']['stkCallback']['ResultCode'],
                    'rdesc' => $content['Body']['stkCallback']['ResultDesc'],
                    'txnid' => $content['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'],
                ]);

            } else {

                MPesa::create([
                    'checkoutid' => $content['Body']['stkCallback']['CheckoutRequestID'],
                    'rcode' => $content['Body']['stkCallback']['ResultCode'],
                    'rdesc' => $content['Body']['stkCallback']['ResultDesc'],
                    'txnid' => null,
                ]);

            }
        } else {
            /** Logging the corrupt transcation in laravel.log file */
            \Log::error(trans("Transcation is corrupted."));
            return redirect('account/purchaseplan')->with('deleted', 'Transcation is corrupted.');

        }
    }

    /**
     * This function will hit and call from await.blade.php file to verify the payment.
     * Result code should be 0 for successfull transcation else it will treat as fail.
     */

    public function verifypay(Request $request, $checkoutid)
    {

        $result = MPesa::where('checkoutid', $checkoutid)->first();

        if ($request->ajax() && $result) {

            if ($result->rcode == 0) 
            {
                    
                $plan_id = $request->plan_id;
                $amount = $request->amount;
                
                $txn_id = $result->txnid;
                $order_id = uniqid();

                /** Capture the success transaction and place order */
                $checkout = new SubscriptionController;
                return $checkout->subscribe($payment_id=$txn_id,$payment_method='MPesa',$plan_id,$payment_status=1,$amount); 
                
                return response()->json([
                    'resultCode' => $result->rcode,
                    'msg' => $result->rdesc,
                    'order_id' => $order_id,
                ]);

            } else {

                return response()->json([
                    'resultCode' => $result->rcode,
                    'msg' => $result->rdesc,
                ]);

            }

        }

    }    

    /**
     * Open keys setting view
     */
    public function getSettings(){
        return view('mpesa::admin.tab');
    }

}
