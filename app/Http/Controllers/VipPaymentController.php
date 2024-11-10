<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VipPaymentController extends Controller
{
    private $url;
    private $key;
    private $sign;
    public function __construct() {
        $this->url = env('VIP_ENDPOINT');
        $this->key = env('VIP_KEY');
        $this->sign = env('VIP_SIGN');
    }
    private function connect(string $endpoint, array $params): string | bool {
        $_post = [];
        if (is_array($params)) {
            foreach ($params as $name => $value) {
                $_post[] = $name . '=' . urlencode($value);
            }
        }
        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if (is_array($params)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, join('&', $_post));
        }
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        $response = curl_exec($ch);
        if (curl_errno($ch) != 0 && empty($response)) {
            $response = false;
        }
        curl_close($ch);
        return $response;
    }
    public function  GetProfile() {
        $url = $this->url . '/profile';
        $param = [
            'key'=>$this->key,
            'sign'=>$this->sign,
        ];
        $get_profile = $this->connect($url,$param);
        $data = json_decode($get_profile);
        return $data->data;
    }
    public function GetProduct() {
        $url = $this->url . '/game-feature';
        $param = [
            'key'=>$this->key,
            'sign'=>$this->sign,
            'type' => 'services',
            'filter_status' => 'available',
        ];
        $get_product = $this->connect($url,$param);
        $data = json_decode($get_product);
        return $data->data;
    }
    public function checkign(Request $request) {
        $url = $this->url . '/game-feature';
        $param = [
            'key'=>$this->key,
            'sign'=>$this->sign,
            'type'=>'get-nickname',
            'code'=>$request->query('code'),
            'target'=> $request->query('user_id'),
            'additional_target'=>$request->query('zone_id')
        ];
        $get_nickname = $this->connect($url,$param);
        return $get_nickname;
    }
    public function GetOrder($carts) {
        $url = $this->url . '/game-feature';
        $param = [
            'key'=>$this->key,
            'sign'=>$this->sign,
            'type'=>'order',
            'service'=>$carts->product_id,
            'data_no'=>$carts->user_id,
            'data_zone'=>$carts->server_id,
        ];
        $get_order = $this->connect($url,$param);
        $data = json_decode($get_order);
        return $data->data;
    }
    public function GetOrderDetails($carts) {
    $url = $this->url . '/game-feature';
    $param = [
        'key'=>$this->key,
        'sign'=>$this->sign,
        'type'=>'status',
        'trxid'=>$carts->trxid,
    ];
    $get_details = $this->connect($url,$param);
    $data = json_decode($get_details,true);
    return $carts->trxid != null ? $data['data'][0] : false;
    }
    public function GetAllOrderRecents() {
        $url = $this->url . '/game-feature';
        $param = [
            'key'=>$this->key,
            'sign'=>$this->sign,
            'type'=>'status',
        ];
        $get_details = $this->connect($url,$param);
        $data = json_decode($get_details,true);
        return $data['data'];
    }


}
