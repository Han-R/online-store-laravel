<?php
Route::get('/admin', function () {
    return redirect('ar/admin');
});

Route::get('/home', function () {
    return redirect('ar/index');
});
Route::get('/welcome', function () {
    return redirect('ar/welcome');
});
Route::get('/index', function () {
    return redirect('ar/index');
});
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

        Route::get('/home', function () {
            return redirect('/');
        });
        Route::get('/welcome', function () {
            return redirect('/');
        });
        Route::get('/index', function () {
            return redirect('/');
        });
//Auth::routes();

//this for user routes
     //this route for track click
    Route::get('/product/track-click/{id}', 'Site\SiteController@addClick');
    //user login
    Route::get('/login','Site\UserController@showLoginForm')->name('userLogin');
    Route::post('/login', 'Site\UserController@login');
    Route::get('logout', 'Site\UserController@logout')->name('userLogout');
    //show user profile
    Route::get('/profile','Site\UserController@showProfile')->middleware('auth:web');
    //submit rate for product
    Route::post('/rate', 'Site\UserController@addRate')->name('addRate');
    //show all reviews for specific product
    Route::get('/showReviews/{id}', 'Site\SiteController@showReviews')->name('showReviews');
    //show edit profile form
    Route::get('/editProfile','Site\UserController@showEditProfileForm');
    //post updated profile data
    Route::patch('/editProfile','Site\UserController@editProfile')->name('user.update');
    //user forget password
    Route::post('password/email', 'Auth\ForgotPasswordController@getResetToken')->name('password.email');
//    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    //user reset password
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');


    Route::post('/join_us','Site\UserController@signUp');
    Route::post('changeOrderStatus','Site\SiteController@changeOrderStatus')->middleware('auth:web');
    Route::post('/contact', 'Site\SiteController@sendContact');
    Route::post('/changePassword','Site\UserController@changePasswordPost')->middleware('auth:web');

    //routes for wishlist
    Route::get('wishlist', 'Site\WishlistController@wishlistPage')->name('showWishlist')->middleware('auth:web');
    Route::post('/addToWishlistFromProductPage','Site\WishlistController@addToWishlistFromProductPage')->name('addToWishlistFromProductPage')->middleware('auth:web');
    Route::delete('/removeFromWishlist/{id}','Site\WishlistController@removeproduct')->name('deleteWishlist')->middleware('auth:web');

    //route for show cart and empty cart
    Route::get('cart', 'Site\CartController@CartPage')->name('showCart')->middleware('auth:web');
    //route for delete product from cart
    Route::delete('/removeFromCart/{id}','Site\CartController@removeproduct')->name('deleteCart')->middleware('auth:web');
    //route for add to cart from index page
    Route::get('addToCart/{id}','Site\CartController@addProductToCart')->middleware('auth:web');
    //routes for change quantity
    Route::get('/increaseQuantity/{id}','Site\CartController@increaseQuantity')->name('increaseQuantity')->middleware('auth:web');
    Route::get('/decreaseQuantity/{id}','Site\CartController@decreaseQuantity')->name('decreaseQuantity')->middleware('auth:web');
    //route for add product from product details page
    //Route::get('/addToCartFromProductPage','Site\CartController@addToCartFromProductPage')->middleware('auth:web');
    Route::post('/addToCartFromProductPage','Site\CartController@addToCartFromProductPage')->name('addToCartFromProductPage')->middleware('auth:web');
    Route::get('/page/{id}','Site\SiteController@showPage');
    //show all products for selected sub category
    Route::get('/products/{id}','Site\SiteController@showAllProducts');
    //route for show product details
    Route::get('/product/{id}','Site\SiteController@showProduct')->name('showProductDetailsPage');

    Route::post('/subscribe','Site\SiteController@subscribe');

    Route::get('removeFavorite/{id}','Site\SiteController@removeFavorite')->middleware('auth:web');
    Route::get('addToFavorite/{id}','Site\SiteController@addToFavorite')->middleware('auth:web');
    //for show and post checkout page
    Route::get('/checkout','Site\CartController@checkOutView')->middleware('auth:web');
    Route::post('/checkout','Site\CartController@checkOut')->middleware('auth:web');
    Route::post('deliveryCost', 'Site\CartController@deliveryCost')->middleware('auth:web');



    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/', 'Site\SiteController@index')->name('home');
    Route::get('/register','Site\UserController@register');
    Route::get('/forgotPassword','Site\UserController@forgetPassword')->name('forget_password_user');
    Route::get('password/reset/{token}', 'Site\UserController@showResetForm')->name('password.reset');
    Route::get('/myAccount','Site\SiteController@myAccount')->middleware('auth:web');
    Route::get('/changePassword','Site\UserController@changePassword')->middleware('auth:web');
    
    

    Route::get('/offers/{id?}','Site\SiteController@offers')->name('show_offers');


    Route::get('/about-us','Site\SiteController@aboutUs');
    Route::get('/terms-of-use','Site\SiteController@termsOfUse');
    Route::get('/privacy-policy','Site\SiteController@privacyPolicy');
    Route::get('/warranty','Site\SiteController@warranty');

    Route::get('/contact-us', 'Site\SiteController@contact');

    //search about product
    Route::get('/search','Site\SiteController@search')->name('search');
    Route::post('/search','Site\SiteController@search')->name('submitSearch');


    Route::get('myFavorites','Site\SiteController@myFavorites')->middleware('auth:web');
    Route::get('myOrders','Site\SiteController@myOrders')->middleware('auth:web');


