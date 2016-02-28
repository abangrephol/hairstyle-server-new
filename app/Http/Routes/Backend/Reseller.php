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
        Route::get('apikey/{id}/mark/{status}', 'ApiKeyController@mark')->name('admin.reseller.apikey.mark')->where(['status' => '[0,1]']);
        Route::get('apikey/changeplan/{id}', 'ApiKeyController@changePlan')->name('admin.reseller.apikey.changeplan');
        Route::patch('apikey/change/{id}','ApiKeyController@change')->name('admin.reseller.apikey.change');
    });
    Route::group(['namespace' => 'SubscriptionPlan','prefix'=>'subscription'] , function(){
        Route::resource('plan', 'SubscriptionPlanController', ['except' => ['show']]);

    });
});