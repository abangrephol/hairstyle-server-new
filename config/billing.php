<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Default Billing Gateway Driver
	|--------------------------------------------------------------------------
	|
	| The Billing API supports a variety of gateways via an unified
	| API, giving you convenient access to each gateway using the same
	| syntax for each one. Here you may set the default billing gateway driver.
	|
	| Supported: "stripe", "braintree", "local"
	|
	*/

	'default' => 'local',

	/*
	|--------------------------------------------------------------------------
	| Customer Models
	|--------------------------------------------------------------------------
	|
	| Define all of the model classes that act as a billing customer.
	|
	*/

	'customer_models' => ['Client'],

	/*
	|--------------------------------------------------------------------------
	| Subscription Models
	|--------------------------------------------------------------------------
	|
	| Define all of the model classes that act as a billing subscription.
	|
	*/

	'subscription_models' => ['ApiKey'],

	/*
	|--------------------------------------------------------------------------
	| Gateway Connections
	|--------------------------------------------------------------------------
	|
	| Here you may configure the connection information for the gateway that
	| is used by your application. A default configuration has been added
	| for each gateway shipped with Billing. You are free to add more.
	|
	*/

	'gateways' => array(

		'stripe' => array(
			'secret' => '',
		),

		'braintree' => array(
			'environment' => '',
			'merchant'    => '',
			'public'      => '',
			'private'     => '',
		),

		'local' => array(
//			'database' => array(
//				'driver'   => 'sqlite',
//				'database' => storage_path().'/meta/billing-local.sqlite',
//				'prefix'   => '',
//			),
			'database' => array(
				'driver'    => 'mysql',
				'host'      => env('DB_HOST', 'localhost'),
				'database'  => env('DB_DATABASE', 'forge'),
				'username'  => env('DB_USERNAME', 'forge'),
				'password'  => env('DB_PASSWORD', ''),
				'charset'   => 'utf8',
				'collation' => 'utf8_unicode_ci',
				'prefix'    => 'billing_',
				'strict'    => false,
			),
			'api_delay_ms' => 200,
		),

	),

);
