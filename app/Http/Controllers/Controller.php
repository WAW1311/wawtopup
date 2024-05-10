<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Models\cart_user;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected function changestatus($order_id,$data){
        $cart = cart_user::where('order_id',$order_id)->first();
        $cart->update($data);
    }
    protected function get_order() {
        $url = env('API_SERVICE');
        $param = [
            'key'=>'c5SB7PtjCCyAzrwGtII8dYt2uJWlR6zQBkBHkIna5Z7oY1hSlZnFnonM14PkBg6t',
            'sign'=>'1550a96bbdeec1f54c0dc4fe065342f6',
            'type'=>'services',
            'filter_status'=>'available',
        ];
        $get_product = Http::asForm()->post($url,$param);
        $Data = $get_product->json();
        $product = $Data['data'];
        return $product;
    }
    // public function get_data() {
    //     // $url = env('API_SERVICE');
    //     // $param = [
    //     //     'key'=>'c5SB7PtjCCyAzrwGtII8dYt2uJWlR6zQBkBHkIna5Z7oY1hSlZnFnonM14PkBg6t',
    //     //     'sign'=>'1550a96bbdeec1f54c0dc4fe065342f6',
    //     //     'type'=>'services',
    //     //     'filter_status'=>'available',
    //     // ];
    //     // $get_product = Http::asForm()->post($url,$param);
    //     // $urls = env('API_SERVICE');
    //     // $params = [
    //     //     'key'=>'c5SB7PtjCCyAzrwGtII8dYt2uJWlR6zQBkBHkIna5Z7oY1hSlZnFnonM14PkBg6t',
    //     //     'sign'=>'1550a96bbdeec1f54c0dc4fe065342f6',
    //     //     'type'=>'status',
    //     //     'trxid'=>'VP-663AAC789599A',
    //     // ];
    //     // $pesanan = Http::asForm()->post($urls,$params);
    //     // $Data = $pesanan->json();
    //     // $datas = $Data['data'][0];
    //     // $status = $datas['status'];
    //     // $asu = [
    //     //     'status'=>'success',
    //     //     'stat'=>$status
    //     // ];
    //     $url = env('API_SERVICE');
    //     $param = [
    //         'key'=>'c5SB7PtjCCyAzrwGtII8dYt2uJWlR6zQBkBHkIna5Z7oY1hSlZnFnonM14PkBg6t',
    //         'sign'=>'1550a96bbdeec1f54c0dc4fe065342f6',
    //         'type'=>'order',
    //         'service'=>'ML5_0-S10',
    //         'data_no'=>123,
    //         'data_zone'=>123,
    //     ];
    //     $get_order = Http::asForm()->post($url,$param);
    //     $Datas = $get_order->json();
    //     return response()->json($Datas);
    // }
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
