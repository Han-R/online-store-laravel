<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Models\Language;
use App\Models\Cart;


class CartController extends Controller
{



    public function image_extensions(){

        return array('jpg','png','jpeg','gif','bmp','pdf');

    }


    public function index(Request $request)
    {
        $locales = Language::all();
        $items = Cart::query();


        if ($request->has('product_name')) {
            if ($request->get('product_name') != null){
                $ides_product = ProductTranslation::where('name', 'like', '%' . $request->get('product_name') . '%')->pluck('product_id')->toArray();
                $items = $items->whereIn('product_id',$ides_product);}
        }


        $items  =  $items->orderBy('created_at', 'desc')->get();

        return view('admin.cart.home', [
            'items' => $items,
            'locales' => $locales
        ]);
    }


    public function edit($id)
    {

    }

    public function destroy($id)
    {

        $item = Cart::query()->findOrFail($id);
        if ($item) {
            Cart::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }

}


