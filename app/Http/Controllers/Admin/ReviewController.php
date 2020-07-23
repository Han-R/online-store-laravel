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
use App\Models\Review;
use App\Models\Product;


class ReviewController extends Controller
{



    public function image_extensions(){

        return array('jpg','png','jpeg','gif','bmp','pdf');

    }


    public function showRate(Request $request)
    {
        $locales = Language::all();
        $items = Product::query();


        if ($request->has('product_name')) {
            if ($request->get('product_name') != null){
                $ides_product = ProductTranslation::where('name', 'like', '%' . $request->get('product_name') . '%')->pluck('product_id')->toArray();
                $items = $items->whereIn('product_id',$ides_product);}
        }


        $items  =  $items->orderBy('created_at', 'desc')->get();

        return view('admin.review.rate', [
            'items' => $items,
            'locales' => $locales
        ]);
    }

    public function index(Request $request)
    {
        $locales = Language::all();
        $items = Review::query();


        if ($request->has('product_name')) {
            if ($request->get('product_name') != null){
                $ides_product = ProductTranslation::where('name', 'like', '%' . $request->get('product_name') . '%')->pluck('product_id')->toArray();
                $items = $items->whereIn('product_id',$ides_product);}
        }


        $items  =  $items->orderBy('created_at', 'desc')->get();

        return view('admin.review.review', [
            'items' => $items,
            'locales' => $locales
        ]);
    }


    public function edit($id)
    {
        $item= Review::findOrFail($id);

        return view('admin.review.edit_review',['item'=>$item]);
    }

    public function update(Request $request, $id)
    {
        $item= Review::findOrFail($id);
        $product=Product::where('id',$item->product_id)->first();


        $item->approved = $request->approved;
        $item->spam = $request->spam;
        $item->save();
        if($item->approved==false || $item->spam==true){
            $reviews = $product->reviews()->notSpam()->approved();
            $avgRating = $reviews->avg('rating');
            $product->rating_cache = round($avgRating,1);
            $product->rating_count = $reviews->count();
            $product->save();

        }

        return redirect()->back()->with('status', __('common.update'));

    }

    public function destroy($id)
    {

        $item = Review::query()->findOrFail($id);
        if ($item) {
            Review::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }

}


