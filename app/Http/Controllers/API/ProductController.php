<?php

namespace App\Http\Controllers\API;

use App\Models\Favourite;
use App\Models\Language;
use App\Models\OrderProduct;
use App\Models\Work;
use App\Models\Order;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $items = Work::query();

        if ($request->has('brand_id'))
        {
            if ($request->get('brand_id') != Null)
            {
                $items->where('brand_id', $request->get('brand_id'));
            }
        }
        if ($request->has('product_type_id'))
        {
            if ($request->get('product_type_id') != Null)
            {
                $items->where('product_type_id', $request->get('product_type_id'));
            }
        }
        if ($request->has('sub_category_id'))
        {
            if ($request->get('sub_category_id') != Null)
            {
                $items->where('sub_category_id', $request->get('sub_category_id'));
            }
        }
        if ($request->has('price'))
        {
            if ($request->get('price') != Null)
            {
                $items->where('price', $request->get('price'));
            }
        }
        if ($request->has('name')) {
            if ($request->get('name') != null)
                $items->whereHas('translations', function ($query) use ($request)
                {
                    $query->where('locale', app()->getLocale())
                        ->where('name', 'like', '%' . $request->get('name') . '%');
                });
        }

        $data = $items->where('status','active')->orderBy('id','desc')->paginate(6);
        return mainResponse(true, 'api.ok', $data,[]);
    }

    public function newest()
    {
        $items = Work::query();
        $data = $items->where('status','active')->orderBy('id','desc')->take(2)->get();
        return mainResponse(true, 'api.ok', $data,[]);
    }

    public function show ($id)
    {
        $item = Work::query()->with('images')->find($id);
        if($item){
            return mainResponse(true, 'api.ok', $item,[]);
        }
        return mainResponse(false, 'api.numberNotFound', [],[]);
    }

    public function sameProduct($id)
    {
        $product = Work::query()->find($id);
        if($product)
        {
            $item = Work::query()->where('sub_category_id',$product->sub_category_id)->where('id','!=',$id)->get();
            if($item){
                return mainResponse(true, 'api.ok', $item,[]);
            }
            return mainResponse(false, 'api.numberNotFound', [],[]);
        }
        else{
            return mainResponse(false, 'api.numberNotFound', [],[]);
        }
    }

    public function add_cart(Request $request)
    {
        $user_id = auth('api')->id();
        //return $user_id;
        if($request->cart!=''){
            $t = json_decode($request->cart,true);
            //return $t["data"];
        }
        else{
            return mainResponse(false,'cart is required',[],[]);
        }
        $user = User::where('id',$user_id)->first();
        $validator = Validator::make($t, [
            'address'=>'required',
            'method'=>'required',
            'data'=>'required',
        ]);

        if ($validator->fails())
        {
            $errors = $validator->errors();
            $errors = $errors->toArray();
            $message = '';
            foreach ($errors as $key => $value) {
                $message .= $value[0] . ',';
            }
            return mainResponse(false, $message , [], [], 1);
        }

        if(!$validator->fails())
        {
            $order = New Order();

            if($user_id)
            {
                $user = User::where('id',$user_id)->first();
                $order->user_id = $user_id;
                $order->address = $t["address"];
                $order->payment_method = $t["method"];
                $order->save();
                $products = $t['data'] ;

                if($products)
                {
                    $total_price = 0;
                    $total_data = 0;
                    foreach($products as $product)
                    {
                        $product_id =  $product['product_id'];
                        $product_quantity =  $product['quantity'];
                        $price_product_all = Work::findOrFail($product_id);
                        //return $price_product_all->price;
                        $price_product = $price_product_all->price;

                        $price_product_total = $price_product * $product_quantity;

                        $total_price = $total_price + $price_product_total;

                        $products_order = New OrderProduct();
                        $products_order->order_id = $order->id;
                        $products_order->product_id = $product_id;
                        $products_order->quantity = $product_quantity;
                        $products_order->price = $price_product;
                        $products_order->total = $price_product_total;

                        $products_order->save();
                    }
                    $total_price_final = $total_price;

                    $price_total_order = Order::findOrFail($order->id);
                    $price_total_order->total_amount = $total_price_final;
                    $price_total_order->save();
                }
            }
        }
        return mainResponse(true,'api.ok',[],[]);
    }

    public function favouriteProduct($product_id)
    {
        $user = Auth::guard('api')->user();
        $product = Work::query()->where('id', $product_id)->first();
        if ($product)
        {
            $newFavourite = Favourite::query()->firstOrCreate(['user_id' => $user->id, 'product_id' => $product_id]);
            if ($newFavourite->wasRecentlyCreated)
            {
                return mainResponse(true, 'api.ok' , [],[]);
            }
            else
            {
                return mainResponse(true, 'api.foundFavourite', [],[]);
            }
        }
        else
        {
            return mainResponse(false, 'api.numberNotFound', [],[]);
        }
    }

    public function unFavouriteProduct($product_id)
    {
        $user = Auth::guard('api')->user();
        $product = Work::query()->where('id', $product_id)->first();
        if ($product)
        {
            $unFavourite = Favourite::query()->where(['user_id' => $user->id, 'product_id' => $product_id])->delete();
            if ($unFavourite)
            {
                return mainResponse(true, 'api.unFavourite' , [],[]);
            }
            else
            {
                return mainResponse(true, 'api.notFoundFavourite', [],[]);
            }
        }
        else
        {
            return mainResponse(false, 'api.numberNotFound', [],[]);
        }
    }

    public function myFavouriteProducts()
    {
        $data = Auth::guard('api')->user()->favourites;
        return mainResponse(true, 'api.ok', $data,[]);
    }
}