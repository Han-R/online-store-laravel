<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use App\Models\Quantity;
use App\Models\Category;
use App\Models\Department;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\Attatchment;
use App\User;
use App\Models\Language;
use App\Models\Setting;
use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{


    protected $settings = '';
    protected $locales = '';

    public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::orderBy('id','desc')->first();
        view()->share('locales', $this->locales);
        view()->share('setting', $this->settings);
    }

    public function image_extensions(){

        return array('jpg','png','jpeg','gif','bmp');

    }
    public function file_extensions(){

        return array('doc','docx','pdf','xls','svg');

    }

    public function index(Request $request)
    {
        $items = Product::query();
        if ($request->has('status')) {
            if ($request->get('status') != null)
                $items->where('status', $request->get('status'));
        }
        $items = $items->orderBy('id', 'desc')->get();
        return view('admin.products.home', [
            'items' => $items,
        ]);

    }

    public function create(Request $request)
    {

        $departments = Department::query()->orderBy('id', 'desc')->get();
        $suppliers = Supplier::query();
        return view('admin.products.create', [
            'departments'=>$departments,
            'suppliers' => $suppliers,
            ]);
    }

    public function store(Request $request)
    {
        //return $request->all();

        $roles = [
            'barCode' => 'string',
            'price' => 'string',
            'discount' => 'string',
            'department_id' => 'integer',
            'category_id' => 'integer',
            'sub_category_id' => 'integer',
            'delivery_time' => 'integer',
            'quantity' => 'integer',
            'quantityPrice' => 'required',
            'supplier_id' => 'required',
            'images.*' => 'required|mimes:jpeg,bmp,png,gif',
        ];

        $locales = Language::all()->pluck('lang');

        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
            $roles['details_' . $locale] = 'required';
        }
        $this->validate($request, $roles);
        $item= New Product;
        foreach ($locales as $locale)
        {
            $item->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $item->translateOrNew($locale)->details = $request->get('details_' . $locale);
        }
        $item->barCode = $request->barCode;
        $item->price = $request->price;
        $item->discount = $request->discount;
        $item->department_id = $request->department_id;
        $item->category_id = $request->category_id;
        $item->sub_category_id = $request->sub_category_id;
        $item->delivery_time = $request->delivery_time;
        $item->status = $request->status;
        $item->recommended = $request->recommended;
        $item->best = $request->best;
        $item->save();

        if($item){
            if ($request->hasFile('images')) {
                $files = $request->file('images');
                foreach($files as $one){
                    $name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".jpg";
                    Image::make($one)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/products/$name");
                    $newAttach = new Attatchment();
                    $newAttach-> product_id=$item->id;
                    $newAttach->name = $name ;
                    $newAttach->save();
                }
            }

            if($request->quantity){
                $newQuantity = new Quantity();
                $newQuantity->product_id=$item->id;
                $newQuantity->quantity=$request->quantity;
                $newQuantity->price=$request->quantityPrice;
                $newQuantity->supplier_id=$request->supplier_id;
                $newQuantity->admin_id=auth('admin')->id();
                $newQuantity->save();
            }

            return redirect()->back()->with('status', __('common.create'));
        }
        return redirect()->back()->with('error', __('common.whoops'));







    }

    public function edit(Request $request,$id)
    {
        $item= Product::findOrFail($id);
        $departments = Department::query()->orderBy('id', 'desc')->get();
        $categories = Category::query()->where('department_id',$item->department_id)->orderBy('id', 'desc')->get();

        $subCategories = Category::query()->where('parent_id',$item->category_id)->orderBy('id', 'desc')->get();

        return view('admin.products.edit',['departments'=>$departments,'categories'=>$categories,'subCategories'=>$subCategories,'item'=>$item]);
    }

    public function update(Request $request, $id)
    {
       // return $request->all();
         $roles = [
             'barCode' => 'string',
             'price' => 'string',
             'discount' => 'string',
             'department_id' => 'integer',
             'category_id' => 'integer',
             'sub_category_id' => 'integer',
             'delivery_time' => 'string',
             'images.*' => 'mimes:jpeg,bmp,png,gif',
        ];

        $locales = Language::all()->pluck('lang');

        foreach ($locales as $locale) {
            $roles['name_' . $locale] = 'required';
            $roles['details_' . $locale] = 'required';
        }

        $this->validate($request, $roles);

        $item= Product::findOrFail($id);

        foreach ($locales as $locale)
        {
            $item->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $item->translateOrNew($locale)->details = $request->get('details_' . $locale);
        }
        $item->barCode = $request->barCode;
        $item->price = $request->price;
        $item->discount = $request->discount;
        $item->department_id = $request->department_id;
        $item->category_id = $request->category_id;
        $item->sub_category_id = $request->sub_category_id;
        $item->delivery_time = $request->delivery_time;
        $item->status = $request->status;
        $item->recommended = $request->recommended;
        $item->best = $request->best;
        $item->save();

        if($item){
            if ($request->hasFile('images')) {
                $files = $request->file('images');
                foreach($files as $one){
                    $name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".jpg";
                    Image::make($one)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/products/$name");
                    $newAttach = new Attatchment();
                    $newAttach-> product_id=$id;
                    $newAttach->name = $name ;
                    $newAttach->save();
                }
            }

            return redirect()->back()->with('status', __('common.update'));
        }
        return redirect()->back()->with('error', __('common.whoops'));

    }
    
    



    public function destroy($id)
    {
        // return $id;
        $item = Product::query()->findOrFail($id);
        if ($item) {
            Product::query()->where('id', $id)->delete();
            ProductTranslation::query()->where('product_id', $id)->delete();
            //Attatchments::query()->where('foreign_id',$id)->where('type',2)->delete();
            return "success";
        }
        return "fail";
    }


     public function delete_attatchment($id)
    {
        $attatchment_delete = Attatchment::find($id);
        if ($attatchment_delete->delete()) {
            return 'success';
        }
        return 'fail';
    }




    public function changeStatus(Request $request)
    {
        //return $request->all();
        if ($request->event == 'delete') {
            Product::query()->whereIn('id', $request->IDsArray)->delete();
        } else {
            Product::query()->whereIn('id', $request->IDsArray)->update(['status' => $request->event]);
        }
        return $request->event;
    }





    public function checkBarCode($barcode , Request $request)
    {
       $product =  Product::query()->where('barCode', $barcode)->first();
        return $product;
    }
















}
