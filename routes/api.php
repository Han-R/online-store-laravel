<?php

Route::post('/login', 'API\UserController@login');
Route::post('/signUp', 'API\UserController@signUp');
Route::post('password/email', 'Auth\ForgotPasswordController@getResetToken');

Route::get('ads',   'API\AdsController@random');
Route::get('slider','API\SliderController@index');

Route::get('/ContactInfo', 'API\ContactController@index');
Route::post('/ContactUs', 'API\ContactController@store');

Route::get('/privacy-policy',  'API\PagesController@privacy');
Route::get('/terms-conditions','API\PagesController@terms');
Route::get('/about-us',        'API\PagesController@about');

Route::get('/products/newest','API\ProductController@newest');
Route::get('/products/{id}/same-product','API\ProductController@sameProduct');
Route::get('/products',       'API\ProductController@index');
Route::get('/products/{id}',  'API\ProductController@show');


Route::group(['middleware' => 'auth:api'], function(){

    Route::post('/add-cart',  'API\ProductController@add_cart');

    Route::post('/favouriteProduct/{product_id}', 'API\ProductController@favouriteProduct');
    Route::post('/unFavouriteProduct/{product_id}', 'API\ProductController@unFavouriteProduct');
    Route::get('/myFavouriteProducts', 'API\ProductController@myFavouriteProducts');

    Route::post('/changePassword','API\UserController@changePassword');
    Route::get('/logout'         ,'API\UserController@logout');
    Route::post('/editUser'      ,'API\UserController@editUser');
});

Route::get('/get_currencies', function () {
    //return currencyConverter('KWD','AED',10);
    $currencies = json_decode(file_get_contents('http://www.apilayer.net/api/live?access_key=fb5c244930a29f4bc511acdc8b5c44cc'), true);
    if ($currencies['success']) {
        foreach ($currencies['quotes'] as $country => $amount) {
            \App\Models\Currency::query()->where('name', substr($country, 3, 3))->update([
                'usd_value' => $amount
            ]);
            //return [substr($country,3,3), $amount];
        }
    }
})->name('get_currencies');
//Route::post('password/email', 'Auth\ForgotPasswordController@getResetToken');