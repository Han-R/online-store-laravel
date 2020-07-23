<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Image;
use App\Admin;
use App\Models\Setting;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    protected $settings = '';
    protected $locales = '';
    //   protected $sentences = '';

    public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::orderBy('id','desc')->first();
        //   $this->sentences = Sentence::get();

        view()->share('locales', $this->locales);
        view()->share('setting', $this->settings);
        //   view()->share('sentences', $this->sentences);
        // view()->share('pages', $this->pages);
        // view()->share('meal', $this->meal);
    }

    public function index()
    {

        $count_users = User::count();
        $count_orders = Order::count();
        $count_products = Product::count();
        $count_categories = Category::count();
        $suppliers = Supplier::all();

        return view('admin.dashboard'
            ,[
                'count_users'=>$count_users,
                'count_orders'=>$count_orders,
                'count_products'=>$count_products,
                'count_categories'=>$count_categories,
                'suppliers'=>$suppliers,

            ]
        );
    }


    public function edit_profile()
    {
        $item = auth('admin')->user();
        return view('admin.edit_profile', ['item' => $item]);
    }


    public function change_password()
    {
        return view('admin.change_password');
    }

    public function edit_profile_post(Request $request)
    {
        $id = auth('admin')->user()->id;
        $validator = Validator::make($request->all(), [
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:admins,id,'.$id,
            'mobile'=>'required|min:10|max:14|unique:admins,id,'.$id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $admin= Admin::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $name = str_random(15) . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . ".jpg";
            Image::make($avatar)->resize(800, null, function ($constraint) {$constraint->aspectRatio();})->save("uploads/managers/$name");
            $admin->avatar = $name;
        }
        $admin->save();
        return redirect()->back()->with('status', __('common.update'));
    }

    public function change_password_post(Request $request)
    {
        $id = auth('admin')->user()->id;
        $users_rules=array(
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password|min:6',
        );
        $users_validation=Validator::make($request->all(), $users_rules);

        if($users_validation->fails())
        {
            return redirect()->back()->withErrors($users_validation)->withInput();
        }
        $admin = Admin::findOrFail($id);
        $admin->password = bcrypt($request->password);
        $admin->save();


        return redirect()->back()->with('status', __('common.update'));
    }



    public function privacy()
    {
        $privacy = Setting::query()->where('key', 'privacy')->firstOrFail();
        return view('layout.extra', ['title' => 'Privacy and Policy', 'item' => $privacy]);
    }

    public function terms()
    {
        $privacy = Setting::query()->where('key', 'terms')->firstOrFail();
        return view('layout.extra', ['title' => 'Terms And Conditions', 'item' => $privacy]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
