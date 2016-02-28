<?php


use LinkThrow\Billing\Gateways\Local\Models\Plan;

Route::group(['middleware' => 'web'], function() {
    /**
     * Switch between the included languages
     */
    Route::group(['namespace' => 'Language'], function () {
        require (__DIR__ . '/Routes/Language/Language.php');
    });

    /**
     * Frontend Routes
     * Namespaces indicate folder structure
     */
    Route::group(['namespace' => 'Frontend'], function () {
        require (__DIR__ . '/Routes/Frontend/Frontend.php');
        require (__DIR__ . '/Routes/Frontend/Access.php');
    });
});

/**
 * Backend Routes
 * Namespaces indicate folder structure
 * Admin middleware groups web, auth, and routeNeedsPermission
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'middleware' => 'admin'], function () {
    /**
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     */
    require (__DIR__ . '/Routes/Backend/Dashboard.php');
    require (__DIR__ . '/Routes/Backend/Access.php');
    require (__DIR__ . '/Routes/Backend/Master.php');
    require (__DIR__ . '/Routes/Backend/Reseller.php');
    require (__DIR__ . '/Routes/Backend/LogViewer.php');
});

require (__DIR__ . '/Routes/API/API.php');

Route::get('/foo',function(){



    $client = App\Models\Reseller\Client\Client::find(4);
    $api = \App\Models\Reseller\ApiKey\ApiKey::find(35);
    $sub = $api->subscription();
    dd($sub->toArray());
//    $api->subscription()->increment();
//

////    $client->billing()->withCardToken('token')->create();
//    $client->subscriptions('test')->create($api);
////    $api->subscription('test')->resume();
//    if($api->subscribed())
//        echo $api->customer();


//    try{
//        return Artisan::call('laravel-billing:local:create-plan',
//            [
//                'key' => 'foossfa',
//                'name' => 'Fuck you dumb',
//                'amount' => 1,
//                'interval' => 'monthly',
//                'trial' => 7
//            ]
//        );
//    } catch (Exception $e) {
//        Response::make($e->getMessage(), 500);
//    }

});