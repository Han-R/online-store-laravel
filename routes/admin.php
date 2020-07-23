<?php
/*
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Route::get('/', 'AdminAuth\HomeController@home');
    Route::get('/home', 'AdminAuth\HomeController@home');
    Route::get('/settings', 'AdminAuth\HomeController@settings');
    Route::post('/Edit_Settings', 'AdminAuth\HomeController@Edit_Settings');


    Route::get('/teams', 'AdminAuth\HomeController@teams');
    Route::get('/team_create', 'AdminAuth\HomeController@team_create');
    Route::post('/team_create', 'AdminAuth\HomeController@team_create_post');
    Route::get('/team_edit/{team_id}', 'AdminAuth\HomeController@team_edit');
    Route::post('/team_edit', 'AdminAuth\HomeController@team_edit_post');
    Route::get('/team_delete/{team_id}', 'AdminAuth\HomeController@team_delete');

    Route::get('/clients', 'AdminAuth\HomeController@clients');
    Route::get('/client_create', 'AdminAuth\HomeController@client_create');
    Route::post('/client_create', 'AdminAuth\HomeController@client_create_post');
    Route::get('/client_edit/{client_id}', 'AdminAuth\HomeController@client_edit');
    Route::post('/client_edit', 'AdminAuth\HomeController@client_edit_post');
    Route::get('/client_delete/{client_id}', 'AdminAuth\HomeController@client_delete');

    Route::get('/works', 'AdminAuth\HomeController@works');
    Route::get('/work_create', 'AdminAuth\HomeController@work_create');
    Route::post('/work_create', 'AdminAuth\HomeController@work_create_post');
    Route::get('/work_edit/{work_id}', 'AdminAuth\HomeController@work_edit');
    Route::post('/work_edit', 'AdminAuth\HomeController@work_edit_post');
    Route::get('/work_delete/{work_id}', 'AdminAuth\HomeController@work_delete');
    Route::get('/deleteAttachment/{attach_id}', 'AdminAuth\HomeController@deleteAttachment');

    Route::get('/blogs', 'AdminAuth\HomeController@blogs');
    Route::get('/blog_create', 'AdminAuth\HomeController@blog_create');
    Route::post('/blog_create', 'AdminAuth\HomeController@blog_create_post');
    Route::get('/blog_edit/{blog_id}', 'AdminAuth\HomeController@blog_edit');
    Route::post('/blog_edit', 'AdminAuth\HomeController@blog_edit_post');
    Route::get('/blog_delete/{blog_id}', 'AdminAuth\HomeController@blog_delete');

    Route::get('/pages', 'AdminAuth\HomeController@pages');
    Route::get('/page_create', 'AdminAuth\HomeController@page_create');
    Route::post('/page_create', 'AdminAuth\HomeController@page_create_post');
    Route::get('/page_edit/{page_id}', 'AdminAuth\HomeController@page_edit');
    Route::post('/page_edit', 'AdminAuth\HomeController@page_edit_post');
    Route::get('/page_delete/{page_id}', 'AdminAuth\HomeController@page_delete');

    Route::get('/sentences', 'AdminAuth\HomeController@sentences');
    Route::get('/sentence_create', 'AdminAuth\HomeController@sentence_create');
    Route::post('/sentence_create', 'AdminAuth\HomeController@sentence_create_post');
    Route::get('/sentence_edit/{sentence_id}', 'AdminAuth\HomeController@sentence_edit');
    Route::post('/sentence_edit', 'AdminAuth\HomeController@sentence_edit_post');
    Route::get('/sentence_delete/{sentence_id}', 'AdminAuth\HomeController@sentence_delete');

    Route::get('/testimonials', 'AdminAuth\HomeController@testimonials');
    Route::get('/testimonial_create', 'AdminAuth\HomeController@testimonial_create');
    Route::post('/testimonial_create', 'AdminAuth\HomeController@testimonial_create_post');
    Route::get('/testimonial_edit/{testimonial_id}', 'AdminAuth\HomeController@testimonial_edit');
    Route::post('/testimonial_edit', 'AdminAuth\HomeController@testimonial_edit_post');
    Route::get('/testimonial_delete/{testimonial_id}', 'AdminAuth\HomeController@testimonial_delete');

    Route::get('/orders', 'AdminAuth\HomeController@orders');
    Route::get('/order_view/{order_id}', 'AdminAuth\HomeController@order_view');

    Route::get('/contacts', 'AdminAuth\HomeController@contacts');
    Route::get('/contact_view/{contact_id}', 'AdminAuth\HomeController@contact_view');
});