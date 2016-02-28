<?php

namespace App\Providers;

use App\Services\Access\Access;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Class AccessServiceProvider
 * @package App\Providers
 */
class ResellerServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Package boot method
     */
    public function boot()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    /**
     * Register service provider bindings
     */
    public function registerBindings()
    {

        $this->app->bind(
            \App\Repositories\Backend\Reseller\Client\ClientContract::class,
            \App\Repositories\Backend\Reseller\Client\EloquentClientRepository::class
        );

        $this->app->bind(
            \App\Repositories\Backend\Reseller\ApiKey\ApiKeyContract::class,
            \App\Repositories\Backend\Reseller\ApiKey\EloquentApiKeyRepository::class
        );

        $this->app->bind(
            \App\Repositories\Backend\Reseller\Reseller\ResellerContract::class,
            \App\Repositories\Backend\Reseller\Reseller\EloquentResellerRepository::class
        );

        $this->app->bind(
            \App\Repositories\Backend\Reseller\SubscriptionPlan\SubscriptionPlanContract::class,
            \App\Repositories\Backend\Reseller\SubscriptionPlan\EloquentSubscriptionPlanRepository::class
        );
    }

}