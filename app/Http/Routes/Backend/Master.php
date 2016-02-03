<?php

Route::group([
    'prefix' => 'master',
    'namespace' => 'Master',
    'middleware' => 'access.routeNeedsPermission:view-master',
], function(){
   /**
    * Categories
    */
    Route::group(['namespace' => 'Category'] , function(){
        Route::resource('category', 'CategoryController', ['except' => ['show']]);
    });
    Route::group(['namespace' => 'Frame'] , function(){
        Route::resource('frame', 'FrameController', ['except' => ['show']]);
    });
    Route::group(['namespace' => 'Hairstyle'] , function(){
        Route::resource('hairstyle', 'HairstyleController', ['except' => ['show']]);
    });
});