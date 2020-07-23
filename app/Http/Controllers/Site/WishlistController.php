<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\Token;
use App\Models\Product;
use App\User;
use DB;

use Auth;
use Validator;

class WishlistController extends Controller
{

    public function wishlistPage(){

        $whishlists=Wishlist::where('user_id', Auth::user()->id)->get();

            return view("website.wishlist", compact("whishlists"));


    }


    public function removeproduct($id){

        $item = Wishlist::query()->findOrFail($id);
        if ($item) {
            Wishlist::query()->where('id', $id)->delete();
            $wishlist = Wishlist::where('user_id', Auth::user()->id)->count();
            return ['status'=>'done','wishlist'=>$wishlist];
        }
        return "fail";
    }


    public function addToWishlistFromProductPage(Request $request){


        $check =  Wishlist::where(['user_id'=>Auth::user()->id,'product_id'=>$request->product_id])->first();


        if($check){

            return ['status'=>'alert'];
        }
        $wishlist = new Wishlist();
        $wishlist->user_id=Auth::user()->id;
        $wishlist->product_id=$request->product_id;
        $wishlist->save();
        $wishlistt = Wishlist::where('user_id', Auth::user()->id)->count();
        return ['status'=>'done','wishlistt'=>$wishlistt];
    }








}