//this for admin

        Route::group(['prefix' => 'admin'], function () {
            Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
            Route::post('/login', 'AdminAuth\LoginController@login');
            Route::get('/logout', 'AdminAuth\LoginController@logout')->name('logout');

            Route::group(['middleware' => ['web', 'admin']], function () {
                Route::get('/', 'Admin\HomeController@index');
                Route::get('/home', 'Admin\HomeController@index');
                Route::get('/edit_profile', 'Admin\HomeController@edit_profile')->name('edit_profile');
                Route::get('/change_password', 'Admin\HomeController@change_password')->name('change_password');
                Route::post('/edit_profile', 'Admin\HomeController@edit_profile_post')->name('edit_profile_post');
                Route::post('/change_password', 'Admin\HomeController@change_password_post')->name('change_password_post');

                // admin _Manager
                Route::get('/managers', 'Admin\ManagerController@index');
                Route::post('/managers', 'Admin\ManagerController@store');
                Route::get('/managers/create', 'Admin\ManagerController@create');
                Route::delete('managers/{id}', 'Admin\ManagerController@destroy');
                Route::get('/managers/{id}/edit', 'Admin\ManagerController@edit');
                Route::post('/managers/{id}', 'Admin\ManagerController@update');
                Route::get('/managers/{id}/edit_password', 'Admin\ManagerController@edit_password');
                Route::post('/managers/{id}/edit_password', 'Admin\ManagerController@update_password');

                Route::get('/users', 'Admin\UserController@index');
                Route::post('/users', 'Admin\UserController@store');
                Route::get('/users/create', 'Admin\UserController@create');
                Route::delete('users/{id}', 'Admin\UserController@destroy');
                Route::get('/users/{id}/edit', 'Admin\UserController@edit');
                Route::post('/users/{id}', 'Admin\UserController@update');
                Route::post('/changeStatus/users', 'Admin\UserController@changeStatus');
                Route::get('/users/{id}/edit_password', 'Admin\UserController@edit_password');
                Route::post('/users/{id}/edit_password', 'Admin\UserController@update_password');

                Route::get('/departments', 'Admin\DepartmentController@index');
                Route::post('/departments', 'Admin\DepartmentController@store');
                Route::get('/department/create', 'Admin\DepartmentController@create');
                Route::delete('department/{id}', 'Admin\DepartmentController@destroy');
                Route::get('/department/{id}/edit', 'Admin\DepartmentController@edit');
                Route::post('/department/{id}', 'Admin\DepartmentController@update');
                Route::post('/changeStatus/departments', 'Admin\DepartmentController@changeStatus');

                Route::get('/categories', 'Admin\CategoryController@index');
                Route::post('/categories', 'Admin\CategoryController@store');
                Route::get('/category/create', 'Admin\CategoryController@create');
                Route::delete('category/{id}', 'Admin\CategoryController@destroy');
                Route::get('/category/{id}/edit', 'Admin\CategoryController@edit');
                Route::post('/category/{id}', 'Admin\CategoryController@update');
                Route::get('/getCategories/{id}', 'Admin\CategoryController@getCategories');

                Route::get('/subCategories', 'Admin\SubCategoriesController@index');
                Route::get('/getSubCategories/{id}', 'Admin\SubCategoriesController@getSubCategories');
                Route::post('/subCategories', 'Admin\SubCategoriesController@store');
                Route::get('/subCategory/create', 'Admin\SubCategoriesController@create');
                Route::delete('subCategory/{id}', 'Admin\SubCategoriesController@destroy');
                Route::get('/subCategory/{id}/edit', 'Admin\SubCategoriesController@edit');
                Route::post('/subCategory/{id}', 'Admin\SubCategoriesController@update');

                Route::get('/suppliers', 'Admin\SupplierController@index');
                Route::post('/suppliers', 'Admin\SupplierController@store');
                Route::get('/supplier/create', 'Admin\SupplierController@create');
                Route::delete('supplier/{id}', 'Admin\SupplierController@destroy');
                Route::get('/supplier/{id}/edit', 'Admin\SupplierController@edit');
                Route::post('/supplier/{id}', 'Admin\SupplierController@update');
                Route::post('/changeStatus/suppliers', 'Admin\QuantityController@changeStatus');



                Route::resource('pages', 'Admin\PagesController');


                Route::get('/slider', 'Admin\SliderController@index');
                Route::post('/slider', 'Admin\SliderController@store');
                Route::get('/slider/create', 'Admin\SliderController@create');
                Route::delete('slider/{id}', 'Admin\SliderController@destroy');
                Route::get('/slider/{id}/edit', 'Admin\SliderController@edit');
                Route::post('/slider/{id}', 'Admin\SliderController@update');
                Route::post('/changeStatus/sliders', 'Admin\SliderController@changeStatus');

                Route::get('/contact', 'Admin\ContactController@index');
                Route::get('/viewMessage/{id}', 'Admin\ContactController@viewMessage');
                Route::delete('/contact/{id}', 'Admin\ContactController@destroy');

                Route::get('/products', 'Admin\ProductController@index');
                Route::post('/products', 'Admin\ProductController@store');
                Route::get('/product/create', 'Admin\ProductController@create');
                Route::delete('product/{id}', 'Admin\ProductController@destroy');
                Route::get('/product/{id}/edit', 'Admin\ProductController@edit');
                Route::post('/product/{id}', 'Admin\ProductController@update');
                Route::post('/changeStatus/products', 'Admin\ProductController@changeStatus');
                Route::delete('delete_attatchment/{id}', 'Admin\ProductController@delete_attatchment');
                Route::get('/checkBarCode/{id}', 'Admin\ProductController@checkBarCode');


                Route::get('/quantities/{product_id}', 'Admin\QuantityController@index');
                Route::get('/addQuantity/{product_id}', 'Admin\QuantityController@create');
                Route::post('/addQuantity', 'Admin\QuantityController@addQuantity');
                Route::delete('quantity/{id}', 'Admin\QuantityController@destroy');
                Route::get('/editQuantity/{id}', 'Admin\QuantityController@edit');
                Route::post('/editQuantity/{id}', 'Admin\QuantityController@update');
                Route::post('/changeStatus/quantities', 'Admin\QuantityController@changeStatus');
                Route::post('/addQuantityByBarCode', 'Admin\QuantityController@addQuantityByBarCode');


                Route::get('/message_notifications', 'Admin\NotificationMessageController@index')->name('message_notifications.all');
                Route::post('/message_notifications', 'Admin\NotificationMessageController@store')->name('message_notifications.store');
                Route::get('/message_notifications/create', 'Admin\NotificationMessageController@create')->name('message_notifications.create');
                Route::delete('message_notifications/{id}', 'Admin\NotificationMessageController@destroy')->name('message_notifications.destroy');


                Route::resource('orders', 'Admin\OrderController');
                //Route::get('orders/orderDetails/{id}', 'Admin\OrderController@orderDetails');

                Route::resource('cart', 'Admin\CartController');


                Route::resource('wishlist', 'Admin\WishlistController');


                Route::resource('review', 'Admin\ReviewController');
                Route::get('rate', 'Admin\ReviewController@showRate');



                Route::get('/settings', 'Admin\SettingController@index');
                Route::post('/settings', 'Admin\SettingController@update');





            });


        });


});

//Route::post('/contact', 'HomeController@contactusMsg');
Route::post('/addComment', 'HomeController@addComment');
Route::post('/order', 'HomeController@order');








Route::get('/test', 'HomeController@test');

Route::get('/test2', 'HomeController@test2');
