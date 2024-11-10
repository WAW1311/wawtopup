<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\cart_user;

class TripayController extends Controller
{
    private $endpoint;
    private $apiKey;
    private $privateKey;
    private $merchantCode;
    public function __construct() {
        $this->endpoint = env('TRIPAY_ENDPOINT');
        $this->apiKey = env('TRIPAY_API_KEY');
        $this->privateKey = env('TRIPAY_PRIVATE_KEY');
        $this->merchantCode = env('TRIPAY_MERCHANT_ID');
    }
    public function GetPaymentMethod() {
        $endpoint = $this->endpoint . '/merchant/payment-channel';
        $apiKey = $this->apiKey;
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_FRESH_CONNECT  => true,
        CURLOPT_URL            => $endpoint,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
        CURLOPT_FAILONERROR    => false,
        CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        return $response ? json_decode($response) : $error ;
    }
    public function FeeCalculate(Request $request) {
        $code = $request->query('code');
        $amount = $request->query('amount');
        $endpoint = $this->endpoint . '/merchant/fee-calculator?';
        $apiKey = $this->apiKey;
        $payload = [
            'code' => $code,
            'amount' => $amount,
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => $endpoint.http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        $result = json_decode($response);
        foreach($result->data as $data) {
            return $response ? response()->json($data->total_fee) : $error ;
        }
    }
    public function GetPayment($carts) {
        $endpoint = $this->endpoint . '/transaction/create';
        $apiKey       = $this->apiKey;
        $privateKey   = $this->privateKey;
        $merchantCode = $this->merchantCode;
        $merchantRef  = $carts->order_id;
        $amount       = $carts->price;
        $data = [
            'method'         => $carts->method,
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => 'customer webiste',
            'customer_email' => 'customerwawtopup@wawtopup.my.id',
            'customer_phone' => $carts->no_hp,
            'order_items'    => [
                [
                    'sku'         => $carts->product_id,
                    'name'        => $carts->name,
                    'price'       => $amount,
                    'quantity'    => 1,
                ]
            ],
            'callback_url' => route('callback'),
            'return_url'   => route('invoice'),
            'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey)
        ];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        $data = json_decode($response);
        return $response ? $data->data : $error;
    }
    public function callback(Request $request) {
        $privateKey   = $this->privateKey;
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $privateKey);

        if ($signature !== (string) $callbackSignature) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid signature',
            ]);
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return Response::json([
                'success' => false,
                'message' => 'Unrecognized callback event, no action was taken',
            ]);
        }
        $data = json_decode($json);
        if (JSON_ERROR_NONE !== json_last_error()) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid data sent by tripay',
            ]);
        }
        $invoiceId = $data->merchant_ref;
        $tripayReference = $data->reference;
        $status = strtoupper((string) $data->status);
        if ($data->is_closed_payment === 1) {
            $invoice = cart_user::where('order_id', $invoiceId)
                ->where('tripay_reference', $tripayReference)
                ->where('status', '=', 'UNPAID')
                ->first();
            if (! $invoice) {
                return Response::json([
                    'success' => false,
                    'message' => 'No invoice found or already paid: ' . $invoiceId,
                ]);
            }
            switch ($status) {
                case 'PAID':
                    $invoice->update(['status' => 'PAID']);
                    $this->sendmsg($invoiceId);
                    break;
                case 'EXPIRED':
                    $invoice->update(['status' => 'EXPIRED']);
                    $this->sendmsg($invoiceId);
                    break;
                case 'FAILED':
                    $invoice->update(['status' => 'FAILED']);
                    $this->sendmsg($invoiceId);
                    break;
                default:
                    return Response::json([
                        'success' => false,
                        'message' => 'Unrecognized payment status',
                    ]);
            }
            return Response::json(['success' => true]);
        }
    }
    
}

