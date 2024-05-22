<?php

namespace App\Http\Controllers;
use App\Models\sub_product;
class topupcontroller extends Controller
{
    public function index($href) {
        $sub_product = sub_product::where('href',$href)->first();
        $product = $this->get_order();
        $order_id = $this->generateuuid();
        return view('products.index',compact('product','order_id','sub_product'));
    }

}
