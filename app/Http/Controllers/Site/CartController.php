<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Token;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductOrder;
use App\Models\DeliveryCompany;
use App\Models\DeliveryCost;
use App\Models\NotificationMessage;
use App\Models\Quantity;
use App\User;
use DB;

use Auth;
use Validator;

class CartController extends Controller
{

	 public function CartPage(){


            $carts=Cart::where('user_id', Auth::user()->id)->get();
            if (count($carts)>0) {
                return view("website.shoping", compact("carts"));
            }
            else{
                return view("website.shopping_empty");
            }


    }


    public function addProductToCart(Request $request){
                $cart = new Cart();
                $cart->user_id=Auth::user()->id;
                $cart->product_id=$request->product_id;
                $cart->quantity=1;
                $cart->save();

             return redirect(route("showCart"));

    }


    public function removeproduct($id){

        $item = Cart::query()->findOrFail($id);


        if ($item) {

            Cart::query()->where('id', $id)->delete();
            $cart = Cart::where('user_id', Auth::user()->id)->count();
            return ['status'=>'done','cart'=>$cart];
        }
        return "fail";

    }


    public function addToCartFromProductPage(Request $request){


        $check =  Cart::where(['user_id'=>Auth::user()->id,'product_id'=>$request->product_id])->first();

        if($check){

            return ['status'=>'alert'];
        }
        $cart = new Cart();
        $cart->user_id=Auth::user()->id;
        $cart->product_id=$request->product_id;
        $cart->quantity=$request->quantity;
        $cart->save();
        //DB::table('carts')->insert(['user_id'=>Auth::user()->id,'product_id'=>$request->product_id,'quantity'=>$request->quantity]);
        $total =  Cart::where('user_id', Auth::user()->id)->count();
        $cart= Cart::where('user_id', Auth::user()->id)->count();
        return ['status'=>'done','total'=>$total,'cart'=>$cart];
    }

    //update cart quantity
    public function increaseQuantity($id)
    {
        $user = auth()->user();
        $cart=Cart::where('id',$id)->first();
        $stock=Quantity::where('product_id',$cart->product_id)->first();
        $product=$cart->product()->where('id', $cart->product_id)->first();
        $new_quantity=$cart->quantity+1;
        if($stock->quantity>=$new_quantity){
            $user->cart()->where('id', $id)->update(['quantity'=>$new_quantity]);
            $cart=Cart::where('id',$id)->first();
            if($product->discount == 0){
                $subTotal=$product->price*$cart->quantity;
            }else{
                $price = $product->price;
                $discount = ($price *$product->discount)/100;
                $newPrice = $price -  $discount ;
                $subTotal=$newPrice*$cart->quantity;
            }
            //$subTotal=$product->price*$cart->quantity;
            return ['status'=>'done','subTotal'=>$subTotal,'quantityy'=>$cart->quantity];
        }else{

            return ['status'=>'error','quantityy'=>$cart->quantity];
        }
    }

    public function decreaseQuantity($id)
    {
        $user = auth()->user();
        $cart=Cart::where('id',$id)->first();
        $product=$cart->product()->where('id', $cart->product_id)->first();
        $new_quantity=$cart->quantity-1;
        if($new_quantity>=1){

            $user->cart()->where('id', $id)->update(['quantity'=>$new_quantity]);
            $cart=Cart::where('id',$id)->first();
            if($product->discount == 0){

                $subTotal=$product->price*$cart->quantity;

            }else{

                $price = $product->price;
                $discount = ($price *$product->discount)/100;
                $newPrice = $price -  $discount ;
                $subTotal=$newPrice*$cart->quantity;
            }
            //$subTotal=$product->price*$cart->quantity;

            return ['status'=>'done','subTotal'=>$subTotal,'quantityy'=>$cart->quantity];
        }
        else{

            return ['status'=>'error','quantityy'=>$cart->quantity];
        }



    }


    public function checkOutView(){
        $carts=Cart::where('user_id', Auth::user()->id)->get();
        $user=User::where('id', Auth::user()->id)->first();
        return view("website.check_out",compact('carts','user'));

    }

    public function checkOut(Request $request){

        $roles = [
            'mobile' => 'required',
            'address' => 'required',
            'payment_method' => 'required',
           ];
           $this->validate($request, $roles);
	     

            $carts=Cart::where('user_id', Auth::user()->id)->get();
            $order = new Order();
            $order->user_id=Auth::user()->id;
            $order->mobile=$request->mobile;
            $order->address=$request->address;
            $order->payment_method=$request->payment_method;
            $total=0;
        foreach ($carts as $cart) {

            if($cart->product->discount == 0){

                $total +=$cart->quantity*$cart->product->price;

            }else{

                $price = $cart->product->price;
                $discount = ($price *$cart->product->discount)/100;
                $newPrice = $price -  $discount ;
                $total +=$cart->quantity*$newPrice;
            }

        }
        $order->total=$total;
        $order->save();
            //this for add to "order_products" table
            foreach ($carts as $cart) {

                    \DB::table("order_products")->insert([
                        'order_id' => $order->id,
                        'product_id' => $cart->product_id,
                        'quantity' => $cart->quantity,
                        'price'   => $cart->product->price,
                    ]);
                $cart->where('user_id', Auth::user()->id)->delete();
            }

        return ['status'=>'done'];

    }


    public function deliveryCost(Request $request){
        $user = auth('web')->id();
        $cart = Cart::where('user_id',$user)->first();
        if($cart) {
            $productDetails = Product::findOrFail($cart->product_id);
            $cityFrom = $productDetails->store->city_id;
            $cityTo = $request->cityto;
         //   return $cityFrom ."  ". $cityTo;
            $costDelivery = DeliveryCost::where('delivery_company_id', $request->delivery_company_id)
                ->where(function ($q) use ($cityFrom, $cityTo) {
                    $q->where(['cityfrom' => $cityFrom, 'cityto' => $cityTo])
                        ->orWhere(['cityfrom' => $cityTo, 'cityto' => $cityFrom]);
                })->pluck('cost')
                ->first();
            $costDelivery = ($costDelivery)? $costDelivery:"0";
            return $costDelivery;
        }

        return 0;

    }







}
