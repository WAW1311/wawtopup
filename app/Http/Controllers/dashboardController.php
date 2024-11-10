<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\cart_user;
use App\Models\sub_product;
use App\Models\category;
use App\Models\daftar_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\VipPaymentController;

class dashboardController extends Controller
{
    public function index() {
        $profile = Cache::remember('profile', 180, function () {
            $vipreseller = new VipPaymentController;
            $data = $vipreseller->GetProfile();
            return $data;
        });
        $cart_user = Cache::remember('cart_user',120,function(){
            return cart_user::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('count(*) as total')
        )->groupBy('month')->get();
        });
        return view('dashboard.index',compact('cart_user','profile'));
    }
    public function cart_user() {
        $cart = cart_user::all();
        return view('dashboard.cart_user',compact('cart'));
    }
    public function product() {
        $categories = category::all();
        $product = sub_product::with('product.category')->get();
        $daftar = daftar_product::select('name')->distinct()->get();
        return view('dashboard.product',compact('product','categories','daftar'));
    }
    public function addproduct(Request $request) {
        try {
            $productImage = $request->file('product_image');
            $imageName = $productImage->getClientOriginalName();
            $path = $productImage->storeAs('static/assets', $imageName);
            // Simpan data product
            $product = new product();
            $product->product_id = $request->product_id;
            $product->name = $request->product_name;
            $product->src = $path;
            $product->id_category = $request->product_category;
            $product->save();
    
            $sub_productImage = $request->file('sub_product_assets');
            $sub_imageName = $sub_productImage->getClientOriginalName();
            $sub_path = $sub_productImage->storeAs('static/assets',$sub_imageName);
    
            $subProduct = new sub_product();
            $subProduct->id_sub_product = $request->id_sub_product;
            $subProduct->name = $request->sub_product_name;
            $subProduct->assets = $sub_path;
            $subProduct->href = $request->sub_product_href;
            $subProduct->howto = $request->sub_product_howto;
            $subProduct->fill_data_id = $request->fill_data_id;
            $subProduct->checkign_on = $request->has('sub_product_checkign_on');
            $subProduct->checkign = $request->sub_product_checkign;
            $subProduct->id_product = $request->product_id;
            $subProduct->save();
    
            return redirect()->back()->with('success', 'Product added successfully.');
        } catch (\Exception $e) {
            if (isset($path) && Storage::exists($path)) {
                Storage::delete($path);
            }
            if (isset($sub_path) && Storage::exists($sub_path)) {
                Storage::delete($sub_path);
            }
            return redirect()->back()->with('error', "Failed to add product. Please try again later. {$e}");
        }

    }
    public function updateproduct(Request $request) {
        DB::beginTransaction();
        try {
            $product = product::where('product_id', $request->product_id)->first();
            $sub_product = sub_product::where('id_sub_product', $request->id_sub_product)->first();
            $imgfile = $request->file('product_image');
            $sub_imgfile = $request->file('sub_product_assets');

            $oldProductSrc = $product->src;
            $oldSubProductAssets = $sub_product->assets;
    
            if ($imgfile == null && $sub_imgfile == null) {
                $change = [
                    'name'=> $request->product_name,
                    'id_category' => $request->product_category,
                ];
                $product->update($change);
                $sub_change = [
                    'name'=> $request->sub_product_name,
                    'href'=> $request->sub_product_href,
                    'howto'=> $request->sub_product_howto,
                    'fill_data_id'=> $request->fill_data_id,
                    'checkign_on'=> $request->has('sub_product_checkign_on'),
                    'checkign'=> $request->sub_product_checkign,
                ];
                $sub_product->update($sub_change);
            }else {
                if($imgfile) {
                    $namepath = $imgfile->getClientOriginalName();
                    $path = $imgfile->storeAs('static/assets',$namepath);
                    $change = [
                        'name'=> $request->product_name,
                        'src'=>$path,
                        'id_category' => $request->product_category,
                    ];
                    $product->update($change);
                }
                if ($sub_imgfile) {
                    $sub_namepath = $sub_imgfile->getClientOriginalName();
                    $sub_path = $sub_imgfile->storeAs('static/assets',$sub_namepath);
                    $sub_change = [
                        'name'=> $request->sub_product_name,
                        'assets'=>$sub_path,
                        'href'=> $request->sub_product_href,
                        'howto'=> $request->sub_product_howto,
                        'fill_data_id'=> $request->fill_data_id,
                        'checkign_on'=> $request->has('sub_product_checkign_on'),
                        'checkign'=> $request->sub_product_checkign,
                    ];
                    $sub_product->update($sub_change);
                }
            }
            DB::commit();

            if (isset($imgfile)) {
                Storage::delete($oldProductSrc);
            }
            if (isset($sub_imgfile)) {
                Storage::delete($oldSubProductAssets);
            }
            return redirect()->back()->with('success', 'Product updated successfully.');

        } catch (\Exception $e) {
            DB::rollback();
            if (isset($path)) {
                Storage::delete($path);
            }
            if (isset($sub_path)) {
                Storage::delete($sub_path);
            }
            return redirect()->back()->with('error', 'Error updating product: ' . $e->getMessage());
        }
    }
    public function deleteproduct($product_id) {
        $prod_delete = product::where('product_id', $product_id)->first();
        $sub_delete = sub_product::where('id_product', $product_id)->first();
        Storage::delete($prod_delete->src);
        Storage::delete($sub_delete->assets);
        $prod_delete->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

    public function history(){
        $vipreseller = new VipPaymentController;
        $histories = $vipreseller->GetAllOrderRecents();
        return view('dashboard.history',compact('histories'));
    }
}
