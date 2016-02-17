<?php
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => '\App\Http\Controllers\API'], function($api) {
        $api->get('check/{api}', 'APIController@check');
        $api->get('hairstyles/{api}', 'APIController@hairstyles');
        $api->get('frames/{api}', 'APIController@frames');
        $api->get('categories/{imei}/{api}', 'APIController@categories');
    });
});