<?php

namespace App\Http\Controllers;
use App\Models\cart_user;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\TripayController;
use App\Http\Controllers\VipPaymentController;

class handlercontroller extends Controller
{
    public function index() {
        $categories = Cache::remember('categories',300,function() {
            return category::with('product.sub_product')->get();
        });
        return view('index',compact('categories'));
    }
    public function profit($price) {
        $profit = $price * 0.07;
        $Price_profit = $price + $profit;
        return $Price_profit;
    }
    public function order(Request $request,$order_id) {
        $validated = $request->validate([
            'userid' => 'required',
            'selectedProduct' => 'required',
            'selectedpayment'=>'required',
            'nohp' => 'required',
        ], [
            'userid.required' => 'User ID tidak boleh kosong.',
            'selectedProduct.required' => 'Silahkan pilih nominal topup!',
            'selectedpayment.required' => 'Silahkan pilih metode pembayaran terlebih dahulu!',
            'nohp.required' => 'Nomor HP tidak boleh kosong!',
        ]);
        $carts = cart_user::where('order_id',$order_id)->first();
        if(!$carts) {
            $products = $this->get_order();
            $product_id = $request->selectedProduct;
            $server = $request->input('server');
            foreach($products as $product) {
                if ($product->code == $product_id) {
                    cart_user::create([
                        'order_id'=> $order_id,
                        'no_hp'=>$request->nohp,
                        'product_id'=> $product_id,
                        'category'=> $product->game,
                        'name' => $product->name,
                        'price'=> $this->profit($product->price),
                        'quantity'=> 1,
                        'user_id'=> $request->userid,
                        'method' => $request->selectedpayment,
                        'server_id'=> $server,
                        'status'=> "UNPAID",
                        'order_processed' => false,
                    ]);
                }
            }
            $carts = cart_user::where('order_id',$order_id)->first();
            $tripay = new TripayController;
            $payment_datases = $tripay->GetPayment($carts);
            $carts->update([
                'tripay_reference'=>$payment_datases->reference,
                'status'=>$payment_datases->status,
                'method_name'=>$payment_datases->payment_name,
                'fee_customer'=>$payment_datases->fee_customer,
                'subtotal'=>$carts->price + $payment_datases->fee_customer,
                'url_checkout'=>$payment_datases->checkout_url,
            ]);
            $this->sendmsg($order_id);
            return redirect($payment_datases->checkout_url);
        }
        return redirect($carts->url_checkout);
    }
    public function invoice(Request $request){
        $order_id = $request->query('tripay_merchant_ref');
        $carts = cart_user::where('order_id',$order_id)->first();
        if (!$order_id) {
            return redirect()->back();
        }
        $vipreseller = new VipPaymentController();
        if (!$carts) {
            return redirect()->back();
        }
        if ($carts->status == "PAID"){
            if ($carts->order_processed == false && $carts->trxid == null){
                try {
                    $product = $vipreseller->GetOrder($carts);
                    $status = ['order_processed'=>true,'trxid'=>$product->trxid];
                    $carts->update($status);
                } catch (\Exception $e)  {
                    $products = [
                        'status'=>'pending',
                    ];
                    return view('invoice',compact('carts','products'));
                }
            }
            $products = $vipreseller->GetOrderDetails($carts);
            if($products != false) {
                return view('invoice',compact('carts','products'));
            } else {
                $products = [
                    'status'=>'pending',
                ];
                return view('invoice',compact('carts','products'));
            }
        }
        $products = [
            'status'=>'pending',
        ];
        return view('invoice',compact('carts','products'));
    }
    public function cek() {
        return view('cek_transaksi');
    }
    public function trx(request $request) {
        $check = cart_user::where('order_id',$request->order_id)->first();
        if (!$check){
            return redirect()->back()->with('error','Transaksi Tidak ditemukan!');
        } else {
            return redirect(route('invoice',['tripay_merchant_ref' => $request->order_id]));
        }
    }
}
