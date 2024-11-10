<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\cart_user;
use App\Models\ApiProduct;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected function sendmsg($order_id): void {
        $cart = cart_user::where('order_id',$order_id)->first();
        $pesan = "-----Detail pembelian-----\n\nOrder_id : $order_id\nProduk : $cart->category $cart->name\nUser_id : $cart->user_id\nServer_id : $cart->server_id\nHarga : $cart->subtotal\nMetode Pembayaran : $cart->method_name\nStatus : $cart->status";
        $env = env('API_WHATSAPP');
        $url = "$env?message=$pesan&number=$cart->no_hp";
        Http::post($url);
    }
    protected function get_order() {
        
        $product = Cache::remember('products',600, function () {
            return ApiProduct::all();
        });
        return $product;
    }
    public function get_data() {
        $result = $this->get_order();
        return response()->json($result);
    }
    protected function generateuuid() {
        $uuid = Str::uuid()->toString();
        $short = substr($uuid,0,16);
        $removedashes = str_replace('-', '', $short);
        $order_id = "WAW-$removedashes";
        return $order_id;
    }
}
