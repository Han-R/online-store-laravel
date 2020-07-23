<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use App\Models\Quantity;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\ProductTranslation;
use App\Models\Attatchment;
use App\User;
use App\Models\Language;
use App\Models\Setting;
use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuantityController extends Controller
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

    public function index($product_id, Request $request)
    {
        $product= Product::findOrFail($product_id);
        $items = Quantity::where('product_id',$product_id)->orderBy('id', 'desc')->get();
        return view('admin.quantities.home', [
            'items' => $items,
            'product' => $product,
        ]);
    }

    public function create($product_id, Request $request)
    {
        $product= Product::findOrFail($product_id);
        $suppliers = Supplier::all();

        return view('admin.quantities.create',['product'=>$product,'suppliers'=>$suppliers,]);
    }

    public function addQuantity(Request $request)
    {
        //return $request->all();

        $roles = [
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
            'price' => 'required',
            'supplier_id' => 'required',
        ];
        $this->validate($request, $roles);
        $newQuantity = new Quantity();
        $newQuantity->product_id=$request->product_id;
        $newQuantity->quantity=$request->quantity;
        $newQuantity->price=$request->price;
        $newQuantity->supplier_id=$request->supplier_id;
        $newQuantity->admin_id=auth('admin')->id();
        $newQuantity->save();
        if($newQuantity){
            return redirect()->back()->with('status', __('common.create'));
        }
        return redirect()->back()->with('error', __('common.whoops'));
    }
    public function addQuantityByBarCode(Request $request)
    {
        //return $request->all();

        $roles = [
            'barCode' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required',
            'supplier_id' => 'required',
        ];
        $this->validate($request, $roles);
        $product =  Product::query()->where('barCode', $request->barCode)->first();
        $newQuantity = new Quantity();
        $newQuantity->product_id=$product->id;
        $newQuantity->quantity=$request->quantity;
        $newQuantity->price=$request->price;
        $newQuantity->supplier_id=$request->supplier_id;
        $newQuantity->admin_id=auth('admin')->id();
        $newQuantity->save();
        if($newQuantity){
            return 'done';
        }
        return 'no';
    }

    public function show($id)
    {
        return Product::query()->findOrFail($id);
    }

    public function edit(Request $request,$id)
    {
        $item= Quantity::findOrFail($id);
        $product= Product::findOrFail($item->product_id);
        $suppliers = Supplier::all();

        return view('admin.quantities.edit',['suppliers'=>$suppliers,'item'=>$item,'product'=>$product]);
    }

    public function update(Request $request, $id)
    {
        // return $request->all();
        $roles = [
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
            'price' => 'required',
            'supplier_id' => 'required',
        ];

        $this->validate($request, $roles);

        $item= Quantity::findOrFail($id);


        $item->product_id=$request->product_id;
        $item->quantity=$request->quantity;
        $item->price=$request->price;
        $item->supplier_id=$request->supplier_id;
        $item->admin_id=auth('admin')->id();
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
        $item = Quantity::query()->findOrFail($id);
        if ($item) {
            Quantity::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }






    public function changeStatus(Request $request)
    {
        //return $request->all();
        if ($request->event == 'delete') {
            Quantity::query()->whereIn('id', $request->IDsArray)->delete();
        } else {
            Quantity::query()->whereIn('id', $request->IDsArray)->update(['status' => $request->event]);
        }
        return $request->event;
    }
















}
