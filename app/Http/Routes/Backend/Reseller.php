<?php

Route::group([
    'prefix' => 'reseller',
    'namespace' => 'Reseller',
    'middleware' => 'access.routeNeedsPermission:view-reseller',
], function(){
    /**
     * Resellers
     */

    Route::resource('users', 'ResellerController', ['except' => ['show']]);
    Route::group(['namespace' => 'Client'] , function(){
        Route::resource('client', 'ClientController', ['except' => ['show']]);
    });
    Route::group(['namespace' => 'ApiKey'] , function(){
        Route::resource('apikey', 'ApiKeyController', ['except' => ['show']]);
    });
});