<?php

namespace App\Http\Controllers\Site;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use App\Models\Product;
use App\Models\categoryUser;
use App\Models\Category;

use App\Models\ProductTranslation;
use App\Models\Attatchments;
use App\User;
use App\Models\Company;
use App\Models\Language;

use App\Models\Setting;
use App\Models\Token;
use App\Models\View;
use Auth;
use Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{


    public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::query()->first();
        view()->share([
            'locales' => $this->locales,
            'settings' => $this->settings,

        ]);
    }
    
    public function image_extensions()
    {

        return array('jpg', 'png', 'jpeg', 'gif', 'bmp');

    }

    public function file_extensions()
    {

        return array('doc', 'docx', 'pdf', 'xls', 'svg');

    }

    public function getProduct($id){
        $featuredProducts=Product::with('Attatchments')->orderBy('id','desc')->limit(5)->get();
    	$Product=Product::with('Attatchments','category')->where('id',$id)->first();
        $new = new View();
        if(Auth::user()) {
            $new->user_id = Auth::user()->id;
        }
        else{
            $new->user_id =0;
        }
        $new->product_id=$id;
        $new->ip_address = \Request::ip();
        $new->save();
    	  return view('website.Details',[
             'product' => $Product,
             'featuredProducts' => $featuredProducts,
              ]);
    }

    public function myProducts(){
        $user_id=Auth::user()->id;
        if(Auth::user()->type == 1) {
        $products=Product::where(['user_id'=>$user_id,'delete'=>0,'status'=>'active'])->get();
        return view('web.myProducts',['products'=> $products]);
        }
        return redirect('/home');

    }

    public function addProduct()
    {
        $locales = Language::all();
        $user=Auth::user()->id;
        $storeSubCategories =  categoryUser::where('user_id',$user)->pluck('category_id')->toArray();
        $subCategories =  Category::whereIn('id',$storeSubCategories)->get();
        if(Auth::user()->type == 1) {

            return view('web.addProduct', [
                'locales' => $locales,
                'subCategories' => $subCategories

            ]);
        }
        return redirect('/home');
    }

    public function editProduct($id){
        $user_id=Auth::user()->id;
        $item = Product::findOrFail($id);
        if ($item->user_id == $user_id) {
            $locales = Language::all();
            $attatch = Attatchments::where('product_id', $id)->get();
            $subCategories = Category::where('is_parent',Auth::user()->category_id)->get();
            return view('web.editProduct', [
                'locales' => $locales,
                'item' => $item,
                'attatch' => $attatch,
                'subCategories' => $subCategories,
            ]);
        }
        else{
            return redirect('/home');
        }
    }

    public function store(Request $request)
    {
     if(Auth::user()->type==1){
        $valid = Validator::make($request->all(),[

            'name_ar'=>'required|string',
            'name_en'=>'required|string',
            'description_ar'=>'required|string',
            'description_en'=>'required|string',
            'price'=>'required',
            'attatchments.*' => 'required|mimes:jpeg,bmp,png,gif',
            'availability'=>'required',
            'sub_Category'=>'required',

        ]);
         if ($valid->fails()) {
             return redirect()->back()->withErrors($valid)->withInput();
         }

            
         $product= new Product();
           $locales = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLanguagesKeys();
           foreach ($locales as $locale) {
          $product->translateOrNew($locale)->name = $request->get('name_' . $locale);
          $product->translateOrNew($locale)->description = $request->get('description_' . $locale);
            }
          $product->user_id=Auth::user()->id;
          $product->price=$request->price;
          $product->status='active';
          $product->price_after_offer=$request->price_after_offer;
          $product->availability=$request->availability;
          
          $product->category_id=$request->sub_Category;
          $add= $product->save();
          

          if($add){
            if ($request->hasFile('attatchments')) {
                $files = $request->file('attatchments');
                foreach($files as $one){
                      $new=new Attatchments();
                      $new->product_id=$product->id;
                        $extension=strtolower($one->getClientOriginalExtension());
                        $array= $this->image_extensions();
                        if(in_array($extension,$array))
                        {
                            $name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".jpg";
                            Image::make($one)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/products/$name");
                            $new->image=$name;
                        }else{
                            $new->image='';
                        }
                  $new->save();
                                    }
               }    

               }   
        return redirect(app()->getLocale().'/myProducts');

    }
        return redirect('/home');

}

    public function update($id,Request $request )
    {
        $product= Product::findOrFail($id);
      if(Auth::user()->type==1  && Auth::user()->id == $product->user_id){
        $valid = Validator::make($request->all(),[

            'name_ar'=>'required|string',
            'name_en'=>'required|string',
            'description_ar'=>'required|string',
            'description_en'=>'required|string',
            'price'=>'required',
            'attatchments.*' => 'mimes:jpeg,bmp,png,gif',
            'sub_Category'=>'required',
        ]);

          if ($valid->fails()) {
              return redirect()->back()->withErrors($valid)->withInput();
          }
            

           $locales = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLanguagesKeys();
           foreach ($locales as $locale) {
          $product->translateOrNew($locale)->name = $request->get('name_' . $locale);
          $product->translateOrNew($locale)->description = $request->get('description_' . $locale);
            }
          $product->user_id=Auth::user()->id;
          $product->price=$request->price;
          $product->status='active';
          $product->price_after_offer=$request->price_after_offer;
          $product->availability=$request->availability;

          $product->category_id=$request->sub_Category;
          $add= $product->save();
          

          if($add){
            if ($request->hasFile('attatchments')) {
                $files = $request->file('attatchments');
                foreach($files as $one){
                      $new=new Attatchments();
                      $new->product_id=$product->id;
                        $extension=strtolower($one->getClientOriginalExtension());
                        $array= $this->image_extensions();
                        if(in_array($extension,$array))
                        {
                            $name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".jpg";
                    Image::make($one)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/products/$name");
                       $new->image=$name;
                        }else{
                          $new->image='';
                        }
                  $new->save();
                                    }
               }    

               }   
        return redirect()->back()->with('status', __('website.editsuccess'));

    }
        return redirect('/home');
    }

    public function delete_attatchment($id)
    {
        $attatchment = Attatchments::find($id);
        $product = Product::findOrFail($attatchment->product_id);
        if($product->user_id == Auth::user()->id) {
            if ($attatchment->delete()) {
                return 'success';
            }
            return 'fail';
        }
        return 'fail';
    }

    public function destroy($id)
    {
        $item = Product::query()->findOrFail($id);
        if(Auth::user()->id==$item->user_id) {
            if ($item) {
                $product = Product::where('id', $id)->first();
                $product->delete=1;
                $product->save();
                Cart::where('product_id',$id)->delete();
                return 1;
            }
            return 0;
        }
        return 0;

    }







}



