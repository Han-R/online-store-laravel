<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Department;
use App\Models\SubCategory;
use App\Models\Slider;
use App\Models\Page;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Quantity;
use App\Models\ProductTranslation;
use App\Models\DepartmentTranslation;
use Illuminate\Http\Request;
use Auth;



class SiteController extends Controller
{

    public function index(Request $request)
    {

        $sliders = Slider::all()->take(3);

        $recommended_products = Product::where('recommended',1)->inRandomOrder()->take(5)->get();
        $discountProducts = Product::query()->where('discount','>','0')->inRandomOrder()->take(3)->get();
        $topSales = Product::query()->where('sales','>',0)->orderBy('sales','des')->take(3)->get();
        $topViews = Product::with('images')->where('click_count','>',0)->orderBy('click_count','desc')->take(3)->get();




        return view('website.index',[
            'sliders' => $sliders,
            'recommended_products' => $recommended_products,
            'discountProducts' => $discountProducts,
            'topSales'=>$topSales,
            'topViews'=>$topViews,

        ]);
    }
    public function contact()
    {
        return view('website.contact_us');
    }
    //show sub category for selected category
    public function showPage($id)
    {
        //$items = Category::with('subCategories')->where('id',$id)->get();
        $items = Category::with('subCategories')->where('id',$id)->get();
        $offers = Product::with('category')->where('category_id',$id)->where('discount','>','0')->get();
        $viewed_products = Product::with('images')->where('click_count','>',0)->orderBy('click_count','desc')->take(3)->get();
        return view('website.page',[
            'items' => $items,
            'offers' =>$offers,
            'viewed_products'=>$viewed_products,
        ]);
    }


    //show all products for selected sub category
    public function showAllProducts($id)
    {
        $department_name="";
        $category_name="";
        $subcategory_name="";
        $items = Product::with('images')->where('sub_category_id',$id)->paginate(5);
        $item = Product::where('sub_category_id',$id)->first();

        if($item){
            $department_name = $item->department()->first();
            $category_name = $item->category()->first();
            $subcategory_name = $item->sub_category()->first();
        }

        return view('website.page_details',[
            'items' => $items,
            '$item'=>$item,
            'department_name'=>$department_name,
            'category_name'=>$category_name,
            'subcategory_name'=>$subcategory_name,

        ]);
    }

//    public function showProduct($id=null)

    public function showProduct($id)
    {
        $check_cart='';
        $check_whishlist='';
        if(Auth::check()){
            $check_cart =  Cart::where(['user_id'=>Auth::user()->id,'product_id'=>$id])->first();
            $check_whishlist =  Wishlist::where(['user_id'=>Auth::user()->id,'product_id'=>$id])->first();
        }
        $item = Product::with('images')->where('id',$id)->first();
        //$item = json_decode(json_encode($item));
        //echo "<pre>"; print_r($item); die;
        // Get all reviews that are not spam for the product and paginate them
        $reviews = $item->reviews()->with('user')->approved()->notSpam()->orderBy('created_at','desc')->paginate(3);
        $viewed_products = Product::with('images')->where('click_count','>',0)->orderBy('click_count','desc')->take(3)->get();
        $stock=Quantity::where('product_id',$id)->first();

        return view('website.Details',[
            'item' => $item,
            'reviews' => $reviews,
            'viewed_products'=>$viewed_products,
            'stock'=>$stock,
            'check_cart'=>$check_cart,
            'check_whishlist'=>$check_whishlist,
        ]);
    }

    public function showReviews($id)
    {
        $item = Product::with('images')->where('id',$id)->first();
        //$item = json_decode(json_encode($item));
        //echo "<pre>"; print_r($item); die;
        // Get all reviews that are not spam for the product and paginate them
        $reviews = $item->reviews()->approved()->notSpam()->orderBy('created_at','desc')->paginate(5);

        return view('website.review',[
            'item'=>$item,
            'reviews' => $reviews,
        ]);
    }

    public function sendContact(Request $request)
    {
        $message = new Contact();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->mobile = $request->mobile;

        $message->save();
        return redirect()->back();

    }

    public function aboutUs()
    {
        $about=Page::where('name','about_us')->first();
        return view('website.about_us',['about'=>$about]);
    }

    public function termsOfUse()
    {
        $terms_use=Page::where('name','terms_of_use')->first();
        return view('website.term_of_use',['terms_use'=>$terms_use]);
    }


    public function search(Request $request)
    {
        $categories = Category::with('subCategories')->get();
        $departments = Department::all();
        $search = $request->search;

        $items = Product::query();
        if ($request->has('search') && $request->search != '' ) {
            if ($request->get('search') != null)
                $ides_product = ProductTranslation::where('name','Like','%'.$request->get('search').'%')->where('locale', app()->getLocale())->pluck('product_id')->toArray();
            //return $ides_product;
            $items->whereIn('id',$ides_product);
        }


        $items = $items->orderBy('id', 'desc')->paginate(5)->appends([
            "search" => $search
        ]);

        return view('website.products', [
            'items' => $items,
            'categories' => $categories,
            'departments' =>$departments,
        ]);

    }

    public function offers($id=null)
    {
        $departments = Department::all();

        if($id!=0){
            $offers = Product::where('discount','>',0)->where('department_id',$id)->orderBy("id","desc")->paginate(5);

            return view('website.offer', ['offers' =>$offers,
                    'departments' =>$departments,]);

        }else{

            $offers = Product::where('discount','>',0)->orderBy("id","desc")->paginate(5);
            return view('website.offer', ['offers' =>$offers,
                    'departments' =>$departments,]);

        }

    }

    public function addClick($id)
    {
        Product::where('id', $id)->increment('click_count');

        return['status'=>'done'];

    }



    public function privacyPolicy()
    {
        $privacy_policy=Page::where('name','privacy_policy')->first();
        return view('website.privacy_policy',['privacy_policy'=>$privacy_policy]);
    }






}
