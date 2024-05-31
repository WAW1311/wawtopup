<?php

namespace App\Http\Controllers;
use App\Models\cart_user;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Midtrans;
use Aditdev\ApiGames;

class handlercontroller extends Controller
{
    public function index() {
        $categories = category::with('product.sub_product')->get();
        return view('index',compact('categories'));
    }
    public function profit($price) {
        $profit = $price * 0.07;
        $Price_profit = $price + $profit;
        return $Price_profit;
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
    public function checkign(Request $request, $game_id) {
        $url = env('API_SERVICE');
        $param = [
            'key'=>'96cq2JelX5A8pnVrIpT728F3x6GHDH1Cd8xBns7JkVgCbUEJpniuS5VP0cY5jWXr',
            'sign'=>'68a076a21ea30488589ef551f49016b8',
            'type'=>'get-nickname',
            'code'=>$game_id,
            'target'=> $request->query('user_id'),
            'additional_target'=>$request->query('zone_id')
        ];
        $get_product = Http::asForm()->post($url,$param);
        $Data = $get_product->json();
        return $Data;
    }
    public function order(Request $request,$order_id) {
        $validated = $request->validate([
            'userid' => 'required',
            'selectedProduct' => 'required',
            'nohp' => 'required',
        ], [
            'userid.required' => 'User ID tidak boleh kosong.',
            'selectedProduct.required' => 'Silahkan pilih nominal topup!',
            'nohp.required' => 'Nomor HP tidak boleh kosong!',
        ]);
        $carts = cart_user::where('order_id',$order_id)->first();
        if(!$carts) {
            $products = $this->get_order();
            $product_id = $request->selectedProduct;
            $server = $request->input('server');
            foreach($products as $product) {
                if ($product['code'] == $product_id) {
                    cart_user::create([
                        'no_hp'=>$request->nohp,
                        'order_id'=> $order_id,
                        'product_id'=> $product_id,
                        'category'=> $product['game'],
                        'name' => $product['name'],
                        'price'=> $this->profit($product['price']['basic']),
                        'quantity'=> 1,
                        'user_id'=> $request->userid,
                        'server_id'=> $server,
                        'status'=> "pending",
                        'order_processed' => false,
                    ]);
                }
            }
            $carts = cart_user::where('order_id',$order_id)->first();
        }
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
        Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Midtrans\Config::$serverKey = $Server_key;
        $notif = new Midtrans\Notification();
        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;
        if ($transaction == 'capture') {
            if ($type == 'credit_card'){
                if($fraud == 'accept'){
                    $data = ['status'=>'success','payment_method' => $type];
                    $this->changestatus($order_id,$data);
                    $this->sendmsg($order_id,$type);
                }
            }
        }
        else if ($transaction == 'settlement'){
            if($fraud == 'accept'){
                $data = ['status'=>'success','payment_method' => $type];
                $this->changestatus($order_id,$data);
                $this->sendmsg($order_id,$type);
            }
        }
        else if($transaction == 'pending'){
            $data = ['status'=>'pending','payment_method' => $type];
            $this->changestatus($order_id,$data);
            $this->sendmsg($order_id,$type);
        }
        else if ($transaction == 'deny') {
            $data = ['status'=>'denied','payment_method' => $type];
            $this->changestatus($order_id,$data);
            $this->sendmsg($order_id,$type);
        }
        else if ($transaction == 'expire') {
            $data = ['status'=>'expired','payment_method' => $type];
            $this->changestatus($order_id,$data);
            $this->sendmsg($order_id,$type);
        }
        else if ($transaction == 'cancel') {
            $data = ['status'=>'cancelled','payment_method' => $type];
            $this->changestatus($order_id,$data);
            $this->sendmsg($order_id,$type);
        }
        $data = ['status'=>$fraud,'payment_method' => $type];
        return response()->json($data,200);
    }
    public function invoice($order_id){
        $carts = cart_user::where('order_id',$order_id)->first();
        if ($carts->status == "success"){
            if ($carts->order_processed == false && $carts->trxid == "none"){
                $url = env('API_SERVICE');
                $param = [
                    'key'=>'96cq2JelX5A8pnVrIpT728F3x6GHDH1Cd8xBns7JkVgCbUEJpniuS5VP0cY5jWXr',
                    'sign'=>'68a076a21ea30488589ef551f49016b8',
                    'type'=>'order',
                    'service'=>$carts->product_id,
                    'data_no'=>$carts->user_id,
                    'data_zone'=>$carts->server_id,
                ];
                $get_order = Http::asForm()->post($url,$param);
                $Datas = $get_order->json();
                $product = $Datas['data'];
                $status = ['order_processed'=>true,'trxid'=>$product['trxid']];
                $carts->update($status);
            }
            $urls = env('API_SERVICE');
            $params = [
                    'key'=>'96cq2JelX5A8pnVrIpT728F3x6GHDH1Cd8xBns7JkVgCbUEJpniuS5VP0cY5jWXr',
                    'sign'=>'68a076a21ea30488589ef551f49016b8',
                    'type'=>'status',
                    'trxid'=>$carts->trxid,
            ];
            $pesanan = Http::asForm()->post($urls,$params);
            $Data = $pesanan->json();
            $products = $Data['data'][0];
            return view('invoice',compact('carts','products'));
        }
        $products = [
            'status'=>'pending',
        ];
        return view('invoice',compact('carts','products'));
    }
    // public function invoice($order_id){
    //     $carts = cart_user::where('order_id',$order_id)->first();
    //     return view('invoice',compact('carts'));
    // }
    public function cek() {
        return view('cek_transaksi');
    }
    public function trx(request $request) {
        $check = cart_user::where('order_id',$request->order_id)->first();
        if (!$check){
            return redirect()->back()->with('error','Transaksi Tidak ditemukan!');
        } else {
            return redirect(route('invoice',['order_id' => $request->order_id]));
        }
    }

    public function finish(Request $request) {
        return redirect(route('invoice',['order_id' => $request->query('order_id')]));
    }
}
