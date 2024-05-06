<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Models\cart_user;
use App\Models\produk_products;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected function changestatus($order_id,$data){
        $cart = cart_user::where('order_id',$order_id)->first();
        $cart->update($data);
    }
    protected function get_order() {
        // $url = env('API_SERVICE');
        // $get_product = Http::post($url);
        // $Data = $get_product->json();
        // $product = $Data['data'];

        $product = produk_products::all();
        return $product;
    }
    protected function generateuuid() {
        $uuid = Str::uuid()->toString();
        $short = substr($uuid,0,8);

        return $short;
    }
    protected function create_snap($order_id){
        $cart = cart_user::where('order_id',$order_id)->first();
        $server_key = env('SERVER_KEY');
        \Midtrans\Config::$serverKey = $server_key;
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order_id,
                'gross_amount' => $cart->price,
            ),
            'customer_details' => array(
                'first_name' => 'customer',
                'last_name' => 'website',
                'email' => 'unknown@gmail.com',
                'phone' => 'unknown',
            ),
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return $snapToken;
    }
}
