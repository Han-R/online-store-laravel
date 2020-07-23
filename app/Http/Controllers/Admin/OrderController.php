<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Models\Language;
use App\Models\Order;
use App\Models\Product;
use App\Models\Quantity;
use App\Models\Setting;
use DB;
use Image;

//use App\Models\Token;

class OrderController extends Controller
{


    public function image_extensions()
    {

        return array('jpg', 'png', 'jpeg', 'gif', 'bmp', 'pdf');

    }
    protected $settings = '';
    protected $locales = '';

    public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::orderBy('id','desc')->first();
        view()->share('locales', $this->locales);
        view()->share('setting', $this->settings);
    }


    public function index(Request $request)
    {
        //$locales = Language::all();
        $items = Order::query()->orderBy('created_at', 'asc')->get();
        return view('admin.orders.home', compact('items'));
    }




    public function edit($id)
    {
        $order_i = Order::findOrFail($id);
        //return $order;
        return view('admin.orders.edit', [
            'order_i' => $order_i,
        ]);
    }



    public function update(Request $request, $id)
    {

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        if($request->status==3){
            //get all products of specific order
            $products=$order->products()->get();
            foreach($products as $product){
                //we want to increment sales count for product with quantity which user asked
                $ordered_product=\DB::table("order_products")->where('order_id', $id)->where('product_id',$product->id)->first();
                $product->increment('sales',$ordered_product->quantity);
                //get the original quantity of product & decrement the original quantity of product
                $product_quantity=Quantity::where('product_id',  $product->id)->first();
                if($product_quantity->quantity>0){
                    $product_quantity->decrement('quantity', $ordered_product->quantity);
                }
            }

        }


//        $message =  __('api.newOrder');
//        $order_id = $id;
//        $tokens_android = [];
//        $tokens_ios = Token::where('user_id',$request->employee_id)->where('device_type','ios')->pluck('fcm_token')->toArray();
//        sendNotificationToUsers( $tokens_android, $tokens_ios,  $order_id, $message );
        return redirect()->back()->with('status', __('common.update'));
    }





    public function destroy($id)
    {
        // return $id;
        $item = Order::query()->findOrFail($id);
        if ($item) {
            Order::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }




}


