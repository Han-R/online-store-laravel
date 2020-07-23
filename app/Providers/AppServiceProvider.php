<?php

namespace App\Providers;
use App\Admin;
use App\Models\City;
use App\Models\Contact;
use App\Models\Department;
use App\Models\Language;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Slider;
use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);
        view()->composer('*', function ($view) 
        {
            $cart = 0;
            if(Auth::check()){
                $cart = Cart::where('user_id', Auth::user()->id)->count();
            }

            $wishlist = 0;
            if(Auth::check()){
                $wishlist = Wishlist::where('user_id', Auth::user()->id)->count();
            }


            //...with this variable
            $view->with([
            'setting' => Setting::query()->first(),
            'locales'=> Language::all(),
            'categories'=> Category::get(),
            'departments'=>Department::all(),
            'admin'=>Admin::first(),
            'contact'=> Contact::where('seen',0)->count(),
                'order'=>Order::where('status','0')->count(),
            'cart'=>$cart,
             'wishlist'=>$wishlist,

        ]); 
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register('Hesto\MultiAuth\MultiAuthServiceProvider');
        }
    }
}
