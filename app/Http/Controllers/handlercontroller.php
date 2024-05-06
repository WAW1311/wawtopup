<?php

namespace App\Http\Controllers;
use App\Models\product;
use App\Models\cart_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Midtrans;
use Aditdev\ApiGames;

class handlercontroller extends Controller
{
    public function index() {
        $products = product::all();
        return view('index',compact('products'));
    }
    public function checkusername(Request $request, $game_id) {
        $api = new ApiGames;
        $userId = $request->query('user_id');
        $zoneId = $request->query('zone_id');
        if ($zoneId == null) {
            $result = $api->$game_id($userId);
            $data = json_decode($result,true);
            if ($data['status'] >= 200 && $data['status'] < 300) {
                $response = [
                    'status'=>$data['status'],
                    'msg'=> 'Data found!',
                    'nickname'=>$data['nickname'],
                ];
                return response()->json($response);
            }else {
                $response = [
                    'status'=>$data['status'],
                    'msg'=> 'Data not found!',
                ];
                return response()->json($response);
            }
        } else {
            $result = $api->$game_id($userId,$zoneId);
            $data = json_decode($result,true);
            if ($data['status'] >= 200 && $data['status'] < 300) {
                $response = [
                    'status'=>$data['status'],
                    'msg'=> 'Data found!',
                    'nickname'=>$data['nickname'],
                ];
                return response()->json($response);
            }else {
                $response = [
                    'status'=>$data['status'],
                    'msg'=> 'Data not found!',
                ];
                return response()->json($response);
            }
        }
    }
    public function order(Request $request,$order_id) {
        $check = cart_user::where('order_id',$order_id)->first();
        if(!$check) {
            $products = $this->get_order();
            $product_id = (int) $request->input('selectedProduct');
            $user_id = (int) $request->input('userid');
            $server = (int) $request->input('server');
            foreach($products as $product) {
                if ($product['id'] == $product_id) {
                    cart_user::create([
                        'order_id'=> $order_id,
                        'product_id'=> $product_id,
                        'category'=> $product['category'],
                        'name' => $product['name'],
                        #'price'=> $product['price']['special'], #api thirdparty
                        'price'=> $product['price'], #database
                        'quantity'=> 1,
                        'user_id'=> $user_id,
                        'server_id'=> $server,
                        'status'=> "pending",
                        'order_processed' => false,
                    ]);
                }
            }
        }
        $carts = cart_user::where('order_id',$order_id)->first();
        if ($carts->token == 'none') {
            $token =$this->create_snap($order_id);
            $data = ['token'=>$token];
            $carts->update($data);
        }
        $token = $carts->token;
        return view('checkout',compact('carts','token'));
    }
    public function webhooks() {
        $Server_key = env('SERVER_KEY');
        Midtrans\Config::$isProduction = false;
        Midtrans\Config::$serverKey = $Server_key;
        $notif = new Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        if ($transaction == 'capture') {
            if ($type == 'credit_card'){
                if($fraud == 'accept'){
                    $data = ['status'=>'success'];
                    $this->changestatus($order_id,$data);
                }
                }
        }
        else if ($transaction == 'settlement'){
            if($fraud == 'accept'){
                $data = ['status'=>'success'];
                $this->changestatus($order_id,$data);
            }
        }
        else if($transaction == 'pending'){
            $data = ['status'=>'pending'];
            $this->changestatus($order_id,$data);
        }
        else if ($transaction == 'deny') {
            $data = ['status'=>'denied'];
            $this->changestatus($order_id,$data);
        }
        else if ($transaction == 'expire') {
            $data = ['status'=>'expired'];
            $this->changestatus($order_id,$data);
        }
        else if ($transaction == 'cancel') {
            $data = ['status'=>'cancelled'];
            $this->changestatus($order_id,$data);
        }
        $data = ['status'=>'success'];
        return response()->json($data,200);
    }
    // public function invoice($order_id){
    //     $carts = cart_user::where('order_id',$order_id)->first();
    //     if ($carts->status == "success" && $carts->order_processed == false && $carts->trxid == "none"){
    //         $param = [
    //             'service'=>$carts->product_id,
    //             'data_no'=>$carts->user_id,
    //             'data_server'=>$carts->server_id
    //         ];
    //         $url = env('API_ORDER') . http_build_query($param);
    //         $get_order = Http::post($url);
    //         $Datas = $get_order->json();
    //         $product = $Datas['data'];
    //         $status = ['order_processed'=>true,'trxid'=>$product['trxid']];
    //         $carts->update($status);
    //     }
    //     $params = ['trx_id'=>$carts->trxid];
    //     $urls= env('API_PESANAN') . http_build_query($params);
    //     $pesanan = Http::post($urls);
    //     $Data = $pesanan->json();
    //     $products = $Data['data'];
    //     return view('invoice',compact('carts','products'));
    // }
    public function invoice($order_id){
    $carts = cart_user::where('order_id',$order_id)->first();
    if ($carts->status == "success" && $carts->order_processed == false && $carts->trxid == "none"){
        return view('invoice',compact('carts'));
    }

    }
    public function cek() {
        return view('cek_transaksi');
    }
    public function trx(request $request) {
        $order_id = $request->input('order_id');
        $cart = cart_user::where('order_id',$order_id)->first();
        return view('cek_transaksi',compact('cart'));
    }
}
